@extends('account.billing.checkout')
@section('payment-form')



    <div class="text-center">
        <div id="msg"></div>
        <a  id="payu-confirm" href="#" class="btn btn-primary"><i class="fa fa-money"></i> {{ __lang('pay-now') }} </a>
    </div>
@endsection
@section('footer')
    <script type="text/javascript"><!--
        $('#payu-confirm').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('cart.method',['code'=>$code,'function'=>'carepro_send']) }}?tid={{ $transaction }}',
                type: 'post',
                dataType: 'json',
                cache: false,
                beforeSend: function() {
                    $('#payu-confirm').hide();
                    $('#msg').html('<div class="attention">{{ __lang('contacting-payu')  }}</div>');
                },
                complete: function() {

                },
                success: function(json) {
                    if (json['redirect']) {
                        location.replace(json['redirect']);
                    } else {
                        $('#msg').text('');
                        $('#payu-confirm').show();
                        alert(json['error']);
                    }
                }
            });
        });
        //-->
    </script>

@endsection
