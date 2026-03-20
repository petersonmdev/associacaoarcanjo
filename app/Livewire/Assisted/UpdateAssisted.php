<?php

namespace App\Livewire\Assisted;

use App\Enums\BrazilStates;
use App\Enums\CivilStatus;
use App\Enums\EducationLevel;
use App\Enums\Gender;
use App\Enums\Relationships;
use App\Enums\Status;
use App\Repositories\AddressRepository;
use App\Repositories\AssistedRepository;
use App\Repositories\ContactRepository;
use App\Repositories\DependentRepository;
use App\Repositories\IncomeRepository;
use App\Repositories\VoluntaryRepository;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdateAssisted extends Component
{
  #[Validate([
    'name' => 'required|string|max:255',
    'dob' => ['required', 'regex:/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/'],
    'taxvat' => ['required', 'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/'],
    'email' => 'nullable|email',
    'phone_number_whatsapp' => 'required|regex:/^\(?\d{2}\)?\s?\d{4,5}-\d{4}$/',
    'zipcode' => ['required_if:dontKnowZipcode,false', 'regex:/^\d{5}-\d{3}$/'],
    'address' => 'required|string|max:150',
    'number' => ['required','numeric'],
    'neighborhood' => 'required|string|max:100',
    'city' => 'required|string|max:100',
    'state' => 'required|string|max:2',
    'dependents.*.name' => 'required|string|max:100',
    'dependents.*.dob' => ['required', 'regex:/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/'],
    'dependents.*.parentage' => 'required|string|max:100',
    'dependents.*.occupation' => 'string|max:100',
    'dependents.*.sex' => 'required|string|max:100',
    'incomes.*.name' => 'required|string|max:100',
    'incomes.*.incomes' => 'required|numeric|min:1',
    'life_history' => 'required|string|max:1000',
    'health_history' => 'required|string|max:1000',
    'continuous_medication' => 'required|string|max:1000',
    'voluntary_id' => 'nullable|integer|exists:voluntaries,id',
  ], message: [
    '*.numeric' => 'O campo deve conter apenas números.',
    '*.required' => 'Campo obrigatório.',
    '*.max' => 'Tamanho máximo do campo excedido.',
    'address.required' => 'O endereço é obrigatório.',
    'neighborhood.required' => 'O bairro é obrigatório.',
    'city.required' => 'A cidade é obrigatória.',
    'state.required' => 'O estado é obrigatório.',
    'number.required' => 'O número é obrigatório.',
    'dob.regex' => 'Data inválida.',
    'taxvat.regex' => 'CPF inválido.',
    '*.email' => 'E-mail inválido.',
    'phone_number_whatsapp.regex' => 'Número de celular inválido.',
    'zipcode.regex' => 'CEP inválido.',
    'dependents.*.name.required' => 'Campo obrigatório.',
    'dependents.*.name.max' => 'Tamanho máximo do campo excedido.',
    'dependents.*.dob.required' => 'Campo obrigatório.',
    'dependents.*.dob.regex' => 'Data inválida.',
    'dependents.*.sex.required' => 'Campo obrigatório.',
    'dependents.*.sex.max' => 'Tamanho máximo do campo excedido.',
    'dependents.*.parentage.required' => 'Campo obrigatório.',
    'dependents.*.parentage.max' => 'Tamanho máximo do campo excedido.',
    'dependents.*.occupation.max' => 'Tamanho máximo do campo excedido.',
    'incomes.*.name.required' => 'Campo obrigatório.',
    'incomes.*.name.max' => 'Tamanho máximo do campo excedido.',
    'incomes.*.incomes.required' => 'Campo obrigatório.',
    'incomes.*.incomes.min' => 'O valor deve ser maior que R$1.',
    'voluntary_id.exists' => 'Voluntário inválido.',
  ])]
  public bool $jobless = false;
  public bool $dontKnowZipcode = false;
  public $assisted = null;
  public $id = null;
  public $repositoryAssisted = null;
  public $repositoryContact = null;
  public $repositoryAddress = null;
  public $repositoryDependents = null;
  public $repositoryIncomes = null;
  public $repositoryVoluntary = null;
  public string $name = '';
  public string $dob = '';
  public int $active = 1;
  public string $taxvat = '';
  public string $civil_status = '';
  public string $education_level = '';
  public string $profession = '';
  public string $email = '';
  public string $phone_number_whatsapp = '';
  public string $phone_number1 = '';
  public string $phone_number2 = '';
  public string $zipcode = '';
  public string $address = '';
  public int $number = 0;
  public string $complement = '';
  public string $neighborhood = '';
  public string $city = '';
  public string $state = '';
  public array $initialDependents = [];
  public array $dependents = [];
  public array $initialIncomes = [];
  public array $incomes = [];
  public string $life_history = '';
  public string $health_history = '';
  public string $continuous_medication = '';
  public $voluntary_id = null;

  public function mount($assistedId)
  {
    $this->id = $assistedId;
    $this->loadAssistedData();
  }

  public function loadAssistedData()
  {
    $this->repositoryAssisted = AssistedRepository::find($this->id);
    $this->repositoryContact = $this->repositoryAssisted?->contact_id !== null
      ? ContactRepository::find((int) $this->repositoryAssisted->contact_id)
      : null;
    $this->repositoryAddress = $this->repositoryAssisted?->address_id !== null
      ? AddressRepository::find((int) $this->repositoryAssisted->address_id)
      : null;
    $this->repositoryDependents = DependentRepository::findByAssistedId($this->id);
    $this->repositoryIncomes = IncomeRepository::findByAssistedId($this->id);
    $this->repositoryVoluntary = $this->repositoryAssisted?->voluntary_id !== null
      ? VoluntaryRepository::find((int) $this->repositoryAssisted->voluntary_id)
      : null;

    $this->fillFormFields();
  }

  public function fillFormFields()
  {
    $this->name = (string) ($this->repositoryAssisted?->name ?? '');
    $this->dob = (string) ($this->repositoryAssisted?->dob ?? '');
    $this->active = (int) ($this->repositoryAssisted?->active ?? Status::ATIVO->value);
    $this->taxvat = (string) ($this->repositoryAssisted?->taxvat ?? '');
    $this->civil_status = (string) ($this->repositoryAssisted?->civil_status ?? '');
    $this->education_level = (string) ($this->repositoryAssisted?->education_level ?? '');
    $this->profession = (string) ($this->repositoryAssisted?->profession ?? '');
    $this->jobless = (bool) ($this->repositoryAssisted?->jobless ?? false);
    $this->email = (string) ($this->repositoryAssisted?->email ?? '');
    $this->phone_number_whatsapp = (string) ($this->repositoryContact?->phone_number_whatsapp ?? '');
    $this->phone_number1 = (string) ($this->repositoryContact?->phone_number1 ?? '');
    $this->phone_number2 = (string) ($this->repositoryContact?->phone_number2 ?? '');
    $this->zipcode = (string) ($this->repositoryAddress?->zipcode ?? '');
    $this->address = (string) ($this->repositoryAddress?->address ?? '');
    $this->number = (int) ($this->repositoryAddress?->number ?? 0);
    $this->complement = (string) ($this->repositoryAddress?->complement ?? '');
    $this->neighborhood = (string) ($this->repositoryAddress?->neighborhood ?? '');
    $this->city = (string) ($this->repositoryAddress?->city ?? '');
    $this->state = (string) ($this->repositoryAddress?->state ?? '');
    $this->dontKnowZipcode = empty($this->zipcode);
    $this->dependents = $this->repositoryDependents->map(function ($dependent) {
      $this->initialDependents[] = $dependent->id;
      return [
        'hash' => uniqid(),
        'id' => $dependent->id,
        'name' => $dependent->name,
        'dob' => $dependent->dob,
        'sex' => $dependent->sex,
        'parentage' => $dependent->parentage,
        'profession' => $dependent->profession,
        'pne' => (bool)$dependent->pne,
        'assisted_id' => (int)$this->id
      ];
    })->toArray();
    $this->incomes = $this->repositoryIncomes->map(function ($income) {
      $this->initialIncomes[] = $income->id;
      return [
        'hash' => uniqid(),
        'id' => $income->id,
        'name' => $income->name,
        'incomes' => $income->incomes,
        'assisted_id' => (int)$this->id
      ];
    })->toArray();
    $this->life_history = (string) ($this->repositoryAssisted?->life_history ?? '');
    $this->health_history = (string) ($this->repositoryAssisted?->health_history ?? '');
    $this->continuous_medication = (string) ($this->repositoryAssisted?->continuous_medication ?? '');
    $this->voluntary_id = $this->repositoryVoluntary?->id;
  }

  public function updatedVoluntaryId($value): void
  {
    $this->voluntary_id = ($value === '' || $value === null) ? null : (int) $value;
  }

  public function updatedDontKnowZipcode($value)
  {
    if ($value) {
      $this->zipcode = '';
      $this->resetErrorBag('zipcode');
    }
  }

  public function render()
  {
    $voluntary = $this->voluntary_id > 0
      ? VoluntaryRepository::find((int) $this->voluntary_id)
      : null;
    $allVoluntaries = VoluntaryRepository::all();
    return view('livewire.assisted.update-assisted', [
      'voluntary'=> $voluntary,
      'voluntaries' => $allVoluntaries,
      'statuses' => Status::cases(),
      'civilStatus' => CivilStatus::cases(),
      'educationLevels' => EducationLevel::cases(),
      'states' => BrazilStates::cases(),
      'relationships' => Relationships::cases(),
      'gender' => Gender::cases()
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

  public function addDependents($hash)
  {
    $this->dependents = array_filter($this->dependents, function($dependent) use ($hash) {
      return $dependent['hash'] !== $hash;
    });

    $this->dependents[] = [
      'hash' => $hash,
      'id' => null,
      'name' => '',
      'dob' => '',
      'parentage' => '',
      'sex' => '',
      'profession' => '',
      'pne' => false,
      'assisted_id' => (int)$this->id
    ];
  }

  public function removeDependentUpdate($index, $id = null)
  {
    try {
      if ($id) {
        foreach ($this->dependents as $dependent) {
          if($dependent['id'] === $id) {
            DependentRepository::delete($id);
            unset($this->dependents[$index]);
            $this->dispatch(
              'alert',
              type: 'error',
              title: 'Dependente deletado!',
              position: 'center',
              timer: 1500
            );
          }
        }
      } else {
        unset($this->dependents[$index]);
      }
    } catch (Exception $e) {
      Log::error($e);
      $this->dispatch(
        'alert',
        type: 'error',
        title: 'Ocorreu um erro ao remover dependente. Por favor, tente novamente. ',
        position: 'center',
        timer: 1500
      );
    }
  }

  public function addIncomeUpdate($hash)
  {
    $this->incomes = array_filter($this->incomes, function($income) use ($hash) {
      return $income['hash'] !== $hash;
    });

    $this->incomes[] = [
      'hash' => $hash,
      'id' => null,
      'name' => '',
      'incomes' => '',
      'assisted_id' => (int)$this->id
    ];
  }

  public function removeIncomeUpdate($index, $id = null)
  {
    try {
      if ($id) {
        foreach ($this->incomes as $income) {
          if($income['id'] === $id) {
            IncomeRepository::delete($id);
            unset($this->incomes[$index]);
            $this->dispatch(
              'alert',
              type: 'error',
              title: 'Renda deletada!',
              position: 'center',
              timer: 1500
            );
          }
        }
      } else {
        unset($this->incomes[$index]);
      }
    } catch (Exception $e) {
      Log::error($e);
      $this->dispatch(
        'alert',
        type: 'error',
        title: 'Ocorreu um erro ao remover renda. Por favor, tente novamente. ',
        position: 'center',
        timer: 1500
      );
    }
  }

  public function submitFormUser()
  {
    $this->validate();

    try {
      $this->updateContact();
      $this->updateAddress();
      $this->updateAssisted();
      $this->updateDependent();
      $this->updateIncomes();

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

  public function changeVoluntary()
  {
    try {
      $this->updateVoluntary();

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

  private function updateAssisted()
  {
    $this->updateEntity(AssistedRepository::class, $this->id, [
      'voluntary_id' => $this->voluntary_id ?: null,
      'name' => $this->name,
      'email' => $this->email,
      'taxvat' => $this->taxvat,
      'dob' => $this->dob,
      'civil_status' => $this->civil_status,
      'education_level' => $this->education_level,
      'profession' => $this->profession,
      'jobless' => $this->jobless,
      'active' => $this->active,
      'life_history' => $this->life_history,
      'health_history' => $this->health_history,
      'continuous_medication' => $this->continuous_medication
    ]);
  }

  private function updateContact()
  {
    $this->updateEntity(ContactRepository::class, $this->repositoryContact->id, [
      'phone_number_whatsapp' => $this->phone_number_whatsapp,
      'phone_number1' => $this->phone_number1,
      'phone_number2' => $this->phone_number2
    ]);
  }

  private function updateAddress()
  {
    $this->updateEntity(AddressRepository::class, $this->repositoryAddress->id, [
      'zipcode' => $this->zipcode,
      'address' => $this->address,
      'number' => $this->number,
      'complement' => $this->complement,
      'neighborhood' => $this->neighborhood,
      'city' => $this->city,
      'state' => $this->state
    ]);
  }

  private function updateVoluntary()
  {
    $this->updateEntity(AddressRepository::class, $this->repositoryAddress->id, [
      'zipcode' => $this->zipcode,
      'address' => $this->address,
      'number' => $this->number,
      'complement' => $this->complement,
      'neighborhood' => $this->neighborhood,
      'city' => $this->city,
      'state' => $this->state
    ]);
  }

  private function updateDependent()
  {
    try {
      foreach ($this->dependents as $index => $dependent) {
        $data = [
          'name' => $dependent['name'] ?? null,
          'dob' => $dependent['dob'] ?? null,
          'sex' => $dependent['sex'] ?? null,
          'parentage' => $dependent['parentage'] ?? null,
          'profession' => $dependent['profession'] ?? null,
          'pne' => (int)$dependent['pne'] ?? null,
          'assisted_id' => (int)$dependent['assisted_id'] ?? null
        ];

        if ($dependent['id'] !== null) {
          $data['id'] = $dependent['id'];
          DependentRepository::update((int)$dependent['id'], $data);
        } else {
          $salved = DependentRepository::create($data);
          $this->dependents[$index]['id'] = $salved->id;
        }
      }

    } catch (Exception $e) {
      Log::error($e);
      $this->dispatch(
        'alert',
        type: 'error',
        title: 'Ocorreu um erro ao atualizar os dependentes. ',
        position: 'center',
        timer: 1500
      );
    }
  }

  private function updateIncomes()
  {
    try {
      foreach ($this->incomes as $index => $income) {
        $data = [
          'name' => $income['name'] ?? null,
          'incomes' => (double)$income['incomes'] ?? null,
          'assisted_id' => (int)$income['assisted_id'] ?? null
        ];

        if ($income['id'] !== null) {
          $data['id'] = $income['id'];
          IncomeRepository::update((int)$income['id'], $data);
        } else {
          $salved = IncomeRepository::create($data);
          $this->incomes[$index]['id'] = $salved->id;
        }
      }

    } catch (Exception $e) {
      Log::error($e);
      $this->dispatch(
        'alert',
        type: 'error',
        title: 'Ocorreu um erro ao atualizar a renda familiar. ',
        position: 'center',
        timer: 1500
      );
    }
  }
}
