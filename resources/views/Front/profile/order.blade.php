@extends('Front.master')

@section('content')
@if(Session::get('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <div>
        {!! Session::get('success') !!}
    </div>
</div>
@endif


@if(Session::get('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    {{Session::get('error')}}
</div>
@endif
<section class=" section-11 ">
    <div class="container  mt-5">
        <div class="row order-row">
            <div class="col-md-3">
                @include('Front.profile.master')
            </div>
            <div class="col-md-9">
                <div class="card order-card">
                    <div class="card-header">
                        <h2 class="Order-title mb-0 pt-2 pb-2 nav-nigth">My Orders</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="order-thead">
                                    <tr>
                                        <th>Orders #</th>
                                        <th>Date Purchased</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="order-tbody">
                                    @if(!empty($orders))

                                    @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <a class="nav-nigth"
                                                href="{{ route('Profile.order-detail',$order->id) }}">{{ $order->id }}</a>
                                        </td>
                                        <td class="nav-nigth">
                                            {{ \Carbon\Carbon::parse($order->created_at)->format('d M ,Y') }}</td>
                                        <td>
                                            @if($order->delivery_status == 'pending')
                                            <span class="badge bg-danger">Pending</span>
                                            @elseif($order->delivery_status == 'shipped')
                                            <span class="badge bg-info">Shipped</span>
                                            @elseif($order->delivery_status == 'delivered')
                                            <span class="badge bg-success">Delivered</span>
                                            @else
                                            <span class="badge bg-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        <td class="nav-nigth">${{number_format($order->grand_total,2)}}</td>
                                        <td class="nav-nigth"><a href="{{ route('Profile.order-detail',$order->id) }}" class="btn btn-primary">View</a></td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection