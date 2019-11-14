@extends('backend.layout.master')
@section('title')
    Detail Slide
@endsection
@section('content-header')
<!-- Content Header -->
<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Chi tiết slide</h1>
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
            @csrf
            <input name="_method" type="hidden" value="PUT">
            {{--{{ method_field('PUT') }}--}}
            <div class="form-group">
                <label class="control-label" for="todo">Tên slide:</label>
                <input name="name" type="text" value="{{ $slides->name }}" class="form-control" id="todo" placeholder="Enter todo">
            </div>
            <div class="form-group">
                <label class="control-label" for="todo">Ảnh :</label><br>
                {{-- @if ($images=='')
                    sản phẩm này không có ảnh
                @else --}}

                    <img width="500px" height="300px"  src="/storage/{{ $slides->path }}"  alt="" style="margin-right: 30px">

            </div>

             <div class="form-group">
                <label class="control-label" for="todo">Ngày tạo:</label>
                <input name="created_at" type="text" value="{{ $slides->created_at }}" class="form-control" id="todo" placeholder="Enter todo">
            </div>

            <div class="form-group">
                <label class="control-label" for="todo">Ngày cập nhật:</label>
                <input name="updated_at" type="text" value="{{ $slides->updated_at }}" class="form-control" id="todo" placeholder="Enter todo">
            </div>


            {{-- <div class="form-group">
                <label class="control-label" for="todo">Trạng thái:</label>
                <select name="status" class="form-control">
                    <option value="0" @if($item->status == 0) selected @endif>Chưa làm</option>
                    <option value="1" @if($item->status == 1) selected @endif>Đang làm</option>
                    <option value="2" @if($item->status == 2) selected @endif>Đã làm</option>
                </select>
            </div> --}}


        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
@endsection
