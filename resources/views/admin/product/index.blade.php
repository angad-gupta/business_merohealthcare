@extends('layouts.admin')
@section('title','Products')

@section('content')
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/unify-core.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/unify-components.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/unify-globals.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<style>

.select2-search__field{
 width: 300px !important;
}
h5{
  margin:8px;
}

@media (min-width: 1200px){
.container {
    width: 100%;
}
}

  .dropdown-toggle::after {
    content: "\e900";
    position: relative;
    top: 0.21429rem;
    font-family: "hs-icons" !important;
    font-size: 10px;
    display: none;
    border: none;
    margin-left: 0.5rem;
  }
  .pagination>.disabled>a, .pagination>.disabled>a:focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>span:hover {
    color: #777;
    cursor: not-allowed;
    background-color: #fff;
    border-color: #fff;
}
  </style>

@php
$cats = App\Category::has('childs')->orderBy('cat_name')->get();  
@endphp

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
                                        <h2>All Products</h2>
                                        <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Products <i class="fa fa-angle-right" style="margin: 0 2px;"></i> All Products</p>
                                    </div>
                                </div>
                                @include('includes.notification')
                            </div>   
                        </div>
                        <div>
                          @include('includes.form-error')
                          @include('includes.form-success')



                          <div class="row">
                            <div class="col-sm-12">
                            <div class="container">
                              <a href="{{route('admin-prod-index')}}" style="margin-bottom: 10px; border-radius:30px;margin-top: 10px;" class="btn btn-default"><i class="fa fa-list" aria-hidden="true"></i> All Products</a>
                              <button style="margin-bottom: 10px; border-radius:30px;margin-top: 10px;" class="btn btn-danger " id="bulk_delete"><i class="fa fa-times" aria-hidden="true"></i> Bulk Delete</button>
                              <button style="margin-bottom: 10px;border-radius:30px;margin-top: 10px;" class="btn btn-warning " id="bulk_status"><i class="icon-magic-wand"></i> Bulk Status Change</button>
                              <a href="{{route('admin-prod-import')}}" style="margin-bottom: 10px;border-radius:30px;margin-top: 10px;" class="btn btn-primary " id=""><i class="fa fa-plus"></i> Import</a>
                              <a href="{{route('admin-prod-create')}}" style="margin-bottom: 10px;border-radius:30px;margin-top: 10px;" class="btn btn-success " id=""><i class="fa fa-plus"></i> Add New Product</a>
                              
                              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#categoryChange" aria-expanded="false" aria-controls="collapseExample" style="margin-bottom: 10px;border-radius:30px;margin-top: 10px;">
                                <i class="fa fa-th-large"></i> Bulk Category Change
                              </button>
                              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#categorySearch" aria-expanded="false" aria-controls="collapseExample" style="margin-bottom: 10px;border-radius:30px;margin-top: 10px;">
                                <i class="fa fa-search"></i> Category Search
                               </button>
                             
                              <div class="row">
                                <div class="col-md-6">
                                    <form action="{{route('admin-prod-price-range-search')}}" method="GET">                    
                                      <div style="display: flex;">
                                          <input class="form-control" type="text" id="price-min" name="min" value="{{ isset($min) ? $min:'0'}}">
                                          <span>-</span>
                                          <input class="form-control" type="text" id="price-max" name="max" value="{{ isset($max) ? $max:'250'}}">
                                          <input type="submit" class="btn btn-primary" value="Price Range Search">
                                      </div>
                                  </form>
                        
                                </div>
                                <div class="col-md-6">
                                <form class="example" style="margin-right: 15px; display:flex;" action="{{route('admin-prod-search')}}">
                                  <input class="form-control" type="text" placeholder="Search products" name="search">
                                  <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                                </div>
                              </div>
                              
                            </div>

                            <div class="collapse" id="categoryChange" style="margin-top:10px;background:#dbf3db">
                              <div class="card card-body">
                                <div class="container" style="padding: 5px 0px;">
                                
                                  <div class="form-group">
                                    <div class="col-sm-4">
                                      <h5 class="pull-right" for="cat">Bulk Category Change : </h5>
                                    </div>
                                  
                                    <div class="col-sm-8">
                        
                                      <div class="">
                                      <select id="child_category_id" class="form-control category-multiple" name="childcategory_ids[]" multiple="multiple" required="" style="width: 400px !important;">
                                        @foreach($cats as $cat)
                                          <optgroup label="{{$cat->cat_name}}">
                                            @foreach ($cat->subs()->has('childs')->get() as $subcat)
                                              <optgroup label="&nbsp;&nbsp;&nbsp;{{$subcat->sub_name}}">
                                                @foreach ($subcat->childs as $child)
                                                  <option value="{{$child->id}}"  >&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->child_name }}</option>
                                                @endforeach
                                              </optgroup>
                                            @endforeach
                                          </optgroup>
                                        @endforeach
                                      </select>
                                      <button class="btn btn-success" id="bulk_category" type="submit">Change</button>
                                      </div>
                                    </div>
                                  </div>
                           
                                </div>
                              </div>
                            </div>

                            <div class="collapse" id="categorySearch" style="margin-top:0px;background:#baf2f9">
                              <div class="card card-body">
                                <div class="container" style="padding: 5px 0px;">
                                
                                  <div class="form-group">
                                    <div class="col-sm-4">
                                      <h5 class="pull-right" for="cat">Child Category Search : </h5>
                                    </div>

                                    <div class="col-sm-8">

                                  <form class="example" style="margin-right: 15px; display:flex;" action="{{route('admin-prod-childcategory-search')}}">
                                    <select class="form-control category-multiple-search" name="childcategory_id" multiple="multiple" required="" style="width: 400px !important;">
                                      @foreach($cats as $cat)
                                        <optgroup label="{{$cat->cat_name}}">
                                          @foreach ($cat->subs()->has('childs')->get() as $subcat)
                                            <optgroup label="&nbsp;&nbsp;&nbsp;{{$subcat->sub_name}}">
                                              @foreach ($subcat->childs as $child)
                                                <option value="{{$child->id}}"  >&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->child_name }}</option>
                                              @endforeach
                                            </optgroup>
                                          @endforeach
                                        </optgroup>
                                      @endforeach
                                    </select>
                                    <button class="btn btn-primary" type="submit" style="margin-left: 5px;">Search</button>
                                  </form>
                                    </div>
                                  </div>
                              
                                </div>
                              </div>
                            </div>
                            
                        


                              <div class="table-responsive">
                                <table id="" class="table table-striped table-hover products dt-responsive" cellspacing="0" width="100%">
                                  <thead>
                                      <tr>
                                        <th width="50px">Select</th>
                                        <th style="width: 150px;">Date</th>
                                        <th style="width: 150px;">Vendor Name</th>
                                        <th style="width: 150px;">Product Title</th>
                                        <th style="width: 100px;">Price</th>
                                        <th style="width: 150px;">Stock</th>
                                        <th style="width: 130px;">Status</th>
                                        <th style="width: 370px;">Actions</th></tr>
                                  </thead>

                                  <tbody>

                                    @if($prods != null)
                                    @foreach($prods as $prod)    
                                        <tr>
                                          @php
                                            $name = str_replace(" ","-",$prod->name);
                                            $prod->pprice = $prod->cprice;
                                            $prod->cprice = $prod->getPrice(1);
                                          @endphp
                                         
                                           <td>
                                            <label class="form-check-inline u-check g-pl-25">
                                              <input class="product_checkbox" type="checkbox" value="{{$prod->id}}" hidden>
                                              <div class="u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
                                                <i class="fa" data-check-icon=""></i>
                                              </div>
                                            </label>
                                          </td>
                                           <td> {{date('d M Y h:i A',strtotime($prod->created_at))}} </td>
                                           <td>
                                            @if($prod->user_id)
                                            @php
                                                $vendor = App\User::findOrFail($prod->user_id);
                                            @endphp
                                                {{$vendor->name}}
                                            @else
                                            Admin Product
                                            @endif
                                        </td>
                                          <td><a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" target="_blank">{{strlen($prod->name) > 50 ? substr($prod->name, 0, 50) : $prod->name}}</a><small style="display: block; color: #777;">ID: {{sprintf("%'.08d", $prod->id)}}</small></td>
                                          <td> 
                                            {{$sign->sign}}{{round(($prod->cprice * $sign->value), 2)}} 
                                            @if($prod->cprice != $prod->pprice)
                                              <button class="btn btn-success product-btn btn-xs" type="button" style="font-size: 12px;">On Sale
                                              </button>
                                            @endif
                                          </td>
                                          <td>
                                              @php
                                              $stck = (string)$prod->stock;
                                              @endphp
                                              @if($stck == "0")
                                              {{"Out Of Stock"}}
                                              @elseif($stck == null)
                                              {{"Unlimited"}}
                                              @else
                                              {{$prod->stock}}
                                              @endif
                                          </td>

                                          <td>                                         
                                            <span class="dropdown">
                                              <button class="btn btn-{{$prod->status == 1 ? "success" : "danger"}} product-btn dropdown-toggle btn-xs" type="button" data-toggle="dropdown" style="font-size: 14px;">{{$prod->status == 1 ? "Activated" : "Deactivated"}}
                                                  <span class="caret"></span>
                                              </button>
                                              <ul class="dropdown-menu">
                                                  <li><a href="{{route('admin-prod-st',['id1'=>$prod->id,'id2'=>1])}}">Active</a></li>
                                                  <li><a href="{{route('admin-prod-st',['id1'=>$prod->id,'id2'=>0])}}">Deactive</a></li>
                                              </ul>
                                            </span>
                                          </td>
                                          <td>

                                            <a href="{{route('admin-prod-edit',$prod->id)}}" class="btn btn-primary product-btn"><i class="fa fa-edit"></i> Edit</a>
                                            <a style="cursor: pointer;" class="btn btn-info product-btn feature" data-toggle="modal" data-target="#feature">
                                              <input type="hidden" value="{{$prod->id}}">
                                              <i class="fa fa-star"></i> Highlight
                                            </a>
                                            <a style="cursor: pointer; background-color: #0165cb;" class="btn btn-info product-btn view-gallery" data-toggle="modal" data-target="#myModal">
                                              <input type="hidden" value="{{$prod->id}}">
                                              <i class="fa fa-eye"></i> Gallery
                                            </a>
                                            <a href="javascript:;" data-href="{{route('admin-prod-delete',$prod->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger product-btn"><i class="fa fa-trash"></i></a>
                                            <a href="{{route('admin-prod-duplicate', $prod->id)}}" class="btn btn-success" style="border-radius:30px;" title="Duplicate Product"><i class="icon-docs"></i></a>
                                          </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    No Product Fouund !
                                    @endif

                                  </tbody>
                                
                                </table>
                                <div class="text-right">
                                {!! $prods->render() !!}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <!-- Ending of Dashboard data-table area -->
          </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="feature" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          </div>
      </div>
  </div>

  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title text-center" id="myModalLabel">Confirm Delete</h4>
              </div>
              <div class="modal-body">
                  <p class="text-center">You are about to delete this Product. Everything will be deleted under this Product.</p>
                  <p class="text-center">Do you want to proceed?</p>
              </div>
              <div class="modal-footer" style="text-align: center;">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-danger btn-ok">Delete</a>
              </div>
          </div>
      </div>
  </div>

  <div id="myModal" class="modal fade gallery" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Image Gallery</h4>
        </div>
        <div class="modal-body">
          <div class="gallery-btn-area text-center">
            <form  method="POST" enctype="multipart/form-data" id="form-gallery">
              {{ csrf_field() }}
              <input style="display: none;" type="file" accept="image/*" id="gallery" name="gallery[]" multiple/>
            <input type="hidden" name="product_id" value="" id="pid">
            </form>
              <a style="cursor: pointer;" class="btn btn-info gallery-btn mr-5" id="prod_gallery"><i class="fa fa-download"></i> Upload Images</a>
              <a style="cursor: pointer; background: #009432;" class="btn btn-info gallery-btn mr-5" data-dismiss="modal"><i class="fa fa-check" ></i> Done</a>
              <p style="font-size: 11px;">You can upload multiple images.</p>
          </div>

          <div class="gallery-wrap">
                  <div class="row">
                  </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
  <script type="text/javascript">

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $(document).on("click", ".feature" , function(){
        var max = '';
        var pid = $(this).parent().find('input[type=hidden]').val();
        $("#feature .modal-content").html('');
        $.ajax({
          type: "GET",
          url:"{{URL::to('/json/feature')}}",
          data:{id:pid},
          success:function(data){
            data[0] = data[0] == 1 ? "checked":"";
            data[1] = data[1] == 1 ? "checked":"";
            data[2] = data[2] == 1 ? "checked":"";
            data[3] = data[3] == 1 ? "checked":"";
            data[4] = data[4] == 1 ? "checked":"";
            data[5] = data[5] == 1 ? "checked":"";
            $("#feature .modal-content").append(''+
              '<form class="form-horizontal" action="{{url('/')}}/admin/product/feature/'+data[6]+'" method="POST">'+
                '{{csrf_field()}}'+
                '<div class="modal-header">'+
                    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
                    '<h4 class="modal-title text-center" id="myModalLabel2">Product Title:'+data[7]+'</h4>'+
                '</div>'+
                '<div class="modal-body">'+
                  '<div class="form-group">'+
                    '<label class="control-label" for="check1"></label>'+
                        '<div class="col-sm-9 col-sm-offset-3">'+
                          '<div class="btn btn-default checkbox1">'+
                              '<input type="checkbox" id="check1" name="featured" value="1" '+data[0]+'>'+ 
                                '<label for="check1">Add Product to {{$lang->bg}}</label>'+
                                  '</div>'+
                                  '</div>'+          
                                  '</div>'+
                                  '<div class="form-group">'+
                                '<label class="control-label" for="check2"></label>'+
                                '<div class="col-sm-9 col-sm-offset-3">'+
                                    '<div class="btn btn-default checkbox1">'+
                                    '<input type="checkbox" id="chec2" name="best" value="1" '+data[1]+'>'+
                                    '<label for="chec2">Add Product to {{$lang->lm}}</label>'+
                                  '</div>'+
                                  '</div>'+
                                '</div>'+
                              '<div class="form-group">'+
                              '<label class="control-label" for="check3"></label>'+
                                '<div class="col-sm-9 col-sm-offset-3">'+
                                  '<div class="btn btn-default checkbox1">'+
                                    '<input type="checkbox" id="chec3" name="top" value="1" '+data[2]+'>'+
                                      '<label for="chec3">Add Product to {{$lang->rds}}</label>'+
                                        '</div>'+
                                        '</div>'+
                                        '</div>'+
                                      '<div class="form-group">'+
                                        '<label class="control-label" for="check4"></label>'+
                                          '<div class="col-sm-9 col-sm-offset-3">'+
                                            '<div class="btn btn-default checkbox1">'+
                                              '<input type="checkbox" id="check4" name="hot" value="1" '+data[3]+'>'+
                                                '<label for="check4">Add Product to {{$lang->hot_sale}}</label>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                              '<label class="control-label" for="check5"></label>'+
                                                '<div class="col-sm-9 col-sm-offset-3">'+
                                                  '<div class="btn btn-default checkbox1">'+
                                                    '<input type="checkbox" id="check5" name="latest" value="1" '+data[4]+'>'+
                                        '<label for="check5">Add Product to {{$lang->latest_special}}</label>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<label class="control-label" for="check6"></label>'+
                                                '<div class="col-sm-9 col-sm-offset-3">'+
                                                  '<div class="btn btn-default checkbox1">'+
                                                    '<input type="checkbox" id="check6" name="big" value="1" '+data[5]+'>'+
                                                '<label for="check6">Add Product to {{$lang->big_sale}}</label>'+
                                                  '</div>'+
                                                '</div>'+
                                            '</div>'+
                '</div>'+
                '<div class="modal-footer" style="text-align: center;">'+
                  '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>'+
                  '<button type="submit" class="btn btn-primary btn-ok">Update</button>'+
                '</div>'+
              '</form>'
            );            
          }
        });
    });

    $( document ).ready(function() {
      $(".add-button").append('<div class="col-sm-4 add-product-btn text-right">'+
        '<a href="{{route('admin-prod-create')}}" class="add-newProduct-btn">'+
        '<i class="fa fa-plus"></i> Add New Product</a>'+
        '<a href="{{route('admin-prod-import')}}" class="add-newProduct-btn">'+
        '<i class="fa fa-plus"></i> Import New Products</a>'+
        '</div>');                                                                       
    });

    $(document).on("click", ".view-gallery" , function(){
      var pid = $(this).parent().find('input[type=hidden]').val();
      $('#pid').val(pid);
      $('.gallery-wrap .row').html('');
      $.ajax({
        type: "GET",
        url:"{{URL::to('/json/gallery')}}",
        data:{id:pid},
        success:function(data){
          if(data[0] == 0)
          {
            $('.gallery-wrap .row').html('<h3 class="text-center">No Images Found.</h3>');
          }
                
          else {

            var arr = $.map(data[1], function(el) {
            return el });
            for(var k in arr)
            {
                $('.gallery-wrap .row').append('<div class="col-sm-4">'+
                    '<div class="gallery__img">'+
                    '<img src="'+'{{asset('assets/images/gallery').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                    '<div class="gallery-close">'+
                    '<input type="hidden" value="'+arr[k]['id']+'">'+
                    '<i class="fa fa-close"></i>'+
                    '</div>'+
                    '</div>'+
                    '</div>');
            }                         
          }

        }
      });
    });

    $(document).on('click', '#prod_gallery' ,function() {
      $('#gallery').click();
    });
  
    $("#gallery").change(function(){
      var pid = $("#pid").val();
      var total_file = document.getElementById("gallery").files.length;
      $("#form-gallery").submit();  
    });
  </script>

  <script type="text/javascript">
    $(document).on('submit', '#form-gallery' ,function() {
      $.ajax({
        url:"{{URL::to('/json/addgallery')}}",
        method:"POST",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
          if(data != 0)
          {
            var arr = $.map(data, function(el) {
              return el 
            });
            for(var k in arr)
            {
                $('.gallery-wrap .row').append('<div class="col-sm-4">'+
                    '<div class="gallery__img">'+
                    '<img src="'+'{{asset('assets/images/gallery').'/'}}'+data[k]['photo']+'" alt="gallery image">'+
                    '<div class="gallery-close">'+
                    '<input type="hidden" value="'+data[k]['id']+'">'+
                    '<i class="fa fa-close"></i>'+
                    '</div>'+
                    '</div>'+
                    '</div>');
            }          
          }
        }

      });
      return false;
    }); 

  </script>

  <script type="text/javascript">
      $(document).on('click', '.gallery-close' ,function() {
        var pid = $(this).find('input[type=hidden]').val();
        $(this).parent().parent().remove();
        $.ajax({
          type: "GET",
          url:"{{URL::to('/json/removegallery')}}",
          data:{id:pid}
        });
      });
  </script>

{{-- <script type="text/javascript">
  $(document).ready(function () {


      $('#master').on('click', function(e) {
       if($(this).is(':checked',true))  
       {
          $(".sub_chk").prop('checked', true);  
       } else {  
          $(".sub_chk").prop('checked',false);  
       }  
      });


      $('.delete_all').on('click', function(e) {


          var allVals = [];  
          $(".sub_chk:checked").each(function() {  
              allVals.push($(this).attr('data-id'));
          });  


          if(allVals.length <=0)  
          {  
              alert("Please select row.");  
          }  else {  


              var check = confirm("Are you sure you want to delete this row?");  
              if(check == true){  


                  var join_selected_values = allVals.join(","); 
                  console.log('join_selected_values');

                  $.ajax({
                      url: $(this).data('url'),
                      type: 'GET',
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      data: 'ids='+join_selected_values,
                      success: function (data) {
                          if (data['success']) {
                              $(".sub_chk:checked").each(function() {  
                                  $(this).parents("tr").remove();
                              });
                              alert(data['success']);
                          } else if (data['error']) {
                              alert(data['error']);
                          } else {
                              alert('Whoops Something went wrong!!');
                          }
                      },
                      error: function (data) {
                          alert(data.responseText);
                      }
                  });


                $.each(allVals, function( index, value ) {
                    $('table tr').filter("[data-row-id='" + value + "']").remove();
                });
              }  
          }  
      });


      $('[data-toggle=confirmation]').confirmation({
          rootSelector: '[data-toggle=confirmation]',
          onConfirm: function (event, element) {
              element.trigger('confirm');
          }
      });


      $(document).on('confirm', function (e) {
          var ele = e.target;
          e.preventDefault();


          $.ajax({
              url: ele.href,
              type: 'DELETE',
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              success: function (data) {
                  if (data['success']) {
                      $("#" + data['tr']).slideUp("slow");
                      alert(data['success']);
                  } else if (data['error']) {
                      alert(data['error']);
                  } else {
                      alert('Whoops Something went wrong!!');
                  }
              },
              error: function (data) {
                  alert(data.responseText);
              }
          });


          return false;
      });
  });
</script> --}}

<script>

$(document).on('click', '#bulk_delete', function(){
  var id = [];
  if(confirm("Are you sure you want to Delete this data?"))
  {
      $('.product_checkbox:checked').each(function(){
          id.push($(this).val());
      });
      console.log(id);
      if(id.length > 0)
      {
          $.ajax({
              url:"{{ route('admin-prod-delete-all')}}",
              method:"get",
              data:{id:id},
              success:function(data)
              {
                  alert(data);
                  setTimeout(function(){
                    location.reload(); 
                    }, 500); 
              }
          });
      }
      else
      {
          alert("Please select atleast one Product");
      }
  }
});



$(document).on('click', '#bulk_status', function(){
  var id = [];
  
  if(confirm("Are you sure you want to change status of these data?"))
  {
      $('.product_checkbox:checked').each(function(){
          id.push($(this).val());
      });
      console.log(id);
      if(id.length > 0)
      {
          $.ajax({
              url:"{{ route('admin-prod-multiplestatus')}}",
              method:"get",
              data:{id:id},
              success:function(data)
              {
                  alert(data);
                  setTimeout(function(){
                    location.reload(); 
                    }, 100); 
              }
          });
      }
      else
      {
          alert("Please select atleast one Product");
      }
  }
});

$(document).on('click', '#bulk_category', function(){
  var id = [];
  var child_category_id = [];

  var child_category_id = $('#child_category_id').val();

  console.log(child_category_id);

  if(confirm("Are you sure you want to change category of this data?"))
  {
      $('.product_checkbox:checked').each(function(){
          id.push($(this).val());
      });
      console.log(id);
      if(id.length > 0)
      {
          $.ajax({
              url:"{{ route('admin-prod-category-change')}}",
              method:"get",
              data:{id:id,child_category_id:child_category_id},
              success:function(data)
              {
                  alert(data);
                  setTimeout(function(){
                    location.reload(); 
                    }, 500); 
              }
          });
      }
      else
      {
          alert("Please select atleast one Product");
      }
  }
});

</script>

<script>
  $('.category-multiple').select2({
      placeholder: 'Category Select'
    });
  </script>
  <script>
    $(document).ready(function() {
    $('.category-multiple-search').select2({
        placeholder: 'Category Search'
      });
    });
    </script>

@endsection