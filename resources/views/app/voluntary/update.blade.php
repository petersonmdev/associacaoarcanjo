@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Voluntário')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Voluntários /</span> Editar voluntário</h4>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

  <div class="d-flex flex-column justify-content-center">
    <h4 class="mb-1 mt-3">Editar {{ $voluntary->name }}</h4>
    @if ($voluntary) <p class="text-muted">Editar cadastro <span class="fw-medium">{{ '#'.sprintf('%04d', $id) }}</span></p> @endif
  </div>
  <div class="d-flex align-content-center flex-wrap gap-3">
    <a href="{{route('voluntary-list')}}" class="btn btn-outline-secondary">
      <i class="bx bx-list-ul me-2"></i> Voltar</a>
  </div>

</div>
<div class="col-md-12">
  <div class="card mb-4">
    <div class="card-body">
      @if ($voluntary)
        <livewire:voluntary.update-voluntary :voluntaryId="$id" lazy="on-load" />
      @else
        <p class="text-center mt-3">Nenhum registro de cadastro com o id <span class="fw-medium">{{ '#'.sprintf('%04d', $id) }}</span> foi encontrado!</p>
      @endif
    </div>
  </div>
</div>

@livewireScripts
@endsection
