@extends('master')

@section('object')
User
@endsection

@section('title')
User
@endsection
@section('container')
<div class="container">
    <a href="{{ route('users.create') }}" class="btn btn-success">Add</a>
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
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>

                <th>Created at</th>
                <th>Updated at</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $key=>$item)


                        <tr id="tr-{{ $item->id }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>

                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td>
                                <a style="display: inline-block; width: 67px;" href=" {{ route('users.show',$item->id) }}" class="btn btn-warning">Show</a>
                                <a style="display: inline-block; width: 67px;" href=" {{ route('users.edit',$item->id) }}  " class="btn btn-success">Edit</a>
                                {{-- <form style="display: inline-block;" action=" {{ route('users.destroy', $item->id) }}" method="post" accept-charset="utf-8">
                                    @csrf>

                                    {{method_field('delete')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form> --}}
                                 <button type="submit" class="btn btn-danger btn_delete" data-url="{{ route('users.destroy', $item->id) }}" data-id='{{ $item->id }}'>Delete</button>
                            </td >
                                  </tr>

                @endforeach

            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection


@section('footer_btn_delete')
    <script  type="text/javascript" charset="utf-8" >
//             $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });
            $('.btn_delete').on('click',function(event){
                event.preventDefault();
                var url = $(this).attr('data-url');
                var id  = $(this).data('id');
                swal({
                      title: "Are you sure?",
                      text: "Once deleted, you will not be able to recover this imaginary file!",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                      $.ajax({
                            type:'post',
                            url: url,
                            data: {
                                _method: 'delete',
                                _token: '{{ csrf_token() }}',
                            },
                            success : function(response){
                                $('#tr-'+id).remove();
                                toastr["success"]("Xóa sản phẩm thành công", "Thông báo")
                                // toastr["success"]("Xóa thành công!!!!!!");
                            }
                        });

                        // window.location.href=url;
                        // swal("Poof! Your imaginary file has been deleted!", {
                        //   icon: "success",
                        // });
                      } else {
                        toastr["warning"]("Giữ nguyên dữ liệu","Thông báo");
                        // swal("Your imaginary file is safe!");
                      }
                    });
            });
    </script>
@endsection
