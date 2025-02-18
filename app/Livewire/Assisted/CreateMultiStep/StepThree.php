<?php

namespace App\Livewire\Assisted\CreateMultiStep;

use App\Enums\BrazilStates;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StepThree extends Component
{
  public array $data = [
    'zipcode' => '',
    'address' => '',
    'number' => '',
    'complement' => '',
    'neighborhood' => '',
    'city' => '',
    'state' => '',
  ];

  #[Validate([
    'data.zipcode' => ['required', 'regex:/^\d{5}-\d{3}$/'],
    'data.address' => 'required|string|max:150',
    'data.number' => 'required|numeric',
    'data.neighborhood' => 'required|string|max:100',
    'data.city' => 'required|string|max:100',
    'data.state' => 'required|string|max:2',
  ], message: [
    'data.*.required' => 'Campo obrigatório.',
    'data.*.numeric' => 'O campo deve conter apenas números.',
    'data.*.max' => 'Tamanho máximo do campo excedido.',
    'data.zipcode.regex' => 'CEP inválido.',
  ])]

  public function mount($data)
  {
    $this->data = $data;
  }

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
    return view('livewire.assisted.create-multi-step.step-three', [
      'states' => BrazilStates::cases(),
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
