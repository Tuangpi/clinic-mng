@extends('layouts.app')

@section('mainStyles')
<link href="{{ mix('/assets/css/login-master.css') }}" rel="stylesheet" />
@endsection

@section('bodyClass', 'app')

@section('body')

<div class="login login-with-news-feed">

    <div class="news-feed">
        <div class="news-image" style="background-image: url({{ asset('/assets/images/login-bg.jpg') }})"></div>
    </div>


    <div class="login-container">

        <div class="brand">
            <img src="{{ asset('/assets/images/logo.png') }}" class="login-logo mx-auto d-block">
        </div>
        <div class="login-content">
            @yield('content')
            <div class="text-blue-900 text-center  mb-0">
                &copy; 2022 Dr. Chio Aesthetic & Laser Centre
            </div>
        </div>

    </div>

</div>
</div>
@endsection