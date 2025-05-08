@extends('layouts.master')

@section('title', 'Inventory')

@section('content')
<div class="row">
  <div class="col">
    <h1 class="page-header">Inventory</h1>
  </div>
</div>
<ul class="nav nav-tabs tab-blue">
  <li class="nav-item">
    <a href="#types" data-bs-toggle="tab" class="nav-link active">Types</a>
  </li>
  <li class="nav-item">
    <a id="categoriesLink" href="#categories" data-bs-toggle="tab" class="nav-link">Categories</a>
  </li>
  <li class="nav-item">
    <a id="uomsLink" href="#uoms" data-bs-toggle="tab" class="nav-link">UOMs</a>
  </li>
  <li class="nav-item">
    <a id="usagesLink" href="#usages" data-bs-toggle="tab" class="nav-link">Usages</a>
  </li>
  <li class="nav-item">
    <a id="dosagesLink" href="#dosages" data-bs-toggle="tab" class="nav-link">Dosages</a>
  </li>
  <li class="nav-item">
    <a id="frequenciesLink" href="#frequencies" data-bs-toggle="tab" class="nav-link">Frequencies</a>
  </li>
</ul>
<div class="tab-content panel p-3 rounded-0 rounded-bottom">
  <div class="tab-pane fade active show" id="types">
    @include('partials.general-setup.inventory.types')
  </div>
  <div class="tab-pane fade" id="categories">
    @include('partials.general-setup.inventory.categories')
  </div>
  <div class="tab-pane fade" id="uoms">
    @include('partials.general-setup.inventory.uoms')
  </div>
  <div class="tab-pane fade" id="usages">
    @include('partials.general-setup.inventory.usages')
  </div>
  <div class="tab-pane fade" id="dosages">
    @include('partials.general-setup.inventory.dosages')
  </div>
  <div class="tab-pane fade" id="frequencies">
    @include('partials.general-setup.inventory.frequencies')
  </div>
</div>
@endsection

@section('modals')
@include('partials.modal-description-form')
@endsection
@section('scripts')
<script type="text/javascript">
  var _typeUrl = '{{route('product-types.index')}}',
        _categoryUrl = '{{route('product-categories.index')}}',
        _uomUrl = '{{route('uoms.index')}}',
        _usageUrl = '{{route('usages.index')}}',
        _dosageUrl = '{{route('dosages.index')}}',
        _frequencyUrl = '{{route('frequencies.index')}}',
        _id = 0;
</script>
<script type="text/javascript" src="{{ mix('/assets/js/general-setup/inventory.js') }}"></script>
@endsection