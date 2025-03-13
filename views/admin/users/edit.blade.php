@extends('admin.layouts.main')

@section('title')
    Edit User
@endsection

@section('content')
<div class="container">
    <h2 class="mb-4">Chỉnh sửa Người Dùng</h2>
    <form action="{{ $_ENV['BASE_URL'] }}admin/user/edit/{{ $user['id'] }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Họ và Tên</label>
            <input type="text" name="name" class="form-control" value="{{ $user['name'] }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user['email'] }}" required readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu mới (để trống nếu không đổi)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" value="{{ $user['phone'] }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <input type="text" name="address" class="form-control" value="{{ $user['address'] }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Vai trò</label>
            <select name="role" class="form-select">
                <option value="admin" {{ $user['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="customer" {{ $user['role'] == 'customer' ? 'selected' : '' }}>Customer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ $_ENV['BASE_URL'] }}admin/user" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
