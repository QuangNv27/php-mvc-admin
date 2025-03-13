@extends('admin.layouts.main')

@section('title')
    User List
@endsection

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Danh sách category</h1>
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
        <form method="GET" action="{{ $_ENV['BASE_URL'] }}admin/category">
            <input type="text" name="search" value="{{ $search }}" placeholder="Tìm danh mục..." class="form-control" style="width: 300px; display: inline-block;">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            <a href="{{ $_ENV['BASE_URL'] }}admin/category" class="btn btn-secondary">Reset</a>
        </form>
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
            <a href="category/add" class="btn btn-success">Thêm mới</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Update At</th>
                        <th>Function</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Update At</th>
                        <th>Function</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <th>{{ $item['name'] }}</th>
                            <th>{{ $item['description'] }}</th>
                            <th>{{ $item['created_at'] }}</th>
                            <th>{{ $item['updated_at'] }}</th>
                            <th>
                                <a href="category/edit/{{ $item['id'] }}" class="btn btn-warning">Sửa</a>
                                <a href="category/delete/{{ $item['id'] }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection