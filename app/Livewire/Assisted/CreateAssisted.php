<?php

namespace App\Livewire\Assisted;

use App\Repositories\AddressRepository;
use App\Repositories\AssistedRepository;
use App\Repositories\ContactRepository;
use App\Repositories\DependentRepository;
use App\Repositories\IncomeRepository;
use App\Repositories\VoluntaryRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateAssisted extends Component
{

  public array $formData = [];

  public $current = 'assisted.create-multi-step.step-one';

  protected $steps = [
    'assisted.create-multi-step.step-one',
    'assisted.create-multi-step.step-two',
    'assisted.create-multi-step.step-three',
    'assisted.create-multi-step.step-four',
    'assisted.create-multi-step.step-five',
    'assisted.create-multi-step.step-six',
    'assisted.create-multi-step.step-seven',
  ];

  protected $listeners = [
    'stepValidated'=> 'handleStepValidated',
    'goToPreviousStep'=> 'handleGoToPreviousStep'
  ];
  public function lastStep() {
    $index = array_key_last($this->steps);
    return $this->steps[$index];
  }

  public function handleStepValidated($payload)
  {
    $this->formData = array_merge($this->formData, $payload['data']);
    $this->save();
  }

  public function handleGoToPreviousStep()
  {
    $currentIndex = array_search($this->current, $this->steps);
    if (isset($this->steps[$currentIndex - 1])) {
      $this->current = $this->steps[$currentIndex - 1];
    }
  }

  public function save(): void
  {
    if ($this->current === $this->lastStep()) {
      try {
        $contactId = $this->saveContact();
        $addressId = $this->saveAddress();
        $assistedId = $this->saveAssisted($contactId, $addressId);
        $this->saveDependent($assistedId);
        $this->saveIncome($assistedId);

        $this->dispatch(
          'alert',
          type: 'success',
          title: 'Cadastro realizado com sucesso!',
          position: 'center',
          timer: 1500
        );
        $this->reset("formData");
        $this->current = 'assisted.create-multi-step.step-one';
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
    } else {
      $currentIndex = array_search($this->current, $this->steps);
      $this->current = $this->steps[(int)$currentIndex + 1];
    }
  }

  private function saveAssisted(int $contact_id, int $address_id): int
  {
    try {
      $assisted = AssistedRepository::create(array_merge($this->formData, [
        'contact_id' => $contact_id,
        'address_id' => $address_id,
      ]));
      return $assisted->id;
    } catch (Exception $e) {
      Log::error($e);
      $this->dispatch(
        'alert',
        type: 'error',
        title: 'Ocorreu um erro ao cadastrar o assistido.',
        position: 'center',
        timer: 1500
      );
    }
  }

  private function saveContact(): int
  {
    try {
      $contact = ContactRepository::create($this->formData);
      return $contact->id;
    } catch (Exception $e) {
      Log::error($e);
      $this->dispatch(
        'alert',
        type: 'error',
        title: 'Ocorreu um erro ao cadastrar o(s) telefone(s).',
        position: 'center',
        timer: 1500
      );
    }
  }

  private function saveAddress(): int
  {
    try {
      $address = AddressRepository::create($this->formData);
      return $address->id;
    } catch (Exception $e) {
      Log::error($e);
      $this->dispatch(
        'alert',
        type: 'error',
        title: 'Ocorreu um erro ao cadastrar o endereço.',
        position: 'center',
        timer: 1500
      );
    }
  }

  private function saveDependent(int $assistedId): void
  {
    try {
      foreach ($this->formData['dependents'] as $dependent) {
        $data = [
          'name' => $dependent['dependent_name'] ?? null,
          'dob' => $dependent['dependent_dob'] ?? null,
          'sex' => $dependent['dependent_sex'] ?? null,
          'parentage' => $dependent['dependent_parentage'] ?? null,
          'profession' => $dependent['dependent_occupation'] ?? null,
          'pne' => $dependent['dependent_pne'] ?? null,
          'assisted_id' => $assistedId
        ];

        DependentRepository::create($data);
      }
    } catch (Exception $e) {
      Log::error($e);
      $this->dispatch(
        'alert',
        type: 'error',
        title: 'Ocorreu um erro ao cadastrar os dependentes.',
        position: 'center',
        timer: 1500
      );
    }
  }

  private function saveIncome(int $assistedId):void
  {
    try {
      foreach ($this->formData['incomes'] as $income) {
        IncomeRepository::create([
          'name' => $income['name'],
          'incomes' => $income['value'],
          'assisted_id' => $assistedId
        ]);
      }
    } catch (Exception $e) {
      Log::error($e);
      $this->dispatch(
        'alert',
        type: 'error',
        title: 'Ocorreu um erro ao cadastrar a(s) renda(s).',
        position: 'center',
        timer: 1500
      );
    }
  }

  public function back()
  {
    $currentIndex = array_search($this->current, $this->steps);
    $this->current = $this->steps[(int)$currentIndex-1];
  }

  /*public function next()
  {
    $this->navigate(1);
  }

  public function back()
  {
    $this->navigate(-1);
  }

  private function navigate($direction)
  {
    $currentIndex = array_search($this->current, $this->steps);

    if ($currentIndex !== false) {
      $newIndex = $currentIndex + $direction;

      if ($newIndex >= 0 && $newIndex < count($this->steps)) {
        $this->current = $this->steps[$newIndex];
      }
    }
  }*/

  public function render()
  {
    $queryVoluntary = VoluntaryRepository::all();
    return view('livewire.assisted.create-assisted', [
      'voluntaries' => $queryVoluntary
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
}
