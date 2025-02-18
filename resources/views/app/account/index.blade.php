@extends('layouts/contentNavbarLayout')

@section('title', 'Minha conta')

@section('content')
  <h4 class="fw-bold py-3 mb-4">Minha conta</h4>

  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-body">
        <livewire:account.show-account lazy="on-load" />
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card">
      <h5 class="card-header">Deletar conta</h5>
      <div class="card-body">
        <livewire:account.delete-account lazy="on-load" />
      </div>
    </div>
  </div>

  @livewireScripts
@endsection
