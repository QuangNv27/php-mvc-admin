<?php
namespace App\Controllers;

use App\Models\User;
use Rakit\Validation\Validator;

class AuthController {
    protected User $user;
    private $validator;
    public function __construct()
    {
        $this->user = new User();
        $this->validator = new Validator();
    }
    public function showLoginForm() {
        return view('admin.auth.login');
    }
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_POST)) {
            $_SESSION['msg'] = [
                'status' => 'danger',
                'message' => 'Không có dữ liệu được gửi!'
            ];
            return redirect($_ENV['BASE_URL'] . 'login');
        }
        $data=$_POST;
        $validator =  $this->validator->make($_POST,[
            'email' => 'required|email',
            'password'=>'required|min:6'
        ]);
        $validator->validate();
        if($validator->fails()) {
            return redirect($_ENV['BASE_URL'].'login','Loi dang nhap','danger');
        }
        $user = $this->user->findByEmail($data['email']);
        // echo "<pre>";
        // print_r($user);
        // exit;
        // var_dump($user['password']); exit;
        if(!$user || !($data['password'] === $user['password'])) {
            return redirect($_ENV['BASE_URL'] . 'login','Email hoặc mật khẩu không đúng!','danger');
        }
        if($user['role'] !== 'admin') {
            return redirect($_ENV['BASE_URL'] . 'login','Bạn không có quyền truy cập!','danger');
        }
            // Lưu session đăng nhập
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $user;

        // print_r($_SESSION);
        // exit;
        return redirect($_ENV['BASE_URL'] . 'admin/user','Dang nhap thanh cong');
    }
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        return redirect($_ENV['BASE_URL'] . 'login');
        exit;
    }
}