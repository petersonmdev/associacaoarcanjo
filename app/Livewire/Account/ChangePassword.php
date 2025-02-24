<?php

namespace App\Livewire\Account;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
  public $current_password;
  public $new_password;
  public $new_password_confirmation;

  protected $messages = [
    'new_password.confirmed' => 'A confirmação da nova senha não coincide.',
  ];

  public function updatePassword()
  {
    $this->validate([
      'current_password' => 'required',
      'new_password' => 'required|min:8|confirmed',
      'new_password_confirmation' => 'required'
    ]);

    $user = Auth::user();
    if (!Hash::check($this->current_password, $user->password)) {
      $this->addError('current_password', 'A senha atual está incorreta.');
      return;
    }

    $user->password = Hash::make($this->new_password);
    $user->save();

    $this->dispatch(
      'alert',
      type: 'success',
      title: 'Senha alterada com sucesso.',
      position: 'center',
      timer: 1500
    );

    $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
  }

  public function render()
  {
    return view('livewire.account.change-password');
  }

  public function placeholder()
  {
    return <<<'HTML'
      <div class="m-auto text-center">
        <p class="mt-4 mb-2 text-center text-primary">Carregando</p>
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: rgba(105, 108, 255, 1); transform: scaleX(-1);">
          <path d="M12 22c5.421 0 10-4.579 10-10h-2c0 4.337-3.663 8-8 8s-8-3.663-8-8c0-4.336 3.663-8 8-8V2C6.579 2 2 6.58 2 12c0 5.421 4.579 10 10 10z">
            <animateTransform attributeName="transform" type="rotate" dur=".4s" values="0 12 12;360 12 12;" repeatCount="indefinite"></animateTransform>
          </path>
        </svg>
      </div>
      HTML;
  }
}
