@extends('admin.layouts.main')

@section('title')
    User List
@endsection

@section('content')
<div class="container">
    <h2 class="mb-4">Thêm Người Dùng</h2>
    <form action="{{$_ENV['BASE_URL']}}admin/user/add" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Họ và Tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <input type="text" name="address" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Vai trò</label>
            <select name="role" class="form-select">
                <option value="admin">Admin</option>
                <option value="customer">User</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="{{$_ENV['BASE_URL']}}admin/user" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection