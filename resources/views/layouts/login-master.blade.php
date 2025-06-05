@extends('layouts.app')

@section('mainStyles')
<link href="{{ mix('/assets/css/login-master.css') }}" rel="stylesheet" />
@endsection

@section('bodyClass', 'app')

@section('body')

<div class="login login-with-news-feed responsive-login">

    <div class="brand">
        <img src="{{ asset('/assets/images/logo.png') }}" class="login-logo mx-auto d-block">
    </div>
    <div class="login-content">
        @yield('content')
        <div class="text-blue-900 text-center  mb-0">
            &copy; 2025 Accuken Pte Ltd
        </div>
    </div>
</div>
</div>
@endsection
