<?php

namespace App\Livewire;

use App\Repositories\AssistedRepository;
use App\Repositories\DependentRepository;
use Livewire\Component;

class AssistedListSummary extends Component
{
    public $count_assisted;
    public function render()
    {
        return view('livewire.assisted-list-summary', [
          'assisteds' => AssistedRepository::all(),
          'dependents' => DependentRepository::all(),
          'assisteds_active' => AssistedRepository::all()->where('active', '=', 1)
        ]);
    }
}
