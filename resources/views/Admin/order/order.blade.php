@extends('Admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('Order-Export').'?keyword='.Request::get('keyword') }}" class="btn btn-primary">Download Excel</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
            <form action="" method="get">
                    <div class="card-header">
                        <a href="{{route('order')}}" class="btn btn-primary">Reset</a>
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input type="text" name="keyword" class="form-control float-right" placeholder="Search"
                                    value="{{Request::get('keyword')}}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Orders #</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Date Purchased</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($orders))
                            @foreach($orders as $order)
                            <tr>
                                <td><a href="{{ route('order-detail',$order->id) }}">{{ $order->id }}</a></td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->mobile }}</td>
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
                                <td>${{ number_format($order->grand_total,2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y')}}</td>
                                <td><a href="{{ route('order-detail',$order->id) }}" class="btn btn-info">View</a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection