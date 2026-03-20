<?php

namespace App\Livewire\Assisted\CreateMultiStep;

use Livewire\Attributes\Validate;
use Livewire\Component;

class StepSix extends Component
{
  public array $data = [
    'life_history' => '',
    'health_history' => '',
    'continuous_medication' => '',
  ];

  #[Validate([
    'data.life_history' => 'required|string|max:1000',
    'data.health_history' => 'required|string|max:1000',
    'data.continuous_medication' => 'required|string|max:1000',
  ], message: [
    'data.life_history.required' => 'A história de vida é obrigatória.',
    'data.life_history.max' => 'A história de vida não pode exceder 1000 caracteres.',
    'data.health_history.required' => 'O histórico de saúde é obrigatório.',
    'data.health_history.max' => 'O histórico de saúde não pode exceder 1000 caracteres.',
    'data.continuous_medication.required' => 'Os medicamentos de uso contínuo são obrigatórios.',
    'data.continuous_medication.max' => 'Os medicamentos de uso contínuo não podem exceder 1000 caracteres.',
    'data.*.required' => 'Campo obrigatório.',
    'data.*.max' => 'Tamanho máximo do campo excedido.',
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
    return view('livewire.assisted.create-multi-step.step-six');
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
