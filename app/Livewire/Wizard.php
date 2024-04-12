<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Exception;
use App\Repositories\AssistedRepository;
use App\Repositories\ContactRepository;
use App\Repositories\AddressRepository;
use App\Repositories\DependentRepository;
use App\Repositories\IncomeRepository;

class Wizard extends Component
{
  public $currentStep = 1;
  public $successMessage = '';
  public bool $jobless = false;
  public bool $no_dependents = false;
  public bool $no_incomes = false;
  public
    $name,
    $dob,
    $active = 1,
    $taxvat,
    $civil_status,
    $education_level,
    $profession,
    $email,
    $phone_number_whatsapp,
    $phone_number1,
    $phone_number2,
    $zipcode,
    $address,
    $number,
    $complement,
    $neighborhood,
    $city,
    $state,
    $dependents = [
      [
        'dependent_name' => '',
        'dependent_dob' => '',
        'dependent_parentage' => '',
        'dependent_sex' => '',
        'dependent_ocupation' => '',
        'dependent_pne' => false
      ]
    ],
    $incomes = [
      [
        'name' => '',
        'value' => ''
      ]
    ],
    $life_history,
    $health_history,
    $continuous_medication,
    $voluntary_id;

  public function render()
  {
    return view('livewire.wizard');
  }

  public function noDependents()
  {
    if (array_values($this->dependents)){
      foreach ($this->dependents as $index => $dependent) {
        unset($this->dependents[$index]);
      }
      $this->dependents = array_values($this->dependents);
    } else {
      $this->addDependent();
    }
  }

  public function addDependent()
  {
    if (!is_array($this->dependents)) {
      $this->dependents = [];
    }

    $this->dependents[] = [
      'dependent_name' => '',
      'dependent_dob' => '',
      'dependent_parentage' => '',
      'dependent_sex' => '',
      'dependent_ocupation' => '',
      'dependent_pne' => false
    ];
  }

  public function removeDependent($index)
  {
    unset($this->dependents[$index]);
    $this->dependents = array_values($this->dependents);
  }

  public function noIncomes()
  {
    if (array_values($this->incomes)){
      foreach ($this->incomes as $index => $income) {
        unset($this->incomes[$index]);
      }
      $this->incomes = array_values($this->incomes);
    } else {
      $this->addIncome();
    }
  }

  public function addIncome()
  {
    if (!is_array($this->incomes)) {
      $this->incomes = [];
    }

    $this->incomes[] = [
      'name' => '',
      'value' => ''
    ];
  }

  public function removeIncome($index)
  {
    unset($this->incomes[$index]);
    $this->incomes = array_values($this->incomes);
  }

  protected $messages = [
    'name.required' => 'O campo nome é obrigatório.',
    'dob.required' => 'O campo data de nascimento é obrigatório.',
    'active.required' => 'O campo ativo é obrigatório.',
    'taxvat.required' => 'O campo CPF é obrigatório.',
    'email.required' => 'O campo email é obrigatório.',
    'email.email' => 'O campo de e-mail deve ser um endereço de e-mail válido.',
    'phone_number_whatsapp.required' => 'O campo celular é obrigatório.',
    'zipcode.required' => 'O campo CEP é obrigatório.',
    'address.required' => 'O campo endereço é obrigatório.',
    'number.required' => 'O campo número é obrigatório.',
    'number.numeric' => 'O campo número deve conter valores númericos.',
    'neighborhood.required' => 'O campo bairro é obrigatório.',
    'city.required' => 'O campo cidade é obrigatório.',
    'state.required' => 'O campo estado é obrigatório.',
    'dependents.*.dependent_name.required' => 'O campo nome do dependente é obrigatório.',
    'dependents.*.dependent_dob.required' => 'O campo data de nascimento do dependente é obrigatório.',
    'dependents.*.dependent_parentage.required' => 'O campo parentesco do dependente é obrigatório.',
    'dependents.*.dependent_sex.required' => 'O campo sexo do dependente é obrigatório.',
    'incomes.*.value.required' => 'O campo valor da renda dependente é obrigatório.',
    'income.*.value.numeric' => 'O campo valor da renda deve conter valores númericos.',
    'life_history.required' => 'O campo SUA BREVE HISTÓRIA DE VIDA é obrigatório.',
    'health_history.required' => 'O campo HISTÓRICO DE SAÚDE é obrigatório.',
    'continuous_medication.required' => 'O campo MEDICAMENTOS DE USO CONTÍNUO é obrigatório.'
  ];

  public function firstStepSubmit()
  {
    notify()->success('Welcome to Laravel Notify ⚡️') or notify()->success('Welcome to Laravel Notify ⚡️', 'My custom title');
    $validatedData = $this->validate([
      'name' => 'required',
      'dob' => 'required',
      'active' => 'required',
      'taxvat' => 'required',
      'email' => 'required|email',
    ]);

    $this->currentStep = 2;
  }

  public function secondStepSubmit()
  {
    $validatedData = $this->validate([
      'phone_number_whatsapp' => 'required',
    ]);

    $this->currentStep = 3;
  }

  public function thirdStepSubmit()
  {
    $validatedData = $this->validate([
      'zipcode' => 'required',
      'address' => 'required',
      'number' => 'required|numeric',
      'neighborhood' => 'required',
      'city' => 'required',
      'state' => 'required'
    ]);

    $this->currentStep = 4;
  }

  public function fourthStepSubmit()
  {
    if (!$this->no_dependents) {
      $validatedData = $this->validate([
        'dependents.*.dependent_name' => 'required',
        'dependents.*.dependent_dob' => 'required',
        'dependents.*.dependent_parentage' => 'required',
      'dependents.*.dependent_sex' => 'required'
      ]);
    }
    $this->currentStep = 5;
  }

  public function fifthStepSubmit()
  {
    if (!$this->no_incomes) {
      $validatedData = $this->validate([
        'incomes.*.value' => 'required|numeric'
      ]);
    }

    $this->currentStep = 6;
  }

  public function sixthStepSubmit()
  {
    $validatedData = $this->validate([
      'life_history' => 'required',
      'health_history' => 'required',
      'continuous_medication' => 'required'
    ]);

    $this->currentStep = 7;
  }

  public function submitForm()
  {
    /*$validatedData = $this->validate([
      'voluntary_id' => 'require'
    ]);*/
    $assistedId = $this->saveAssisted();
    $this->saveContact($assistedId);
    $this->saveAddress($assistedId);
    $this->saveDependent($assistedId);
    $this->saveIncome($assistedId);

    $this->successMessage = 'Cadastro realizado com sucesso.';

    $this->clearForm();

    $this->currentStep = 1;
  }

  private function saveAssisted():int
  {
    try {
      $assisted = AssistedRepository::create([
        'name' => $this->name,
        'dob' => $this->dob,
        'active' => $this->active,
        'taxvat' => $this->taxvat,
        'civil_status' => $this->civil_status,
        'education_level' => $this->education_level,
        'profession' => $this->profession,
        'jobless' => $this->jobless,
        'email' => $this->email,
        'life_history' => $this->life_history,
        'health_history' => $this->health_history,
        'continuous_medication' => $this->continuous_medication,
        'voluntary_id' => 1
      ]);
      return $assisted->id;
    } catch (Exception $e) {
      Log::error($e);
      return 0;
    }
  }

  private function saveContact(int $assistedId):void
  {
    try {
      ContactRepository::create([
        'phone_number_whatsapp' => $this->phone_number_whatsapp,
        'phone_number1' => $this->phone_number1,
        'phone_number2' => $this->phone_number2,
        'assisted_id' => $assistedId
      ]);
    } catch (Exception $e) {
      Log::error($e);
    }
  }

  private function saveAddress(int $assistedId):void
  {
    try {
      AddressRepository::create([
        'zipcode' => $this->zipcode,
        'address' => $this->address,
        'number' => $this->number,
        'complement' => $this->complement,
        'neighborhood' => $this->neighborhood,
        'city' => $this->city,
        'state' => $this->state,
        'assisted_id' => $assistedId
      ]);
    } catch (Exception $e) {
      Log::error($e);
    }
  }

  private function saveDependent(int $assistedId):void
  {
    try {
      if (!$this->no_dependents) {
        foreach ($this->dependents as $dependent) {
          DependentRepository::create([
            'name' => $dependent['dependent_name'],
            'dob' => $dependent['dependent_dob'],
            'parentage' => $dependent['dependent_parentage'],
            'profession' => $dependent['dependent_ocupation'],
            'pne' => $dependent['dependent_pne'],
            'assisted_id' => $assistedId
          ]);
        }
      }
    } catch (Exception $e) {
      Log::error($e);
    }
  }

  private function saveIncome(int $assistedId):void
  {
    try {
      if (!$this->no_incomes) {
        foreach ($this->incomes as $income) {
          IncomeRepository::create([
            'name' => $income['name'],
            'incomes' => $income['value'],
            'assisted_id' => $assistedId
          ]);
        }
      }
    } catch (Exception $e) {
      Log::error($e);
    }
  }

  /**
   * Write code on Method
   *
   * @return response()
   */
  public function back($step)
  {
    $this->currentStep = $step;
  }

  /**
   * Write code on Method
   *
   * @return response()
   */
  public function clearForm()
  {
    //oneStep
    $this->name = '';
    $this->dob = '';
    $this->active = 1;
    $this->taxvat = '';
    $this->civil_status = '';
    $this->education_level = '';
    $this->profession = '';
    $this->jobless = 0;
    $this->email = '';

    //twoStep
    $this->phone_number_whatsapp = '';
    $this->phone_number1 = '';
    $this->phone_number2 = '';

    //threeStep
    $this->zipcode = '';
    $this->address = '';
    $this->number = '';
    $this->complement = '';
    $this->neighborhood = '';
    $this->city = '';
    $this->state = '';

    //fourStep
    if (array_values($this->dependents)){
      foreach ($this->dependents as $index => $dependent) {
        unset($this->dependents[$index]);
      }
      $this->dependents = array_values($this->dependents);
    }
    $this->addDependent();

    //fiveStep
    if (array_values($this->incomes)){
      foreach ($this->incomes as $index => $income) {
        unset($this->incomes[$index]);
      }
      $this->incomes = array_values($this->incomes);
    }
    $this->addIncome();

    //sixStep
    $this->life_history = '';
    $this->health_history = '';
    $this->continuous_medication = '';

    //sevenStep
    $this->voluntary_id = '';
  }
}
