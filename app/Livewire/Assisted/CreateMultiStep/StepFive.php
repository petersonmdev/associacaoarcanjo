<?php

namespace App\Livewire\Assisted\CreateMultiStep;

use Livewire\Attributes\Validate;
use Livewire\Component;

class StepFive extends Component
{
  public array $data = [
    'no_incomes' => false,
    'incomes' => [
      [
        'name' => '',
        'value' => ''
      ]
    ]
  ];

  #[Validate([
    'data.incomes.*.name' => 'required_if:data.no_incomes,false|string|max:100',
    'data.incomes.*.value' => 'required_if:data.no_incomes,false|numeric|min:1',
  ], message: [
    'data.incomes.*.name.required_if' => 'Campo obrigatório.',
    'data.incomes.*.name.max' => 'Tamanho máximo do campo excedido.',
    'data.incomes.*.value.required_if' => 'Campo obrigatório.',
    'data.incomes.*.value.min' => 'O valor deve ser maior que R$1.',
  ])]

  public function validateStep()
  {
    $this->validate();
    $this->dispatch('stepValidated', ['data' => $this->data]);
  }

  public function back()
  {
    $this->dispatch('goToPreviousStep');
  }

  public function render()
  {
    return view('livewire.assisted.create-multi-step.step-five');
  }

  public function noIncomes()
  {
    if ($this->data['no_incomes']) {
      $this->data['incomes'] = [];
    } else {
      if (!isset($this->data['incomes'])) {
        $this->data['incomes'] = [];
      }
    }
  }

  public function addIncome()
  {
    $this->data['incomes'][] = [
      'name' => '',
      'value' => ''
    ];
    $this->data['no_incomes'] = false;
  }

  public function removeIncome($index)
  {
    unset($this->data['incomes'][$index]);
    $this->data['incomes'] = array_values($this->data['incomes']);
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
