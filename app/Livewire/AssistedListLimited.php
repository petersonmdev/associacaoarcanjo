<?php

namespace App\Livewire;

use Livewire\Component;
use App\Repositories\AssistedRepository;

class AssistedListLimited extends Component
{

    public int $limit = 10;

    public function render()
    {
        return view('livewire.assisted-list-limited', [
          'assisted' => AssistedRepository::findByLastedCreatedLimited($this->limit)
        ]);
    }
}
