<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiAuthMiddleware
{
    public function handle(Closure $next)
    {
        $this->allowFrontendRequests();

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(204);
            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION['authenticated'])) {
            return $next();
        }

        $this->respond(['success' => false, 'error' => 'Authentication required.'], 401);
    }

    private function allowFrontendRequests()
    {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        if ($origin === 'http://localhost:5173' || $origin === 'http://127.0.0.1:5173') {
            header('Access-Control-Allow-Origin: ' . $origin);
            header('Access-Control-Allow-Credentials: true');
        }
        header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Content-Type: application/json; charset=UTF-8');
    }

    private function respond(array $payload, $status)
    {
        http_response_code($status);
        echo json_encode($payload);
        exit;
    }
}