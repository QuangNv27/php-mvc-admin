@extends('admin.layouts.main')

@section('title')
    User List
@endsection

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Danh sách sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Danh sách</li>
    </ol>
    <div class="card mb-4">
        @if(isset($_SESSION['msg']))
            <div class="alert alert-{{ $_SESSION['msg']['status'] }}">
                {{ $_SESSION['msg']['message'] }}
            </div>
            <?php unset($_SESSION['msg']); ?> <!-- Xóa session sau khi hiển thị -->
        @endif
        <form method="GET" action="{{ $_ENV['BASE_URL'] }}admin/product">
            <input type="text" name="search" value="{{ $search }}" placeholder="Tìm sản phẩm..." class="form-control" style="width: 300px; display: inline-block;">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            <a href="{{ $_ENV['BASE_URL'] }}admin/product" class="btn btn-secondary">Reset</a>
        </form>
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
            <a href="product/add" class="btn btn-success">Thêm mới</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Function</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Function</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <th>{{ $item['id'] }}</th>
                            <th>{{ $item['name'] }}</th>
                            <th>{{ $item['description'] }}</th>
                            <th>{{ number_format($item['price'], 0, ',', '.') }} VND</th>
                            <th>{{ $item['stock'] }}</th>
                            <th>{{ $item['category_name'] }}</th>
                            <th>
                                <img src="{{ $_ENV['BASE_URL'] }}{{ $item['image'] }}" alt="Product Image" width="100">
                            </th>
                            <th>{{ $item['created_at'] }}</th>
                            <th>{{ $item['updated_at'] }}</th>
                            <th>
                                <a href="product/edit/{{ $item['id'] }}" class="btn btn-warning">Sửa</a>
                                <a href="product/delete/{{ $item['id'] }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection