<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UsersController
 * 
 * Automatically generated via CLI.
 */
class UsersController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('UserModel');
        $this->call->model('AccountModel');
        $this->call->library('form_validation');
        $this->call->helper('security');
    }

    public function index()
    {
        $this->show_users();
    }

    public function create()
    {
        $this->show_users();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->call->view('users/register', [
                'errors' => [],
                'old' => []
            ]);
            return;
        }

        $post = $this->io->post();
        $username = trim($post['username'] ?? '');
        $password = (string) ($post['password'] ?? '');
        $confirmation = (string) ($post['password_confirmation'] ?? '');
        $errors = [];

        if (!preg_match('/^[A-Za-z0-9_]{3,100}$/', $username)) {
            $errors[] = 'Username must be 3 to 100 characters and contain only letters, numbers, or underscores.';
        }
        if (strlen($password) < 8) {
            $errors[] = 'Password must be at least 8 characters.';
        }
        if ($password !== $confirmation) {
            $errors[] = 'Passwords do not match.';
        }
        if ($this->AccountModel->getByUsername($username)) {
            $errors[] = 'Username is already registered.';
        }

        if (!empty($errors)) {
            $this->call->view('users/register', [
                'errors' => $errors,
                'old' => ['username' => $username]
            ]);
            return;
        }

        $this->AccountModel->create([
            'username' => $username,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'is_active' => 1
        ]);

        redirect('users/register?registered=1');
    }

    public function store()
    {
        $this->validate_user();

        if (!$this->form_validation->run()) {
            $this->show_users([
                'errors' => $this->form_validation->get_errors(),
                'old' => $_POST
            ]);
            return;
        }

        $this->UserModel->insert([
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'role' => $_POST['role'] ?? '',
            'is_active' => 1
        ]);

        header('Location: /users');
        exit;
    }

    public function update($id)
    {
        $user = $this->UserModel->find((int) $id);
        if (!$user) {
            http_response_code(404);
            exit('User not found.');
        }

        $this->validate_user((int) $id);

        if (!$this->form_validation->run()) {
            $this->show_users([
                'errors' => $this->form_validation->get_errors(),
                'old' => $_POST,
                'editing_id' => (int) $id
            ]);
            return;
        }

        $data = [
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'role' => $_POST['role'] ?? '',
            'is_active' => (int) ($_POST['is_active'] ?? 0)
        ];

        if (!empty($_POST['password'])) {
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        $this->UserModel->update((int) $id, $data);

        header('Location: /users');
        exit;
    }

    public function delete($id)
    {
        if (!$this->UserModel->find((int) $id)) {
            http_response_code(404);
            exit('User not found.');
        }

        $this->UserModel->delete((int) $id);

        header('Location: /users');
        exit;
    }

    private function validate_user($id = null)
    {
        $this->form_validation
            ->name('username')->required()->min_length(3)->max_length(100)->pattern('alphanum')
            ->name('email')->required()->valid_email()->max_length(255)
            ->name('role')->required()->in_list('admin,moderator,user')
            ->name('is_active')->required()->in_list('0,1');

        $existing = $this->UserModel->find_by('username', trim($_POST['username']));
        if ($existing && (int) $existing['id'] !== (int) $id) {
            $this->form_validation->errors[] = 'Username already exists.';
        }

        $existing = $this->UserModel->find_by('email', trim($_POST['email']));
        if ($existing && (int) $existing['id'] !== (int) $id) {
            $this->form_validation->errors[] = 'Email already exists.';
        }

        if ($id === null) {
            $this->form_validation->name('password')->required()->min_length(8)->max_length(255);
        } elseif (!empty($_POST['password'])) {
            $this->form_validation->name('password')->min_length(8)->max_length(255);
        }
    }

    private function show_users($extra = [])
    {
        $data = array_merge([
            'users' => $this->UserModel->all(),
            'errors' => [],
            'old' => [],
            'editing_id' => null
        ], $extra);

        $this->call->view('users/index', $data);
    }
}
