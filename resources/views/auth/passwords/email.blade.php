@extends('layouts.login-master')

@section('title', 'Reset Password')

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<form action="{{ route('password.email') }}" method="POST" class="fs-13px">
    @csrf

    <div class="form-floating mb-15px">
        <input type="email" class="form-control h-45px fs-13px @error('email') is-invalid @enderror" placeholder="email"
            id="email" name="email" value="{{ old('email') }}" required />
        <label for="email" class="d-flex align-items-center fs-13px text-gray-600">Email Address</label>

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="mb-15px">
        <button type="submit" class="btn btn-primary d-block h-45px w-100 btn-lg fs-14px">Send Password Reset
            Link</button>
    </div>
    <div class="text-center">
    </div>
    <div class="mb-40px pb-40px text-dark text-center">
        Remember your account? Click <a href="{{ route('login') }}" class="text-primary">here</a> to sign in.
    </div>
</form>
@endsection