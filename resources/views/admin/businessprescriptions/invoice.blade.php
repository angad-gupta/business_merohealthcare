@extends('layouts.admin')
        
@section('content')
<style>
    .text-bold-800{
        font-weight: 800;
    }
</style>
    <div class="right-side">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- Starting of Dashboard area -->
                    <div class="section-padding add-product-1">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="add-product-box">
                                    <div class="product__header" style="border-bottom: none;">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="product-header-title">
                                                    <h2>Business Prescription Details <a href="{{ route('admin-business-prescription-show',$business_prescriptions->id) }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a> </h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Business orders <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Business Order Invoice</p>
                                                </div>
                                            </div>
                                            @include('includes.notification')
                                        </div>   
                                    </div>

                                    <main>

                                        @include('includes.form-success')

                                        <div class="order-table-wrap">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr class="tr-head">
                                                                    <th class="order-th" width="45%">Business Order Details</th>
                                                                    <th width="10%"></th>
                                                                    <th class="order-th" width="45%"></th>
                                                                </tr>

                                                                <tr>
                                                                    <th width="45%">Ordered By</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$business_prescriptions->user_id}}</td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <th width="45%">Ordered Date</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{date('d-M-Y H:i:s a',strtotime($business_prescriptions->created_at))}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Registration Certificate File</th>
                                                                    <th width="10%">:</th>
                                                                    <th width="45%"><a href="{{ route('admin-businessorder-reg-file',[$business_prescriptions->id,$business_prescriptions->reg_certificate_file]) }}" target="_blank">{{ $business_prescriptions->reg_certificate_file }}</a></th>
                                                                </tr>

                                                                <tr>
                                                                    <th width="45%">Business Order Files</th>
                                                                    <th width="10%">:</th>
                                                                    <th width="45%">
                                                                        @foreach($business_prescriptions->files as $file)
                                                                        <a href="{{ route('admin-businessorder-file',[$business_prescriptions->id,$file->file,$file->id]) }}" target="_blank">{{ $file->file }}</a>
                                                                        <br/>
                                                                        @endforeach
                                                                    </th>
                                                                </tr>

                                                                <tr>
                                                                    <th width="45%">Status</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">
                                                                        <button class="btn btn-danger product-btn dropdown-toggle btn-xs" type="button" data-toggle="dropdown" style="font-size: 14px;
                                                            
                                                                            @if($business_prescriptions->status == "completed")
                                                                            {{ "background-color: #01c004;" }}
                                                                            @elseif($business_prescriptions->status == "processing")
                                                                            {{ "background-color: #02abff;" }}
                                                                            @elseif($business_prescriptions->status == "declined")
                                                                            {{ "background-color: #d9534f;" }}
                                                                            @else
                                                                            {{"background-color: #ff9600;"}}
                                                                            @endif
                                                                        
                                                                        ">{{ucfirst($business_prescriptions->status)}} <span class="caret"></span></button>
                                                                            <ul class="dropdown-menu" style="position: unset;">
                                                                                <li><a href="javascript:;" data-href="{{route('admin-prescription-status',['id1' => $business_prescriptions->id, 'status' => 'processing'])}}" data-toggle="modal" data-target="#confirm-delete">Processing</a></li>
                                                                                <li><a href="javascript:;" data-href="{{route('admin-prescription-status',['id1' => $business_prescriptions->id, 'status' => 'completed'])}}" data-toggle="modal" data-target="#confirm-delete">Completed</a></li>
                                                                                <li><a href="javascript:;" data-href="{{route('admin-prescription-status',['id1' => $business_prescriptions->id, 'status' => 'declined'])}}" data-toggle="modal" data-target="#confirm-delete">Declined</a></li>
                                                                            </ul>
                                                                        </span>
                                                                    </td>
                                                                </tr>
    
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-lg-6">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr class="tr-head">
                                                                    <th class="order-th" width="45%">Invoice Details</th>
                                                                    <th width="10%"></th>
                                                                    <th class="order-th" width="45%"></th>
                                                                </tr>

                                                                <tr>
                                                                    <th width="45%">Ordered By</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{!! $prescription->user_id ? '<a href="'.route('admin-user-show',$prescription->user_id).'" target="_blank">'.$prescription->user->name.'</a>' : 'Guest' !!}</td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <th width="45%">Ordered Date</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{date('d-M-Y H:i:s a',strtotime($prescription->created_at))}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Prescription File</th>
                                                                    <th width="10%">:</th>
                                                                    <th width="45%"><a href="{{ route('admin-prescription-file',[$prescription->id,$prescription->file]) }}" target="_blank">{{ $prescription->file }}</a></th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> --}}
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 col-sm-12">
                                                    <form action="{{ route('admin-business-prescription-invoice',$business_prescriptions->id) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <h4 style="padding: 5px; margin-bottom: 0">Items</h4>
                                                            
                                                        <p style="border-top: 2px solid #0165cbc2;width: 10%;margin-left: 5px;"></p>
                                                        <div class="table-responsive">
                                                            @php
                                                                $items = old('items') ? old('items') : ($invoice ? json_decode($invoice->items,true) : []);
                                                                
                                                                $total = 0;
                                                                $shipping_cost = old('shipping_cost') ? : ($invoice ? $invoice->shipping_cost : 0);
                                                            @endphp
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Product Name</th>
                                                                        <th scope="col">Qty</th>
                                                                        <th scope="col">Price per item</th>
                                                                        <th scope="col">Total</th>
                                                                        <th scope="col"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="item-list">
                                                                    @if($invoice)
                                                                        @foreach ($items as $item)
                                                                            <tr>
                                                                                <td scope="row" width="50%">{{ $item['name'] }}</td>
                                                                                <td width="10%">
                                                                                    {{ $item['qty'] }}
                                                                                </td>
                                                                                <td width="15%">{{ $item['price'] }}</td>
                                                                                <td width="20%" style="vertical-align: middle;">Rs. {{ $item['qty'] * $item['price'] }}</td>
                                                                            </tr>
                                                                            @php
                                                                                $total += $item['qty'] * $item['price']; 
                                                                            @endphp
                                                                        @endforeach
                                                                    @else
                                                                        @forelse ($items as $item)
                                                                            <tr class="item-list-area">
                                                                                <input type="hidden" name="items[{{ $loop->iteration - 1 }}][id]" value="{{ $item['id'] }}" id="item-id-{{ $loop->iteration - 1 }}"/>
                                                                                <td scope="row" width="50%"><input class="form-control typeahead" name="items[{{ $loop->iteration - 1 }}][name]" id="item-name-{{ $loop->iteration - 1 }}" placeholder="Product Name" type="text" value="{{ $item['name'] }}" autocomplete="off" required></td>
                                                                                <td width="10%">
                                                                                    <input class="form-control toupdate" name="items[{{ $loop->iteration - 1 }}][qty]" id="item-qty-{{ $loop->iteration - 1 }}" placeholder="Quantity" type="number" value="{{ $item['qty'] }}" min="1" required>
                                                                                </td>
                                                                                <td width="15%"><input class="form-control toupdate" name="items[{{ $loop->iteration - 1 }}][price]" id="item-price-{{ $loop->iteration - 1 }}" placeholder="Price" type="number" value="{{ $item['price'] }}" min="0" required></td>
                                                                                <td width="20%" style="vertical-align: middle;">Rs. <span class="item-total" id="item-total-{{ $loop->iteration - 1 }}">{{ $item['qty'] * $item['price'] }}</span></td>
                                                                                <td width="5%"><button class="btn btn-danger item-close" type="button"><i class="fa fa-trash"></i></td>
                                                                            </tr>
                                                                            @php
                                                                                $total += $item['qty'] * $item['price']; 
                                                                            @endphp
                                                                        @empty
                                                                            <tr class="item-list-area">
                                                                                <input type="hidden" name="items[0][id]" id="item-id-0" />
                                                                                <td scope="row" width="50%"><input class="form-control typeahead" name="items[0][name]" id="item-name-0" placeholder="Product Name" type="text" value="" autocomplete="off" required></td>
                                                                                <td width="10%">
                                                                                    <input class="form-control toupdate" name="items[0][qty]" id="item-qty-0" placeholder="Quantity" type="number" value="1" min="1" required>
                                                                                </td>
                                                                                <td width="15%"><input class="form-control toupdate" name="items[0][price]" id="item-price-0" placeholder="Price" type="number" value="0" min="0" required></td>
                                                                                <td width="20%" style="vertical-align: middle;">Rs. <span class="item-total" id="item-total-0">0.00</span></td>
                                                                                <td width="5%"><button class="btn btn-danger item-close" type="button"><i class="fa fa-trash"></i></td>
                                                                            </tr>
                                                                        @endforelse
                                                                    @endif
                                                                </tbody>
                                                                @if(!$invoice)
                                                                <button style="float:right" class="btn btn-success featured-btn" type="button" name="add-item-btn" id="add-item-btn"><i class="fa fa-plus"></i> Add </button>
                                                                @endif
                                                            </table>
                                                            
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <td width="50%"></td>
                                                                        <td width="10%"></td>
                    
                                                                        <td style="width: 15%;text-align: right;vertical-align: middle;" class="text-bold-800">Sub Total</td>
                                                                        <td class="text-xs-right">Rs. <span id="subtotal">{{ $total }}</span></td>
                                                                        <td width="10%"></td>
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                                        <td width="50%"></td>
                                                                        <td width="10%"></td>

                                                                        <td style="width: 15%;text-align: right;vertical-align: middle;" class="text-bold-800">Shipping Fee</td>
                                                                        @if($invoice)
                                                                            <td class=" text-xs-right"> {{ $shipping_cost }}</td>
                                                                        @else
                                                                            <td class=" text-xs-right"> <input class="form-control" type="number"  name="shipping_cost" id="shipping" min="0" value="{{ $shipping_cost }}" /></td>
                                                                        @endif
                                                                        <td width="10%"></td>
                                                                    </tr>
                                
                                                                    <tr>
                                                                        <td width="50%"></td>              
                                                                        <td width="10%"></td>

                                                                        <td style="width: 15%;text-align: right;vertical-align: middle;" class="text-bold-800">Total</td>
                                                                        <td class="text-bold-800 text-xs-right"> Rs. <span id="totalAmount">{{ $total + $shipping_cost }}</span></td>
                                                                        <td width="10%"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        
                                                        </div>

                                                        <h5>Note:</h5>
                                                        @if($invoice)
                                                            {{ $invoice->note ? : '-' }}
                                                        @else
                                                            <textarea class="form-control" name="note" >{{ old('note') ? : ($invoice ? $invoice->note : '') }}</textarea>
                                                            <div class="text-center" style="margin:30px">
                                                                <button class="btn btn-primary"><i class="fa fa-file"></i> Save Invoice</button>
                                                            </div>
                                                        @endif
                                                        
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                        
                                        <br>
                                        
                                    </main>
                                    <hr>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Ending of Dashboard area --> 
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/assets/admin/js/bootstrap3-typeahead.js"></script>
    <script type="text/javascript">
        
        var total = {{ $total + $shipping_cost }};
        var shipping_cost = {{ $shipping_cost }};
        
        $(document).on('click','#add-item-btn',function() {
            var index = $('.item-list').children().length;      
                        
            $(".item-list").append('<tr class="item-list-area">'+
                    '<input type="hidden" name="items['+index+'][id]" id="item-id-'+index+'" />'+
                    '<td scope="row" width="50%"><input class="form-control typeahead" name="items['+index+'][name]" id="item-name-'+index+'" placeholder="Product Name" type="text" value="" autocomplete="off" required></td>'+
                    '<td width="10%">'+
                    '    <input class="form-control toupdate" name="items['+index+'][qty]" id="item-qty-'+index+'" placeholder="Quantity" type="number" value="1" min="1" required>'+
                    '</td>'+
                    '<td width="15%"><input class="form-control toupdate" name="items['+index+'][price]" id="item-price-'+index+'" placeholder="Price" type="number" value="0" min="0" required></td>'+
                    '<td width="20%" style="vertical-align: middle;">Rs. <span class="item-total" id="item-total-'+index+'">0.00</span></td>'+
                    '<td width="5%"><button class="btn btn-danger item-close" type="button"><i class="fa fa-trash"></i></td>'+
                '</tr>'
            );

        });

        $(document).on('click', '.item-close' ,function() {
            var input_id = $(this).parent().parent().find('.item-total').attr('id').split('-');
            var item_id = parseInt(input_id[input_id.length-1]);
            total -= parseFloat($('#item-total-' + item_id).text());
            
            $('#totalAmount').text(total);
            $('#subtotal').text(total - shipping_cost);

            $(this.parentNode.parentNode).hide();
            $(this.parentNode.parentNode).remove();

            if (isEmpty($('.item-list'))) {
                $(".item-list").append('<tr class="item-list-area">'+
                    '<input type="hidden" name="items[0][id]" id="item-id-0" />'+
                    '<td scope="row" width="50%"><input class="form-control typeahead" name="items[0][name]" id="item-name-0" placeholder="Product Name" type="text" value="" autocomplete="off" required></td>'+
                    '<td width="10%">'+
                    '    <input class="form-control toupdate" name="items[0][qty]" id="item-qty-0" placeholder="Quantity" type="number" value="1" min="1" required>'+
                    '</td>'+
                    '<td width="15%"><input class="form-control toupdate" name="items[0][price]" id="item-price-0" placeholder="Price" type="number" value="0" min="0" required></td>'+
                    '<td width="20%" style="vertical-align: middle;">Rs. <span class="item-total" id="item-total-0">0.00</span></td>'+
                    '<td width="5%"><button class="btn btn-danger item-close" type="button"><i class="fa fa-trash"></i></td>'+
                '</tr>');
            }

        });

        function isEmpty(el){
            return !$.trim(el.html())
        }

        $(document).on('click', '.typeahead', function() {
            if(!$(this).attr('id')) return;
            var input_id = $(this).attr('id').split('-');

            var item_id = parseInt(input_id[input_id.length-1]);

            $(this).typeahead({
                minLength: 3,
                displayText:function (data) {
                    return data.name + ' ( ' + data.stock + ' in stock )';
                },
                source: function (query, process) {
                    $.ajax({
                        url: '/json/search',
                        type: 'GET',
                        dataType: 'JSON',
                        data: 'query=' + query,
                        success: function(data) {
                            return process(data);
                        }
                    });
                },
                afterSelect: function (data) {
                    this.$element[0].value = data.name;

                    var prev = parseFloat($('#item-total-' + item_id).text());

                    $('#item-id-' + item_id).val(data.id);
                    $('#item-qty-' + item_id).val('1');
                    $('#item-qty-' + item_id).attr('max',data.stock);
                    $('#item-price-' + item_id).val(data.cprice);

                    // This event Select2 Stylesheet
                    $('#item-price-' + item_id).trigger('focusout');
                    $('#item-total-' + item_id).html(data.cprice);

                    total = total - prev + parseFloat(data.cprice);
            
                    $('#totalAmount').text(total);
                    $('#subtotal').text(total - shipping_cost);

                }
            });
        });

        $(document).on('change', '.typeahead', function() {
            var current = $(this).typeahead("getActive");

            var input_id = $(this).attr('id').split('-');
            var item_id = parseInt(input_id[input_id.length-1]);

            if(current){
                if (current.name != $(this).val()) {
                    $('#item-id-' + item_id).val('');
                }else
                    $('#item-id-' + item_id).val(current.id);

            } else {
                $('#item-id-' + item_id).val('');
            }
            
            
        });

        $('.item-list').on('change', '.toupdate', function() {
            
            var input_id = $(this).attr('id').split('-');

            var item_id = parseInt(input_id[input_id.length-1]);

            var qty = parseInt($('#item-qty-' + item_id).val());
            var price = parseFloat($('#item-price-' + item_id).val()).toFixed(2);

            if(!isNaN(qty) && !isNaN(price)){
                var prev = parseFloat($('#item-total-' + item_id).text());
                
                $('#item-total-' + item_id).html(qty*price);

                total = total - prev + qty*price;
            
                $('#totalAmount').text(total);
                $('#subtotal').text(total - shipping_cost);

            } 
        });

        $('#shipping').on('change', function() {
            var prev = shipping_cost;
            shipping_cost = parseInt($('#shipping').val());

            if(!isNaN(shipping_cost)){

                total = total - prev + shipping_cost;
                
                $('#totalAmount').text(total);
                $('#subtotal').text(total - shipping_cost);
            }else{
                $('#shipping').val(0);
                shipping_cost = 0;

            }
        })

    </script>
@endsection