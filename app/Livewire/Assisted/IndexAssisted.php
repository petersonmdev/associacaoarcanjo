<?php

namespace App\Livewire\Assisted;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Repositories\AssistedRepository;
use Livewire\WithPagination;

class IndexAssisted extends Component
{
  use WithPagination;
  protected $paginationTheme = 'bootstrap';
  public $perpage = 10;
  public $search = '';
  public $status_assisted;
  public $queryAssisted = null;

  public function mount(){
    $this->loadAssisteds();
  }

  #[On('AssistedDeleted')]
  public function showSuccessDelete()
  {
    $this->loadAssisteds();
  }

  public function updatedSearch()
  {
    $this->resetPage();
    $this->loadAssisteds();
  }

  public function updatedStatusAssisted()
  {
    $this->resetPage();
    $this->loadAssisteds();
  }

  private function loadAssisteds()
  {
    $query = AssistedRepository::findByAssistedNameComplete($this->search);

    if (!is_null($this->status_assisted)) {
      $query->where('assisteds.active', '=', $this->status_assisted);
    }
  }

  public function render()
  {
    $query = AssistedRepository::findByAssistedNameComplete($this->search);

    if (!is_null($this->status_assisted)) {
      $query->where('assisteds.active', '=', $this->status_assisted);
    }

    return view('livewire.assisted.index-assisted', [
      'assisted' => $query->paginate($this->perpage)
    ]);
  }

  public function placeholder()
  {
    return <<<'HTML'
      <div class="m-auto text-center">
        <p class="mt-4 mb-2 text-center text-primary">Carregando cadastros</p>
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: rgba(105, 108, 255, 1); transform: scaleX(-1);">
          <path d="M12 22c5.421 0 10-4.579 10-10h-2c0 4.337-3.663 8-8 8s-8-3.663-8-8c0-4.336 3.663-8 8-8V2C6.579 2 2 6.58 2 12c0 5.421 4.579 10 10 10z">
            <animateTransform attributeName="transform" type="rotate" dur=".4s" values="0 12 12;360 12 12;" repeatCount="indefinite"></animateTransform>
          </path>
        </svg>
      </div>
      HTML;
  }
}
