<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

require_once __DIR__ . '/../middlewares/StudentMiddleware.php';

class StudentController extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // CHANGE THIS TO true OR false TO CONTROL PROFILE ACCESS
        $_SESSION['student_access'] = true;

        $this->call->view('student');
    }

    public function profile()
    {
        $middleware = new StudentMiddleware();

        return $middleware->handle(function () {

            $student = [
                'student_id' => 'MCC2024-00183',
                'name' => 'John Judel Manongsong',
                'course' => 'Bachelor of Science in Information Technology',
                'year' => '3rd Year',
                'section' => 'F4',
                'email' => 'johnmanongsong05@gmail.com',
                'contact' => '09354122452',
                'address' => 'Puerto Galera',
                'skills' => 'Digital&NonDigital Arts, UI designing',
                'hobbies' => 'Drawing, , Swimming, Gaming',
                'description' => 'A BSIT student who loves to learn anything related to science, technology and arts',
                'Instagram' => 'https://www.instagram.com/qu1n_k1ng5?igsh=NWc2emR1M2t1Ym9w',
                'github' => 'https://github.com/fkhq00183'
            ];

            return $this->call->view('student_profile', $student);
        });
    }
}