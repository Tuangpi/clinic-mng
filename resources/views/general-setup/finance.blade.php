@extends('layouts.master')

@section('title', 'Finance')

@section('content')
<div class="row">
  <div class="col">
    <h1 class="page-header">Finance</h1>
  </div>
</div>
<ul class="nav nav-tabs tab-blue">
  <li class="nav-item">
    <a href="#paymentModes" data-bs-toggle="tab" class="nav-link active">Payment Modes</a>
  </li>
  <li class="nav-item">
    <a id="taxesLink" href="#taxes" data-bs-toggle="tab" class="nav-link">Taxes</a>
  </li>
</ul>
<div class="tab-content panel p-3 rounded-0 rounded-bottom">
  <div class="tab-pane fade active show" id="paymentModes">
    @include('partials.general-setup.finance.payment-modes.payment-modes')
  </div>
  <div class="tab-pane fade" id="taxes">
    @include('partials.general-setup.finance.taxes.taxes')
  </div>
</div>
@endsection

@section('modals')
@include('partials.general-setup.finance.taxes.modal-tax-form')
@include('partials.general-setup.finance.payment-modes.modal-payment-mode-form')
@endsection
@section('pre-scripts')
<script type="text/javascript" src="{{ mix('/assets/js/plugins/general-setup/finance.js') }}"></script>
@endsection
@section('scripts')
<script type="text/javascript">
  var _taxUrl = '{{route('taxes.index')}}',
        _paymentModeUrl = '{{route('payment-modes.index')}}',
        _id = 0;
</script>
<script type="text/javascript" src="{{ mix('/assets/js/general-setup/finance.js') }}"></script>
@endsection