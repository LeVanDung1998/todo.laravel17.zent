@extends('master')

@section('container')
{{--     <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add todo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body> --}}
{{-- <nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Todo</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#">Danh sách công việc</a></li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Tìm kiếm">
                </div>
                <button type="submit" class="btn btn-default">Tìm</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Thông báo</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">hoannc <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav> --}}
<div class="container">
    <form action="{{ route('todos.store') }}" method="POST" class="" role="form">
            @csrf
            <div class="form-group">
                <legend>Add todo</legend>
            </div>
            <div class="form-group">
                <label class="control-label" for="todo">Todo:</label>
                <input name="title" type="text" class="form-control" id="todo" placeholder="Enter todo">
            </div>
            <div class="form-group">
                <label class="control-label" for="todo">Mô tả:</label>
                <textarea name="content" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label class="control-label" for="todo">Trạng thái:</label>
                <select name="status" class="form-control">
                    <option value="0">Chưa làm</option>
                    <option value="1">Đang làm</option>
                    <option value="2">Đã làm</option>
                </select>
            </div>
            <div class="form-group">
                <div class="">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
    </form>
</div>
{{-- <footer class="footer" style="background-color: #f7f7f7; height: 100px; padding-top: 30px">

    <!-- Copyright -->
    <div class="text-center">© 2019 Copyright:
        <a href="#"> Nguyen Cong Hoan</a>
    </div>
    <!-- Copyright -->

</footer> --}}
{{-- </body>
<!-- Latest compiled and minified CSS & JS -->
<script src="//code.jquery.com/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>
 --}}
@endsection
