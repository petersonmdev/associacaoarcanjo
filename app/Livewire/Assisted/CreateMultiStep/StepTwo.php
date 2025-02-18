<?php

namespace App\Livewire\Assisted\CreateMultiStep;

use Livewire\Attributes\Validate;
use Livewire\Component;

class StepTwo extends Component
{

  public array $data = [
    'phone_number_whatsapp' => '',
    'phone_number1' => '',
    'phone_number2' => '',
  ];

  public function mount($data)
  {
    $this->data = $data;
  }

  #[Validate([
    'data.phone_number_whatsapp' => 'required|regex:/^\(?\d{2}\)?\s?\d{4,5}-\d{4}$/',
    'data.phone_number_1' => 'regex:/^\(?\d{2}\)?\s?\d{4,5}-\d{4}$/',
    'data.phone_number_2' => 'regex:/^\(?\d{2}\)?\s?\d{4,5}-\d{4}$/',
  ], message: [
    'data.*.required' => 'Campo obrigatório.',
    'data.phone_number_whatsapp.regex' => 'Número de celular inválido.',
    'data.phone_number_1.regex' => 'Número de celular inválido.',
    'data.phone_number_2.regex' => 'Número de celular inválido.',
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
      return view('livewire.assisted.create-multi-step.step-two');
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
