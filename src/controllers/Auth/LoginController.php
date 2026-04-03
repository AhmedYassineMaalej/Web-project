<?php

namespace App\Controllers\Auth;


// use App\models\UserRepository; 
use App\Helpers\JWT;
use App\Helpers\CSRF;
class LoginController {





    static public function index() {
        if (JWT::isLoggedIn()) {
            header('Location: /myspace');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return self::authenticate();
        }
        else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return self::show_login_form();
        }
        else{
            header('HTTP/1.1 405 Method Not Allowed');
            echo "Method Not Allowed";
            exit;
        }
        
    }

    static public function authenticate() {

        // validate that CSRF Token if it exists ofc
        $csrf_token = $_POST['csrf'] ?? '';
        if ( ! CSRF::validate_token($csrf_token ?? '')) {
            header('Location: /login?error=invalid_csrf');
            exit;
        }
        // get username and password from POST data
        
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            header('Location: /login?error=missing_fields');
            exit;
        }

        // when db ready, we uncomment this and remove the mock login below
        /*
        $user = UserRepository::getUserByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
        
            
            $_COOKIE["JWT"] = JWT::issue_jwt($username, $user['id']);
            header('Location: /myspace');

        }
            */


        //just testing
        if ($username === "admin" && $password === "1234") {
            error_log("Mock login successful for user: " . $username);
            $_COOKIE["JWT"] = JWT::issue_jwt($username, 1); 
            setcookie("JWT", $_COOKIE["JWT"], time() + 3600, "/");
            error_log("JWT issued: " . $_COOKIE["JWT"]);

            header('Location: /'); 
        } else {
            header('Location: /login?error=invalid_credentials');
        }
    }





    static function show_login_form() {
        $csrf_token = CSRF::generate_token();
        $_SESSION['csrf_token'] = $csrf_token;
        require __DIR__ . '/../../../views/pages/login.php';
    }

    
}