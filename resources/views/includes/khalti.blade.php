@php
    $url = ($module == 'Order' ? '/checkout/khalti/verify' : '/lab/payment/khalti/verify');
@endphp
<script>
    var config = {
        "publicKey": "{{ env('KHALTI_PUBLIC') }}",
        "productIdentity": '{{ $order->order_number }}',
        "productName": "Payment for {{ $module }} No.: {{ $order->order_number }}",
        'productUrl':"{{ env('APP_URL','http://localhost:8000') }}",
        "eventHandler": {
            onSuccess (payload) {

                $.ajax({
                    type: "POST",
                    url:"{{ $url }}",
                    data:{
                        amount: payload.amount,
                        mobile: payload.mobile,
                        order_number : payload.product_identity,
                        token : payload.token,
                        _token: '{{ csrf_token() }}'
                    },
                    success:function(data){
                        location.href = "/payment/return";
                    },
                    error: function(data){
                        $.notify("Something went wrong,","error");
                        $('#overlay').css('display','none');
                        $('.btn#pay-btn').removeAttr('disabled');
                        
                        checkout.hide();
                    }
                });  
            },
            onError (error) {
                console.log(error);
                //redirect as needed
                $('#overlay').css('display','none');
                $('.btn#pay-btn').removeAttr('disabled');
                
                checkout.hide();

            },
            onClose () {
                console.log('widget is closing');
                $('#overlay').css('display','none');
                $('.btn#pay-btn').removeAttr('disabled');

                //redirect as needed
                checkout.hide();
            }
        }
    };

    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("pay-btn");
    btn.onclick = function (e) {
        e.preventDefault();
        var amount = parseFloat({{ $order->pay_amount }} * 100.00);
        $('#overlay').css('display','block');
        $('.btn#pay-btn').attr('disabled','disabled');

        checkout.show({amount: amount});
    }
</script>