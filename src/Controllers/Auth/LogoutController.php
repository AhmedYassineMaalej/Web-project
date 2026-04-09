<?php
namespace App\Controllers\Auth;
use App\Helpers\JWT;
use App\Helpers\CSRF;
class LogoutController {

    static public function index() {
        if (!JWT::isLoggedIn()) {
            $_SESSION['error'] = "You're already logged in";
            header('Location: /');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return self::logout();
        }
        else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return self::show_logout_form();
        }
        else{
            header('HTTP/1.1 405 Method Not Allowed');
            echo "Method Not Allowed";
            exit;
        }
    }

    static public function show_logout_form() {
        $csrf_token = CSRF::generate_token();
        require __DIR__ . '/../../../views/pages/logout.php';
    }

    static public function logout() {

        
        $csrf_token = $_POST['csrf'];
        if (!CSRF::validate_token($csrf_token)) {
            $_SESSION['error'] = 'Invalid security token. Please try again.';
            header('Location: /myspace');
            exit;
        }

        setcookie("JWT", "", time() - 3600, "/","",false,true);
        $_SESSION['csrf_token'] = null;
        unset($_COOKIE["JWT"]);
        header('Location: /');
        exit;
    }
}