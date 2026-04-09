<?php

namespace App\Controllers\Auth;

use App\Repositories\UserRepository;
use App\Entities\User;
use App\Helpers\JWT;
use App\Helpers\CSRF;

class SignUpController {

    static public function index() {
        
        if (JWT::isLoggedIn()) {
            $_SESSION['error'] = "You're already logged in";
            header('Location: /myspace');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return self::register();
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return self::show_signup_form();
        } else {
            header('HTTP/1.1 405 Method Not Allowed');
            echo "Method Not Allowed";
            exit;
        }
    }

    static public function register() {
        $csrf_token = $_POST['csrf'] ?? '';
        if (!CSRF::validate_token($csrf_token)) {
            $_SESSION['error'] = 'Invalid security token. Please try again.';
            header('Location: /signup');
            exit;
        }
        
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm  = $_POST['confirm_password'] ?? '';

        if (empty($username) || empty($password)) {
            $_SESSION['error'] = 'Please fill out all the fields';
            header('Location: /signup');
            exit;
        }

        if ($password !== $confirm) {
            $_SESSION['error'] = "The passwords don't match";
            header('Location: /signup');
            exit;
        }
        if (UserRepository::getUserByUsername($username)) {
            $_SESSION['error'] = 'User of this name already exists !';
            header('Location: /signup');
            exit;
        }
        
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        
        $user = $user_repo->createUser($username, $hashedPassword);
        
        if ($user) {
            $user_id = $user->getId();
            $jwt = JWT::issue_jwt($username, $user_id);
            /*
            below i set the argument "secure" of setcookie to false, because if i dont
            then http://localhost will not accept that token because its not https
            */
            setcookie('JWT', $jwt, time() + 3600, '/', '', false, true);
            
            header('Location: /?success=account_created');
            exit;
        } else {
            $_SESSION['error'] = 'DB ERROR';
            header('Location: /signup');
            exit;
        }
    }
    
    static function show_signup_form() {
        $csrf_token = CSRF::generate_token();
        $_SESSION['csrf_token'] = $csrf_token;
        require __DIR__ . '/../../../views/pages/signup.php';
    }
}
