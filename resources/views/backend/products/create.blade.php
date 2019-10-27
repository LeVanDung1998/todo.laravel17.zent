@extends('backend.layout.master')
@section('title')
    Product
@endsection
@section('content-header')
<!-- Content Header -->
<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tạo sản phẩm</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                    <li class="breadcrumb-item active">Tạo sản phẩm</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('content')

<!-- Content -->
<div class="container-fluid">
        <!-- Main row -->
        {{--  @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <form role="form" method="post" action="{{ route('backend.product.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" id="" placeholder="Điền tên sản phẩm">
        </div>


         @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        <div class="form-group">
            <label>Danh mục sản phẩm</label>
            <select name="category_id" class="form-control select2" style="width: 100%;">
                <option>--Chọn danh mục---</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Giá gốc</label>
                    <input type="text" name="origin_price" class="form-control" placeholder="Điền giá gốc">
                </div>
            </div>
            @error('origin_price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-6">
                <div class="form-group">
                    <label>Giá bán</label>
                    <input type="text" name="sale_price" class="form-control" placeholder="Điền giá bán">
                </div>
            </div>
            @error('sale_price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Mô tả sản phẩm</label>
            <textarea class="textarea" name="content" placeholder="Place some text here"
                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Hình ảnh sản phẩm</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile"  name="image[]" multiple>
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                </div>
            </div>
        </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div class="form-group">
            <label>Trạng thái sản phẩm</label>
            <select name="status" class="form-control select2" style="width: 100%;">
                <option>--Chọn trạng thái---</option>
                <option value="0">Đang nhập</option>
                <option value="1">Mở bán</option>
                <option value="-1">Hết hàng</option>
            </select>
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <a href="{{ route('backend.product.index') }}" class="btn btn-default">Huỷ bỏ</a>
        <button type="submit" class="btn btn-success">Tạo mới</button>
    </div>
</form>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
@endsection
