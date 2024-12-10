<div>
  <div class="modal fade" id="modalConfirmeRemoveAssisted{{$assistedDelete->id}}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Deseja remover?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-wrap">Tem certeza que deseja remover o cadastro de <span class="fw-bold">{{ $assistedDelete->name }}</span>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Cancelar
          </button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" wire:click="deleteAssisted({{ $assistedDelete->id }})">Remover</button>
        </div>
      </div>
    </div>
  </div>
</div>
