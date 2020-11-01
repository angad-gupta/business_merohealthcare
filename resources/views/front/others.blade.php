delete others

<form action="{{ route('others.delete') }}" method="post" enctype="multipart/form-data" >
    {{csrf_field()}}
    <button type="submit"> Delete</button>

</form>