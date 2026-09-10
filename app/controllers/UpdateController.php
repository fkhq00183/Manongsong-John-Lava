<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UpdateController
 * 
 * Automatically generated via CLI.
 */
class UpdateController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }


    public function update($id)
    {
        $data = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'role' => $_POST['role'],
            'is_active' => $_POST['is_active']
        ];

        $this->UserModel->update($id, $data);

        header('Location: /users');
        exit;
    }
}