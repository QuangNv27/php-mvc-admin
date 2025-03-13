<?php
// session_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
use eftec\bladeone\BladeOne;
require 'vendor/autoload.php';
define('PATH_ROOT',__DIR__);
if (!function_exists('file_url')) {
    function file_url($path)
    {
        if (!file_exists($path)) {
            return null;
        }
        return $_ENV['BASE_URL'] . $path;
    }
}
if(!function_exists('view')) {
    function view($view, $data = [])
    {
        $views = __DIR__ . '/views';
        $cache = __DIR__ . '/storage/compiles';
        $blade = new BladeOne($views, $cache,BladeOne::MODE_DEBUG);
        echo $blade->run($view,$data);
    }
    
}
if(!function_exists('redirect')) {
    function redirect($url, $message = '', $status = 'success') {
        $_SESSION['msg'] = [
            'status' => $status, // hoặc 'danger', 'warning', 'info'
            'message' => $message
        ];
        header("Location: " . $url);
        exit();
    } 
}
Dotenv\Dotenv::createImmutable(__DIR__)->load();
require 'routers/admin.php';


