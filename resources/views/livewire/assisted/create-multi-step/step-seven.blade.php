<div>
  <div class="row setup-content" id="step-7">
    <div class="col-12 title-step mb-3">
      <h4 class="m-0 text-primary"><span class="tf-icons bx bxs-face fs-3"></span>&nbsp; Voluntário responsável</h4>
      <p>Vincule um voluntário para essa família</p>
    </div>

    <div class="col-12 mb-4">
      <div class="position-relative">
        <label for="voluntary-assisted">Qual voluntário deve acompanhar essa família?</label>
        <input
          id="voluntary-assisted"
          type="text"
          class="form-control @error('data.voluntary_id') is-invalid @enderror"
          wire:model.live.debounce.200ms="searchVoluntary"
          placeholder="Digite o nome do voluntário"
          autocomplete="off"
        />

        @if($showSuggestions && !empty($searchVoluntary) && $voluntaries->isNotEmpty())
          <div class="list-group position-absolute w-100" style="z-index: 1050; max-height: 220px; overflow-y: auto;">
            @foreach($voluntaries as $voluntary)
              <button
                type="button"
                class="list-group-item list-group-item-action bg-white"
                wire:click="selectVoluntary({{ $voluntary->id }})"
              >
                {{ $voluntary->name }}
              </button>
            @endforeach
          </div>
        @elseif($showSuggestions && !empty($searchVoluntary) && $voluntaries->isEmpty())
          <div class="list-group position-absolute w-100 bg-white" style="z-index: 1050;">
            <div class="list-group-item text-muted">Nenhum voluntário encontrado.</div>
          </div>
        @endif
        @error('data.voluntary_id') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
      </div>
    </div>

    <hr class="mt-3">

    <div class="mt-3">
      <div class="d-md-flex d-block justify-content-between flex-row-reverse gap-3">
        <button class="w-100 w-md-auto btn btn-lg btn-success mb-3" type="button" wire:click="validateStep">Salvar <i class="bx bx-save"></i></button>
        <button class="w-100 w-md-auto btn btn-outline-secondary mb-3" type="button" wire:click="back()"><i class="bx bx-chevrons-left"></i> Voltar</button>
      </div>
    </div>
  </div>
</div>
