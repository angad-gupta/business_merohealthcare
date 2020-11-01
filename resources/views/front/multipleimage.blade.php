@foreach($multiple_image as $multiple_img)
<a href="{{$multiple_img->file}}">asasas{{$multiple_img->file}}asasas</a>
@endforeach

@foreach($multiple_image as $image)
    <img src="{{ url('file/') . $image->file }}">
    <a href="">{{ url('file/') . $image->file }}</a>
@endforeach



<h4><i class="glyphicon glyphicon-picture"></i> Display Data Image    </h4>
<table class="table table-bordered table-hover table-striped">
 <thead>
 <tr><th>#</th>
     <th>Picture</th>
 </tr>
 </thead>
 <tbody>
     @foreach($multiple_image as $image)
    <tr><td>{{$image->id}}</td>
        <td> <?php foreach (json_decode($image->file)as $picture) { ?>
              <img src="{{ asset('/files/'.$picture) }}" style="height:120px; width:200px"/>
            
        <a href="{{ asset('/files/'.$picture) }}">{{$picture}}</a>
             <?php } ?>
        </td>
   </tr>
     @endforeach
 </tbody>
</table>