<?php

use App\Controllers\Auth\LogoutController;
use App\Controllers\Auth\LoginController;
use App\Controllers\BookmarkController;
use App\Controllers\CatalogController;
use App\Controllers\HomeController;
use App\Controllers\NavbarController;
use App\Controllers\MySpaceController;
use App\Controllers\Auth\SignUpController;
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

function define_apis(Router $router){
    $router->add('GET', '/catalog/getProductAjax', [CatalogController::class, 'getProductAjax']);
    $router->add('GET', '/bookmarks/items', [BookmarkController::class, 'getBookmarksJson']);
    $router->add('POST', '/bookmarks/add', [BookmarkController::class, 'addBookmark']);
    $router->add('POST', '/bookmark/remove', [BookmarkController::class, 'removeBookmark']);
    $router->add('POST', '/bookmark/toggle', [BookmarkController::class, 'toggleBookmark']);
}

function define_user_endpoints(Router $router){
    $router->add('GET', '/', [HomeController::class, 'index']);
    $router->add('ANY', '/catalog', [CatalogController::class, 'index']);
    $router->add('GET', '/myspace', [MySpaceController::class, 'index']);
    $router->add('GET', '/navbar', [NavbarController::class, 'index']);
    $router->add('ANY', '/login', [LoginController::class, 'index']);
    $router->add('ANY', '/logout', [LogoutController::class, 'index']);
    $router->add('ANY', '/signup', [SignUpController::class, 'index']);
    $router->add('ANY', '/bookmarks', [BookmarkController::class, 'index']);
}


$router->dispatch($uri, $method);
