@extends('layouts.auth', ['title' => 'Login'])

@section('content')
    <div class="col-xl-5">

        <div class="card auth-card">
            <div class="card-body px-3 py-5">
                <div class="mx-auto mb-4 text-center auth-logo">
                    <span class="logo-dark">
                        <img src="/images/logo-dark.png" height="32" alt="logo dark">
                    </span>

                    <span class="logo-light">
                        <img src="/images/logo-light.png" height="28" alt="logo light">
                    </span>
                </div>

                <h2 class="fw-bold text-uppercase text-center fs-18">Sign In</h2>

                <div class="px-4">
                    <form method="POST" action="{{ route('login') }}" class="authentication-form">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="login_user_name">Username <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="login_user_name" name="adm_user_name"
                                   class="form-control bg-light bg-opacity-50 border-light py-2 @error('adm_user_name') is-invalid @enderror"
                                   placeholder="Enter your username" value="">
                            @error('adm_user_name')
                            <span class="validation-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {{--<a href="--}}{{--{{ route('second', ['auth', 'password'])}}--}}{{--"
                               class="float-end text-muted text-unline-dashed ms-1">Reset
                                password</a>--}}
                            <label class="form-label" for="password">Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" id="password"
                                   class="form-control bg-light bg-opacity-50 border-light py-2 @error('password') is-invalid @enderror"
                                   placeholder="Enter your password" name="password" value="">
                            @error('password')
                            <span class="validation-message">{{ $message }}</span>
                            @enderror
                        </div>
                        {{--<div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                <label class="form-check-label" for="checkbox-signin">Remember me</label>
                            </div>
                        </div>--}}

                        <div class="mb-1 text-center d-grid">
                            <button class="btn btn-danger py-2 fw-medium" type="submit">Sign In</button>
                        </div>
                    </form>
                </div> <!-- end col -->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
        </p>
    </div>
@endsection
