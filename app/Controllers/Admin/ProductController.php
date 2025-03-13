<?php
namespace App\Controllers\Admin;

use App\Controller;
use App\Models\Category;
use App\Models\Product;
use Rakit\Validation\Validator;

class ProductController extends Controller
{
    private Product $product;
    private Validator $validator;
    private Category $category;
    public function __construct()
    {
        $this->product = new Product();
        $this->validator = new Validator();
        $this->category = new Category();
    }
    public function index()
    {
        $title = ' Trang danh sach products';
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        $data = $this->product->findAll();
        // $categories = $this->category->findAll();
        if (!empty($search)) {
            $data = $this->product->findOnSearch($search);
        }
        return view('admin.products.index', compact('title','data'));
    }
    public function create()
    {
        $title = ' Trang them moi';
        $categories = $this->category->findAll(); 
        return view('admin.products.add', compact('title','categories'));
    }
    public function store()
    {
        $validation = $this->validator->make($_POST + $_FILES,[
            'name'         => 'required|min:3',   // Tên sản phẩm không được bỏ trống, ít nhất 3 ký tự
            'description'  => 'required|min:3',  // Mô tả sản phẩm cần ít nhất 10 ký tự
            'price'        => 'required|numeric|min:0', // Giá sản phẩm phải là số và >= 0
            'stock'        => 'required|integer|min:0', // Số lượng tồn kho là số nguyên >= 0
            'category_id'  => 'required|integer', // ID danh mục bắt buộc phải có
            'image'       => 'uploaded_file'
        ]);
        $validation->validate();
        if($validation->fails()) {
            return redirect($_ENV['BASE_URL'].'admin/product','Them khong thanh cong', 'danger');
        }
        // if ($validation->fails()) {
        //     // Debug lỗi
        //     echo "<pre>";
        //     print_r($validation->errors()->all());
        //     echo "</pre>";
        //     exit(); // Dừng để xem lỗi
        // }
        $imagePath = null; // Mặc định không có ảnh
        if (!empty($_FILES['image']['name'])) {
            $uploadDir  = 'storage/uploads/products/'; // Thư mục lưu ảnh
            $imageName  = time() . '-' . basename($_FILES['image']['name']);
            $uploadFile = $uploadDir . $imageName;
    
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $imagePath = $uploadFile; // Lưu đường dẫn ảnh
            }
        }
        $data = [
            'name'        => $_POST['name'],
            'description' => $_POST['description'],
            'price'       => $_POST['price'],
            'stock'       => $_POST['stock'],
            'category_id' => $_POST['category_id'],
            'image'       => $imagePath // Đường dẫn ảnh đã upload
        ];
        $this->product->insert($data);
        return redirect($_ENV['BASE_URL'].'admin/product','Thêm thành công!');
    }
    public function edit($id)
    {
        $title = "Chỉnh sửa";
        $product = $this->product->find($id);
        $categories = $this->category->findAll(); 
        if(!$product) {
            return redirect($_ENV['BASE_URL'].'admin/product','ID khong ton tai', 'danger');
        }
        return view('admin.products.edit', compact('title','product','categories'));
    }
    public function update($id)
    {
        $data = $_POST; // Sao chép dữ liệu đầu vào
        $validation = $this->validator->make($data,[
            'name'         => 'required|min:3',   // Tên sản phẩm không được bỏ trống, ít nhất 3 ký tự
            'description'  => 'required|min:3',  // Mô tả sản phẩm cần ít nhất 10 ký tự
            'price'        => 'required|numeric|min:0', // Giá sản phẩm phải là số và >= 0
            'stock'        => 'required|integer|min:0', // Số lượng tồn kho là số nguyên >= 0
            'category_id'  => 'required|integer', // ID danh mục bắt buộc phải có
        ]);
        $validation->validate();
        if($validation->fails()) {
            return redirect($_ENV['BASE_URL'].'admin/product','Update khong thanh cong', 'danger');
        }
        $product = $this->product->find($id);
        $imagePath = $product['image']; // Giữ ảnh cũ mặc định

        if (!empty($_FILES['image']['name'])) {
            $uploadDir  = 'storage/uploads/products/'; // Thư mục lưu ảnh
            $imageName  = time() . '-' . basename($_FILES['image']['name']);
            $uploadFile = $uploadDir . $imageName;
    
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $imagePath = $uploadFile; // Lưu đường dẫn ảnh
            }
        }
        // if ($validation->fails()) {
        //     // Debug lỗi
        //     echo "<pre>";
        //     print_r($validation->errors()->all());
        //     echo "</pre>";
        //     exit(); // Dừng để xem lỗi
        // }
        $data = [
            'name'        => $_POST['name'],
            'description' => $_POST['description'],
            'price'       => $_POST['price'],
            'stock'       => $_POST['stock'],
            'category_id' => $_POST['category_id'],
            'image'       => $imagePath // Đường dẫn ảnh đã upload
        ];
        $this->product->update($id,$data);
        return redirect($_ENV['BASE_URL'].'admin/product','Update thành công!');
    }
    public function destroy($id)
    {   
        $product = $this->product->find($id);
        if (!$product) {
            redirect($_ENV['BASE_URL'].'/admin/product', 'Người dùng không tồn tại!', 'danger');
            return;
        }
        $deleted = $this->product->delete($id);
        if ($deleted) {
            redirect($_ENV['BASE_URL'].'admin/product', 'Xóa người dùng thành công!', 'success');
        } else {
            redirect($_ENV['BASE_URL'].'admin/product', 'Xóa thất bại, vui lòng thử lại!', 'danger');
        }
    }
}