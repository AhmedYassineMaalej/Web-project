<?php

namespace App\Controllers\Auth;

use App\models\UserRepository;
use App\models\User;
use App\Helpers\JWT;
use App\Helpers\CSRF;

class SignUpController {

    static public function index() {
        
        if (JWT::isLoggedIn()) {
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
            header('Location: /signup?error=invalid_csrf');
            exit;
        }
        
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm  = $_POST['confirm_password'] ?? '';

        if (empty($username) || empty($password)) {
            header('Location: /signup?error=empty_fields');
            exit;
        }

        if ($password !== $confirm) {
            header('Location: /signup?error=password_mismatch');
            exit;
        }
        $user_repo = new UserRepository();
        if ($user_repo->getUserByUsername($username)) {
            header('Location: /signup?error=user_exists');
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
            header('Location: /signup?error=db_error');
            exit;
        }
    }
    
    static function show_signup_form() {
        $csrf_token = CSRF::generate_token();
        $_SESSION['csrf_token'] = $csrf_token;
        require __DIR__ . '/../../../views/pages/signup.php';
    }
}