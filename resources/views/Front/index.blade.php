@extends('Front.master')
@section('content')
<!-- Carousel Start -->
<div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('asset/Front/img/carousel-1.jpg') }}" alt="Image" />
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <h1 class="display-1 text-white mb-5 animated slideInDown">
                                    Make Your Home Like Garden
                                </h1>
                                <a href="" class="btn btn-primary py-sm-3 px-sm-4">Explore More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('asset/Front/img/carousel-2.jpg') }}" alt="Image" />
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <h1 class="display-1 text-white mb-5 animated slideInDown">
                                    Create Your Own Small Garden At Home
                                </h1>
                                <a href="" class="btn btn-primary py-sm-3 px-sm-4">Explore More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->

<!-- Top Feature Start -->
<div class="container-fluid top-feature py-5 pt-lg-0">
    <div class="container py-5 pt-lg-0">
        <div class="row gx-0">
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px">
                    <div class="d-flex">
                        <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                            <i class="fa fa-times text-primary"></i>
                        </div>
                        <div class="ps-3">
                            <h4>No Hidden Cost</h4>
                            <span>Clita erat ipsum lorem sit sed stet duo justo</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px">
                    <div class="d-flex">
                        <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                            <i class="fa fa-users text-primary"></i>
                        </div>
                        <div class="ps-3">
                            <h4>Dedicated Team</h4>
                            <span>Clita erat ipsum lorem sit sed stet duo justo</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px">
                    <div class="d-flex">
                        <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                            <i class="fa fa-phone text-primary"></i>
                        </div>
                        <div class="ps-3">
                            <h4>24/7 Available</h4>
                            <span>Clita erat ipsum lorem sit sed stet duo justo</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Feature End -->

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-end">
            <div class="col-lg-3 col-md-5 wow fadeInUp" data-wow-delay="0.1s">
                <img class="img-fluid rounded" data-wow-delay="0.1s" src="{{ asset('asset/Front/img/about.jpg') }}" />
            </div>
            <div class="col-lg-6 col-md-7 wow fadeInUp" data-wow-delay="0.3s">
                <h1 class="display-1 text-primary mb-0">25</h1>
                <p class="text-primary mb-4">Year of Experience</p>
                <h1 class="display-5 mb-4">We Make Your Home Like A Garden</h1>
                <p class="mb-4">
                    Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu
                    diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet
                    lorem sit clita duo justo magna dolore erat amet
                </p>
                <a class="btn btn-primary py-3 px-4" href="">Explore More</a>
            </div>
            <div class="col-lg-3 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <div class="row g-5">
                    <div class="col-12 col-sm-6 col-lg-12">
                        <div class="border-start ps-4">
                            <i class="fa fa-award fa-3x text-primary mb-3"></i>
                            <h4 class="mb-3">Award Winning</h4>
                            <span>Clita erat ipsum et lorem et sit, sed stet lorem sit clita
                                duo justo magna</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-12">
                        <div class="border-start ps-4">
                            <i class="fa fa-users fa-3x text-primary mb-3"></i>
                            <h4 class="mb-3">Dedicated Team</h4>
                            <span>Clita erat ipsum et lorem et sit, sed stet lorem sit clita
                                duo justo magna</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Facts Start -->
<div class="container-fluid facts my-5 py-5" data-parallax="scroll"
    data-image-src="{{ asset('asset/Front/img/carousel-1.jpg') }}">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-4 text-white" data-toggle="counter-up">12</h1>
                <span class="fs-5 fw-semi-bold text-light">Happy Customer</span>
            </div>
            <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                <h1 class="display-4 text-white" data-toggle="counter-up">20</h1>
                <span class="fs-5 fw-semi-bold text-light">Order Complated</span>
            </div>
            <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                <h1 class="display-4 text-white" data-toggle="counter-up">12</h1>
                <span class="fs-5 fw-semi-bold text-light">Dedicated Staff</span>
            </div>
            <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                <h1 class="display-4 text-white" data-toggle="counter-up">123</h1>
                <span class="fs-5 fw-semi-bold text-light">Awards Achieved</span>
            </div>
        </div>
    </div>
</div>
<!-- Facts End -->

<!-- Features Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="fs-5 fw-bold text-primary">Why Choosing Us!</p>
                <h1 class="display-5 mb-4">Few Reasons Why People Choosing Us!</h1>
                <p class="mb-4">
                    Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu
                    diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet
                    lorem sit clita duo justo magna dolore erat amet
                </p>
                <a class="btn btn-primary py-3 px-4" href="">Explore More</a>
            </div>
            <div class="col-lg-6">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6">
                        <div class="row g-4">
                            <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                                <div class="text-center rounded py-5 px-4"
                                    style="box-shadow: 0 0 45px rgba(0, 0, 0, 0.08)">
                                    <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                        style="width: 90px; height: 90px">
                                        <i class="fa fa-check fa-3x text-primary"></i>
                                    </div>
                                    <h4 class="mb-0">100% Satisfaction</h4>
                                </div>
                            </div>
                            <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                                <div class="text-center rounded py-5 px-4"
                                    style="box-shadow: 0 0 45px rgba(0, 0, 0, 0.08)">
                                    <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                        style="width: 90px; height: 90px">
                                        <i class="fa fa-users fa-3x text-primary"></i>
                                    </div>
                                    <h4 class="mb-0">Dedicated Team</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeIn" data-wow-delay="0.7s">
                        <div class="text-center rounded py-5 px-4" style="box-shadow: 0 0 45px rgba(0, 0, 0, 0.08)">
                            <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                style="width: 90px; height: 90px">
                                <i class="fa fa-tools fa-3x text-primary"></i>
                            </div>
                            <h4 class="mb-0">Natural & Healty Plants</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features End -->

<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px">
            <p class="fs-5 fw-bold text-primary">Our Accessories</p>
            <h1 class="display-5 mb-5">Accessories </h1>
        </div>
        <div class="row g-4">
            @if(!empty($accessorie))
            @foreach($accessorie as $acce)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded d-flex h-100">
                    <div class="service-img rounded">
                        <img class="img-fluid" src="{{ asset('uploads/Accessorie/thumb/'.$acce->img) }}" alt="" />
                    </div>
                    <div class="service-text rounded p-5">
                        
                        <h4 class="mb-3">{{ $acce->title }}</h4>
                        <p class="mb-4">
                           {!! $acce->description !!}
                        </p>
                        <a href="">View More</a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
           
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Quote Start -->
<div class="container-fluid quote my-5 py-5" data-parallax="scroll"
    data-image-src="{{ asset('asset/Front/img/carousel-2.jpg') }}">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="bg-white rounded p-4 p-sm-5 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-5 text-center mb-5">Get A FeedBack</h1>
                    <form action="" method="post" id="FeedbackForm" name="FeedbackForm">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control bg-light border-0" id="name"
                                    placeholder="Gurdian Name" />
                                <label for="gname">Your Name</label>
                                <span style = "color: red ;"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="email" class="form-control bg-light border-0" name="email"  id="email"
                                    placeholder="Gurdian Email" />
                                <label for="gmail">Your Email</label>
                                <span style = "color: red ;"></span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control bg-light border-0" name="message" placeholder="Leave a message here"
                                    id="message" style="height: 100px"></textarea>
                                <label for="message">Message</label>
                                <span style = "color: red ;"></span>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary py-3 px-4" type="submit">
                                Submit Now
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quote End -->

<!-- Projects Start -->
<section class="new-arrivals-products-area bg-gray section-padding-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Section Heading -->
                <div class="section-heading text-center">
                    <h2>NEW ARRIVALS</h2>
                    <p>We have the latest products, it must be exciting for you</p>
                </div>
            </div>
        </div>

        <div class="row">

            @if(!empty($products))

            @foreach($products as $product)
            @php
            $img = $product->image->first()
            @endphp
            <!-- Single Product Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-product-area mb-50 wow fadeInUp" data-wow-delay="100ms">
                    <!-- Product Image -->
                    <div class="product-img">
                        <a href="shop-details.html"><img src="{{ asset('uploads/product/small/'.$img->image) }}" alt="" /></a>
                        <!-- Product Tag -->

                        <div class="product-meta d-flex">
                            <a href="#" class="wishlist-btn"><i class="icon_heart_alt"></i></a>
                            <a href="{{route('Front.product-detail',$product->slug)}}" class="add-to-cart-btn">View More</a>
                            <a href="#" class="compare-btn"><i class="arrow_left-right_alt"></i></a>
                        </div>
                    </div>
                    <!-- Product Info -->
                    <div class="product-info mt-15 text-center">
                        <a href="shop-details.html">
                            <p>{{ $product->title }}</p>
                        </a>
                        <h6>${{ $product->price }}</h6>
                    </div>
                </div>
            </div>
            @endforeach
            @else

            <h1>Product Not Found</h1>

            @endif



        </div>
    </div>
</section>
<!-- Projects End -->

<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px">
            <p class="fs-5 fw-bold text-primary">Our Team</p>
            <h1 class="display-5 mb-5">Dedicated & Experienced Team Members</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item rounded">
                    <img class="img-fluid" src="{{ asset('asset/Front/img/team-1.jpg') }}" alt="" />
                    <div class="team-text">
                        <h4 class="mb-0">Doris Jordan</h4>
                        <p class="text-primary">Landscape Designer</p>
                        <div class="team-social d-flex">
                            <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item rounded">
                    <img class="img-fluid" src="{{ asset('asset/Front/img/team-2.jpg') }}" alt="" />
                    <div class="team-text">
                        <h4 class="mb-0">Johnny Ramirez</h4>
                        <p class="text-primary">Garden Designer</p>
                        <div class="team-social d-flex">
                            <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item rounded">
                    <img class="img-fluid" src="{{ asset('asset/Front/img/team-3.jpg') }}" alt="" />
                    <div class="team-text">
                        <h4 class="mb-0">Diana Wagner</h4>
                        <p class="text-primary">Senior Gardener</p>
                        <div class="team-social d-flex">
                            <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->

<!-- Testimonial Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                <p class="fs-5 fw-bold text-primary">Testimonial</p>
                <h1 class="display-5 mb-5">What Our Clients Say About Us!</h1>
                <p class="mb-4">
                    Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu
                    diam amet diam et eos. Clita erat ipsum et lorem et sit sed stet
                    lorem sit clita duo justo.
                </p>
                <a class="btn btn-primary py-3 px-4" href="">See More</a>
            </div>
            <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.5s">
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item">
                        <img class="img-fluid rounded mb-3" src="{{ asset('asset/Front/img/testimonial-1.jpg') }}"
                            alt="" />
                        <p class="fs-5">
                            Dolores sed duo clita tempor justo dolor et stet lorem kasd
                            labore dolore lorem ipsum. At lorem lorem magna ut et, nonumy
                            et labore et tempor diam tempor erat.
                        </p>
                        <h4>Client Name</h4>
                        <span>Profession</span>
                    </div>
                    <div class="testimonial-item">
                        <img class="img-fluid rounded mb-3" src="{{ asset('asset/Front/img/testimonial-1.jpg') }}"
                            alt="" />
                        <p class="fs-5">
                            Dolores sed duo clita tempor justo dolor et stet lorem kasd
                            labore dolore lorem ipsum. At lorem lorem magna ut et, nonumy
                            et labore et tempor diam tempor erat.
                        </p>
                        <h4>Client Name</h4>
                        <span>Profession</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->



@endsection

@section('js')


<script>
  $('#FeedbackForm').submit(function(event) {
    event.preventDefault();
    $('button[type=submit]').prop('disabled', true)
    $.ajax({
        url: ' {{ url("/Store-Feedback") }}',
        type: 'post',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response) {
            $('button[type=submit]').prop('disabled', false)
            if (response['status'] == true) {
                window.location.href = ' {{ route("Front.contact") }} '
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
                    $('#name').addClass('is-invalid').siblings('span').addClass('invalid-feedback')
                        .html(error['name'])
                } else {
                    $('#name').removeClass('is-invalid').siblings('span').removeClass(
                        'invalid-feedback').html('')
                }

                
                if (error['email']) {
                    $('#email').addClass('is-invalid').siblings('span').addClass('invalid-feedback')
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
@endsection