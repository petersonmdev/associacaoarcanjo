<div>
  <div class="row mb-3">
    <div class="col-md-12 my-2">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="m-0 text-primary"><span class="tf-icons bx bx-info-circle fs-2"></span>&nbsp; Dados pessoais</h4>
      </div>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-12 col-md-5 mb-3">
          <label for="nameAssisted" class="form-label">Nome responsável</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameAssisted" wire:model="name" placeholder="Nome completo"/>
          @error('name') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-4 mb-3">
          <label for="dtNascAssisted" class="form-label">Data de nascimento</label>
          <input class="form-control @error('dob') is-invalid @enderror" type="date" wire:model="dob" id="dtNascAssisted" />
          @error('dob') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-3 mb-3">
          <label for="statusAssisted" class="form-label">Status</label>
          <select class="form-select @error('active') is-invalid @enderror" id="statusAssisted" wire:model="active" aria-label="status">
            @foreach ($statuses as $status)
              <option value="{{ $status->value }}" {{ $status->value == '1' ? "checked" : "" }}>{{ $status->label() }}</option>
            @endforeach
          </select>
          @error('active') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md mb-3">
          <label for="cpfAssisted" class="form-label">CPF</label>
          <input type="text" class="form-control @error('taxvat') is-invalid @enderror" id="cpfAssisted" x-mask="999.999.999-99" wire:model="taxvat" placeholder="999.999.999-99"/>
          @error('taxvat') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-md mb-3">
          <label for="maritalStatusAssisted" class="form-label">Estado civil</label>
          <select class="form-select @error('civil_status') is-invalid @enderror" id="maritalStatusAssisted" wire:model="civil_status" aria-label="Estado civil">
            <option selected>Selecione seu estado civil</option>
            @foreach ($civilStatus as $estadoCivil)
              <option value="{{ $estadoCivil->value }}">{{ $estadoCivil->value }}</option>
            @endforeach
          </select>
          @error('civil_status') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-md mb-3">
          <label for="schoolingAssisted" class="form-label">Escolaridade</label>
          <select class="form-select @error('education_level') is-invalid @enderror" id="schoolingAssisted" wire:model="education_level" aria-label="Escolaridade">
            <option selected>Selecione sua escolaridade</option>
            @foreach ($educationLevels as $educationLevel)
              <option value="{{ $educationLevel->value }}">{{ $educationLevel->value }}</option>
            @endforeach
          </select>
          @error('education_level') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md mb-3">
          {{$jobless}}
          <label for="occupationAssisted" class="form-label">Profissão</label>
          <input type="text" class="form-control @error('profession') is-invalid @enderror" id="occupationAssisted" wire:model="profession" placeholder="Ocupação"/>
          @error('profession') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          <div class="form-check form-switch my-2">
            <input class="form-check-input @error('jobless') is-invalid @enderror" type="checkbox" wire:model="jobless" id="joblessAssisted" />
            <label class="form-check-label" for="joblessAssisted">Desempregado</label>
            @error('jobless') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
        </div>
        <div class="col-md mb-3">
          <label for="emailAssisted" class="form-label">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailAssisted" wire:model="email" placeholder="email@gmail.com" />
          @error('email') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>
    </div>

    <hr class="mt-5 mb-3">

    <div class="col-md-12 my-2">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="m-0 text-primary"><span class="tf-icons bx bx-phone-call fs-2"></span>&nbsp; Telefones para contato</h4>
      </div>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-md mb-3">
          <label for="telAssisted" class="form-label">Celular (Whatsapp)</label>
          <input type="tel" class="form-control @error('phone_number_whatsapp') is-invalid @enderror" id="telAssisted" x-mask="(99)99999-9999" wire:model="phone_number_whatsapp" placeholder="(99)99999-9999"/>
          @error('phone_number_whatsapp') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-md mb-3">
          <label for="telOpc1Assisted" class="form-label">Telefone 1</label>
          <input type="tel" class="form-control @error('phone_number1') is-invalid @enderror" id="telOpc1Assisted" x-mask="(99)99999-9999" wire:model="phone_number1" placeholder="(99)99999-9999"/>
          @error('phone_number1') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-md mb-3">
          <label for="telOpc2Assisted" class="form-label">Telefone 2</label>
          <input type="tel" class="form-control @error('phone_number2') is-invalid @enderror" id="telOpc2Assisted" x-mask="(99)99999-9999" wire:model="phone_number2" placeholder="(99)99999-9999"/>
          @error('phone_number2') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>
    </div>

    <hr class="mt-5 mb-3">

    <div class="col-md-12 my-2">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="m-0 text-primary"><span class="tf-icons bx bx-location-plus fs-2"></span>&nbsp; Endereço</h4>
      </div>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-12 col-md-4 col-xl mb-3">
          <label for="cepAddressAssisted" class="form-label">CEP</label>
          <input type="text" class="form-control @error('zipcode') is-invalid @enderror" id="cepAddressAssisted" x-mask="99999-999" wire:model="zipcode" placeholder="99999-999"/>
          @error('zipcode') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-5 col-xl mb-3">
          <label for="streetAddressAssisted" class="form-label">Endereço</label>
          <input type="text" class="form-control @error('address') is-invalid @enderror" id="streetAddressAssisted" wire:model="address" placeholder="Nome da rua ou avenida"/>
          @error('address') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-3 col-xl mb-3">
          <label for="numberAddressAssisted" class="form-label">Número</label>
          <input type="text" class="form-control @error('number') is-invalid @enderror" id="numberAddressAssisted" wire:model="number" placeholder="Número" />
          @error('number') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6 mb-3">
          <label for="complementAddressAssisted" class="form-label">Complemento</label>
          <input type="text" class="form-control @error('complement') is-invalid @enderror" id="complementAddressAssisted" wire:model="complement" placeholder="Apartamento, suíte, sala, quadra, lote, etc." />
          @error('complement') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-6 mb-3">
          <label for="neighborhoodAddressAssisted" class="form-label">Bairro</label>
          <input type="text" class="form-control @error('neighborhood') is-invalid @enderror" id="neighborhoodAddressAssisted" wire:model="neighborhood" placeholder="Bairro"/>
          @error('neighborhood') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-6 mb-3">
          <label for="cityAddressAssisted" class="form-label">Cidade</label>
          <input type="text" class="form-control @error('city') is-invalid @enderror" id="cityAddressAssisted" wire:model="city" placeholder="Cidade"/>
          @error('city') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-6 mb-3">
          <label for="stateDependentAssisted" class="form-label">Estado</label>
          <select class="form-select @error('state') is-invalid @enderror" id="stateDependentAssisted" wire:model="state" aria-label="Estado">
            <option value="" selected>Selecione o estado</option>
            @foreach ($states as $state)
              <option value="{{ $state->name }}">{{ $state->value }}</option>
            @endforeach
          </select>
          @error('state') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>
    </div>

    <hr class="mt-5 mb-3">

    <div class="col-md-12 my-2">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="m-0 text-primary"><span class="tf-icons bx bx-user-plus fs-2"></span>&nbsp; Composição familiar</h4>
      </div>
    </div>
    <div class="col-12 mb-4">
      <form class="form-repeater-dependents">
        <div class="row">
          @if (array_values($dependents))
            @foreach($dependents as $index => $dependent)
              <div class="col-12 pb-3">
                <h5 class="text-secondary">Dependente <span class="fw-medium">{{ '#'.sprintf('%02d', $index+1) }}</span><small class="mx-2 badge rounded-pill bg-secondary fs-tiny">{{$dependent['hash']}}</small></h5>
              </div>
              <div class="mb-3 col-md-6 col-xl-4 col-12">
                <label class="form-label" for="dependent-name-{{$index}}-update">Nome</label>
                <input type="text" id="dependent-name-{{$index}}-update" class="form-control @error('dependents.'.$index.'.name') is-invalid @enderror" wire:model="dependents.{{$index}}.name" placeholder="informe nome completo">
                @error('dependents.'.$index.'.name') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
              </div>
              <div class="mb-3 col-md-6 col-xl-4 col-12">
                <label class="form-label" for="dependent-dob-{{$index}}-update">Data de nascimento</label>
                <input type="date" id="dependent-dob-{{$index}}-update" class="form-control @error('dependents.'.$index.'.dob') is-invalid @enderror" wire:model="dependents.{{$index}}.dob">
                @error('dependents.'.$index.'.dob') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
              </div>
              <div class="mb-3 col-md-6 col-xl-4 col-12">
                <label class="form-label" for="dependent-sex-{{$index}}-update">Sexo</label>
                <select id="dependent-sex-{{$index}}-update" class="form-select @error('dependents.'.$index.'.sex') is-invalid @enderror" wire:model="dependents.{{$index}}.sex">
                  <option selected="">Selecione o sexo</option>
                  @foreach ($gender as $sex)
                    <option value="{{ $sex->name }}">{{ $sex->value }}</option>
                  @endforeach
                </select>
                @error('dependents.'.$index.'.sex') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
              </div>
              <div class="mb-3 col-md-6 col-xl-4 col-12">
                <label class="form-label" for="dependent-parentage-{{$index}}-update">Parentesco</label>
                <select id="dependent-parentage-{{$index}}-update" class="form-select @error('dependents.'.$index.'.parentage') is-invalid @enderror" wire:model="dependents.{{$index}}.parentage">
                  <option selected="">Selecione um parentesco</option>
                  @foreach ($relationships as $relationship)
                    <option value="{{ $relationship->name }}">{{ $relationship->value }}</option>
                  @endforeach
                </select>
                @error('dependents.'.$index.'.parentage') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
              </div>
              <div class="mb-3 col-md-6 col-xl-4 col-12">
                <label class="form-label" for="dependent-profission-{{$index}}-update">Ocupação</label>
                <input type="text" id="dependent-profession-{{$index}}-update" class="form-control @error('dependents.'.$index.'.profession') is-invalid @enderror" wire:model="dependents.{{$index}}.profession" placeholder="informe a ocupação">
                @error('dependents.'.$index.'.profession') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
              </div>
              <div class="mb-3 col-md-3 col-xl-2 col-6 form-check form-switch my-2">
                <label class="form-label d-block" for="dependent-pne-{{$index}}-update">PNE</label>
                <input id="dependent-pne-{{$index}}-update" class="form-check-input m-auto @error('dependents.'.$index.'.pne') is-invalid @enderror" type="checkbox" wire:model="dependents.{{$index}}.pne">
                @error('dependents.'.$index.'.pne') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
              </div>
              <div class="mb-3 col-md-3 col-xl-2 col-6 d-flex align-items-end">
                <button class="btn btn-outline-danger w-100 mt-4" wire:click.prevent="removeDependentUpdate({{$index}}, {{($dependent['id']) ?? null}})">
                  <i class="bx bx-x me-1"></i> Excluir
                </button>
              </div>
              <hr class="my-2 pb-3">
            @endforeach
          @else
            <div class="mb-3 col-12">
              <div class="alert alert-info text-center" role="alert">
                Nenhum dependente cadastrado
              </div>
            </div>
          @endif
          <div class="mb-0">
            <button class="btn btn-outline-primary" type="button" wire:click.prevent="addDependents('{{uniqid()}}')">
              <i class="tf-icons bx bx bx-add-to-queue me-1"></i>
              <span class="align-middle">Adicionar dependentes</span>
            </button>
          </div>
        </div>
      </form>
    </div>

    <hr class="mt-5 mb-3">

    <div class="col-md-12 my-2">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="m-0 text-primary"><span class="tf-icons bx bx-money fs-2"></span>&nbsp; Renda familiar</h4>
      </div>
    </div>
    <form class="form-repeater-incomes">
      <div class="row">
        @if (!empty($incomes))
          @foreach($incomes as $i => $income)
            <div class="col-12 pb-3">
            </div>
            <div class="mb-3 col-lg-6 col-xl-6 col-12">
              <label class="form-label" for="form-repeater-2-1">Origem da renda</label>
              <input type="text" id="form-repeater-2-1" class="form-control @error('incomes.'.$i.'.name') is-invalid @enderror" wire:model="incomes.{{$i}}.name" placeholder="informe a origem da renda">
              @error('incomes.'.$i.'.name') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 col-lg-4 col-xl-4 col-sm-8 col-12">
              <label class="form-label" for="form-repeater-2-2">valor da renda</label>
              <div class="input-group">
                <span class="input-group-text">R$</span>
                <input id="form-repeater-2-2" type="number" class="form-control @error('incomes.'.$i.'.incomes') is-invalid @enderror" wire:model="incomes.{{$i}}.incomes" placeholder="Digite o valor da renda (em reais)">
                <span class="input-group-text">,00</span>
                @error('incomes.'.$i.'.incomes') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
              </div>
            </div>
            <div class="mb-3 col-md-3 col-xl-2 col-6 d-flex align-items-end">
              <button class="btn btn-outline-danger w-100 mt-4" wire:click.prevent="removeIncomeUpdate({{$i}}, {{($income['id']) ?? null}})">
                <i class="bx bx-x me-1"></i> Excluir
              </button>
            </div>
            <hr class="my-2 pb-3">
          @endforeach
        @else
          <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
            <p class="mb-1 text-center">Nenhuma renda cadastrada</p>
          </a>
        @endif
        <div class="mb-0">
          <button class="btn btn-outline-primary" wire:click.prevent="addIncomeUpdate('{{uniqid()}}')">
            <i class="tf-icons bx bx bx-add-to-queue me-1"></i>
            <span class="align-middle">Adicionar Renda</span>
          </button>
        </div>
      </div>
    </form>

    <hr class="mt-5 mb-3">

    <div class="col-md-12 my-2">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="m-0 text-primary"><span class="tf-icons bx bx-message-square-dots fs-2"></span>&nbsp; Saúde familiar e social</h4>
      </div>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="mb-4">
          <div class="col-md">
            <label for="socialAssisted" class="form-label">Sua breve história de vida</label>
            <textarea
              class="form-control @error('life_history') is-invalid @enderror"
              id="socialAssisted"
              wire:model="life_history"
              placeholder="Conte um pouco da sua história"
              aria-describedby="socialAssistedHelp"></textarea>
            <div id="socialAssistedHelp" class="form-text">
              De onde veio, como estão vivendo, dificuldades
            </div>
            @error('life_history') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
        </div>
        <div class="mb-4">
          <div class="col-md">
            <label for="medicineAssisted" class="form-label">Histórico de saúde</label>
            <textarea
              class="form-control @error('health_history') is-invalid @enderror"
              id="medicineAssisted"
              wire:model="health_history"
              placeholder="Conte um breve histórico dos membros da família"
              aria-describedby="socialAssistedHelp"></textarea>
            <div id="socialAssistedHelp" class="form-text">
              Doenças, cirurgias feitas ou a fazer
            </div>
            @error('health_history') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
        </div>
        <div class="mb-4">
          <div class="col-md">
            <label for="continuousMedicineAssisted" class="form-label">Medicamentos de uso contínuo</label>
            <textarea
              class="form-control @error('continuous_medication') is-invalid @enderror"
              id="continuousMedicineAssisted"
              wire:model="continuous_medication"
              placeholder="Quais medicamentos são de uso contínuo?"></textarea>
            @error('continuous_medication') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
        </div>
      </div>
    </div>

    <hr class="mt-5 mb-3">

    <div class="col-md-12 my-2">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="m-0 text-primary"><span class="tf-icons bx bxs-face fs-2"></span>&nbsp; Voluntário responsável</h4>
      </div>
    </div>
    <div class="col-12 mb-4">
      <div class="position-relative">
        <label for="voluntary-assisted" class="form-label">voluntário vinculado</label>
        <select id="voluntary-assisted" class="form-control select2 @error('voluntary_id') is-invalid @enderror" wire:model="voluntary_id">
          <option value="" selected>Selecione um voluntário</option>
          @foreach($voluntaries as $voluntary)
            <option value="{{$voluntary->id}}" @if($voluntary->id === $voluntary_id) selected @endif>{{ $voluntary->name }}</option>
          @endforeach
        </select>
        @error('voluntary_id') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md">
        <a class="btn btn-outline-secondary" href="{{url()->previous()}}">Voltar</a>
        <button class="btn btn-success float-end" type="submit" wire:click="submitForm()" >Salvar</button>
      </div>
    </div>
  </div>
</div>
