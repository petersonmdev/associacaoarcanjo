@extends('layouts/contentNavbarLayout')

@section('title', 'Configurações de conta')

@section('content')
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Configurações /</span> Minha conta</h4>
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-body">
        <livewire:configuration.user.update-user :userId="$id" :user="$user" lazy="on-load" />
      </div>
    </div>
  </div>

  @livewireScripts
@endsection

