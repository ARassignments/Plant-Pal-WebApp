@extends('Front.master')

@section('content')
<section class="section-11">
    <div class="container mt-5">
        <div class="row order-row">
            <div class="col-md-3">
                @include('Front.profile.master')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2">Change Password</h2>
                    </div>
                    <div class="card-body p-4">
                        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="old_password" class="form-label">Old Password</label>
                                <input type="password" name="current_password" id="old_password" placeholder="Old Password" class="form-control">
                                @if ($errors->updatePassword->has('current_password'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->updatePassword->first('current_password') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" name="password" id="new_password" placeholder="New Password" class="form-control">
                                @if ($errors->updatePassword->has('password'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->updatePassword->first('password') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="confirm_password" placeholder="Confirm Password" class="form-control">
                                @if ($errors->updatePassword->has('password_confirmation'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->updatePassword->first('password_confirmation') }}
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex">
                                <button type="submit" class="btn btn-dark">Save</button>
                            </div>

                            @if (session('status') === 'password-updated')
                                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-success mt-3">
                                    {{ __('Saved.') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
