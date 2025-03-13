@extends('admin.layouts.main')

@section('title')
    Chỉnh sửa Sản Phẩm
@endsection

@section('content')
<div class="container">
    <h2 class="mb-4">Chỉnh sửa Sản Phẩm</h2>
    <form action="{{ $_ENV['BASE_URL'] }}admin/product/edit/{{ $product['id'] }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" value="{{ $product['name'] }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="3">{{ $product['description'] }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" name="price" class="form-control" value="{{ $product['price'] }}" required min="0">
        </div>
        <div class="mb-3">
            <label class="form-label">Số lượng tồn kho</label>
            <input type="number" name="stock" class="form-control" value="{{ $product['stock'] }}" required min="0">
        </div>
        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}" {{ $product['category_id'] == $category['id'] ? 'selected' : '' }}>
                        {{ $category['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh hiện tại</label><br>
            <img src="{{ $_ENV['BASE_URL'] . $product['image'] }}" alt="Product Image" width="150">
        </div>
        <div class="mb-3">
            <label class="form-label">Chọn ảnh mới (nếu muốn thay đổi)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ $_ENV['BASE_URL'] }}admin/product" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection