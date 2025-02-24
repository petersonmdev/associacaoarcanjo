<?php

namespace App\Livewire\Configuration\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserAvatar extends Component
{

  use WithFileUploads;


  public $user;
  public $avatar;

    public function mount()
    {
      $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.configuration.user.user-avatar');
    }

    public function uploadImage()
    {
      if ($this->avatar) {
        $imageName = Carbon::now()->timestamp . '.' .$this->avatar->extension();
        $this->user->profile_photo_path = $this->avatar->storeAs('avatars', $imageName);
        $this->user->save();
        $this->dispatch(
          'alert',
          type: 'success',
          title: 'Foto de perfil atualizada. ',
          position: 'center',
          timer: 1500
        );
        $this->avatar = null;
      }
    }
}
