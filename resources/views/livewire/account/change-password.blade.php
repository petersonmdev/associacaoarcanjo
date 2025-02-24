<div>
  <form id="formChangePassword" wire:submit.prevent="updatePassword" class="fv-plugins-bootstrap5 fv-plugins-framework">
    <div class="alert alert-warning alert-dismissible" role="alert">
      <h6 class="alert-heading fw-bold mb-1">{{ __('Garantir que estes requisitos sejam cumpridos') }}</h6>
      <span>{{ __('Mínimo de 8 caracteres, letras maiúsculas e símbolo') }}</span>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="row gx-6">
      <div class="mb-4 col-12 form-password-toggle fv-plugins-icon-container">
        <label class="form-label" for="current_password">{{ __('Senha atual') }}</label>
        <div class="input-group input-group-merge has-validation">
          <input class="form-control @error('current_password') is-invalid @enderror" type="password" autocomplete="on" id="current_password" wire:model="current_password" placeholder="············">
          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
        @error('current_password') <span class="error">{{ $message }}</span> @enderror
      </div>

      <div class="mb-4 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
        <label class="form-label" for="new_password">{{ __('Nova senha') }}</label>
        <div class="input-group input-group-merge has-validation">
          <input class="form-control @error('new_password') is-invalid @enderror" type="password" autocomplete="on" id="new_password" wire:model="new_password" placeholder="············">
          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
        @error('new_password') <span class="error">{{ $message }}</span> @enderror
      </div>

      <div class="mb-4 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
        <label class="form-label" for="new_password_confirmation">{{ __('Confirme a nova senha') }}</label>
        <div class="input-group input-group-merge has-validation">
          <input class="form-control @error('new_password_confirmation') is-invalid @enderror" type="password" autocomplete="on" id="new_password_confirmation" wire:model="new_password_confirmation" placeholder="············">
          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
        @error('new_password_confirmation') <span class="error">{{ $message }}</span> @enderror
      </div>
      <div>
        <button type="submit" class="btn btn-primary me-2">{{ __('Alterar senha') }}</button>
      </div>
    </div>
    <input type="hidden">
  </form>
</div>
