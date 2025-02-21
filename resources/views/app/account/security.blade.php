@extends('layouts/contentNavbarLayout')

@section('title', 'Minha conta - Segurança')

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
            <form id="formChangePassword" method="POST" onsubmit="return false" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
              <div class="alert alert-warning alert-dismissible" role="alert">
                <h6 class="alert-heading fw-bold mb-1">{{ __('Garantir que estes requisitos sejam cumpridos') }}</h6>
                <span>{{ __('Mínimo de 8 caracteres, letras maiúsculas e símbolo') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <div class="row gx-6">
                <div class="mb-4 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
                  <label class="form-label" for="newPassword">{{ __('Nova senha') }}</label>
                  <div class="input-group input-group-merge has-validation">
                    <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="············">
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>

                <div class="mb-4 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
                  <label class="form-label" for="confirmPassword">{{ __('Confirme a nova senha') }}</label>
                  <div class="input-group input-group-merge has-validation">
                    <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="············">
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
                <div>
                  <button type="submit" class="btn btn-primary me-2">{{ __('Alterar senha') }}</button>
                </div>
              </div>
              <input type="hidden"></form>
          </div>
        </div>
      </div>
    </div>
  </div>

  @livewireScripts()
@endsection
