<?php

namespace App\Livewire\Assisted\CreateMultiStep;

use App\Repositories\VoluntaryRepository;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StepSeven extends Component
{
  public array $data = [
    'voluntary_id' => null
  ];
  public string $searchVoluntary = '';
  public bool $showSuggestions = false;

  #[Validate([
    'data.voluntary_id' => 'nullable|integer|exists:voluntaries,id',
  ], message: [
    'data.*.integer' => 'O campo deve conter apenas números.',
    'data.voluntary_id.exists' => 'Voluntário inválido.',
  ])]

  public function mount($data)
  {
    $this->data = $data;

    if (!empty($this->data['voluntary_id'])) {
      $selectedVoluntary = VoluntaryRepository::find((int) $this->data['voluntary_id']);
      $this->searchVoluntary = (string) ($selectedVoluntary->name ?? '');
      $this->showSuggestions = false;
    }
  }

  public function updatedSearchVoluntary(string $value): void
  {
    if (trim($value) === '') {
      $this->data['voluntary_id'] = null;
      $this->showSuggestions = false;
    } else {
      $this->showSuggestions = true;
    }
  }

  public function selectVoluntary(int $voluntaryId): void
  {
    $selectedVoluntary = VoluntaryRepository::find($voluntaryId);

    $this->data['voluntary_id'] = $voluntaryId;
    $this->searchVoluntary = (string) ($selectedVoluntary->name ?? '');
    $this->showSuggestions = false;
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
    $term = trim($this->searchVoluntary);

    $queryVoluntary = ($term === '')
      ? collect()
      : VoluntaryRepository::findByVoluntaryNameComplete($term)
          ->limit(8)
          ->get();

    return view('livewire.assisted.create-multi-step.step-seven',[
      'voluntaries' => $queryVoluntary
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
