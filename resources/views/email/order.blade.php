<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Email</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('asset/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('asset/admin/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/admin/css/custom.css')}}">
</head>

<body>
    @php
    $country = country($maildata['order']->country_id) ;

    @endphp
    <h1  class="h1 mb-3">{{ $maildata['subject'] }}</h1>
    <h2  class="h2 mb-3">Your Order id is: #{{ $maildata['order']->id }}</h2>
    <h1 class="h5 mb-3">Shipping Address</h1>
    <address>
        <strong>{{$maildata['order']->first_name}} {{$maildata['order']->last_name}}</strong><br>
        {{ $maildata['order']->address }}<br>
        {{ $maildata['order']->state }}, {{ $maildata['order']->zip }} {{ $country->name }} <br>
        Phone: {{ $maildata['order']->mobile }}<br>
        Email: {{ $maildata['order']->email }}
    </address>

    <h3>Products</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th width="100">Price</th>
                <th width="100">Qty</th>
                <th width="100">Total</th>
            </tr>
        </thead>
        <tbody>

            @foreach($maildata['order']->items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>${{ number_format($item->price,2) }}</td>
                <td>{{ $item->qty }}</td>
                <td>${{ number_format($item->total,2) }}</td>
            </tr>

            @endforeach

            <tr>
                <th colspan="3" class="text-right">Subtotal:</th>
                <td>${{ number_format($maildata['order']->subtotal,2)}}</td>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Discount
                    {{ ($maildata['order']->coupon_code != null) ? '('. $maildata['order']->coupon_code .')' : '' }}:
                </th>
                <td>${{ number_format($maildata['order']->discount,2)}}</td>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Shipping:</th>
                <td>${{ number_format($maildata['order']->shipping,2)}}</td>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Grand Total:</th>
                <td>${{ number_format($maildata['order']->grand_total,2)}}</td>
            </tr>
        </tbody>
    </table>



</body>

</html>