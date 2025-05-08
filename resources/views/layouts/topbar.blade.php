@php
$currentBranch = session('branch');
$currentUser = \Auth::user();
$isAdministrator = $currentUser->is_administrator;
if ($isAdministrator) {
$branches = App\Models\Branch::orderBy('description')->get();
} else {
$branches = $currentUser->branches;
}

@endphp
<div id="header" class="app-header no-print">

    <div class="navbar-header">
        <button type="button" class="navbar-desktop-toggler" data-toggle="app-sidebar-minify">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="/" class="navbar-brand">
            <img src="{{ asset('/assets/images/logo-2.png') }}" class="header-logo">
        </a>
        <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>


    <div class="navbar-nav">
        <div class="navbar-item navbar-form"></div>
        <div class="navbar-item navbar-user dropdown">
            <a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                @if ($currentUser->photo_ext)
                <img src="{{ $currentUser->photoUrl }}">
                @else
                <i class="fa fa-user me-2"></i>
                @endif
                <span class="d-none d-md-inline">{{ $currentUser->first_name }}</span> <b class="caret ms-lg-2"></b>
            </a>
            <div class="dropdown-menu dropdown-menu-end me-1">
                <a href="{{ route('users.change-password') }}" class="dropdown-item">Change Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Log out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        <div class="navbar-item navbar-branch dropdown me-3">
            <a href="#" class="dropdown-toggle btn" data-bs-toggle="dropdown">
                <i class="fa fa-shop me-2"></i>
                {{ $currentBranch ? $currentBranch->code : 'DC-All' }}
            </a>
            <div id="branchList" class="dropdown-menu dropdown-menu-end me-1">
                @foreach ($branches as $branch)
                <a id="br{{ $branch->id }}" href="javascript:;"
                    class="dropdown-item @if ($branch->id == ($currentBranch ? $currentBranch->id : 0)) active @endif">{{
                    $branch->description }} ({{ $branch->code }})</a>
                @endforeach
                @if ($isAdministrator)
                <div class="dropdown-divider"></div>
                <a id="br0" href="javascript:;" class="dropdown-item @if(!$currentBranch) active @endif">All
                    Branches (DC-All)</a>
                @endif
            </div>
        </div>
    </div>

</div>