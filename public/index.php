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

session_start();

$router = new Router();

$router
    ->get('/', [HomeController::class, 'render'])
    ->get('/login', [AuthController::class, 'renderLogin'])
    ->post('/login', [AuthController::class, 'login'])
    ->get('/logout', [AuthController::class, 'logout'])
    ->get('/signup', [AuthController::class, 'renderSignUp'])
    ->post('/signup', [AuthController::class, 'signUp'])
    ->get('/post/create', [PostController::class, 'renderCreatePage'])
    ->post('/post/create', [PostController::class, 'createNewPost']);

(new App(
    $router,
    ['path' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']]
))->run();