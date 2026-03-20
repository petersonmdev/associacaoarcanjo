<?php

namespace App\Livewire\Voluntary;

use Livewire\Component;
use App\Repositories\VoluntaryRepository;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class IndexVoluntary extends Component
{
  use WithPagination;
  protected $paginationTheme = 'bootstrap';
  public $perpage = 10;
  public $search = '';
  public $status_voluntary = '';
  public $queryVoluntary = null;

  public function mount(){
    $this->loadVoluntaries();
  }

  #[On('VoluntaryDeleted')]
  public function showSuccessDelete()
  {
    $this->loadVoluntaries();
  }

  public function updatedSearch()
  {
    $this->resetPage();
    $this->loadVoluntaries();
  }

  public function updatedStatusVoluntary()
  {
    $this->resetPage();
    $this->loadVoluntaries();
  }

  private function loadVoluntaries()
  {
    $query = VoluntaryRepository::findByVoluntaryNameComplete($this->search);

    if ($this->status_voluntary !== '') {
      $query->where('voluntaries.active', '=', (int)$this->status_voluntary);
    }
  }

  public function render()
  {
    $query = VoluntaryRepository::findByVoluntaryNameComplete($this->search);

    if ($this->status_voluntary !== '') {
      $query->where('voluntaries.active', '=', (int)$this->status_voluntary);
    }
    return view('livewire.voluntary.index-voluntary', [
      'voluntary' => $query->paginate($this->perpage)
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
