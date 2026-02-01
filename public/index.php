<?php 

require_once __DIR__ . '/../vendor/autoload.php';

$config = [
    'host'     => getenv('DB_HOST'),
    'user'     => getenv('DB_USER'),
    'pass'     => getenv('DB_PASS'),
    'database' => getenv('DB_DATABASE'),
    'driver'   => getenv('DB_DRIVER'),
];

$pdo = new PDO(
    $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],
    $config['user'],
    $config['pass'],
    [
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);

$stmt = $pdo->query(
    'SELECT
        title, created_at, body
    FROM
        posts
    ORDER BY
        created_at DESC'
);

define('VIEW_PATH', __DIR__ . '/../src/Views');

if ($stmt === false)
{
    throw new Exception('There was a problem running this query');
}

use App\App;
use App\Router;
use App\Controllers\HomeController;
use App\Controllers\PostController;

$router = new Router();

$router
    ->add('get', '/', [HomeController::class, 'render'])
    ->add('get', '/post', [PostController::class, 'render']);

(new App(
    $router,
    ['path' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']]
))->run();