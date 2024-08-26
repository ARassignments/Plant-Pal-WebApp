@extends('Front.master')

@section('content')
<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px">
            <p class="fs-5 fw-bold text-primary">Our Accessories</p>
            <h1 class="display-5 mb-5">Accessories That We Offer For You</h1>
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
                    </div>
                </div>
            </div>
            @endforeach
            @endif
           
        </div>
    </div>
</div>
<!-- Service End --> 
@endsection