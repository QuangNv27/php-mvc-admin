<?php
use App\Controllers\AuthController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\ProductController;
use App\Controllers\Admin\UserController;
use App\Middleware\AdminMiddleware;
use Bramus\Router\Router;

$router = new Router();

$router->before('GET|POST', '/admin/.*',AdminMiddleware::class.'@handle');
$router->get('/', AuthController::class. '@showLoginForm');
$router->get('/login', AuthController::class. '@showLoginForm');
$router->post('/login', AuthController::class. '@login');
$router->get('/logout', AuthController::class. '@logout');

$router->mount('/admin', function() use ($router) {
    $router->get('/', function() {
        return view('admin.dashboard');
    });
    // CRUD User
    $router->mount('/user', function() use ($router) {
        $router->get('/', UserController::class . '@index');
        $router->get('/add', UserController::class . '@create');
        $router->post('/add', UserController::class . '@store');
        $router->get('/edit/{id}', UserController::class . '@edit');
        $router->post('/edit/{id}', UserController::class . '@update');
        $router->get('/delete/{id}', UserController::class . '@destroy');
    });
    
    // CRUD Category
    $router->mount('/category', function() use ($router) {
        $router->get('/', CategoryController::class . '@index');
        $router->get('/add', CategoryController::class . '@create');
        $router->post('/add', CategoryController::class . '@store');
        $router->get('/edit/{id}', CategoryController::class . '@edit');
        $router->post('/edit/{id}', CategoryController::class . '@update');
        $router->get('/delete/{id}', CategoryController::class . '@destroy');
    });
    
    // CRUD Product
    $router->mount('/product', function() use ($router) {
        $router->get('/', ProductController::class . '@index');
        $router->get('/add', ProductController::class . '@create');
        $router->post('/add', ProductController::class . '@store');
        $router->get('/edit/{id}', ProductController::class . '@edit');
        $router->post('/edit/{id}', ProductController::class . '@update');
        $router->get('/delete/{id}', ProductController::class . '@destroy');
    });
});
$router->run();