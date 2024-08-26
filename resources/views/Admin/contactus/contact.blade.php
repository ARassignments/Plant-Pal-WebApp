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
                    <h1>contacts</h1>
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
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th width="100">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($contacts))
                            @foreach($contacts as $contact)
                            <tr>
                                <td>
                                    {{ $contact->id }}
                                </td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>{{ $contact->message }}</td>
                               

                                <td>
                                
                                    <a href="javascript:void(0)" class="text-danger w-4 h-4 mr-1"
                                        onclick="deleteContact('{{ $contact->id }}')">
                                        <svg wire:loading.remove.delay="" wire:target=""
                                            class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path ath fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $contacts->links() }}
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
function deleteContact(id) {
    var url = '{{route("deleteContact","ID")}}';
    var newurl = url.replace('ID', id)
    if (confirm('Are You sure want to delete')) {
        $.ajax({
            url: newurl,
            type: 'delete',
            data: {},
            dataType: 'json',
            success: function(response) {
                if (response['status']) {
                    window.location.href = '{{route("admin.contact")}}'

                } else {
                    window.location.href = '{{route("admin.contact")}}'
                }
            }
        })
    }


}

function ChangeStatus(id) {
    var url = '{{route("Change-Rating-Status","ID")}}';
    var newurl = url.replace('ID', id)
    if (confirm('Are You sure want to Change Status')) {
        $.ajax({
            url: newurl,
            type: 'post',
            data: {},
            dataType: 'json',
            success: function(response) {
                if (response['status']) {
                    window.location.href = '{{route("Rating")}}'

                } else {
                    window.location.href = '{{route("Rating")}}'
                }
            }
        })
    }


}
</script>
@endsection