<?php 

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('CONFIG', [
    'host'     => $_ENV['DB_HOST'],
    'user'     => $_ENV['DB_USER'],
    'pass'     => $_ENV['DB_PASS'],
    'database' => $_ENV['DB_DATABASE'],
    'driver'   => $_ENV['DB_DRIVER'],
]);

define('VIEW_PATH', __DIR__ . '/../src/Views');

use App\App;
use App\Router;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\AuthController;
use App\Controllers\UserPageController;
use App\Controllers\CommentController;

session_start();

$router = new Router();

$router
    ->get('/', [HomeController::class, 'render'])
    ->get('/login', [AuthController::class, 'renderLogin'])
    ->post('/login', [AuthController::class, 'login'])
    ->get('/logout', [AuthController::class, 'logout'])
    ->get('/signup', [AuthController::class, 'renderSignUp'])
    ->post('/signup', [AuthController::class, 'signUp'])
    ->get('/post', [PostController::class, 'renderPost'])
    ->post('/post', [PostController::class, 'postNewComment'])
    ->get('/post/create', [PostController::class, 'renderCreatePage'])
    ->post('/post/create', [PostController::class, 'createNewPost'])
    ->get('/post/edit', [PostController::class, 'renderEditPage'])
    ->post('/post/edit', [PostController::class, 'updatePost'])
    ->get('/post/delete', [PostController::class, 'deletePost'])
    ->get('/my_page', [UserPageController::class, 'renderMyPage'])
    ->get('/user', [UserPageController::class, 'renderOtherUsersPage'])
    ->get('/user/posts', [UserPageController::class, 'renderUserPosts'])
    ->get('/user/comments', [UserPageController::class, 'renderUserComments'])
    ->get('/comment/delete', [CommentController::class, 'deleteComment']);

(new App(
    $router,
    ['path' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']]
))->run();