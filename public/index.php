<?php

use App\Router;

//env vars for the secret jwt key for now and extra env vars for more features in the future...
$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // Skip comments
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}


include_once '../src/autoloader.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];


$router = new Router();


$router->add('GET', '/', 'App\Controllers\HomeController@index');
$router->add('GET', '/catalog', 'App\Controllers\CatalogController@index');
$router->add('GET', '/myspace', 'App\Controllers\MySpaceController@index');
$router->add('GET', '/navbar', 'App\Controllers\NavbarController@index');
$router->add('ANY','/login', 'App\Controllers\Auth\LoginController@index');
$router->add('ANY','/logout', 'App\Controllers\Auth\LogoutController@index');
$router->add('ANY','/sign_up','App\Controllers\Auth\SignupController@index');
$router->add('GET', '/catalog/getProductAjax', 'App\Controllers\CatalogController@getProductAjax');



$router->dispatch($uri, $method);
