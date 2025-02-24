<?php

namespace App\Livewire\Configuration\User;

use App\Enums\BrazilStates;
use App\Enums\Roles;
use App\Repositories\AddressRepository;
use App\Repositories\ContactRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdateUser extends Component
{
  #[Validate([
    'userName' => 'required|string|max:255',
    'email' => 'required|email',
    'phone_number_whatsapp' => 'required|regex:/^\(?\d{2}\)?\s?\d{4,5}-\d{4}$/',
    'role' => 'required',
    'zipcode' => ['required', 'regex:/^\d{5}-\d{3}$/'],
    'address' => 'required|string|max:150',
    'number' => ['required','numeric'],
    'neighborhood' => 'required|string|max:100',
    'city' => 'required|string|max:100',
    'state' => 'required|string|max:2'
  ], message: [
    '*.numeric' => 'O campo deve conter apenas números.',
    '*.required' => 'Campo obrigatório.',
    '*.max' => 'Tamanho máximo do campo excedido.',
    '*.email' => 'E-mail inválido.',
    'phone_number_whatsapp.regex' => 'Número de celular inválido.',
    'zipcode.regex' => 'CEP inválido.',
  ])]

  public $user;
  public $id;
  public $repositoryUser;
  public $repositoryContact;
  public $repositoryAddress;
  public $repositoryVoluntary;
  public string $userName;
  public string $email;
  public string $phone_number_whatsapp;
  public string $zipcode;
  public string $address;
  public int $number;
  public string $complement;
  public string $neighborhood;
  public string $city;
  public string $state;

  public function mount($userId)
  {
    $this->id = $userId;
    $this->loadUserData();
  }

  public function loadUserData()
  {
    $this->repositoryUser = UserRepository::find($this->id);
    $this->repositoryContact = ContactRepository::find($this->id);
    $this->repositoryAddress = AddressRepository::find($this->id);

    $this->fillFormFields();
  }

  public function fillFormFields()
  {
    $this->userName = $this->repositoryUser->name;
    $this->email = $this->repositoryUser->email;
    $this->phone_number_whatsapp = $this->repositoryContact->phone_number_whatsapp;
    $this->zipcode = $this->repositoryAddress->zipcode;
    $this->address = $this->repositoryAddress->address;
    $this->number = $this->repositoryAddress->number;
    $this->complement = $this->repositoryAddress->complement;
    $this->neighborhood = $this->repositoryAddress->neighborhood;
    $this->city = $this->repositoryAddress->city;
    $this->state = $this->repositoryAddress->state;
  }

  public function render()
  {
    return view('livewire.configuration.user.update-user', [
      'user'=> $this->user,
      'roles' => Roles::cases(),
      'states' => BrazilStates::cases()
    ]);
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

  public function submitFormUser()
  {
    $this->validate();

    try {
      $this->updateContact();
      $this->updateAddress();
      $this->updateUser();

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
}
