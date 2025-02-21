@extends('layouts/contentNavbarLayout')

@section('title', 'Minha conta')

@section('content')
  <h4 class="fw-bold py-3 mb-4">{{ __('Minha conta') }}</h4>

  <div class="row">
    <div class="col-md-12">
      <livewire:account.menu/>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-widget-separator-wrapper">
          <div class="card-body card-widget-separator">
            <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8 p-3">
              <div class="flex-shrink-0 mt-1 mx-sm-0 mx-auto">
                <img width='100' src="{{ ($user->profile_photo_path) ? asset($user->profile_photo_path) : asset('assets/img/avatars/avatar-default.png')}}" alt class="d-block h-auto ms-0 ms-sm-6 rounded-3 user-profile-img"/>
              </div>
              <div class="flex-grow-1 mt-3">
                <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                  <div class="user-profile-info">
                    <h4 class="mb-2 mt-lg-7">{{ $user->name }}</h4>
                    <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                      <li class="list-inline-item">
                        <i class="bx bx-envelope me-2 align-top"></i><span class="fw-medium">{{$user->email}}</span>
                      </li>
                      <li class="list-inline-item">
                        <i class="bx bx-save me-2 align-top"></i><span class="fw-medium">Cadastrado {{$user->created_at->format('d/m/Y \à\s H:i:s')}}</span>
                      </li>
                    </ul>
                  </div>
                  <a href="{{route('account-user-update', ['id' => Auth::user()->id])}}" class="btn btn-primary mb-1">
                    <i class="bx bx-edit-alt bx-sm me-2"></i>Editar
                  </a>
                </div>
              </div>
            </div>

            <hr class="my-2">

            <div class="row">
              <div class="col-md-6 col-lg-6 col-12">
                <ul class="list-unstyled my-3 py-1">
                  <li class="d-flex align-items-center mb-4">
                    <i class="bx bx-user"></i>
                    <span class="fw-medium mx-2">{{ __('Nome:') }}</span> <span>{{ $user->name }}</span>
                  </li>
                  <li class="d-flex align-items-center mb-4">
                    <i class="bx bx-envelope"></i>
                    <span class="fw-medium mx-2">{{ __('Email:') }}</span> <span>{{ $user->email }}</span>
                  </li>
                  <li class="d-flex align-items-center mb-4">
                    <i class="bx bx-group"></i>
                    <span class="fw-medium mx-2">{{ __('Time:') }}</span> <span>{{ $user->current_team_id }}</span>
                  </li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-6 col-12">
                <ul class="list-unstyled my-3 py-1">
                  <li class="d-flex align-items-center mb-4">
                    <i class="bx bx-save"></i>
                    <span class="fw-medium mx-2">{{ __('Criado em:') }}</span> <span>{{ $user->created_at->format('d/m/Y \à\s H:i:s') }}</span>
                  </li>
                  <li class="d-flex align-items-center mb-2">
                    <i class="bx bx-up-arrow-circle"></i>
                    <span class="fw-medium mx-2">{{ __('Atualizado em:') }}</span> <span>{{ $user->updated_at->format('d/m/Y \à\s H:i:s') }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @livewireScripts()
@endsection
