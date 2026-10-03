<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiAuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('AccountModel');
        $this->allowFrontendRequests();
    }

    public function login()
    {
        $data = $this->requestData();
        $username = trim((string) ($data['username'] ?? ''));
        $password = (string) ($data['password'] ?? '');
        $account = $username !== '' ? $this->AccountModel->getByUsername($username) : null;

        if (!$account || empty($account['is_active']) || $password === '' || !password_verify($password, $account['password_hash'])) {
            $this->respond(['success' => false, 'error' => 'Invalid username or password.'], 401);
            return;
        }

        $this->startSession();
        session_regenerate_id(true);
        $_SESSION['authenticated'] = true;
        $_SESSION['user_id'] = (int) $account['id'];
        $_SESSION['username'] = $account['username'];

        $this->respond([
            'success' => true,
            'data' => [
                'id' => (int) $account['id'],
                'username' => $account['username']
            ]
        ]);
    }

    public function logout()
    {
        $this->startSession();
        $_SESSION = [];
        session_destroy();
        $this->respond(['success' => true, 'message' => 'Logged out.']);
    }

    public function me()
    {
        $this->startSession();
        if (empty($_SESSION['authenticated'])) {
            $this->respond(['success' => false, 'error' => 'Authentication required.'], 401);
            return;
        }

        $this->respond([
            'success' => true,
            'data' => [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username']
            ]
        ]);
    }

    public function options()
    {
        http_response_code(204);
    }

    private function requestData()
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        if (stripos($contentType, 'application/json') !== false) {
            $data = json_decode(file_get_contents('php://input'), true);
            return is_array($data) ? $data : [];
        }
        return $_POST;
    }

    private function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function allowFrontendRequests()
    {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        if ($origin === 'http://localhost:5173' || $origin === 'http://127.0.0.1:5173') {
            header('Access-Control-Allow-Origin: ' . $origin);
            header('Access-Control-Allow-Credentials: true');
        }
        header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Content-Type: application/json; charset=UTF-8');
    }

    private function respond(array $payload, $status = 200)
    {
        http_response_code($status);
        echo json_encode($payload);
        exit;
    }
}
