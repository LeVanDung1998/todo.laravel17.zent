@extends('backend.layout.master')
@section('title')
    Edit Product
@endsection
@section('content-header')
<!-- Content Header -->
<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Cập nhật sản phẩm</h1>
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
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <form action="{{ route('backend.product.update', $item->id) }}" method="POST" class="" role="form" enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="PUT">
            {{--{{ method_field('PUT') }}--}}
            <div class="form-group">
                <label class="control-label" for="todo">Tên sản phẩm:</label>
                <input name="name" type="text" value="{{ $item->name }}" class="form-control" id="todo" placeholder="Enter todo">
            </div>
            <div class="form-group">
                <label class="control-label" for="todo">Ảnh sản phẩm:</label><br>
                {{-- @if ($images=='')
                    sản phẩm này không có ảnh
                @else --}}
                @foreach ($images as $image)
                    <img width="200px"  src="/storage/{{ $image->path }}"  alt="" style="margin-right: 30px">
                @endforeach
            </div>

             <div class="form-group">
            <label for="exampleInputFile">Thêm mới ảnh nếu muốn</label>
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

            <div class="form-group">
                <label class="control-label" for="todo">Slug sản phẩm:</label>
                <input name="slug" type="text" value="{{ $item->slug }}" class="form-control" id="todo" placeholder="Enter todo">
            </div>
            <div class="form-group">
                <label class="control-label" for="todo">Giá gốc:</label>
                <input name="origin_price" type="text" value="{{ $item->origin_price }}" class="form-control" id="todo" placeholder="Enter todo">
            </div>


            <div class="form-group">
                <label class="control-label" for="todo">Giá bán:</label>
                <input name="sale_price" type="text" value="{{ $item->sale_price }}" class="form-control" id="todo" placeholder="Enter todo">
            </div>
            <div class="form-group">
                <label class="control-label" for="todo">Mô tả:</label>
                <textarea name="content" class="form-control">{{ $item->content }}</textarea>
            </div>
            <div class="form-group">
                <label class="control-label" for="todo">Trạng thái:</label>
                <select name="status" class="form-control">
                    <option value="0" @if($item->status == 0) selected @endif>Chưa làm</option>
                    <option value="1" @if($item->status == 1) selected @endif>Đang làm</option>
                    <option value="2" @if($item->status == 2) selected @endif>Đã làm</option>
                </select>
            </div>
            {{-- <div class="form-group">
                <label class="control-label" for="todo">Trạng thái:</label>
                <select name="status" class="form-control">
                    <option value="0" @if($item->status == 0) selected @endif>Chưa làm</option>
                    <option value="1" @if($item->status == 1) selected @endif>Đang làm</option>
                    <option value="2" @if($item->status == 2) selected @endif>Đã làm</option>
                </select>
            </div> --}}
            <div class="form-group">
                <div class="">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
@endsection
