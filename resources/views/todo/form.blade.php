<form action="{{ route('post.form') }}" method="post" accept-charset="utf-8">
    {{ @csrf_field()  }}
    <input type="" name="name">
    <button type="submit">Submit</button>

</form>
