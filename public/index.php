<?php

use App\Router;
use App\Helpers\Env;

include_once '../src/autoloader.php';

Env::load_variables();

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];


$router = new Router();

define_user_endpoints($router);
define_apis($router);


function define_apis($router){
    $router->add('GET', '/catalog/getProductAjax', 'App\Controllers\CatalogController@getProductAjax');
    $router->add('GET', '/cart/items', 'App\Controllers\CartController@getCartItemsJson');
    $router->add('POST', '/cart/add', 'App\Controllers\CartController@addToCart');
    $router->add('POST', '/cart/remove', 'App\Controllers\CartController@removeFromCart');
}
function define_user_endpoints($router){
    $router->add('GET', '/', 'App\Controllers\HomeController@index');
    $router->add('ANY', '/catalog', 'App\Controllers\CatalogController@index');
    $router->add('GET', '/myspace', 'App\Controllers\MySpaceController@index');
    $router->add('GET', '/navbar', 'App\Controllers\NavbarController@index');
    $router->add('ANY','/login', 'App\Controllers\Auth\LoginController@index');
    $router->add('ANY','/logout', 'App\Controllers\Auth\LogoutController@index');
    $router->add('ANY','/signup','App\Controllers\Auth\SignupController@index');
}


$router->dispatch($uri, $method);
