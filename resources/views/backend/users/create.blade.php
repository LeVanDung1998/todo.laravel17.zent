@extends('backend.layout.master')
@section('title')
    Create User
@endsection
@section('content-header')
<!-- Content Header -->
<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tạo người dùng</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Người dùng</a></li>
                    <li class="breadcrumb-item active">Tạo mới</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <!-- Content -->
 <form role="form" method="post" action="{{ route('backend.user.store') }}">
    @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên người dùng</label>
                    <input type="text" name="name" class="form-control" id="" placeholder="Điền tên người dùng">
                </div>

                 @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


               <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" name="email" class="form-control" id="" placeholder="Điền email">
                </div>

                @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                <div class="form-group">
                    <label for="exampleInputEmail1">Mật khẩu</label>
                    <input type="text" name="password" class="form-control" id="" placeholder="Điền mật khẩu">
                </div>

                 @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror



                {{-- <div class="form-group">
                    <label for="exampleInputEmail1">Depth</label>
                    <input type="text" name="depth" class="form-control" id="" placeholder="Điền path danh mục">
                </div>

                 @error('depth')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror --}}
            </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <a href="{{ route('backend.user.index') }}" class="btn btn-default">Huỷ bỏ</a>
        <button type="submit" class="btn btn-success">Tạo mới</button>
    </div>
</form>
@endsection
