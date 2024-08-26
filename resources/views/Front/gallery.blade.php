@extends('Front.master')

@section('content')
    
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">Gallery</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


 
  


     <!-- Team Start -->
     <div class="container-xxl py-5">
        <div class="container">
         
          <div class="row g-4">
           
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/1.webp') }}" alt="Team Member 1" />
                        <div class="team-text">
                            <h4 class="mb-0">Member 1</h4>
                            <p class="text-primary">Role 1</p>
                            <div class="team-social d-flex">
                                <a class="btn btn-square rounded-circle me-2" href="https://facebook.com/member1" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="btn btn-square rounded-circle me-2" href="https://twitter.com/member1" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="btn btn-square rounded-circle me-2" href="https://instagram.com/member1" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 2 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/2.webp') }}" alt="Team Member 2" />
                       
                    </div>
                </div>

                <!-- Gallery Item 3 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/a1.webp') }}" alt="Team Member 3" />
                      
                    </div>
                </div>

                <!-- Gallery Item 4 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/a2.jpg') }}" alt="Team Member 4" />
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/5.webp') }}" alt="Team Member 4" />
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/a3.webp') }}" alt="Team Member 4" />
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/7.webp') }}" alt="Team Member 4" />
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/8.webp') }}" alt="Team Member 4" />
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/9.webp') }}" alt="Team Member 4" />
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/10.webp') }}" alt="Team Member 4" />
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/11.webp') }}" alt="Team Member 4" />
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/12.webp') }}" alt="Team Member 4" />
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/13.webp') }}" alt="Team Member 4" />
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/14.webp') }}" alt="Team Member 4" />
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('asset/Front/gallery/15.webp') }}" alt="Team Member 4" />
                       
                    </div>
                </div>
          </div>
        </div>
      </div>
      <!-- Team End -->
@endsection