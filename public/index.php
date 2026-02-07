<?php 

require_once __DIR__ . '/../vendor/autoload.php';

define('CONFIG', [
    'host'     => getenv('DB_HOST'),
    'user'     => getenv('DB_USER'),
    'pass'     => getenv('DB_PASS'),
    'database' => getenv('DB_DATABASE'),
    'driver'   => getenv('DB_DRIVER'),
]);

define('VIEW_PATH', __DIR__ . '/../src/Views');

use App\App;
use App\Router;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\AuthController;

$router = new Router();

$router
    ->add('get', '/', [HomeController::class, 'render'])
    ->add('get', '/post', [PostController::class, 'render'])
    ->add('get', '/login', [AuthController::class, 'renderLogin'])
    ->add('get', '/signup', [AuthController::class, 'renderSignUp'])
    ->add('post', '/signup', [AuthController::class, 'signUp']);

(new App(
    $router,
    ['path' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']]
))->run();