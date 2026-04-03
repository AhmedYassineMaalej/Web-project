<?php

namespace App\Controllers\Auth;

// use App\models\UserRepository; once ofc its done

class SignUpController {

    public function index() {
        require __DIR__ . '/../../views/pages/signup.php';
    }

    public function register() {
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
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

        // uncomment everything below once done
        /*
        // Check if user already exists
        if (UserRepository::getUserByUsername($username)) {
            header('Location: /signup?error=user_exists');
            exit;
        }

        
        $success = UserRepository::createUser($username, $hashedPassword);

        if ($success) {
            $_COOKIE["JWT"] = issue_jwt($username, $user_id); 
            header('Location: /login?success=account_created');

            exit;
        } else {
            header('Location: /signup?error=db_error');
            exit;
        }
        */

        // --- MOCK SUCCESS FOR TESTING UI ---
        // This lets you test the redirect to login without a database
        if ($username === "newuser") {
            header('Location: /login?success=1');
            exit;
        }
        

        header('Location: /signup?error=unknown');
        exit;
    }
}