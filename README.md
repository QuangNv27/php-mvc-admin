# 🚀 PHP MVC Admin

## 📌 Giới thiệu
PHP MVC Admin là một hệ thống quản lý website với giao diện Admin được xây dựng theo mô hình **MVC**. Dự án này hỗ trợ quản lý người dùng, danh mục, sản phẩm và phân quyền **Admin**. Hệ thống được thiết kế với các thư viện PHP hiện đại giúp mã nguồn gọn gàng, dễ bảo trì.

## Cách cài đặt
1️⃣ Clone dự án
 -git clone https://github.com/QuangNv27/php-mvc-admin.git
 -cd php-mvc-admin
2️⃣ Cài đặt thư viện
 -composer install
3️⃣ Cấu hình môi trường
```
-Trong file .env
-DB_HOST=localhost
-DB_NAME=your_database_name
-DB_USER=root
-DB_PASSWORD=
```
4️⃣ Import database
5️⃣ Chạy dự án với Laragon hoặc XAMPP
## 🛠 Công nghệ sử dụng
```
- **Ngôn ngữ**: PHP, MySQL
- **Kiến trúc**: MVC
- **Thư viện chính**:
  - [`bramus/router`](https://github.com/bramus/router) - Định tuyến
  - [`doctrine/dbal`](https://www.doctrine-project.org/projects/dbal.html) - Kết nối & truy vấn MySQL
  - [`vlucas/phpdotenv`](https://github.com/vlucas/phpdotenv) - Cấu hình biến môi trường
  - [`rakit/validation`](https://github.com/rakit/validation) - Validate dữ liệu đầu vào
  - [`eftec/bladeone`](https://github.com/EFTEC/BladeOne) - Template engine
- **Công cụ hỗ trợ**: GitHub, Composer, Laragon
```

## 🎯 Tính năng chính
```
✅ **Quản lý người dùng**: CRUD tài khoản, phân quyền Admin  
✅ **Quản lý danh mục & sản phẩm**: Thêm, sửa, xóa, hiển thị danh mục & sản phẩm  
✅ **Xác thực đăng nhập**: Chỉ Admin có quyền truy cập  
✅ **Middleware kiểm tra đăng nhập**  
✅ **Routing động & hệ thống template engine**
```
