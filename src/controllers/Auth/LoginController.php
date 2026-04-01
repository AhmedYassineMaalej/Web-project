<?php

namespace App\controllers;

// We assume your friends will build this later
// use App\models\UserRepository; 

class LoginController {


    public function index() {
        require __DIR__ . '/../../views/pages/login.php';
    }

    public function authenticate() {
        
        $secret = $_ENV['JWT_SECRET'] ?? 'default_secret_key';
        
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
            
            // Standardized payload: includes ID for MySpace data fetching
            $payload = [
                'id'   => $user['id'], 
                'user' => $username,
                'iat'  => time(),
                'exp'  => time() + 3600
            ];

            $token = $this->generateJWT($payload, $secret);
            setcookie("token", $token, [
                'expires' => time() + 3600,
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax'
            ]);

            header('Location: /myspace');
            exit; 
        }
        */

        //just testing
        if ($username === "admin" && $password === "1234") {
            
            $payload = [
                'id'   => 1,
                'user' => $username,
                'iat'  => time(),
                'exp'  => time() + 3600 
            ];

            $jwt = $this->generateJWT($payload, $secret);

            setcookie("token", $jwt, [
                'expires' => time() + 3600,
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax'
            ]);

            header('Location: /'); 
            exit;
        } else {
            header('Location: /login?error=invalid_credentials');
            exit;
        }
    }

    private function generateJWT($payload, $secret) {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($payload)));

        // Create Signature using HMAC SHA256
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }
}