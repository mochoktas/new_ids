@extends('Layouts.main')
@section('title_page','transaction')
@section('title','payment')
@section('css_custom')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <table class="table site-block-order-table mb-5">
            <thead>
                <th>Total</th>
            </thead>
            <tbody>
                <tr>
                    <td class="text-black font-weight-bold"><strong>Pay Total</strong></td>
                    <td class="text-black font-weight-bold"><strong>Rp. 350.000</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <button id="pay-button" class="btn btn-info ml-1">Pay Now</button>
    </div>

</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                console.log(result);
                updateDatabase(result);
            },
            onPending: function(result) {
                console.log(result);
                updateDatabase(result);
            },
            onError: function(result) {
                console.log(result);
                updateDatabase(result);
            },
            onClose: function() {
                console.log('customer closed the popup without finishing the payment');
            }
        });
    };

    function updateDatabase(result) {
        $.ajax({
            url: '/update-payment-status', // Laravel route URL
            type: 'POST',
            data: {
                result: result,
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
            },
            success: function(response) {
                console.log(response.message);
                window.location.href = '/payment';
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
@endsection