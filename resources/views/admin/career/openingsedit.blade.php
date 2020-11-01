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
                                        <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Career <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Openings</p>
                                    </div>
                                </div>
                                @include('includes.notification')
                            </div>   
                        </div>
                        <div>
                          @include('includes.form-error')
                          @include('includes.form-success')


                          <div class="container">

                           
                            <form class="form-horizontal" action="{{route('admin-career-openings-edit-update', $openings->id)}}" method="POST" enctype="multipart/form-data">
                           
                              {{csrf_field()}}

                           
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="current_logo">Current Image</label>
                                <div class="col-sm-6">
                                <div class="col-sm-6"><img style="width: 100%; height: auto;" id="adminimg" src="{{ $openings->image ? asset('assets/images/'.$openings->image):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="" id="adminimg">
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
                                    <input  type="text" placeholder="Title" name="title" value="{{$openings->title}}" style="width:500px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="setup_new_logo">Description *</label>
                                    <div class="col-sm-6">
                                    <textarea  type="text" id="description" placeholder="Descriptions" name="description" style="height:200px;width:500px;" >{{$openings->description}}</textarea>
                                    </div>
                                </div>
                                    <hr>
                                    <div class="add-product-footer">
                                        <button name="addProduct_btn" type="submit" class="btn add-product_btn">Submit</button> 
                                    </div>

                            
                            </form>
                            
                       
                 

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
  
@endsection

@section('scripts')

<script type="text/javascript" src="{{asset('assets/admin/js/nicEdit.js')}}"></script> 
<script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { 
            new nicEditor().panelInstance('description');
    
            // new nicEditor().panelInstance('policy');
        });
  //]]>
</script>


@endsection