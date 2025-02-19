@extends('layouts/contentNavbarLayout')

@section('title', 'Minha conta - Segurança')

@section('content')
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Configurações da minha conta') }} / </span>{{ __('Segurança') }}</h4>

  <div class="row">
    <div class="col-md-12">
      <livewire:account.menu />
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <h4 class="card-header text-primary fw-bold py-3 my-4">{{ __('Alterar minha senha') }}</h4>
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
        <h5 class="card-header">{{ __('Apagar Conta') }}</h5>
        <div class="card-body">
          <div class="mb-3 col-12 mb-0">
            <div class="alert alert-warning">
              <h6 class="alert-heading fw-bold mb-1">{{ __('Tem certeza de que deseja excluir sua conta?') }}</h6>
              <p class="mb-0">{{ __('Depois que você excluir sua conta, não há como voltar atrás. Por favor, certifique-se.') }}</p>
            </div>
          </div>
          <form id="formAccountDeactivation" onsubmit="return false">
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation"/>
              <label class="form-check-label" for="accountActivation">{{ __('Confirmo a desativação da minha conta') }}</label>
            </div>
            <button type="submit" class="btn btn-danger deactivate-account">{{ __('Desativar conta') }}</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  @livewireScripts()
@endsection
