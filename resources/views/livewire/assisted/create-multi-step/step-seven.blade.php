<div>
  <div class="row setup-content" id="step-7">
    <div class="col-12 title-step mb-3">
      <h4 class="m-0 text-primary">Vincular voluntário</h4>
      <p>Vincule um voluntário para essa família</p>
    </div>

    <div class="col-12 mb-4">
      <div class="position-relative">
        <label for="voluntary-assisted">Qual voluntário deve acompanhar essa família?</label>
        <select id="voluntary-assisted" class="form-control select2 @error('data.voluntary_id') is-invalid @enderror" wire:model="data.voluntary_id">
          <option value="" selected>Selecione um voluntário</option>
          @foreach($voluntaries as $voluntary)
            <option value="{{$voluntary->id}}">{{ $voluntary->name }}</option>
          @endforeach
        </select>
        @error('data.voluntary_id') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
      </div>
    </div>

    <div class="my-4">
      <div class="col-12">
        <button class="btn btn-outline-secondary" type="button" wire:click="back()">Voltar</button>
        <button class="btn btn-success float-end" type="submit" wire:click="validateStep" >Salvar</button>
      </div>
    </div>
  </div>
</div>
