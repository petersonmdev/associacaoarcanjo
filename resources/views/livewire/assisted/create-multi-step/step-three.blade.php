<div>
  <div class="row setup-content" id="step-3">
    <div class="col-12 title-step mb-3">
      <h4 class="m-0 text-primary"><span class="tf-icons bx bx-location-plus fs-3"></span>&nbsp;Endereço</h4>
      <p>Informe o endereço</p>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-12 col-md-4 col-xl mb-3">
          <label for="cepAddressAssisted" class="form-label">CEP</label>
          <div class="position-relative">
            <input type="text" class="form-control @error('data.zipcode') is-invalid @enderror @if ($cepError) is-invalid @endif" id="cepAddressAssisted" x-mask="99999-999" wire:model.live="data.zipcode" wire:blur="fetchAddressByCepFromZipcode" placeholder="99999-999"/>
            <div
              class="position-absolute top-50 end-0 translate-middle-y me-3"
              wire:loading.flex
              wire:target="data.zipcode,fetchAddressByCep"
              style="display:none;"
            >
              <div class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></div>
            </div>
          </div>
          @error('data.zipcode') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          @if ($cepError)
            <span class="d-block invalid-feedback">{{ $cepError }}</span>
          @endif
        </div>
        <div class="col-12 col-md-5 col-xl mb-3">
          <label for="streetAddressAssisted" class="form-label">Endereço</label>
          <input type="text" class="form-control @error('data.address') is-invalid @enderror" id="streetAddressAssisted" wire:model="data.address" wire:loading.attr="disabled"
                 wire:loading.class="opacity-50"
                 wire:target="fetchAddressByCep,fetchAddressByCepFromZipcode" placeholder="Nome da rua ou avenida"/>
          @error('data.address') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-3 col-xl mb-3">
          <label for="numberAddressAssisted" class="form-label">Número</label>
          <input type="text" class="form-control @error('data.number') is-invalid @enderror" id="numberAddressAssisted" wire:model="data.number" x-ref="addressNumber" x-on:focus-number-address.window="$nextTick(() => $refs.addressNumber?.focus())" placeholder="Número" />
          @error('data.number') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6 mb-3">
          <label for="complementAddressAssisted" class="form-label">Complemento</label>
          <input type="text" class="form-control @error('data.complement') is-invalid @enderror" id="complementAddressAssisted" wire:model="data.complement" placeholder="Apartamento, suíte, sala, quadra, lote, etc." />
          @error('data.complement') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-6 mb-3">
          <label for="neighborhoodAddressAssisted" class="form-label">Bairro</label>
          <input type="text" class="form-control @error('data.neighborhood') is-invalid @enderror" id="neighborhoodAddressAssisted" wire:model="data.neighborhood" wire:loading.attr="disabled" wire:loading.class="opacity-50" wire:target="fetchAddressByCep,fetchAddressByCepFromZipcode" placeholder="Bairro"/>
          @error('data.neighborhood') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-6 mb-3">
          <label for="cityAddressAssisted" class="form-label">Cidade</label>
          <input type="text" class="form-control @error('data.city') is-invalid @enderror" id="cityAddressAssisted" wire:model="data.city" wire:loading.attr="disabled" wire:loading.class="opacity-50" wire:target="fetchAddressByCep,fetchAddressByCepFromZipcode" placeholder="Cidade"/>
          @error('data.city') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-6 mb-3">
          <label for="stateDependentAssisted" class="form-label">Estado</label>
          <select class="form-select @error('data.state') is-invalid @enderror" id="stateDependentAssisted" wire:model="data.state" wire:loading.attr="disabled" wire:loading.class="opacity-50" wire:target="fetchAddressByCep,fetchAddressByCepFromZipcode" aria-label="Estado">
            <option value="" selected>Selecione o estado</option>
            @foreach ($states as $state)
              <option value="{{ $state->name }}">{{ $state->value }}</option>
            @endforeach
          </select>
          @error('data.state') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
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
