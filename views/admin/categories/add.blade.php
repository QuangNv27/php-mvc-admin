@extends('admin.layouts.main')

@section('title')
    User List
@endsection

@section('content')
<div class="container">
    <h2 class="mb-4">Thêm Danh Mục</h2>
    <form action="{{ $_ENV['BASE_URL'] }}admin/category/add" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên danh mục</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="{{ $_ENV['BASE_URL'] }}admin/category" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection