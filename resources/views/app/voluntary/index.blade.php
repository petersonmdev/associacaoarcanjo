@extends('layouts/contentNavbarLayout')

@section('title', 'Lista de voluntários')

@section('page-script')
  <script src="{{asset('assets/js/ui-popover.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Voluntários /</span> Todos os voluntários</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h4 class="card-header text-primary fw-bold py-3 my-4">Voluntários cadastrados</h4>
      <div class="card-body">
        <livewire:voluntary.index-voluntary lazy="on-load" />
      </div>
    </div>
  </div>
</div>

@livewireScripts()
@endsection
