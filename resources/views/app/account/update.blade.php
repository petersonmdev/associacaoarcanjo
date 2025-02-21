@extends('layouts/contentNavbarLayout')

@section('title', 'Editar minha conta')

@section('page-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Configurações da minha conta') }} / </span>{{ __('Editar dados') }}</h4>

  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body">
          @if ($user)
            <livewire:account.update-account :userId="$id" :user="$user" lazy="on-load" />
          @else
            <p class="text-center mt-3">Nenhum registro de cadastro com o id <span class="fw-medium">{{ '#'.sprintf('%04d', $id) }}</span> foi encontrado!</p>
          @endif
        </div>
      </div>
    </div>
  </div>

  @livewireScripts()
@endsection
