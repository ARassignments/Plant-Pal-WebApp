@extends('Admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('Message.message')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Wishlist</h1>
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
                <div class="card-header">
                    <a href="{{route('Rating')}}" class="btn btn-primary">Reset</a>
                    <div class="card-tools">
                        <form action="" method="get">
                            <div class="input-group input-group" style="width: 250px;">
                                <input type="text" name="keyword" class="form-control float-right" placeholder="Search"
                                    value="{{Request::get('keyword')}}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-3">
        <a href="{{ route('admin.Wishlist', ['keyword' => request()->keyword, 'sort_by' => 'product_name', 'sort_order' => request('sort_order') === 'desc' ? 'asc' : 'desc']) }}" class="btn btn-link">
            Product Name {{ request('sort_by') === 'product_name' ? (request('sort_order') === 'desc' ? '▲' : '▼') : '' }}
        </a>
        <a href="{{ route('admin.Wishlist', ['keyword' => request()->keyword, 'sort_by' => 'user_name', 'sort_order' => request('sort_order') === 'desc' ? 'asc' : 'desc']) }}" class="btn btn-link">
            User Name {{ request('sort_by') === 'user_name' ? (request('sort_order') === 'desc' ? '▲' : '▼') : '' }}
        </a>
    </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Product</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($wishlists))
                            @foreach($wishlists as $wishlist)
                            <tr>
                                <td>
                                    {{ $wishlist->id }}
                                </td>
                                <td>{{ $wishlist->user->name }}</td>
                                <td>{{ $wishlist->user->email }}</td>
                                <td>{{ $wishlist->product->title }}</td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $wishlists->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
