<?php

namespace App\Livewire\Assisted\Modals;

use App\Repositories\AddressRepository;
use App\Repositories\ContactRepository;
use App\Repositories\DependentRepository;
use App\Repositories\IncomeRepository;
use App\Repositories\VoluntaryRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class ViewAssisted extends Component
{
  public $assisted;
  public function mount($assistedRegister)
  {
    $this->assisted = $assistedRegister;
  }

  public function render()
  {
    $address = $this->assisted?->address_id !== null
      ? AddressRepository::find((int) $this->assisted->address_id)
      : null;

    $contacts = $this->assisted?->contact_id !== null
      ? ContactRepository::find((int) $this->assisted->contact_id)
      : null;

    $dependents = $this->assisted?->id !== null
      ? DependentRepository::findByAssistedId((int) $this->assisted->id)
      : collect();

    $incomes = $this->assisted?->id !== null
      ? IncomeRepository::findByAssistedId((int) $this->assisted->id)
      : collect();

    $voluntary = $this->assisted?->voluntary_id !== null
      ? VoluntaryRepository::find((int) $this->assisted->voluntary_id)
      : null;

    return view('livewire.assisted.modals.view-assisted', [
      'assistedView' => $this->assisted,
      'addressView' => $address,
      'contactsView' => $contacts,
      'dependentsView' => $dependents,
      'incomesView' => $incomes,
      'voluntaryView' => $voluntary
    ]);
  }

  public function generatePdf(){
    $data = [
      'assisted' => $this->assisted
    ];
    $pdf = Pdf::loadView('app.assisted.pdf.show', $data);
    return response()->streamDownload(function() use($pdf){
      echo $pdf->stream();
    }, 'assisted.pdf');
  }
}
