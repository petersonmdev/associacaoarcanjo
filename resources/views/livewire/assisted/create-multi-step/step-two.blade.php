<div>
  <div class="row setup-content" id="step-2">
    <div class="col-12 title-step mb-3">
      <h4 class="m-0 text-primary"><span class="tf-icons bx bx-phone-call fs-3"></span>&nbsp;Telefones para contato</h4>
      <p>Informe formas para contato</p>
    </div>

    <div class="col-12">
      <div class="row">
        <div class="col-md mb-3">
          <label for="telAssisted" class="form-label">Celular (Whatsapp)</label>
          <input type="tel" class="form-control @error('data.phone_number_whatsapp') is-invalid @enderror" id="telAssisted" x-mask="(99)99999-9999" wire:model="data.phone_number_whatsapp" placeholder="(99)99999-9999"/>
          @error('data.phone_number_whatsapp') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-md mb-3">
          <label for="telOpc1Assisted" class="form-label">Telefone 1</label>
          <input type="tel" class="form-control @error('data.phone_number1') is-invalid @enderror" id="telOpc1Assisted" x-mask="(99)99999-9999" wire:model="data.phone_number1" placeholder="(99)99999-9999"/>
          @error('data.phone_number1') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-md mb-3">
          <label for="telOpc2Assisted" class="form-label">Telefone 2</label>
          <input type="tel" class="form-control @error('data.phone_number2') is-invalid @enderror" id="telOpc2Assisted" x-mask="(99)99999-9999" wire:model="data.phone_number2" placeholder="(99)99999-9999"/>
          @error('data.phone_number2') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
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
