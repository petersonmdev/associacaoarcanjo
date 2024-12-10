<?php

namespace App\Livewire\Assisted\CreateMultiStep;

use App\Enums\Relationships;
use App\Enums\Gender;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StepFour extends Component
{
  public bool $no_dependents = false;
  public array $data = [
    'dependents' => [
      [
        'dependent_name' => '',
        'dependent_dob' => '',
        'dependent_parentage' => '',
        'dependent_sex' => '',
        'dependent_occupation' => '',
        'dependent_pne' => false
      ]
    ]
  ];

  #[Validate([
    'data.dependents.*.dependent_name' => 'required_if:no_dependents,false|string|max:100',
    'data.dependents.*.dependent_dob' => ['required_if:no_dependents,false', 'regex:/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/'],
    'data.dependents.*.dependent_parentage' => 'required_if:no_dependents,false|string|max:100',
    'data.dependents.*.dependent_occupation' => 'string|max:100',
    'data.dependents.*.dependent_sex' => 'required_if:no_dependents,false|string|max:100',
  ], message: [
    'data.dependents.*.dependent_name.required_if' => 'Campo obrigatório.',
    'data.dependents.*.dependent_name.max' => 'Tamanho máximo do campo excedido.',
    'data.dependents.*.dependent_dob.required_if' => 'Campo obrigatório.',
    'data.dependents.*.dependent_dob.regex' => 'Data inválida.',
    'data.dependents.*.dependent_sex.required_if' => 'Campo obrigatório.',
    'data.dependents.*.dependent_sex.max' => 'Tamanho máximo do campo excedido.',
    'data.dependents.*.dependent_parentage.required_if' => 'Campo obrigatório.',
    'data.dependents.*.dependent_parentage.max' => 'Tamanho máximo do campo excedido.',
    'data.dependents.*.dependent_occupation.max' => 'Tamanho máximo do campo excedido.',
  ])]

  public function validateStep()
  {
    $this->validate();
    $this->dispatch('stepValidated', ['data' => $this->data]);
  }

  public function render()
  {
    return view('livewire.assisted.create-multi-step.step-four', [
      'relationships' => Relationships::cases(),
      'gender' => Gender::cases()
    ]);
  }

  public function noDependents()
  {
    if (array_values($this->data['dependents'])){
      foreach ($this->data['dependents'] as $index => $dependent) {
        unset($this->data['dependents'][$index]);
      }
      $this->data['dependents'] = array_values($this->data['dependents']);
    } else {
      $this->addDependent();
    }
  }

  public function addDependent()
  {
    $this->data['dependents'][] = [
      'dependent_name' => '',
      'dependent_dob' => '',
      'dependent_parentage' => '',
      'dependent_sex' => '',
      'dependent_occupation' => '',
      'dependent_pne' => false
    ];
  }

  public function removeDependent($index)
  {
    unset($this->data['dependents'][$index]);
    $this->data['dependents'] = array_values($this->data['dependents']);
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
