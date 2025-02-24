<?php

namespace App\Livewire\Account;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Repositories\UserRepository;
use Livewire\WithFileUploads;

class UpdateAccount extends Component
{
  use WithFileUploads;

    #[Validate([
      'userName' => 'required|string|max:255',
      'email' => 'required|email'
    ], message: [
      '*.required' => 'Campo obrigatório.',
      '*.max' => 'Tamanho máximo do campo excedido.',
      '*.email' => 'E-mail inválido.'
    ])]

    public int $id;
    public string $userName;
    public string $email;
    public $avatar;
    public $repositoryUser;

    public function mount($userId)
    {
      $this->id = $userId;
      $this->loadUserData();
    }

    public function loadUserData()
    {
      $this->repositoryUser = UserRepository::find($this->id);

      $this->fillFormFields();
    }

    public function fillFormFields()
    {
      $this->userName = $this->repositoryUser->name;
      $this->email = $this->repositoryUser->email;
    }

    public function uploadImage()
    {
      if ($this->avatar) {
        $imageName = Carbon::now()->timestamp . '.' .$this->avatar->extension();
        $manager = new ImageManager(new GdDriver());
        $image = $manager->read($this->avatar->getRealPath());
        $width = $image->width();
        $height = $image->height();
        $size = min($width, $height);
        $x = intval(($width - $size) / 2);
        $y = intval(($height - $size) / 2);
        $image->crop($size, $size, $x, $y);
        $image->resize(300, 300);
        $image->save(public_path('uploads/avatars').'/'.$imageName);
        $this->repositoryUser->profile_photo_path = 'uploads/avatars/' . $imageName;;
        $this->repositoryUser->save();
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

    public function render()
    {
        return view('livewire.account.update-account');
    }

  private function updateEntity($repository, $id, array $data)
  {
    try {
      $repository::update($id, $data);
    } catch (Exception $e) {
      Log::error($e);
      $this->dispatch(
        'alert',
        type: 'error',
        title: 'Erro ao atualizar ' . class_basename($repository) . '. ',
        position: 'center',
        timer: 1500
      );
    }
  }

  public function submitUpdateUser()
  {
    $this->validate();

    try {
      $this->updateEntity(UserRepository::class, $this->id, [
        'name' => $this->userName,
        'email' => $this->email
      ]);

      $this->dispatch(
        'alert',
        type: 'success',
        title: 'Cadastro atualizado com sucesso. ',
        position: 'center',
        timer: 1500
      );
    } catch (Exception $e) {
      Log::error($e);
      $this->dispatch(
        'alert',
        type: 'error',
        title: 'Ocorreu um erro ao processar o cadastro. Por favor, tente novamente. ',
        position: 'center',
        timer: 1500
      );
    }
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
