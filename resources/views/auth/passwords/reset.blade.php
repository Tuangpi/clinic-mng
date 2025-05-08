@extends('layouts.login-master')

@section('title', 'Reset Password')

@section('content')
<form action="{{ route('password.update') }}" method="POST" class="fs-13px">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-floating mb-15px">
        <input type="email" class="form-control h-45px fs-13px @error('email') is-invalid @enderror" placeholder="email"
            id="email" name="email" value="{{ $email ?? old('email') }}" required />
        <label for="email" class="d-flex align-items-center fs-13px text-gray-600">Email Address</label>

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-floating mb-15px">
        <input type="password" class="form-control h-45px fs-13px @error('password') is-invalid @enderror"
            placeholder="Password" id="password" name="password" required/>
        <label for="password" class="d-flex align-items-center fs-13px text-gray-600">New Password</label>

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-floating mb-15px">
        <input type="password" class="form-control h-45px fs-13px @error('password_confirmation') is-invalid @enderror"
            placeholder="Password" id="password-confirm" name="password_confirmation" required/>
        <label for="password" class="d-flex align-items-center fs-13px text-gray-600">Confirm New Password</label>
    </div>
    <div class="mb-15px">
        <button type="submit" class="btn btn-primary d-block h-45px w-100 btn-lg fs-14px">Reset Password</button>
    </div>
    <div class="text-center">
    </div>
    <div class="mb-40px pb-40px text-dark text-center">
        Remember your account? Click <a href="{{ route('login') }}" class="text-primary">here</a> to sign in.
    </div>
</form>
@endsection
