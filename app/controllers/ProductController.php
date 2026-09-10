<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('ProductModel');
        $this->call->model('AccountModel');
        $this->call->library('form_validation');
        $this->call->helper('security');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->call->view('products/login', [
                'errors' => [],
                'old' => []
            ]);
            return;
        }

        $post = $this->io->post();
        $username = trim($post['username'] ?? '');
        $password = (string) ($post['password'] ?? '');
        $account = $this->AccountModel->getByUsername($username);

        if (!$account || !(int) ($account['is_active'] ?? 0) || !password_verify($password, $account['password_hash'])) {
            $this->call->view('products/login', [
                'errors' => ['Invalid username or password.'],
                'old' => ['username' => $username]
            ]);
            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int) $account['id'];
        $_SESSION['user'] = [
            'id' => (int) $account['id'],
            'username' => $account['username']
        ];

        redirect('products');
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        redirect('products/login');
    }

    public function products()
    {
        $this->show_products();
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->call->view('products/create', [
                'errors' => [],
                'old' => []
            ]);
            return;
        }

        $this->validate_product();

        if (!$this->form_validation->run()) {
            $this->call->view('products/create', [
                'errors' => $this->form_validation->get_errors(),
                'old' => $_POST
            ]);
            return;
        }

        $this->ProductModel->insert([
            'product_name' => trim($_POST['product_name'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'price' => (float) ($_POST['price'] ?? 0),
            'quantity' => (int) ($_POST['quantity'] ?? 0)
        ]);

        header('Location: /products');
        exit;
    }

    public function edit($id)
    {
        $product = $this->ProductModel->find((int) $id);
        if (!$product) {
            http_response_code(404);
            exit('Product not found.');
        }

        $this->call->view('products/edit', [
            'product' => $product,
            'errors' => [],
            'old' => []
        ]);
    }

    public function update($id)
    {
        if (!$this->ProductModel->find((int) $id)) {
            http_response_code(404);
            exit('Product not found.');
        }

        $this->validate_product();

        if (!$this->form_validation->run()) {
            $this->call->view('products/edit', [
                'product' => $this->ProductModel->find((int) $id),
                'errors' => $this->form_validation->get_errors(),
                'old' => $_POST
            ]);
            return;
        }

        $this->ProductModel->update((int) $id, [
            'product_name' => trim($_POST['product_name'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'price' => (float) ($_POST['price'] ?? 0),
            'quantity' => (int) ($_POST['quantity'] ?? 0)
        ]);

        header('Location: /products');
        exit;
    }

    public function delete($id)
    {
        if (!$this->ProductModel->find((int) $id)) {
            http_response_code(404);
            exit('Product not found.');
        }

        $this->ProductModel->delete((int) $id);

        header('Location: /products');
        exit;
    }

    private function validate_product()
    {
        $this->form_validation
            ->name('product_name')->required()->min_length(2)->max_length(150)
            ->name('description')->max_length(1000)
            ->name('price')->required()->numeric()->greater_than_equal_to(0)
            ->name('quantity')->required()->numeric()->greater_than_equal_to(0);
    }

    private function show_products($extra = [])
    {
        $data = array_merge([
            'products' => $this->ProductModel->all(),
        ], $extra);

        $this->call->view('ProductViews', $data);
    }
}
