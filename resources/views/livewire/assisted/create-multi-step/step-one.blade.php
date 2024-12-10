<div>
  <div class="row setup-content" id="step-1">
    <div class="col-12 title-step mb-3">
      <h4 class="m-0 text-primary">Dados pessoais</h4>
      <p>Informações pessoais do títular</p>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-12 col-md-5 mb-3">
          <label for="nameAssisted" class="form-label">Nome do responsável</label>
          <input type="text" class="form-control @error('data.name') is-invalid @enderror" id="nameAssisted" wire:model="data.name" placeholder="Nome completo"  autocomplete="off"/>
          @error('data.name') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-4 mb-3">
          <label for="dtNascAssisted" class="form-label">Data de nascimento</label>
          <input class="form-control @error('data.dob') is-invalid @enderror" type="date" wire:model="data.dob" id="dtNascAssisted" />
          @error('data.dob') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-3 mb-3">
          <label for="statusAssisted" class="form-label">Status</label>
          <select class="form-select @error('data.active') is-invalid @enderror" id="statusAssisted" wire:model="data.active" aria-label="status">
            @foreach ($statuses as $status)
              <option value="{{ $status->value }}" {{ $status->value == '1' ? "checked" : "" }}>{{ $status->label() }}</option>
            @endforeach
          </select>
          @error('data.active') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md mb-3">
          <label for="cpfAssisted" class="form-label">CPF</label>
          <input type="text" class="form-control @error('data.taxvat') is-invalid @enderror" id="cpfAssisted" x-mask="999.999.999-99" wire:model="data.taxvat" placeholder="999.999.999-99"/>
          @error('data.taxvat') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-md mb-3">
          <label for="maritalStatusAssisted" class="form-label">Estado civil</label>
          <select class="form-select @error('data.civil_status') is-invalid @enderror" id="maritalStatusAssisted" wire:model="data.civil_status" aria-label="Estado civil">
            <option selected>Selecione seu estado civil</option>
            @foreach ($civilStatus as $estadoCivil)
              <option value="{{ $estadoCivil->value }}">{{ $estadoCivil->value }}</option>
            @endforeach
          </select>
          @error('data.civil_status') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-md mb-3">
          <label for="schoolingAssisted" class="form-label">Escolaridade</label>
          <select class="form-select @error('data.education_level') is-invalid @enderror" id="schoolingAssisted" wire:model="data.education_level" aria-label="Escolaridade">
            <option selected>Selecione sua escolaridade</option>
            @foreach ($educationLevels as $educationLevel)
              <option value="{{ $educationLevel->value }}">{{ $educationLevel->value }}</option>
            @endforeach
          </select>
          @error('data.education_level') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md mb-3">
          <label for="occupationAssisted" class="form-label">Profissão</label>
          <input type="text" class="form-control @error('data.profession') is-invalid @enderror" id="occupationAssisted" wire:model="data.profession" placeholder="Ocupação"/>
          @error('data.profession') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          <div class="form-check form-switch my-2">
            <input class="form-check-input @error('data.jobless') is-invalid @enderror" type="checkbox" wire:model="data.jobless" id="joblessAssisted" />
            <label class="form-check-label" for="joblessAssisted">Desempregado</label>
            @error('data.jobless') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
        </div>
        <div class="col-md mb-3">
          <label for="emailAssisted" class="form-label">Email</label>
          <input type="email" class="form-control @error('data.email') is-invalid @enderror" id="emailAssisted" wire:model="data.email" placeholder="email@gmail.com" />
          @error('data.email') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="my-4">
        <div class="col-12">
          <button class="btn btn-primary float-end" wire:click="validateStep" type="button" >Próximo</button>
        </div>
      </div>
    </div>
  </div>
</div>
