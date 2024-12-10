@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastro de família assistida')

@section('content')
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Assistidos /</span> {{$assisted->name}}</h4>
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

    <div class="d-flex flex-column justify-content-center">
      <h4 class="mb-1 mt-3">Família assistida</h4>
      <p class="text-muted">Cadastro <span class="fw-medium">{{ '#'.sprintf('%04d', $assisted->id) }}</span></p>
    </div>
    <div class="d-flex align-content-center flex-wrap gap-3">
      <a href="{{url()->previous()}}" class="btn btn-label-secondary">Voltar</a>
      <a href="{{route('assisted-update', ['id' => $assisted->id])}}" class="btn btn-primary">
        <i class='bx bx-edit-alt me-2'></i> Editar</a>
      <a href="javascript:void(0)" onclick="printById('show-assisted-{{$assisted->id}}', 'Cadastro de Familia assistida')" class="btn btn-primary">
        <i class='bx bx-printer me-2'></i> Imprimir</a>
    </div>

  </div>

  <div class="row" id="show-assisted-{{$assisted->id}}">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-widget-separator-wrapper">
          <div class="card-body card-widget-separator ">
            <livewire:assisted.show-assisted :assisted="$assisted" :addresses="$addresses" :contacts="$contacts" :dependents="$dependents" :incomes="$incomes" :voluntary="$voluntary" lazy="on-load" />
          </div>
        </div>
      </div>
    </div>
  </div>

@livewireScripts()
@endsection
