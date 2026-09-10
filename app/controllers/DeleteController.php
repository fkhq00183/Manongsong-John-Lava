<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: DeleteController
 * 
 * Automatically generated via CLI.
 */
class DeleteController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

        public function delete($id)
    {
        $this->UserModel->delete($id);

        header('Location: /users');
        exit;
    }
}