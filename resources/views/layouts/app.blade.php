<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href="{{ mix('/assets/css/app.css') }}" rel="stylesheet" />
    @yield('mainStyles')

</head>

<body>

    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>


    <div id="app" class="@yield('bodyClass')">
        @yield('body')

        <button type="button" class="btn btn-icon btn-circle btn-success btn-scroll-to-top"
            data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></button>

    </div>

    <script type="text/javascript" src="{{ mix('/assets/js/app.js') }}"></script>
    
    <script type="text/javascript">
        var _rootUrl = '{{url(config('app.url'))}}'
    </script>
    @yield('mainScripts')

</body>

</html>