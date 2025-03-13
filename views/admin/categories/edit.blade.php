@extends('admin.layouts.main')

@section('title')
    Edit User
@endsection

@section('content')
<div class="container">
    <h2 class="mb-4">Chỉnh sửa Danh Mục</h2>
    <form action="{{ $_ENV['BASE_URL'] }}admin/category/edit/{{ $category['id'] }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên danh mục</label>
            <input type="text" name="name" class="form-control" value="{{ $category['name'] }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="4">{{ $category['description'] }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ $_ENV['BASE_URL'] }}admin/category" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
