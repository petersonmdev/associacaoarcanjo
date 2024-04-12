<?php

namespace App\Livewire;

use App\Models\Assisted;
use App\Repositories\AssistedRepository;
use App\Repositories\DependentRepository;
use App\Repositories\VoluntaryRepository;
use Livewire\Component;
use Livewire\WithPagination;
use function PHPUnit\Framework\isJson;

class AssistedList extends Component
{
  use WithPagination;
  protected $paginationTheme = 'bootstrap';
  public $perpage = 10;
  public $search = '';
  public $status_assisted;

  public function render()
  {

    $queryAssisted = AssistedRepository::findByAssistedNameComplete($this->search);

    if ($this->status_assisted != null) {
      $queryAssisted->where('assisteds.active', '=', $this->status_assisted);
    }

    return view('livewire.assisted-list', [
      'assisted' => $queryAssisted->paginate($this->perpage)
    ]);
  }
}
