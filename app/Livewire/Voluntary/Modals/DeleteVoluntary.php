<?php

namespace App\Livewire\Voluntary\Modals;

use App\Repositories\VoluntaryRepository;
use App\Services\VoluntaryService;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DeleteVoluntary extends Component
{
  public $voluntary;

  public function mount($voluntaryRegister)
  {
    $this->voluntary = $voluntaryRegister;
  }

  public function render()
  {
    return view('livewire.voluntary.modals.delete-voluntary', [
      'voluntaryDelete' => $this->voluntary,
    ]);
  }

  public function deleteVoluntary($id)
  {
    try {
      $deleted = app(VoluntaryService::class)->deleteWithRelations((int) $id);

      if ($deleted) {
        $this->dispatch(
          'alert',
          type: 'success',
          title: 'Cadastro deletado com sucesso.',
          position: 'center',
          timer: 1500
        );

        $this->dispatch('VoluntaryDeleted');
      }
    } catch (Exception $e) {
      Log::error($e);
      $this->dispatch(
        'alert',
        type: 'error',
        title: 'Ocorreu um erro ao deletar o cadastro.',
        position: 'center',
        timer: 1500
      );
    }
  }
}
