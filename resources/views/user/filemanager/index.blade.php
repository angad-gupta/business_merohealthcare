@extends('layouts.user')
@section('title','File manager')
@section('styles')


  <style>
    .invalid-feedback{
      color: red
    }

    @media only screen and (max-width: 600px) {
        #filesubmit{
            margin-top: 10px !important;
        }
        
    }
  </style>
@endsection
@section('content')

<style>

  .blog-wrap {
      background: #fff;
  }
  
    .form-control{
      border-radius: 30px;
    }
  #drop-zone {
    width: 100%;
    min-height: 80px;
    border: 1px dashed rgba(0, 0, 0, .3);
    border-radius: 5px;
    font-family: Arial;
    text-align: center;
    position: relative;
    font-size: 20px;
    color: #7E7E7E;
    border-radius:30px;
  }
  #drop-zone input {
    position: absolute;
    cursor: pointer;
    left: 0px;
    top: 0px;
    opacity: 0;
  }
  /*Important*/
  
  #drop-zone.mouse-over {
    border: 3px dashed rgba(0, 0, 0, .3);
    color: #7E7E7E;
  }
  /*If you dont want the button*/
  
  #clickHere {
    display: inline-block;
      cursor: pointer;
      color: white;
      font-size: 17px;
      width: 50px;
      border-radius: 4px;
      background-color: #2385aa;
      padding: 10px;
      border-radius: 30px;
  
  }
  #clickHere:hover {
    background-color: #376199;
  }
  #filename {
    margin-top: 10px;
    margin-bottom: 10px;
    font-size: 14px;
    line-height: 1.5em;
  }
  .file-preview {
    background: #ccc;
    border: 1px solid #fff;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
    display: inline-block;
    width: 60px;
    height: 60px;
    text-align: center;
    font-size: 14px;
    margin-top: 5px;
  }
  .closeBtn:hover {
    color: red;
    display:inline-block;
  }
  }
  </style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
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
                      <div class="row represcription-xs">
                          <div class="col-lg-8 col-md-5 col-sm-5 col-xs-12">
                              <div class="product-header-title">
                                  <h2>Presciption File Manager <a href="{{route('user-family.index')}}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a></h2>
                                  <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> File manager</p>
                              </div>
                          </div>
                            @include('includes.user-notification')
                      </div>   
                  </div>
                  <div>

                    
                    @include('includes.form-success')

                    <br/>

                    <div class="row">
                    
                    <div class="container">
                    <div class="col-md-6 col-xs-12">
                    <div class=""  >
                      <h4>Manage Your Prescription Files. </h4>
                      
                        <form method="POST" action="{{route('user-prescriptions.filestorefamilysingle',$user->id)}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                         <div class="row" style="padding:20px; background:#f1f1f1; margin:10px; border-radius:30px;">  
                          
                          <div class="col-lg-12 col-md-12 col-sm-12">
                         
                          
                            <label class="g-color-gray-dark-v2 g-font-size-13">Prescription File(s) Upload </label>
                            <div id="drop-zone">

                        
                              <span class="u-icon-v4 u-icon-v4-rounded-10 u-icon-v4-bg-primary g-color-white" style="margin-top:7px; border-radius:30px;">
                              <div id="clickHere" style="margin-top: 15px;"><i class="icon-docs"></i>
                                <input type="file" name="filenames[]" id="file" multiple />
                              </div>
                              </span>
                              <span style="font-size:14px;">Or, Drop files here</span>
                              <h6 class="">File type: jpeg,jpg,png,pdf</h6>
                              <div id='filename'></div>
                            </div>
                       
                        
                    </div>
                           
                          <div class="col-lg-12 col-md-12 col-sm-12">

                            <label class="g-color-gray-dark-v2 g-font-size-13">Prescription Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Prescription Title" />
                   
                            <label class="g-font-size-13"></label>
                          <button id="filesubmit" class="btn btn-primary btn-block " type="submit" style="border-radius:30px;">Submit</button>
                      </div>
            
                </div>  
                </form>
                      </div>
                      </div>

             

                    </div>
                    </div>
                

                
        
                        <div class="table-responsive" style="margin-top:15px;">
                          <table id="product-table_wrapper" class="table table-striped table-hover products dt-responsive" cellspacing="0" width="100%">
                            <div style="margin-left: 20px;">
                            <h4>Presciption Group File Details</h4>
                            </div>
                            {{-- <p>Suitable to hide old prescription which is not required to prevent accidental orders on old prescriptions.  </p> --}}
                            <thead>
                              
                              <tr class="table-header-row">
                                <th>#</th>
                                <th>Prescription Title</th>
                                <th>Prescription File</th>
                                {{-- <th>Name </th> --}}
                                <th>Date </th>
                                {{-- <th>Relation </th> --}}
                                <th>Staus</th>
                                <th>Actions</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                              
                            @foreach($p_folder as $pf)

                        
                            @if($pf->status == 'active')
                     
                            {{-- @php
                            $t = $pf->title;
                            $count = 0;
                            if($pf->title ==  $t ){
                              $count = $count +1;
                            }
                           
                            @endphp --}}

                       
                          
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                <td>{{ $pf->title }}</td>
                                <td>
                                  {{-- @foreach($p_file as $pf)
                                  
                                    @if($pf->title == $t ) --}}
                                    {{-- <a href="{{ route('user-file',[$pf->file]) }}"><i class="fa fa-picture-o" aria-hidden="true" style="font-size:25px;"></i></a> --}}
                                    {{-- @endif
                                  @endforeach --}}

                                  @foreach($pf->files as $f)
                                    @if($f->status == 'active')
                                      <a href="{{ route('user-file',[$f->file]) }}"><img src="{{asset('storage/app/public/prescriptions/'.$f->file)}}" style="height:40px;width:40px;border-radius:10px;" alt="{{$f->file}}"/></a>
                                    @endif
                                   @endforeach
                                </td>
                             
                                {{-- <td>
                                  @php
                                  $family_name = App\Family::where('id','=', $pf->family_id)->get(); 
                                  @endphp
                                 
                                    @if($pf->family_id == null)
                                      <p>Self</p>
                                    @else
                                        @foreach ($family_name as $fn)
                                          {{ $fn->name }}
                                          @endforeach
                                    @endif
                                 
                              </td> --}}

                              <td>{{date('d M Y',strtotime($pf->created_at))}}</td>

                              {{-- <td>
                              
                                @php
                                $family_name = App\Family::where('id','=', $pf->family_id)->get(); 
                              
                                @endphp

                              @if($pf->family_id == null)
                              <p>Self</p>
                              @else
                                @foreach ($family_name as $fn)
                                {{ $fn->relation }}
                                @endforeach
                              @endif
                              
                              </td>  --}}
                            
                              <td>
                                @if($pf->status == 'active')
                                <span class="label label-success">Show</span>
                                @else
                                <span class="label label-danger">Hide</span>
                                @endif 
                            </td>

                                 <td>
                                    <a href="javascript:;" data-toggle="modal" data-target="#update-title" data-href="{{route('user-filemanagertitleupdate', $pf->id)}}" class="btn btn-primary" style="border-radius:30px;"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                  @if($pf->status == 'active')
                                  <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" data-href="{{route('user-filemanagerupdate', $pf->id)}}" class="btn btn-danger" style="border-radius:30px;"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                  @endif
                                 
        
                                </td>
                      
                                </tr>
                       
                               {{-- @endif
                                  @endforeach --}}
                                @endif
                            @endforeach
                              
                            </tbody>
                          </table>
                        </div>

                        <div class="container" style="margin-top:20px;">
                          <h4>Presciption All File Details</h2>
                          
                          <button onclick="change()" id="myButton1" type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo" style="margin-bottom:20px;border-radius:30px;">Show</button>
                          <div id="demo" class="collapse">
                            <div class="table-responsive">
                              <table id="product-table_wrapper" class="table table-striped table-hover products dt-responsive" cellspacing="0" width="100%">
                                <div class="">
                                  <br/>
                              
                                <h4>Presciption Each Files Details</h4>
                                </div>
                                {{-- <p>Suitable to hide old prescription which is not required to prevent accidental orders on old prescriptions.  </p> --}}
                                <thead>
                                  
                                  <tr class="table-header-row">
                                    <th>#</th>
                                    <th>Prescription Title</th>
                                    <th>Prescription File</th>
                                    <th>Name </th>
                                    <th>Date </th>
                                    {{-- <th>Relation </th> --}}
                                    {{-- <th>Staus</th> --}}
                                    <th>Actions</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                  
                                @foreach($pfiles as $pf)
    
                            
                                @if($pf->status == 'active')

                                
                         
                                {{-- @php
                                $t = $pf->title;
                                $count = 0;
                                if($pf->title ==  $t ){
                                  $count = $count +1;
                                }
                               
                                @endphp --}}
    
                                
                              
                                    <tr>
                                      <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pf->title }}</td>
                                    <td>
                                      {{-- @foreach($p_file as $pf)
                                      
                                        @if($pf->title == $t ) --}}
                                        {{-- <a href="{{ route('user-file',[$pf->file]) }}"><i class="fa fa-picture-o" aria-hidden="true" style="font-size:25px;"></i></a> --}}
                                        {{-- @endif
                                      @endforeach --}}
    
                               
                                       <a href="{{ route('user-file',[$pf->file]) }}"><img src="{{asset('storage/app/public/prescriptions/'.$pf->file)}}" style="height:40px;width:40px;border-radius:10px;" alt="{{$pf->file}}"/></a>
                                
                                    </td>
                                 
                                    {{-- <td>
                                      @php
                                      $family_name = App\Family::where('id','=', $pf->family_id)->get(); 
                                      @endphp
                                     
                                        @if($pf->family_id == null)
                                          <p>Self</p>
                                        @else
                                            @foreach ($family_name as $fn)
                                              {{ $fn->name }}
                                              @endforeach
                                        @endif
                                     
                                  </td> --}}
    
                                  <td>{{date('d M Y',strtotime($pf->created_at))}}</td>
    
                                  {{-- <td>
                                  
                                    @php
                                    $family_name = App\Family::where('id','=', $pf->family_id)->get(); 
                                  
                                    @endphp
    
                                  @if($pf->family_id == null)
                                  <p>Self</p>
                                  @else
                                    @foreach ($family_name as $fn)
                                    {{ $fn->relation }}
                                    @endforeach
                                  @endif
                                  
                                  </td> 
                                 --}}
                                  {{-- <td>
                                    @if($pf->status == 'active')
                                    <span class="label label-success">Show</span>
                                    @else
                                    <span class="label label-danger">Hide</span>
                                    @endif 
                                </td> --}}
    
                                     <td>
                                        <a href="javascript:;" data-toggle="modal" data-target="#update-title-single" data-href="{{route('user-filemanagertitleupdatesingle', $pf->id)}}" class="btn btn-primary" style="border-radius:30px;"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                      @if($pf->status == 'active')
                                      <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete-single" data-href="{{route('user-filemanagerupdatesingle', $pf->id)}}" class="btn btn-danger" style="border-radius:30px;"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                      @endif
                                     
            
                                    </td>
                          
                                    </tr>
                           
                                   {{-- @endif
                                      @endforeach --}}
                                    @endif
                                @endforeach
                                  
                                </tbody>
                              </table>
                            </div>
                          </div>
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

  <div class="modal fade" id="update-title" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel">Update Title</h4>
            </div>
            <div class="modal-body">
                <label>Prescription Title : </label>
                <form class="btn-update" action="" method="POST" style="display:inline-block" >
                  {{ csrf_field() }}
                  <input type="text" name="title" value="" placeholder="Prescription Title" >
                
            </div>
            <div class="modal-footer" style="text-align: center;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                
                  
                  <button type="submit" class="btn btn-success">Update</button>
               
            </div>
          </form>
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
                <p class="text-center">You are about to delete.</p>
                <p class="text-center">Do you want to proceed?</p>
            </div>
            <div class="modal-footer" style="text-align: center;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <form class="btn-ok" action="" method="POST" style="display:inline-block" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="update-title-single" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title text-center" id="myModalLabel">Update Title</h4>
          </div>
          <div class="modal-body">
              <label>Prescription Title : </label>
              <form class="btn-update-single" action="" method="POST" style="display:inline-block" >
                {{ csrf_field() }}
                <input type="text" name="title" value="" placeholder="Prescription Title" >
              
          </div>
          <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              
                
                <button type="submit" class="btn btn-success">Update</button>
             
          </div>
        </form>
      </div>
  </div>
</div>

<div class="modal fade" id="confirm-delete-single" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title text-center" id="myModalLabel">Confirm Delete</h4>
          </div>
          <div class="modal-body">
              <p class="text-center">You are about to delete.</p>
              <p class="text-center">Do you want to proceed?</p>
          </div>
          <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <form class="btn-ok-single" action="" method="POST" style="display:inline-block" enctype="multipart/form-data">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
          </div>
      </div>
  </div>
</div>




@endsection

@section('scripts')

<script>
  var dropZoneId = "drop-zone";
    var buttonId = "clickHere";
    var mouseOverClass = "mouse-over";
  var dropZone = $("#" + dropZoneId);
   var inputFile = dropZone.find("input");
   var finalFiles = {};
  $(function() {
    
  
    
    var ooleft = dropZone.offset().left;
    var ooright = dropZone.outerWidth() + ooleft;
    var ootop = dropZone.offset().top;
    var oobottom = dropZone.outerHeight() + ootop;
   
    document.getElementById(dropZoneId).addEventListener("dragover", function(e) {
      e.preventDefault();
      e.stopPropagation();
      dropZone.addClass(mouseOverClass);
      var x = e.pageX;
      var y = e.pageY;
  
      if (!(x < ooleft || x > ooright || y < ootop || y > oobottom)) {
        inputFile.offset({
          top: y - 15,
          left: x - 100
        });
      } else {
        inputFile.offset({
          top: -400,
          left: -400
        });
      }
  
    }, true);
  
    if (buttonId != "") {
      var clickZone = $("#" + buttonId);
  
      var oleft = clickZone.offset().left;
      var oright = clickZone.outerWidth() + oleft;
      var otop = clickZone.offset().top;
      var obottom = clickZone.outerHeight() + otop;
  
      $("#" + buttonId).mousemove(function(e) {
        var x = e.pageX;
        var y = e.pageY;
        if (!(x < oleft || x > oright || y < otop || y > obottom)) {
          inputFile.offset({
            top: y - 15,
            left: x - 160
          });
        } else {
          inputFile.offset({
            top: -400,
            left: -400
          });
        }
      });
    }
  
    document.getElementById(dropZoneId).addEventListener("drop", function(e) {
      $("#" + dropZoneId).removeClass(mouseOverClass);
    }, true);
  
  
    inputFile.on('change', function(e) {
      finalFiles = {};
      $('#filename').html("");
      var fileNum = this.files.length,
        initial = 0,
        counter = 0;
  
      $.each(this.files,function(idx,elm){
         finalFiles[idx]=elm;
      });
  
      for (initial; initial < fileNum; initial++) {
        counter = counter + 1;
        $('#filename').append('<div id="file_'+ initial +'"><span class="fa-stack fa-lg"><i class="fa fa-file fa-stack-1x "></i><strong class="fa-stack-1x" style="color:#FFF; font-size:12px; margin-top:2px;">' + counter + '</strong></span> ' + this.files[initial].name + '&nbsp;&nbsp;<span class="fa fa-times-circle fa-lg closeBtn" onclick="removeLine(this)" title="remove"></span></div>');
      }
    });
  
  
  
  })
  
  function removeLine(obj)
  {
    inputFile.val('');
    var jqObj = $(obj);
    var container = jqObj.closest('div');
    var index = container.attr("id").split('_')[1];
    container.remove(); 
  
    delete finalFiles[index];
    //console.log(finalFiles);
  }
  
    </script>

<script type="text/javascript">

$(document).ready(function(){
        $("#myButton1").click(function(){
            $(this).text($(this).text() == 'Show' ? 'Hide' : 'Show');
        });
    });

    
  $(document).ready(function() {


    $('#confirm-delete').on('show.bs.modal', function(e) {
    
    $(this).find('.btn-ok').attr('action', $(e.relatedTarget).data('href'));
}); 

$('#update-title').on('show.bs.modal', function(e) {
    
    $(this).find('.btn-update').attr('action', $(e.relatedTarget).data('href'));
}); 

$('#confirm-delete-single').on('show.bs.modal', function(e) {
    
    $(this).find('.btn-ok-single').attr('action', $(e.relatedTarget).data('href'));
}); 

$('#update-title-single').on('show.bs.modal', function(e) {
    
    $(this).find('.btn-update-single').attr('action', $(e.relatedTarget).data('href'));
}); 


});

$("#myButton1").click(function() {
    $('html, body').animate({
        scrollTop: $("#product-table_wrapper").offset().top
    }, 1500);
});

  

</script>

@endsection