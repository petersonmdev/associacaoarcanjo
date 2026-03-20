<div>
  <div class="row setup-content" id="step-6">
    <div class="col-12 title-step mb-3">
      <h4 class="m-0 text-primary"><span class="tf-icons bx bx-message-square-dots fs-3"></span> Saúde familiar e social</h4>
      <p>Informe o histórico médico e social</p>
    </div>

    <div class="mb-4">
      <div class="col-md">
        <label for="socialAssisted" class="form-label">Sua breve história de vida</label>
        <textarea
          class="form-control @error('data.life_history') is-invalid @enderror"
          id="socialAssisted"
          wire:model="data.life_history"
          placeholder="Conte um pouco da sua história"
          aria-describedby="socialAssistedHelp"></textarea>
        <div id="socialAssistedHelp" class="form-text">
          De onde veio, como estão vivendo, dificuldades
        </div>
        @error('data.life_history') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
      </div>
    </div>

    <div class="mb-4">
      <div class="col-md">
        <label for="medicineAssisted" class="form-label">Histórico de saúde</label>
        <textarea
          class="form-control @error('data.health_history') is-invalid @enderror"
          id="medicineAssisted"
          wire:model="data.health_history"
          placeholder="Conte um breve histórico dos membros da família"
          aria-describedby="socialAssistedHelp"></textarea>
        <div id="socialAssistedHelp" class="form-text">
          Doenças, cirurgias feitas ou a fazer
        </div>
        @error('data.health_history') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
      </div>
    </div>
    <div class="mb-4">
      <div class="col-md">
        <label for="continuousMedicineAssisted" class="form-label">Medicamentos de uso contínuo</label>
        <textarea
          class="form-control @error('data.continuous_medication') is-invalid @enderror"
          id="continuousMedicineAssisted"
          wire:model="data.continuous_medication"
          placeholder="Quais medicamentos são de uso contínuo?"></textarea>
        @error('data.continuous_medication') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
      </div>
    </div>

    <hr class="mt-3">

    <div class="mt-3">
      <div class="d-md-flex d-block justify-content-between flex-row-reverse gap-3">
        <button class="w-100 w-md-auto btn btn-lg btn-primary mb-3" type="button" wire:click="validateStep">Próximo <i class="bx bx-chevrons-right"></i></button>
        <button class="w-100 w-md-auto btn btn-outline-secondary mb-3" type="button" wire:click="back()"><i class="bx bx-chevrons-left"></i> Voltar</button>
      </div>
    </div>
  </div>
</div>
