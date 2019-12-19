<?php

class UsersController extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function signin()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'password' => trim($_POST['password']),
                'name_err' => '',
                'password_err' => '',
            ];

            // Validate Name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            } else {
                // Check Name
                if ($this->userModel->findUserByName($data['name'])) {
                    // User Found
                } else {
                    $data = [
                        'name' => trim($_POST['name']),
                        'password' => trim($_POST['password']),
                        'name_err' => 'Error',
                        'password_err' => 'Error',
                    ];
                }
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Make sure errors are empty
            if (empty($data['name_err']) && empty($data['password_err'])) {
                // Validated
                $loggedInUser = $this->userModel->login($data['name'], $data['password']);

                if ($loggedInUser) {
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';

                    // Load view with errors
                    $this->view('users/signin', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/signin', $data);
            }


        } else {
            // Init data
            $data = [
                'name' => '',
                'password' => '',
                'name_err' => '',
                'password_err' => '',
            ];

            // Load view
            $this->view('users/signin', $data);
        }
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_isAdmin'] = $user->is_admin;
        $_SESSION['user_name'] = $user->name;
        redirect('indexcontroller/index');
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_isAdmin']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('userscontroller/signin');
    }
}