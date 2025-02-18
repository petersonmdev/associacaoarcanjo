@extends('layouts/contentNavbarLayout')

@section('title', 'Configurações de conta')

@section('content')
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Configurações /</span> Minha conta</h4>
  <div class="col-md-12">
    <div class="card mb-4">
      <h4 class="card-header text-primary fw-bold py-3 my-4">{{__('Integração com WhatsApp')}}</h4>
      <div class="card-body">
        Em desenvolvimento
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card mb-4">
      <h4 class="card-header text-primary fw-bold py-3 my-4">{{__('Dispositivos recentes')}}</h4>
      <div class="card-body">
        <livewire:configuration.user.user-session lazy="on-load" />
      </div>
    </div>
  </div>

  @livewireScripts
@endsection

