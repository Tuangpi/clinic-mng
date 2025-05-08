@extends('layouts.login-master')

@section('title', 'Login')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<form action="{{ route('login') }}" method="POST" class="fs-13px">
    @csrf

    <div class="form-floating mb-15px">
        <input type="text" class="form-control h-45px fs-13px @error('username') is-invalid @enderror"
            placeholder="Username" id="username" name="username" value="{{ old('username') }}" required />
        <label for="username" class="d-flex align-items-center fs-13px text-gray-600">Username</label>

        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-floating mb-15px">
        <input type="password" class="form-control h-45px fs-13px @error('password') is-invalid @enderror"
            placeholder="Password" id="password" name="password" required/>
        <label for="password" class="d-flex align-items-center fs-13px text-gray-600">Password</label>

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <hr class="bg-gray-600 opacity-2" />
    <div class="mb-15px">
        <select id="branch" name="branch" class="form-select h-45px fs-13px @error('branch') is-invalid @enderror" required >
            <option value="">Select Branch...</option>
            @foreach ($branches as $branch)
                <option value="{{ $branch->id }}" @if(old('branch') == $branch->id) selected @endif>{{ $branch->description }}</option>
            @endforeach
        </select>
        
        @error('branch')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="mb-15px">
        <button type="submit" class="btn btn-primary d-block h-45px w-100 btn-lg fs-14px">Log in</button>
    </div>
    @if (Route::has('password.request'))
    <div class="mb-40px pb-40px text-dark text-center">
        Forgot password? Click <a href="{{ route('password.request') }}" class="text-primary">here</a> to reset password.
    </div>
    @endif
</form>
@endsection