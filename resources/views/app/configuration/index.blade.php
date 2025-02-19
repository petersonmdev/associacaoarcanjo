@extends('layouts/contentNavbarLayout')

@section('title', 'Configurações')

@section('content')
  <h4 class="fw-bold py-3 mb-4">{{ __('Configurações') }}</h4>

  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <h4 class="card-header text-primary fw-bold py-3 my-4">{{ __('Preferencias de notificações') }}</h4>
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
        <h4 class="card-header text-primary fw-bold py-3 my-4">{{ __('Integrações') }}</h4>
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
        <h4 class="card-header text-primary fw-bold py-3 my-4">{{ __('Segurança') }}</h4>
        <div class="card-widget-separator-wrapper">
          <div class="card-body card-widget-separator">
            {{ __('Em desenvolvimento') }}
          </div>
        </div>
      </div>
    </div>
  </div>

  @livewireScripts
@endsection

