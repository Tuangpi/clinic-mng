@extends('layouts.master')

@section('title', 'Appointment')

@section('pre-styles')
<link href="{{ mix('/assets/css/plugins/general-setup/appointment.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
  <div class="col">
    <h1 class="page-header">Appointment</h1>
  </div>
</div>
<ul class="nav nav-tabs tab-blue">
  <li class="nav-item">
    <a href="#categories" data-bs-toggle="tab" class="nav-link active">Categories</a>
  </li>
  <li class="nav-item">
    <a id="statusesLink" href="#statuses" data-bs-toggle="tab" class="nav-link">Statuses</a>
  </li>
</ul>
<div class="tab-content panel p-3 rounded-0 rounded-bottom">
  <div class="tab-pane fade active show" id="categories">
    @include('partials.general-setup.appointment.categories.categories')
  </div>
  <div class="tab-pane fade" id="statuses">
    @include('partials.general-setup.appointment.statuses.statuses')
  </div>
</div>
@endsection

@section('modals')
@include('partials.general-setup.appointment.categories.modal-category-form')
@include('partials.general-setup.appointment.statuses.modal-status-form')
@endsection
@section('pre-scripts')
<script type="text/javascript" src="{{ mix('/assets/js/plugins/general-setup/appointment.js') }}"></script>
@endsection
@section('scripts')
<script type="text/javascript">
  var _categoryUrl = '{{route('appointment-categories.index')}}',
      _statusUrl = '{{route('appointment-statuses.index')}}',
      _id = 0;
</script>
<script type="text/javascript" src="{{ mix('/assets/js/general-setup/appointment.js') }}"></script>
@endsection