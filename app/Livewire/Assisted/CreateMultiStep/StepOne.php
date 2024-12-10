<?php

namespace App\Livewire\Assisted\CreateMultiStep;

use App\Enums\CivilStatus;
use App\Enums\EducationLevel;
use App\Enums\Status;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StepOne extends Component
{
  public array $data = [
    'name' => '',
    'dob' => '',
    'active' => 1,
    'taxvat' => '',
    'civil_status' => '',
    'education_level' => '',
    'profession' => '',
    'jobless' => false,
    'email' => '',
  ];

  #[Validate([
    'data.name' => 'required|string|max:255',
    'data.dob' => ['required', 'regex:/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/'],
    'data.taxvat' => ['required', 'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/'],
    'data.email' => 'required|email',
  ], message: [
    'data.*.required' => 'Campo obrigatório.',
    'data.*.max' => 'Tamanho máximo do campo excedido.',
    'data.dob.regex' => 'Data inválida.',
    'data.taxvat.regex' => 'CPF inválido.',
    'data.*.email' => 'E-mail inválido.',
  ])]

  public function validateStep()
  {
    $this->validate();
    $this->dispatch('stepValidated', ['data' => $this->data]);
  }

  public function render()
  {
    return view('livewire.assisted.create-multi-step.step-one',[
      'statuses' => Status::cases(),
      'civilStatus' => CivilStatus::cases(),
      'educationLevels' => EducationLevel::cases()
    ]);
  }

  public function placeholder()
  {
    return <<<'HTML'
      <div class="m-auto text-center">
        <p class="mt-4 mb-2 text-center text-primary">Carregando formulário</p>
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: rgba(105, 108, 255, 1); transform: scaleX(-1);">
          <path d="M12 22c5.421 0 10-4.579 10-10h-2c0 4.337-3.663 8-8 8s-8-3.663-8-8c0-4.336 3.663-8 8-8V2C6.579 2 2 6.58 2 12c0 5.421 4.579 10 10 10z">
            <animateTransform attributeName="transform" type="rotate" dur=".4s" values="0 12 12;360 12 12;" repeatCount="indefinite"></animateTransform>
          </path>
        </svg>
      </div>
      HTML;
  }
}
