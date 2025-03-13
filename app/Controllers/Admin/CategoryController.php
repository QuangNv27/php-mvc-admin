<?php
namespace App\Controllers\Admin;

use App\Controller;
use App\Models\Category;
use Rakit\Validation\Validator;

class CategoryController extends Controller
{
    private Category $category;
    private Validator $validator;
    public function __construct()
    {
        $this->category = new Category();
        $this->validator = new Validator();
    }
    public function index()
    {
        $title = ' Trang danh sach category';
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $data = $this->category->findAll();
        if (!empty($search)) {
            $data = $this->category->findOnSearch($search);
        }
        return view('admin.categories.index', compact('title','data'));
    }
    public function create()
    {
        $title = ' Trang them moi';
        return view('admin.categories.add', compact('title'));
    }
    public function store()
    {
        $validation = $this->validator->make($_POST,[
            'name' => 'required|min:3',
            'description' => 'required|min:5',
        ]);
        $validation->validate();
        if($validation->fails()) {
            return redirect($_ENV['BASE_URL'].'admin/category','Them khong thanh cong', 'danger');
        }
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
        ];
        $this->category->insert($data);
        return redirect($_ENV['BASE_URL'].'admin/category','Thêm thành công!');
    }
    public function edit($id)
    {
        $title = "Chỉnh sửa";
        $category = $this->category->find($id);
        if(!$category) {
            return redirect($_ENV['BASE_URL'].'admin/category','ID khong ton tai', 'danger');
        }
        return view('admin.categories.edit', compact('title','category'));
    }
    public function update($id)
    {
        $data = $_POST; // Sao chép dữ liệu đầu vào
        if (empty($data['password'])) {
            unset($data['password']); // Chỉ thay đổi trên $data, không động vào $_POST
        }
        $validation = $this->validator->make($data,[
            'name' => 'required|min:3',
            'description' => 'required|min:5',
        ]);
        $validation->validate();
        if($validation->fails()) {
            return redirect($_ENV['BASE_URL'].'admin/category','Update khong thanh cong', 'danger');
        }
        // if ($validation->fails()) {
        //     // Debug lỗi
        //     echo "<pre>";
        //     print_r($validation->errors()->all());
        //     echo "</pre>";
        //     exit(); // Dừng để xem lỗi
        // }
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
        ];
        $this->category->update($id,$data);
        return redirect($_ENV['BASE_URL'].'admin/category','Update thành công!');
    }
    public function destroy($id)
    {   
        $category = $this->category->find($id);
        if (!$category) {
            redirect($_ENV['BASE_URL'].'/admin/category', 'Người dùng không tồn tại!', 'danger');
            return;
        }
        $deleted = $this->category->delete($id);
        if ($deleted) {
            redirect($_ENV['BASE_URL'].'admin/category', 'Xóa người dùng thành công!', 'success');
        } else {
            redirect($_ENV['BASE_URL'].'admin/category', 'Xóa thất bại, vui lòng thử lại!', 'danger');
        }
    }
}