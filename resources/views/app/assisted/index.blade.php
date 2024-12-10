@extends('layouts/contentNavbarLayout')

@section('title', 'Lista de famílias assistidas')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Assistidos /</span> Todos os assistidos</h4>

<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-widget-separator-wrapper">
        <div class="card-body card-widget-separator">
          <livewire:assisted.index-summary-assisted lazy="on-load" />
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h4 class="card-header text-primary fw-bold py-3 my-4">Famílias assistidas cadastradas</h4>
      <div class="card-body">
        <livewire:assisted.index-assisted lazy="on-load" />
      </div>
    </div>
  </div>
</div>

@livewireScripts()
@endsection
