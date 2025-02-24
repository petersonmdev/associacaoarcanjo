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

    <div class="my-4">
      <div class="col-12">
        <button class="btn btn-outline-secondary" type="button" wire:click="back()">Voltar</button>
        <button class="btn btn-primary float-end" wire:click="validateStep" type="button" >Próximo</button>
      </div>
    </div>
  </div>
</div>
