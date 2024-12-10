@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastrar nova família assistida')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Assistidos /</span> Cadastrar novo assistido</h4>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

  <div class="d-flex flex-column justify-content-center">
    <h4 class="mb-1 mt-3">Novo assistido</h4>
    <p class="text-muted">Cadastre uma nova família assistida</p>
  </div>
  <div class="d-flex align-content-center flex-wrap gap-3">
    <a href="{{url()->previous()}}" class="btn btn-label-secondary">Voltar</a>
    <a href="{{route('assisted-list')}}" class="btn btn-primary">
      <i class="bx bx-list-ul me-2"></i> Todos assistidos</a>
  </div>

</div>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-body">
        <livewire:assisted.create-assisted lazy="on-load" />
      </div>
    </div>
  </div>
</div>

@livewireScripts()
@endsection
