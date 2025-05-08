@php
$currentBranch = session('branch');
$currentBranchAll = !$currentBranch;
@endphp

@extends('layouts.app')

@section('mainStyles')
<link href="{{ mix('/assets/css/plugins.css') }}" rel="stylesheet" />
@yield('pre-styles')
<link href="{{ mix('/assets/css/cms.css') }}" rel="stylesheet" />
@yield('styles')
@endsection

@section('bodyClass', 'app app-header-fixed app-sidebar-fixed app-with-wide-sidebar app-with-light-sidebar')

@section('body')
@include('layouts.topbar')
@include('layouts.sidebar')

<div id="content" class="app-content">
    @yield('content')
</div>
<input type="hidden" id='hfParentUrl' value="@yield('parentUrl')">
@yield('modals')
@endsection
@section('mainScripts')
<script type="text/javascript">
    var _rootUrl = '{{url(config('app.url'))}}',
        _isCurrentBranchAll = {{ $currentBranchAll ? 'true': 'false' }},
        _currentBranchCurrencySymbol = '{{ $currentBranch ? $currentBranch->currency_symbol : '$' }}',
        _isAdmin = {{ \Auth::user()->is_administrator ? 'true' : 'false' }};
</script>
<script type="text/javascript" src="{{ mix('/assets/js/plugins.js') }}"></script>
@yield('pre-scripts')
<script type="text/javascript" src="{{ mix('/assets/js/cms.js') }}"></script>
@yield('scripts')
@endsection