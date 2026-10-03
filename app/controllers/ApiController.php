<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->library('api');
    }

    public function login()
    {
        $this->api->require_method('POST');
        $this->api->rate_limit(null, 10, 60);

        $input = $this->api->body();
        $username = trim((string) ($input['username'] ?? ''));
        $password = (string) ($input['password'] ?? '');
        $statement = $this->db->raw(
            'SELECT id, username, password, role, is_active FROM users WHERE username = ? LIMIT 1',
            [$username]
        );
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user || !(int) $user['is_active'] || !password_verify($password, $user['password'])) {
            $this->api->respond_error('Invalid username or password.', 401);
        }

        $tokens = $this->api->issue_tokens([
            'id' => (int) $user['id'],
            'role' => $user['role'],
            'scopes' => ['products:read', 'products:write'],
        ]);

        $this->api->respond(array_merge($tokens, [
            'user' => [
                'id' => (int) $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
            ],
        ]));
    }

    public function logout()
    {
        $this->api->require_method('POST');
        $input = $this->api->body();
        $this->api->revoke_refresh_token((string) ($input['refresh_token'] ?? ''));
        $this->api->respond(['message' => 'Logged out.']);
    }

    public function me()
    {
        $this->api->require_method('GET');
        $auth = $this->api->require_jwt();
        $statement = $this->db->raw(
            'SELECT id, username, role FROM users WHERE id = ? AND is_active = 1 LIMIT 1',
            [(int) $auth['sub']]
        );
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $this->api->respond_error('User not found.', 404);
        }

        $this->api->respond(['user' => $user]);
    }

    public function products()
    {
        $this->api->require_method('GET');
        $auth = $this->api->require_jwt();
        $this->api->rate_limit('products_' . $auth['sub'], 120, 60);
        $this->api->respond(['products' => $this->allProducts()]);
    }

    public function createProduct()
    {
        $this->api->require_method('POST');
        $auth = $this->api->require_jwt();
        $this->api->rate_limit('products_' . $auth['sub'], 120, 60);
        $product = $this->validatedProduct($this->api->body());

        $this->db->raw(
            'INSERT INTO products (product_name, description, price, quantity) VALUES (?, ?, ?, ?)',
            [$product['product_name'], $product['description'], $product['price'], $product['quantity']]
        );

        $this->api->respond(['products' => $this->allProducts()], 201);
    }

    public function updateProduct($id)
    {
        $this->api->require_method('PUT');
        $auth = $this->api->require_jwt();
        $this->api->rate_limit('products_' . $auth['sub'], 120, 60);
        $id = (int) $id;
        $this->requireProduct($id);
        $product = $this->validatedProduct($this->api->body());

        $this->db->raw(
            'UPDATE products SET product_name = ?, description = ?, price = ?, quantity = ? WHERE id = ?',
            [$product['product_name'], $product['description'], $product['price'], $product['quantity'], $id]
        );

        $this->api->respond(['products' => $this->allProducts()]);
    }

    public function deleteProduct($id)
    {
        $this->api->require_method('DELETE');
        $auth = $this->api->require_jwt();
        $this->api->rate_limit('products_' . $auth['sub'], 120, 60);
        $id = (int) $id;
        $this->requireProduct($id);
        $this->db->raw('DELETE FROM products WHERE id = ?', [$id]);
        $this->api->respond(['products' => $this->allProducts()]);
    }

    public function refresh()
    {
        $this->api->require_method('POST');
        $input = $this->api->body();
        $this->api->refresh_access_token((string) ($input['refresh_token'] ?? ''));
    }

    public function options()
    {
        http_response_code(204);
    }

    private function allProducts()
    {
        $statement = $this->db->raw(
            'SELECT id, product_name, description, price, quantity, created_at FROM products ORDER BY id DESC'
        );

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    private function requireProduct($id)
    {
        $statement = $this->db->raw('SELECT id FROM products WHERE id = ? LIMIT 1', [$id]);
        if (!$statement->fetch(PDO::FETCH_ASSOC)) {
            $this->api->respond_error('Product not found.', 404);
        }
    }

    private function validatedProduct(array $input)
    {
        $productName = $input['product_name'] ?? null;
        $description = $input['description'] ?? '';
        $price = $input['price'] ?? null;
        $quantity = filter_var($input['quantity'] ?? null, FILTER_VALIDATE_INT);

        if (!is_string($productName) || !is_string($description) || !is_numeric($price) || $quantity === false) {
            $this->api->respond_error('Product data is invalid.', 422);
        }

        $productName = trim($productName);
        $price = (float) $price;
        if (
            strlen($productName) < 2 || strlen($productName) > 100 || strlen($description) > 65535 ||
            !is_finite($price) || $price < 0 || $price > 99999999.99 || $quantity < 0
        ) {
            $this->api->respond_error('Product data is invalid.', 422);
        }

        return [
            'product_name' => $productName,
            'description' => $description,
            'price' => number_format($price, 2, '.', ''),
            'quantity' => $quantity,
        ];
    }
}