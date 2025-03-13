@extends('admin.layouts.main')

@section('title')
    Thêm Sản Phẩm
@endsection

@section('content')
<div class="container">
    <h2 class="mb-4">Thêm Sản Phẩm</h2>
    <form action="{{ $_ENV['BASE_URL'] }}admin/product/add" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" name="price" class="form-control" required min="0">
        </div>
        <div class="mb-3">
            <label class="form-label">Số lượng tồn kho</label>
            <input type="number" name="stock" class="form-control" required min="0">
        </div>
        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh sản phẩm</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        <a href="{{ $_ENV['BASE_URL'] }}admin/product" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection