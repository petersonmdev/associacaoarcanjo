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
    $address = AddressRepository::find($this->assisted->address_id);
    $contacts = ContactRepository::find($this->assisted->contact_id);
    $dependents = DependentRepository::findByAssistedId($this->assisted->id);
    $incomes = IncomeRepository::findByAssistedId($this->assisted->id);
    $voluntary = VoluntaryRepository::find($this->assisted->voluntary_id);
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
