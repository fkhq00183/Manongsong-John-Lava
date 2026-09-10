<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: CreateController
 * 
 * Automatically generated via CLI.
 */
class CreateController extends Controller {
    //  protected $table = 'users';
    // protected $primary_key = 'id';

    // protected $fillable = [
    //     'username',
    //     'email',
    //     'password',
    //     'role',
    //     'is_active'
    // ];

    // protected $guarded = ['id'];

    // public function __construct()
    // {
    //     parent::__construct();
    // }
    // public function create(){
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         // Handle form submission
    //     } else {
    //         // Display the create user form
    //         $this->view('users/create-user');
    //     }
    // }

    public function store()
    {
        $data = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'role' => $_POST['role'],
            'is_active' => 1
        ];

        $this->UserModel->insert($data);

        header('Location: /users');
        exit;
    }
}