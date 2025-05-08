@extends('layouts.master')

@section('title', 'Patient')

@section('pre-styles')
<link href="{{ mix('/assets/css/plugins/general-setup-patient.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
  <div class="col">
    <h1 class="page-header">Patient</h1>
  </div>
</div>
<ul class="nav nav-tabs tab-blue">
  <li class="nav-item">
    <a href="#caseTypes" data-bs-toggle="tab" class="nav-link active">Case Types</a>
  </li>
  <li class="nav-item">
    <a id="caseNoteTemplatesLink" href="#caseNoteTemplates" data-bs-toggle="tab" class="nav-link">Case Note Templates</a>
  </li>
  <li class="nav-item">
    <a id="titlesLink" href="#titles" data-bs-toggle="tab" class="nav-link">Titles</a>
  </li>
</ul>
<div class="tab-content panel p-3 rounded-0 rounded-bottom">
  <div class="tab-pane fade active show" id="caseTypes">
    @include('partials.general-setup.patient.case-types')
  </div>
  <div class="tab-pane fade" id="caseNoteTemplates">
    @include('partials.general-setup.patient.case-note-templates.case-note-templates')
  </div>
  <div class="tab-pane fade" id="titles">
    @include('partials.general-setup.patient.titles')
  </div>
</div>
@endsection

@section('modals')
@include('partials.general-setup.patient.case-note-templates.modal-case-note-template-form')
@include('partials.modal-description-form')
@endsection
@section('scripts')
@section('pre-scripts')
<script type="text/javascript" src="{{ mix('/assets/js/plugins/general-setup-patient.js') }}"></script>
@endsection
<script type="text/javascript">
  var _caseTypeUrl = '{{route('case-types.index')}}',
      _caseNoteTemplateUrl = '{{route('case-note-templates.index')}}',
      _titleUrl = '{{route('titles.index')}}',
      _id = 0;
</script>
<script type="text/javascript" src="{{ mix('/assets/js/general-setup/patient.js') }}"></script>
@endsection