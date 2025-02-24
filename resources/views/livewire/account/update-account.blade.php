<div>
  <div class="row mb-3">
    <div class="d-flex align-items-start align-items-sm-center gap-4 mb-3">
      @auth
        @if ($avatar)
          <img
            src="{{$avatar->temporaryUrl()}}"
            alt="user-avatar"
            class="d-block rounded"
            height="100"
            width="100"
            id="uploadedAvatar"
          />
          <button class="btn btn-primary me-2 mb-4" wire:click="uploadImage">
            Salvar foto de perfil
          </button>
        @else
          <img
            src="{{asset($repositoryUser->profile_photo_path)}}"
            alt="user-avatar"
            class="d-block rounded"
            height="100"
            width="100"
            id="uploadedAvatar"
          />
          <div class="button-wrapper">
            <div class="btn btn-outline-secondary mb-4" tabindex="0">
              <span class="d-none d-sm-block" onclick="document.getElementById('avatar').click();">Alterar foto</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
            </div>
          </div>
        @endif
        <input
          type="file"
          id="avatar"
          class="account-file-input"
          hidden
          accept="image/png, image/jpeg"
          wire:model="avatar"
        />
      @else
        <img
          src="{{asset('img/avatars/avatar-default.png')}}"
          alt="user-avatar"
          class="d-block rounded"
          height="100"
          width="100"
          id="uploadedAvatar"
        />
        <div class="button-wrapper">
          <a href="{{route('login')}}" class="btn btn-primary me-2 mb-4" tabindex="0">
            <span class="d-none d-sm-block" >Alterar foto</span>
            <i class="bx bx-upload d-block d-sm-none"></i>
          </a>
        </div>
      @endauth
    </div>

    <hr class="my-0" />

    <div class="row pt-2">
      <div class="mb-3 col-md-6">
        <label for="userName" class="form-label">Nome</label>
        <input class="form-control @error('userName') is-invalid @enderror" type="text" id="userName" wire:model="userName" placeholder="Seu nome"/>
        @error('userName') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="mb-3 col-md-6">
        <label for="email" class="form-label">E-mail</label>
        <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" wire:model="email" placeholder="email@example.com"/>
        @error('email') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
      </div>

      <div class="mb-3 col-12">
        <div class="alert alert-secondary alert-dismissible" role="alert">
          <span>
            {{ __('Para alterar a senha do usuário, clique em ') }}
            <a class="link-primary" href="{{route('account-security-user', ['id' => $repositoryUser->id ])}}">{{ __('clique aqui')}}</a>
            {{ __('e siga as instruções na tela.') }}
          </span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>

    <div class="mt-2">
      <a class="btn btn-outline-secondary" href="{{url()->previous()}}">Voltar</a>
      <button class="btn btn-success float-end" type="submit" wire:click="submitUpdateUser()" >Salvar</button>
    </div>
  </div>
</div>
