@extends('layouts/contentNavbarLayout')

@section('title', 'Editar família assistida')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Assistidos /</span> Editar assistido</h4>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

  <div class="d-flex flex-column justify-content-center">
    <h4 class="mb-1 mt-3">Editar família assistida</h4>
    @if ($assisted) <p class="text-muted">Editar cadastro <span class="fw-medium">{{ '#'.sprintf('%04d', $id) }}</span></p> @endif
  </div>
  <div class="d-flex align-content-center flex-wrap gap-3">
    <a href="{{url()->previous()}}" class="btn btn-label-secondary">Voltar</a>
    <a href="{{route('assisted-list')}}" class="btn btn-primary">
      <i class="bx bx-list-ul me-2"></i> Todos assistidos</a>
  </div>

</div>
<div class="col-md-12">
  <div class="card mb-4">
    <div class="card-body">
      @if ($assisted)
        <livewire:assisted.update-assisted :assistedId="$id" lazy="on-load" />
      @else
        <p class="text-center mt-3">Nenhum registro de cadastro com o id <span class="fw-medium">{{ '#'.sprintf('%04d', $id) }}</span> foi encontrado!</p>
      @endif
    </div>
  </div>
</div>

@livewireScripts
@endsection
