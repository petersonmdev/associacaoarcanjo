<?php

namespace App\Livewire\Assisted;

use Livewire\Component;

class ShowAssisted extends Component
{
  public $assisted;
  public $addresses;
  public $contacts;
  public $dependents;
  public $incomes;
  public $voluntary;
  public function mount($assisted, $addresses, $contacts, $dependents, $incomes, $voluntary)
  {
    $this->assisted = $assisted;
    $this->addresses = $addresses;
    $this->contacts = $contacts;
    $this->dependents = $dependents;
    $this->incomes = $incomes;
    $this->voluntary = $voluntary;
  }
  public function render()
  {
    return view('livewire.assisted.show-assisted', [
      'assisted' => $this->assisted,
      'addresses' => $this->addresses,
      'contacts' => $this->contacts,
      'dependents' => $this->dependents,
      'incomes' => $this->incomes,
      'voluntary' => $this->voluntary
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
