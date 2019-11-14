@extends('backend.layout.master')
@section('title')
    Product
@endsection
@section('content-header')
    <!-- Content Header -->
<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Danh sách sản phẩm</h1>
            </div><!-- /.col -->


            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                    <li class="breadcrumb-item active">Danh sách</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

            @if (session()->has('success'))
                <span style="color: green">{!! session()->get('success') !!}</span>
            @endif

            @if (session()->has('success_img_fail'))
                <span style="color: green">{!! session()->get('success_img_fail') !!}</span>
            @endif

            @if (session()->has('success_img'))
                <span style="color: green">{!! session()->get('success_img') !!}</span>
            @endif


            @if (session()->has('fail'))
                <span style="color: red">{!! session()->get('fail') !!}</span>
            @endif

             @if (session()->has('success_update'))
                <span style="color: green">{!! session()->get('success_update') !!}</span>
            @endif

             @if (session()->has('fail_update'))
                <span style="color: red">{!! session()->get('fail_update') !!}</span>
            @endif
@endsection
@section('content')

<!-- Content -->
<div class="container-fluid">
        <!-- Main row -->
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sản phẩm mới nhập</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Người tạo</th>
                                <th>Thời gian nhập</th>
                                <th>Hành động</th>
                                <th>Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>

                                        <td>
                                        @if (isset ($product->category))
                                            {{ $product->category->name }}
                                             @else
                                            Không có
                                        @endif
                                        </td>

                                        <td>
                                        @if (isset ($product->user))
                                            {{ $product->user->name }}
                                            @else
                                            Không có
                                        @endif
                                        </td>

                                        <td>{{ $product->created_at }}</td>
                                        <td>
                                            <a style="display: inline-block; width: 35px;" href="{{ route('backend.product.show',$product->id) }}" class="btn btn-success"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                            <a style="display: inline-block; width: 35px;" href="{{ route('backend.product.edit',$product->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger" style="display: inline-block; width: 35px;" href="{{ route('backend.product.destroy', $product->id) }}" data-toggle="modal" data-target="#exampleModalCenter-{{$product->id}}"><i class="fas fa-trash-alt"></i></a>
                                            <div class="modal fade" id="exampleModalCenter-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle" style="display: inline-block;">Bạn có chắc chắn xóa ko?</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>
                                                          <div class="modal-body">
                                                             <h4>Bạn chắc chắn muốn xóa?</h4>
                                                          </div>
                                                          <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <form style="display: inline-block;" action="{{ route('backend.product.destroy', $product->id) }}" method="post" accept-charset="utf-8">
                                                                @csrf
                                                                {{method_field('delete')}}
                                                                <button type="submit" class="btn btn-danger">Đồng ý</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                 </div>
                                            </div>

                                        </td>
                                        </td>
                                        <td>
                                            @if ($product->status==1)
                                                    Mới nhập
                                                @elseif($product->status==2)
                                                    Mở bán
                                                @else
                                                    Hết hàng
                                                @endif</td>
                                        </tr>
                                @endforeach



                            </tbody>
                        </table>
                          {!! $products->links() !!}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
@endsection
