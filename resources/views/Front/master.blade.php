<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>PlantNest</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap"
        rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('asset/Front/lib/animate/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset/Front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset/Front/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <!-- bootstrap link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- bootstrap link  -->
    <link href="{{ asset('asset/Front/css/bootstrap.min.css') }}" rel="stylesheet" />

    @yield('css')


    <!-- Template Stylesheet -->
    <link href="{{ asset('asset/Front/css/style.css') }}" rel="stylesheet" />

    <!-- CSRF Token  -->
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- CSRF Token  -->

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem"></div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="container-fluid bg-dark text-light px-0 py-2">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <span class="fa fa-phone-alt me-2"></span>
                    <span>+012 345 6789</span>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <span class="far fa-envelope me-2"></span>
                    <span>info@example.com</span>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center mx-n2">
                    @if(Auth::check() == true)
                    <a class="btn btn-link text-light" href="{{ route('Profile.account') }}"><i
                            class="fa-solid fa-user"></i>
                    </a>
                    @else
                    <a class="btn btn-link text-light" href="{{ route('login') }}">
                        Sign in
                    </a>
                    @endif

                    <a class="btn btn-link text-light" href="{{ route('Front.cart') }}"><i
                            class="fa fa-shopping-bag"></i></a>

                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h1 class="m-0">PlantNest</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('Front.index') }}" class="nav-item nav-link active">Home</a>
                <a href="{{ route('Front.about') }}" class="nav-item nav-link">About</a>
                <a href="{{ route('Front.service') }}" class="nav-item nav-link">Services</a>
                <a href="{{ route('Front.gallery') }}" class="nav-item nav-link">Gallery</a>
                <a href="{{ route('Front.shop') }}" class="nav-item nav-link">Shop</a>
                <a href="{{ route('Front.contact') }}" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    @yield('content')


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Our Office</h4>
                    <p class="mb-2">
                        <i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-phone-alt me-3"></i>+012 345 67890
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-envelope me-3"></i>info@example.com
                    </p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2"
                            href="{{ route('Front.cart') }}"><i class="fa-solid fa-bag-shopping"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="{{ route('Front.about') }}">About Us</a>
                    <a class="btn btn-link" href="{{ route('Front.contact') }}">Contact Us</a>
                    <a class="btn btn-link" href="{{ route('Front.gallery') }}">Gallery</a>
                    <a class="btn btn-link" href="{{ route('Front.service') }}">Our Services</a>
                    <a class="btn btn-link" href="{{ route('Front.cart') }}">Cart</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="{{ route('Front.index') }}">PlantNest</a>, All
                    Right Reserved.
                </div>

            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    <!-- jquery script link -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- jquery script link -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('asset/Front/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('asset/Front/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('asset/Front/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('asset/Front/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/Front/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('asset/Front/lib/parallax/parallax.min.js') }}"></script>
    <script src="{{ asset('asset/Front/lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('asset/Front/lib/lightbox/js/lightbox.min.js') }}"></script>

    @yield('js')

    <!-- Template Javascript -->
    <script src="{{ asset('asset/Front/js/main.js') }}"></script>

    <script>
         $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
</body>

</html>