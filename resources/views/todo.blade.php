@extends('master')

@section('container')
<div class="container">
    <a href="{{ route('todos.create') }} " class="btn btn-success">Add</a>
    <div class="table-responsive">
        <table class="table table-hover">
            {{-- @php
                echo 'string';
                if (1>0) {
                    echo 'true';
                }
            @endphp --}}
            <thead>
                @if (count($list)==0)
                    không có dữ liệu
                @else


            <tr>
                <th>#</th>
                <th>Todo</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $key=>$item)


                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item }}</td>
                            <td>23/8/2019</td>
                            <td>23/8/2019</td>
                            <td>
                                <a style="display: inline-block; width: 67px;" href="todos/{{ $key+1 }}" class="btn btn-warning">Show</a>
                                <a style="display: inline-block; width: 67px;" href="todos/{todo}/edit" class="btn btn-success">Edit</a>
                                <form style="display: inline-block;" action="#" method="post" accept-charset="utf-8">
                                    @csrf
                                    {{method_field('delete')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>

                @endforeach

            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
