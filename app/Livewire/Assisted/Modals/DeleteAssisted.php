<?php

namespace App\Livewire\Assisted\Modals;

use App\Repositories\AssistedRepository;
use App\Services\AssistedService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Exception;

class DeleteAssisted extends Component
{
  public $assisted;
  public function mount($assistedRegister)
  {
    $this->assisted = $assistedRegister;
  }

  public function render()
  {
    return view('livewire.assisted.modals.delete-assisted', [
      'assistedDelete' => $this->assisted
    ]);
  }

  public function deleteAssisted($id)
  {
    try {
      $deleted = app(AssistedService::class)->deleteWithRelations((int) $id);

      if ($deleted) {
       $this->dispatch(
          'alert',
          type: 'success',
          title: 'Cadastro deletado com sucesso.',
          position: 'center',
          timer: 1500
        );

        $this->dispatch('AssistedDeleted');
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
