<?php
namespace App\Controllers\Admin;

use App\Controller;
use App\Models\User;
use Rakit\Validation\Validator;

class UserController extends Controller
{
    private User $user;
    private Validator $validator;
    public function __construct()
    {
        $this->user = new User();
        $this->validator = new Validator();
    }
    public function index()
    {    
        // print_r($_SESSION); exit;
        $title = ' Trang danh sach users';
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        // $data = $this->user->findAll();
        $data = empty($search) ? $this->user->findAll() : $this->user->findOnSearch($search);
        return view('admin.users.index', compact('title','data'));
    }
    public function create()
    {
        $title = ' Trang them moi';
        return view('admin.users.add', compact('title'));
    }
    public function store()
    {
        $validation = $this->validator->make($_POST,[
            'name'=>'required|min:3',
            'email'=>'required|email',
            'password'=>'required|min:6',
            'phone'=>'required',
            'address'=>'required',
            'role'=>'required',
        ]);
        $validation->validate();
        if($validation->fails()) {
            return redirect($_ENV['BASE_URL'].'admin/user','Them khong thanh cong', 'danger');
        }
        $data = [
            'name'=>$_POST['name'],
            'email'=>$_POST['email'],
            'password'=>$_POST['password'],
            'phone'=>$_POST['phone'],
            'address'=>$_POST['address'],
            'role'=>$_POST['role']
        ];
        $this->user->insert($data);
        return redirect($_ENV['BASE_URL'].'admin/user','Thêm thành công!');
    }
    public function edit($id)
    {
        $title = "Chỉnh sửa";
        $user = $this->user->find($id);
        if(!$user) {
            return redirect($_ENV['BASE_URL'].'admin/user','ID khong ton tai', 'danger');
        }
        return view('admin.users.edit', compact('title','user'));
    }
    public function update($id)
    {
        $data = $_POST; // Sao chép dữ liệu đầu vào
        if (empty($data['password'])) {
            unset($data['password']); // Chỉ thay đổi trên $data, không động vào $_POST
        }
        $validation = $this->validator->make($data,[
            'name'=>'required|min:3',
            'email'=>'required|email',
            'password'=>'min:6',
            'phone'=>'required',
            'address'=>'required',
            'role'=>'required'
        ]);
        $validation->validate();
        if($validation->fails()) {
            return redirect($_ENV['BASE_URL'].'admin/user','Update khong thanh cong', 'danger');
        }
        // if ($validation->fails()) {
        //     // Debug lỗi
        //     echo "<pre>";
        //     print_r($validation->errors()->all());
        //     echo "</pre>";
        //     exit(); // Dừng để xem lỗi
        // }
        $data = [
            'name'=>$_POST['name'],
            'email'=>$_POST['email'],
            'password'=>$_POST['password'],
            'phone'=>$_POST['phone'],
            'address'=>$_POST['address'],
            'role'=>$_POST['role']
        ];
        $this->user->update($id,$data);
        return redirect($_ENV['BASE_URL'].'admin/user','Update thành công!');
    }
    public function destroy($id)
    {   
        $user = $this->user->find($id);
        if (!$user) {
            redirect($_ENV['BASE_URL'].'/admin/user', 'Người dùng không tồn tại!', 'danger');
            return;
        }
        $deleted = $this->user->delete($id);
        if ($deleted) {
            redirect($_ENV['BASE_URL'].'admin/user', 'Xóa người dùng thành công!', 'success');
        } else {
            redirect($_ENV['BASE_URL'].'admin/user', 'Xóa thất bại, vui lòng thử lại!', 'danger');
        }
    }
}