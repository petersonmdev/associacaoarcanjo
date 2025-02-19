@extends('layouts/contentNavbarLayout')

@section('title', 'Minha conta - historico de atividades')

@section('content')
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Configurações da minha conta') }} / </span>{{ __('Histórico de atividades') }}</h4>

  <div class="row">
    <div class="col-md-12">
      <livewire:account.menu />
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <h4 class="card-header text-primary fw-bold py-3 my-4">{{ __('Historico de atividades') }}</h4>
        <div class="card-widget-separator-wrapper">
          <div class="card-body card-widget-separator">
            {{ __('Em desenvolvimento') }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <h4 class="card-header text-primary fw-bold py-3 my-4">{{ __('Dispositivos conectados') }}</h4>
        <div class="card-widget-separator-wrapper">
          <div class="card-body card-widget-separator">
            {{ __('Em desenvolvimento') }}
          </div>
        </div>
      </div>
    </div>
  </div>

  @livewireScripts()
@endsection
