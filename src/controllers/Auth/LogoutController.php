<?php
namespace App\Controllers\Auth;
use App\Helpers\JWT;
use App\Helpers\CSRF;
class LogoutController {
    static public function index() {
        if (!JWT::isLoggedIn()) {
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

        // validate that CSRF Token if it exists ofc
        $csrf_token = $_POST['csrf'] ?? '';
        if ( ! CSRF::validate_token($csrf_token ?? '')) {
            header('Location: /myspace?error=invalid_csrf');
            exit;
        }

        setcookie("JWT", "", time() - 3600, "/");
        $_SESSION['csrf_token'] = null;
        unset($_COOKIE["JWT"]);
        header('Location: /');
        exit;
    }
}