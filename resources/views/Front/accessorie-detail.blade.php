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
<div class="Product-Detail-container">
    <div class="product-detail-image">
    <div class="main-image">
            @if(!empty($accessories->img))
            <img src="{{asset('uploads/Accessorie/thumb/'.$accessories->img)}}" class="Image">
            @else
            <img src="{{asset('asset/img/default.avif')}}" class="Image">
            @endif
        </div>
       
    </div>
    <div class="product-detail-content">
        <h1 class="nav-nigth">{{$accessories->title}}</h1>
        <div class="Product-price">
            <h2 class="nav-nigth">${{$accessories->price}}</h2>
        </div>
        <p class="nigth-description">{!! $accessories->description !!}</p>
        <div class="Product-button">

            @if($accessories->qty != 0)
            <a href="javascript:void(0)" onclick="AddtoCart('{{$accessories->id}}')" class="cart-button gear-button">Add To
                cart </a>
            @else
            <a href="javascript:void(0)" class="cart-button gear-button">Out of Stock</a>
            @endif

            {{-- <a href="javascript:void(0)" class="wishlit-button gear-button"
                onclick="AddWishlist('{{$accessories->id}}')">Add to
                Wishlist</a> --}}
        </div>
    </div>
</div>
<div class="Product-comment-container">

    <form action="" class="form" method="post" id="RatingForm" name="RatingForm">
        <h1 class="nav-nigth comment">Leave a Comment</h1>
        <div class="service-input comment-input">
            <div>
                <input type="text" placeholder="Name" class="dark-input-service form-control" id="name" name="name">
                <span></span>
            </div>
            <div>
                <input type="email" placeholder="Email" class="dark-input-service form-control" id="email" name="email">
                <span></span>
            </div>
        </div>
        <div>
            <textarea name="message" id="message" cols="20" rows="6" placeholder="message"
                class="dark-input-service form-control" name="message" id="message"></textarea>
            <span></span>
        </div>
        <button class="comment-button gear-button" type="submit"><span>Submit Commit</span></button>


    </form>
   
    @endsection

    @section('js')
    <!-- javascript link  -->


    <script type="text/javascript">
    function AddtoCart(id) {
        $.ajax({
            url: '{{route("Add-to-Cart")}}',
            type: 'post',
            data: {
                id: id,
                status : 'accessories'
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == true) {
                    window.location.href = "{{route('Front.cart')}}"
                } else {
                    alert(response.msg)
                }
            },
        });
    }

    function AddWishlist(id) {
        $.ajax({
            url: '{{route("Store-Wishlist")}}',
            type: 'post',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == true) {
                    window.location.href = "{{route('accessorie-detail',$accessories->slug)}}"
                } else {
                    alert(response.msg)
                }
            },
        });
    }


    $('#RatingForm').submit(function(event) {
        event.preventDefault();
        $('button[type=submit]').prop('disabled', true)
        $.ajax({
            url: '{{ route("Store-Rating",$accessories->id) }}',
            type: 'post',
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response) {
                $('button[type=submit]').prop('disabled', false)
                if (response['status'] == true) {
                    window.location.href = "{{route('accessorie-detail',$accessories->slug)}}";

                    $('#name').removeClass('is-invalid').siblings('span').removeClass(
                            'invalid-feedback')
                        .html('')
                    $('#email').removeClass('is-invalid').siblings('span').removeClass(
                            'invalid-feedback')
                        .html('')
                    $('#message').removeClass('is-invalid').siblings('span').removeClass(
                            'invalid-feedback')
                        .html('')

                } else {
                    var error = response['errors']
                    if (error['name']) {
                        $('#name').addClass('is-invalid').siblings('span').addClass(
                                'invalid-feedback')
                            .html(error['name'])
                    } else {
                        $('#name').removeClass('is-invalid').siblings('span').removeClass(
                            'invalid-feedback').html('')
                    }

                    if (error['email']) {
                        $('#email').addClass('is-invalid').siblings('span').addClass(
                                'invalid-feedback')
                            .html(error['email'])
                    } else {
                        $('#email').removeClass('is-invalid').siblings('span').removeClass(
                            'invalid-feedback').html('')
                    }
                    if (error['message']) {
                        $('#message').addClass('is-invalid').siblings('span').addClass(
                                'invalid-feedback')
                            .html(error['message'])
                    } else {
                        $('#message').removeClass('is-invalid').siblings('span').removeClass(
                            'invalid-feedback').html('')
                    }
                }


            }
        })
    })
    </script>
    <!-- javascript link  -->
    @endsection