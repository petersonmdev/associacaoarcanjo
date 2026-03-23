<?php

namespace App\Livewire\Voluntary;

use App\Data\VoluntaryUpsertData;
use App\Enums\BrazilStates;
use App\Enums\Driving;
use App\Enums\Status;
use App\Repositories\AddressRepository;
use App\Repositories\AssistedRepository;
use App\Repositories\ContactRepository;
use App\Repositories\VoluntaryRepository;
use App\Services\VoluntaryService;
use App\Traits\Livewire\WithAssistedLinking;
use App\Traits\Livewire\WithCepLookup;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdateVoluntary extends Component
{
  use WithCepLookup, WithAssistedLinking;

  #[Validate([
    'name'         => 'required|string|max:255',
    'dob'          => ['regex:/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/'],
    'taxvat'       => ['regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/'],
    'email'        => 'nullable|email',
    'phone'        => 'nullable|regex:/^\(?\d{2}\)?\s?\d{4,5}-\d{4}$/',
    'zipcode'      => ['required_if:dontKnowZipcode,false', 'regex:/^\d{5}-\d{3}$/'],
    'street'       => 'required|string|max:150',
    'number'       => ['integer'],
    'neighborhood' => 'required|string|max:100',
    'city'         => 'required|string|max:100',
    'state'        => 'required|string|max:2',
    'driving'      => 'nullable|string|max:100',
    'active'       => 'integer',
  ], message: [
    '*.numeric'     => 'O campo deve conter apenas números.',
    '*.required'    => 'Campo obrigatório.',
    '*.max'         => 'Tamanho máximo do campo excedido.',
    'dob.regex'     => 'Data inválida.',
    'taxvat.regex'  => 'CPF inválido.',
    '*.email'       => 'E-mail inválido.',
    'phone.regex'   => 'Número de celular inválido.',
    'zipcode.regex' => 'CEP inválido.',
  ])]
  public bool $dontKnowZipcode = false;
  public $id = null;
  public $repositoryVoluntary = null;
  public $repositoryContact = null;
  public $repositoryAddress = null;
  public string $name = '';
  public string $dob = '';
  public int $active = 1;
  public string $taxvat = '';
  public string $email = '';
  public string $phone = '';
  public string $zipcode = '';
  public string $street = '';
  public int $number = 0;
  public string $complement = '';
  public string $neighborhood = '';
  public string $city = '';
  public string $state = '';
  public string $driving = '';

  public function mount($voluntaryId): void
  {
    $this->id = $voluntaryId;
    $this->loadVoluntaryData();
  }

  public function loadVoluntaryData(): void
  {
    $this->repositoryVoluntary = VoluntaryRepository::find($this->id);
    $this->repositoryContact = $this->repositoryVoluntary?->contact_id !== null
      ? ContactRepository::find((int) $this->repositoryVoluntary->contact_id)
      : null;
    $this->repositoryAddress = $this->repositoryVoluntary?->address_id !== null
      ? AddressRepository::find((int) $this->repositoryVoluntary->address_id)
      : null;

    $this->fillFormFields();
  }

  public function fillFormFields(): void
  {
    $this->name         = (string) ($this->repositoryVoluntary?->name ?? '');
    $this->dob          = (string) ($this->repositoryVoluntary?->dob ?? '');
    $this->active       = (int) ($this->repositoryVoluntary?->active ?? Status::ATIVO->value);
    $this->taxvat       = (string) ($this->repositoryVoluntary?->taxvat ?? '');
    $this->email        = (string) ($this->repositoryVoluntary?->email ?? '');
    $this->phone        = (string) ($this->repositoryContact?->phone_number_whatsapp ?? '');
    $this->zipcode      = (string) ($this->repositoryAddress?->zipcode ?? '');
    $this->street       = (string) ($this->repositoryAddress?->address ?? '');
    $this->number       = (int) ($this->repositoryAddress?->number ?? 0);
    $this->complement   = (string) ($this->repositoryAddress?->complement ?? '');
    $this->neighborhood = (string) ($this->repositoryAddress?->neighborhood ?? '');
    $this->city         = (string) ($this->repositoryAddress?->city ?? '');
    $this->state        = (string) ($this->repositoryAddress?->state ?? '');
    $this->driving      = (string) ($this->repositoryVoluntary?->driving ?? '');

    $this->dontKnowZipcode    = empty($this->zipcode);
    $this->selectedAssistedIds = AssistedRepository::findIdsByVoluntaryId((int) $this->id);
  }

  public function render()
  {
    return view('livewire.voluntary.update-voluntary', array_merge(
      [
        'statuses' => Status::cases(),
        'drivings' => Driving::cases(),
        'states'   => BrazilStates::cases(),
      ],
      $this->getAssistedViewData()
    ));
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

  public function submitFormUser(): void
  {
    $this->validate();

    try {
      $upsertData = VoluntaryUpsertData::fromUpdateFields([
        'name' => $this->name,
        'email' => $this->email,
        'taxvat' => $this->taxvat,
        'dob' => $this->dob,
        'driving' => $this->driving,
        'active' => $this->active,
        'phone' => $this->phone,
        'zipcode' => $this->zipcode,
        'street' => $this->street,
        'number' => $this->number,
        'complement' => $this->complement,
        'neighborhood' => $this->neighborhood,
        'city' => $this->city,
        'state' => $this->state,
      ], $this->selectedAssistedIds);

      app(VoluntaryService::class)->updateWithRelations(
        (int) $this->id,
        $upsertData->voluntaryData(),
        $upsertData->contactData(),
        $upsertData->addressData(),
        $upsertData->assistedIds()
      );

      $this->dispatch(
        'alert',
        type: 'success',
        title: 'Voluntário atualizado com sucesso.',
        position: 'center',
        timer: 1500
      );
    } catch (Exception $e) {
      Log::error($e);
      $this->dispatch(
        'alert',
        type: 'error',
        title: 'Ocorreu um erro ao processar o cadastro. Por favor, tente novamente.',
        position: 'center',
        timer: 1500
      );
    }
  }

}
