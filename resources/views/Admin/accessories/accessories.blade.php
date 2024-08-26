@extends('Admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @include('Message.message')
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Accessories</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('Create-Accessorie') }}" class="btn btn-primary">New Accessories</a>
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
                            <a href="{{ route('acccessoire') }}" class="btn btn-primary">Reset</a>
                            <div class="card-tools mt-1">
                                <div class="input-group input-group" style="width: 250px;">
                                    <input type="text" name="keyword" class="form-control float-right"
                                        placeholder="Search" value="{{ Request::get('keyword') }}">

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
                                    <th width="60">ID</th>
                                    <th width="80">Img</th>
                                    <th>
                                        <a href="{{ route('acccessoire', ['keyword' => request()->keyword, 'sort_by' => 'title', 'sort_order' => request('sort_order') === 'desc' ? 'asc' : 'desc']) }}"
                                            class="text-decoration-none text-dark">
                                            Accessories
                                            {{ request('sort_by') === 'title' ? (request('sort_order') === 'desc' ? '▲' : '▼') : '▼' }}
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('acccessoire', ['keyword' => request()->keyword, 'sort_by' => 'price', 'sort_order' => request('sort_order') === 'desc' ? 'asc' : 'desc']) }}"
                                            class="text-decoration-none text-dark">
                                            Price
                                            {{ request('sort_by') === 'price' ? (request('sort_order') === 'desc' ? '▲' : '▼') : '▼' }}
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('acccessoire', ['keyword' => request()->keyword, 'sort_by' => 'qty', 'sort_order' => request('sort_order') === 'desc' ? 'asc' : 'desc']) }}"
                                            class="text-decoration-none text-dark">
                                            Quantity
                                            {{ request('sort_by') === 'qty' ? (request('sort_order') === 'desc' ? '▲' : '▼') : '▼' }}
                                        </a>
                                    </th>

                                    <th width="100">Status</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @if ($Accessorie->isNotEmpty())
                                    @foreach ($Accessorie as $Acc)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                @if (!empty($Acc->img))
                                                    <img src="{{ asset('uploads/Accessorie/thumb/' . $Acc->img) }}"
                                                        class="img-thumbnail" width="50">
                                                @else
                                                    <img src="{{ asset('asset/img/default.avif') }}" class="img-thumbnail"
                                                        width="50">
                                                @endif
                                            </td>

                                            <td>{{ $Acc->title }}</td>
                                            <td>${{ $Acc->price }}</td>
                                            <td>{{ $Acc->qty }} left in Stock</td>

                                            <td>
                                                @if ($Acc->status == 1)
                                                    <svg class="text-success-500 h-6 w-6 text-success"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                @else
                                                    <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('Edit-Accessorie', $Acc->id) }}">
                                                    <svg class="filament-link-icon w-4 h-4 mr-1"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="deleteAccessorie('{{ $Acc->id }}')"
                                                    class="text-danger w-4 h-4 mr-1">
                                                    <svg wire:loading.remove.delay="" wire:target=""
                                                        class="filament-link-icon w-4 h-4 mr-1"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path ath fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th>Record Not Found</th>
                                    </tr>
                                @endif


                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $Accessorie->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script>
        function deleteAccessorie(id) {
            var url = '{{ route('Delete-Accessorie', 'ID') }}';
            var newurl = url.replace('ID', id)
            if (confirm('Are You sure want to delete')) {
                $.ajax({
                    url: newurl,
                    type: 'delete',
                    data: {},
                    dataType: 'json',
                    success: function(response) {
                        if (response['status']) {
                            window.location.href = '{{ route('acccessoire') }}'

                        } else {
                            window.location.href = '{{ route('acccessoire') }}'
                        }
                    }
                })
            }


        }
    </script>
@endsection
