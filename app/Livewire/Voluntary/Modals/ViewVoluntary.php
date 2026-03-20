<?php

namespace App\Livewire\Voluntary\Modals;

use App\Repositories\AddressRepository;
use App\Repositories\AssistedRepository;
use App\Repositories\ContactRepository;
use Livewire\Component;

class ViewVoluntary extends Component
{
  public $voluntary;

  public function mount($voluntaryRegister)
  {
    $this->voluntary = $voluntaryRegister;
  }

  public function render()
  {
    $address = $this->voluntary?->address_id !== null
      ? AddressRepository::find((int) $this->voluntary->address_id)
      : null;

    $contacts = $this->voluntary?->contact_id !== null
      ? ContactRepository::find((int) $this->voluntary->contact_id)
      : null;

    $assisteds = $this->voluntary?->id !== null
      ? AssistedRepository::findByIdsComplete(AssistedRepository::findIdsByVoluntaryId((int) $this->voluntary->id))
      : collect();

    return view('livewire.voluntary.modals.view-voluntary', [
      'voluntaryView' => $this->voluntary,
      'addressView' => $address,
      'contactsView' => $contacts,
      'assistedsView' => $assisteds,
    ]);
  }
}
