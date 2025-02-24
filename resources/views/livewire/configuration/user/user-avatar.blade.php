<div>
  <div class="d-flex align-items-start align-items-sm-center gap-4 mb-3">
    @auth
      @if ($avatar)
        <img
          src="{{$avatar->temporaryUrl()}}"
          alt="user-avatar"
          class="d-block rounded"
          height="101"
          width="100"
          id="uploadedAvatar"
        />
        <button class="btn btn-primary me-2 mb-4" wire:click="uploadImage">
          Salvar foto de perfil
        </button>
      @else
        <img
          src="{{asset('uploads/'.$user->profile_photo_path)}}"
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
</div>
