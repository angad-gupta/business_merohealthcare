@extends('layouts.admin')
@section('title','Categories')

@section('content')

<div class="right-side">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- Starting of Dashboard data-table area -->
            <div class="section-padding add-product-1">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="add-product-box">
                        <div class="product__header">
                            <div class="row reorder-xs">
                                <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                    <div class="product-header-title">
                                        <h2>Career</h2>
                                        <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Career <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Descriptions</p>
                                    </div>
                                </div>
                                @include('includes.notification')
                            </div>   
                        </div>
                        <div>
                          @include('includes.form-error')
                          @include('includes.form-success')

                          <div class="container">
                              <br/>
                            <h3>First Section</h3>
                            <hr>

                            @php

                            $description = App\CareerDescription::orderBy('id','desc')->get();
                            $hirings= App\CareerHiring::orderBy('id','desc')->get();
                                
                            @endphp
                            
                            @foreach($description as $dd)
                            @if($dd->points == null)
                            <form class="form-horizontal" action="{{route('admin-career-descriptions-post',$dd->id)}}" method="POST" enctype="multipart/form-data">
                                @include('includes.form-error')
                                @include('includes.form-success')      
                              {{csrf_field()}}
                         
                              
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="setup_new_logo">Title *</label>
                                    <div class="col-sm-6">
                                    <input  type="text" placeholder="Title" name="title" value="{{$dd->title}}" style="width:500px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="setup_new_logo">Description *</label>
                                    <div class="col-sm-6">
                                    <textarea  type="text" placeholder="Descriptions" name="description" style="height:200px;width:500px;" >{{$dd->description}}</textarea>
                                    </div>
                                </div>
                                    <hr>
                                    <div class="add-product-footer">
                                        <button name="addProduct_btn" type="submit" class="btn add-product_btn">Submit</button> 
                                    </div>

                            
                            </form>
                            @endif

                            @endforeach

                            @foreach($description as $p)
                                @if($p->title == null && $p->description == null )
                                <form class="form-horizontal" action="{{route('admin-career-descriptions-post',$p->id)}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="field_wrapper">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="setup_new_logo" style="    text-align: end;">Points *</label>
                                            <input type="text" name="points" value="{{$p->points}}" style="width:500px;"/>
                                            <button type="submit" class="btn"><i class="fa fa-check"></i></button> 
                                         
                                        </div>
                                    </div>
                               
                                           

                                    
                                </form>
                                @endif
                            @endforeach



                            <div class="container">
                                <br/>
                              <h3>Second Section</h3>
                            @foreach($hirings as $h)
                              <form class="form-horizontal" action="{{route('admin-career-hirings-post', $h->id)}}" method="POST" enctype="multipart/form-data">
                  
                              {{csrf_field()}}

                           
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="current_logo">Current Image</label>
                                <div class="col-sm-6">
                                <div class="col-sm-6"><img style="width: 100%; height: auto;" id="adminimg" src="{{ $h->image ? asset('assets/images/'.$h->image):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="" id="adminimg">
                                    </div>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-4" for="current_logo">Choose Image</label>
                                <div class="col-sm-6">
                                  <input type="file" name="filename" value="" />
                                   
                                </div>
                              </div>
                              
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="setup_new_logo">Title *</label>
                                    <div class="col-sm-6">
                                    <input  type="text" placeholder="Title" name="title" value="{{$h->title}}" style="width:500px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="setup_new_logo">Description *</label>
                                    <div class="col-sm-6">
                                    <textarea  type="text" placeholder="Descriptions" name="description" style="height:200px;width:500px;" >{{$h->description}}</textarea>
                                    </div>
                                </div>
                                    <hr>
                                    <div class="add-product-footer">
                                        <button name="addProduct_btn" type="submit" class="btn add-product_btn">Submit</button> 
                                    </div>

                            
                            </form>
                            @endforeach
                            </div>
                            


                         
          </div>
      </div>
    </div>
  </div>
  
@endsection

@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $( document ).ready(function() {
        $(".add-button").append('<div class="col-sm-4 add-product-btn text-right">'+
          '<a href="{{route('admin-cat-create')}}" class="add-newProduct-btn">'+
          '<i class="fa fa-plus"></i> Add New Category</a>'+
          '</div>');                                                                       
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = ' <div class="form-group"> <label class="control-label col-sm-4" for="setup_new_logo">Points</label><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><i class="fa fa-remove"></i></a></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
    </script>

@endsection