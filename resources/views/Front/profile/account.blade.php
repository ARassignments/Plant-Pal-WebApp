@extends('Front.master')

@section('content')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-11">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3">
                     @include('Front.profile.master')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="row">
                            <div class="mb-3">
                                    @if(auth()->user()->img)
                                        <p class="text-sm text-gray-600">{{ __('Current Profile Picture:') }}</p>
                                        <img src="{{ asset('user-profile/' . auth()->user()->img) }}" alt="{{ auth()->user()->name }}" class="mt-2 w-32 h-32 object-cover rounded-full border border-gray-300">
                                    @else
                                        <p class="text-sm text-gray-600">{{ __('No profile picture set.') }}</p>
                                    @endif
                                </div>

                                <!-- Profile Image -->
                                <div class="mb-3">
                                    <label for="profile_image">Profile Picture</label>
                                    <input type="file" name="profile_image" id="profile_image" class="form-control">
                                    @if(auth()->user()->profile_image)
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-600">{{ __('Current Profile Picture:') }}</p>
                                            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="{{ auth()->user()->name }}" class="mt-2 w-32 h-32 object-cover rounded-full border border-gray-300">
                                        </div>
                                    @endif
                                </div>

                                <!-- Name Field -->
                                <div class="mb-3">               
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" placeholder="Enter Your Name" class="form-control">
                                </div>

                                <!-- Email Field -->
                                <div class="mb-3">            
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" placeholder="Enter Your Email" class="form-control">
                                </div>

                                <!-- Phone Field -->
                                <div class="mb-3">                                    
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="Enter Your Phone" class="form-control">
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex">
                                    <button class="btn btn-dark">Update</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>  
@endsection
