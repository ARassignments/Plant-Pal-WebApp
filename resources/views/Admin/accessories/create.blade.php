@extends("Admin.master")
@section('css')
<link rel="stylesheet" href="{{asset('asset/admin/plugins/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="{{asset('asset/admin/plugins/dropzone/dropzone.css')}}">
<link rel="stylesheet" href="{{asset('asset/admin/plugins/select2/css/select2.min.css')}}">

@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Accessories</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('acccessoire') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <form action="" method="post" id="Accessoriesform" name="Accessoriesform">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                placeholder="Title">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="slug">Slug</label>
                                            <input type="text" readonly name="slug" id="slug" class="form-control"
                                                placeholder="slug">
                                            <p class="error"></p>
                                        </div>
                                      
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                                <textarea name="description" id="description" cols="30" rows="10"
                                                class="summernote" placeholder="Description"></textarea>
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <input type="hidden" id="img" name="img" class="form-control">
                                <h2 class="h4 mb-3">Media</h2>
                                <div id="image" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">
                                        <br>Drop files here or click to upload.<br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Pricing</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="price">Price</label>
                                            <input type="number" name="price" id="price" class="form-control"
                                                placeholder="Price">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Inventory</h2>
                                <div class="row">
                                  
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="qty">Quantity</label>
                                            <input type="number" name="qty" id="qty" class="form-control"
                                                placeholder="qty">
                                            <p class="error"></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Accessories status</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                    <p class="error"></p>
                                </div>
                            </div>
                        </div>
                        
                       
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Featured Accessories</h2>
                                <div class="mb-3">
                                    <select name="is_featured" id="is_featured" class="form-control">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                    <p class="error"></p>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button class="btn btn-primary">Create</button>
                    <a href="{{ route('acccessoire') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </div>
        </form>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('js')
<script src="{{asset('asset/admin/plugins/summernote/summernote.min.js')}}"></script>
<script src="{{asset('asset/admin/plugins/dropzone/dropzone.js')}}"></script>

<script>
   
$(document).ready(function() {
    $('.summernote').summernote({
        height: 250,
    })
})

Dropzone.autoDiscover = false;
const dropzone = $("#image").dropzone({
    url: "{{route('Temp-image')}}",
    maxFiles: 1,
    paramName: 'image',
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png,image/gif,image/webp",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(file, response) {
        $('#img').val(response.Image_id)
    },
    
});





$('#Accessoriesform').submit(function(event) {
    event.preventDefault();
    var element = $(this)
    $('button[type=submit]').prop('disabled', true)
    $.ajax({
        url: '{{route("Store-Accessorie")}}',
        type: 'post',
        data: element.serializeArray(),
        dataType: 'json',
        success: function(response) {
            $('button[type=submit]').prop('disabled', false)
            if (response['status'] == true) {
                $('.error').removeClass('invalid-feedback').html('')
                $('input,select,textarea').removeClass('is-invalid')
                window.location.href = '{{ route("acccessoire") }}'

           
            } else {
                var error = response['errors']
                $('.error').removeClass('invalid-feedback').html('')
                $('input,select,textarea').removeClass('is-invalid')
                console.log(error)
                $.each(error, function(key, value) {
                    $(`#${key}`).addClass('is-invalid').siblings('p').addClass(
                            'invalid-feedback')
                        .html(value)
                })

            }
        },
        error: function(JQXHR, exception) {
            console.log('Something Error');
        }
    })

})

$('#title').change(function() {
    var element = $(this).val();
    $('button[type=submit]').prop('disabled', true)
    $.ajax({
        url: '{{route("GetSlug")}}',
        type: 'get',
        data: {
            title: element
        },
        dataType: 'json',
        success: function(respose) {
            $('button[type=submit]').prop('disabled', false)
            $('#slug').val(respose['slug']);
        }
    })
})
</script>
@endsection