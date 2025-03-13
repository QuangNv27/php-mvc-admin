<?php
namespace App\Middleware;

class AdminMiddleware {
    public static function handle() {
        // session_start();

        if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
            $_SESSION['msg'] = ['status' => 'danger', 'message' => 'Bạn cần đăng nhập!'];
            header('Location: ' . $_ENV['BASE_URL'] . 'login');
            exit;
        }

        if (!isset($_SESSION['admin_user']) || $_SESSION['admin_user']['role'] !== 'admin') {
            $_SESSION['msg'] = ['status' => 'danger', 'message' => 'Bạn không có quyền truy cập!'];
            header('Location: ' . $_ENV['BASE_URL'] . 'login');
            exit;
        }
    }
}
