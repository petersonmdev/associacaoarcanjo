@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastrar novo voluntário')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Voluntários /</span> Cadastrar novo voluntário</h4>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
  <div class="d-flex flex-column justify-content-center">
    <h4 class="mb-1 mt-3">Novo voluntário</h4>
    <p class="text-muted">Cadastre um novo voluntário</p>
  </div>
  <div class="d-flex align-content-center flex-wrap gap-3">
    <a href="{{route('voluntary-list')}}" class="btn btn-outline-secondary">
      <i class="bx bx-list-ul me-2"></i> Voltar</a>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-body">
        <livewire:voluntary.create-voluntary lazy="on-load" />
      </div>
    </div>
  </div>
</div>

@livewireScripts()
@endsection
