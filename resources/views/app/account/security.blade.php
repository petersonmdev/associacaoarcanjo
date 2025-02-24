@extends('layouts/contentNavbarLayout')

@section('title', 'Minha conta - Segurança')

@section('page-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Minha conta') }} / </span>{{ __('Segurança') }}</h4>

  <div class="row">
    <div class="col-md-12">
      <livewire:account.menu/>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <h4 class="card-header text-primary fw-bold py-3 my-4">{{ __('Alterar minha senha') }}</h4>
        <div class="card-widget-separator-wrapper">
          <div class="card-body card-widget-separator">
            <livewire:account.change-password lazy="on-load"/>
          </div>
        </div>
      </div>
    </div>
  </div>

  @livewireScripts()
@endsection
