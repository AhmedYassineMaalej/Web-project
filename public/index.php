<?php
//env vars for the secret jwt key for now and more features in the future!!
$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // Skip comments
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}


require_once __DIR__ . '/../vendor/autoload.php';

// 2. Error Reporting (Keep this on while developing!)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 3. Capture the Request
// We strip the query string (like ?id=1) to get a clean URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// 4. Initialize the Router
$router = new App\Router();

// 5. Define your Routes
// These map a URL to a specific Controller and Method
$router->add('GET', '/', 'App\controllers\HomeController@index');
$router->add('GET', '/catalog', 'App\controllers\CatalogController@index');
$router->add('GET', '/myspace', 'App\controllers\MySpaceController@index');
$router->add('GET', '/navbar', 'App\controllers\NavbarController@index');
$router->add('GET', '/login', 'App\controllers\Auth\LoginController@index');

// 6. Dispatch the Request
// The router looks for a match and runs the code
$router->dispatch($uri, $method);