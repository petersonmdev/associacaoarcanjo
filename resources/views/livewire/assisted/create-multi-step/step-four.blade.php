<div>
  <div class="row setup-content" id="step-4">
    <div class="col-12 title-step mb-3">
      <h4 class="m-0 text-primary">Composição familiar</h4>
      <p>Adicione os dependentes</p>
    </div>

    <div class="mb-4">
      <div class="row">
        <div class="col-12 form-check form-switch mt-2 mb-4 pe-3 ps-3 d-flex align-items-center">
          <input id="noDependents" class="form-check-input m-0" type="checkbox" wire:model="no_dependents" wire:change="noDependents()"/>
          <label class="form-check-label ms-2" for="noDependents">
            <span class="d-block">Não possuo dependentes</span>
            <small class="d-block text-secondary">isso removerá todos dependentes já adicionados</small>
          </label>
        </div>
      </div>

      <form class="form-repeater-dependents">
        <div class="row">
          @foreach($data['dependents'] as $index => $dependent)
            <div class="col-12 pb-3">
              <h5 class="text-secondary">Dependente {{$index+1}}</h5>
            </div>
            <div class="mb-3 col-md-6 col-xl-4 col-12">
              <label class="form-label" for="dependent-name-{{$index}}">Nome</label>
              <input type="text" id="dependent-name-{{$index}}" class="form-control @error('data.dependents.'.$index.'.dependent_name') is-invalid @enderror" wire:model="data.dependents.{{$index}}.dependent_name" placeholder="informe nome completo">
              @error('data.dependents.'.$index.'.dependent_name') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 col-md-6 col-xl-4 col-12">
              <label class="form-label" for="dependent-dob-{{$index}}">Data de nascimento</label>
              <input type="date" id="dependent-dob-{{$index}}" class="form-control @error('data.dependents.'.$index.'.dependent_dob') is-invalid @enderror" wire:model="data.dependents.{{$index}}.dependent_dob">
              @error('data.dependents.'.$index.'.dependent_dob') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 col-md-6 col-xl-4 col-12">
              <label class="form-label" for="dependent-sex-{{$index}}">Sexo</label>
              <select id="dependent-sex-{{$index}}" class="form-select @error('data.dependents.'.$index.'.dependent_sex') is-invalid @enderror" wire:model="data.dependents.{{$index}}.dependent_sex">
                <option selected="">Selecione o sexo</option>
                @foreach ($gender as $sex)
                  <option value="{{ $sex->name }}">{{ $sex->value }}</option>
                @endforeach
              </select>
              @error('data.dependents.'.$index.'.dependent_sex') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 col-md-6 col-xl-4 col-12">
              <label class="form-label" for="dependent-parentage-{{$index}}">Parentesco</label>
              <select id="dependent-parentage-{{$index}}" class="form-select @error('data.dependents.'.$index.'.dependent_parentage') is-invalid @enderror" wire:model="data.dependents.{{$index}}.dependent_parentage">
                <option selected="">Selecione um parentesco</option>
                @foreach ($relationships as $relationship)
                  <option value="{{ $relationship->name }}">{{ $relationship->value }}</option>
                @endforeach
              </select>
              @error('data.dependents.'.$index.'.dependent_parentage') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 col-md-6 col-xl-4 col-12">
              <label class="form-label" for="dependent-occupation-{{$index}}">Ocupação</label>
              <input type="text" id="dependent-occupation-{{$index}}" class="form-control @error('data.dependents.'.$index.'.dependent_occupation') is-invalid @enderror" wire:model="data.dependents.{{$index}}.dependent_occupation" placeholder="informe a ocupação">
              @error('data.dependents.'.$index.'.dependent_occupation') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 col-md-3 col-xl-2 col-6 form-check form-switch my-2">
              <label class="form-label d-block" for="dependent-pne-{{$index}}">PNE</label>
              <input id="dependent-pne-{{$index}}" class="form-check-input m-auto @error('data.dependents.'.$index.'.dependent_pne') is-invalid @enderror" type="checkbox" wire:model="data.dependents.{{$index}}.dependent_pne">
              @error('data.dependents.'.$index.'.dependent_pne') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
            </div>
            @if($index != 0)
              <div class="mb-3 col-md-3 col-xl-2 col-6 d-flex align-items-end">
                <button class="btn btn-outline-danger w-100 mt-4" wire:click.prevent="removeDependent({{$index}})">
                  <i class="bx bx-x me-1"></i> Excluir
                </button>
              </div>
            @endif
            <hr class="my-2 pb-3">
          @endforeach
        </div>
        @if(!$no_dependents)
          <div class="mb-0">
            <button class="btn btn-outline-primary" wire:click.prevent="addDependent">
              <i class="tf-icons bx bx bx-add-to-queue me-1"></i>
              <span class="align-middle">Adicionar mais dependentes</span>
            </button>
          </div>
        @else
          <div class="alert alert-info" role="alert">
            Por favor, esteja ciente de que ao selecionar a opção <b>'Não possuo dependentes'</b> você declara que mora sozinho e que em sua casa não existe nenhum dependente.<br>
            Se isso estiver correto, por favor prossiga para próxima etapa. Caso contrário, por favor revise sua seleção.
          </div>
        @endif
      </form>
    </div>

    <div class="my-4">
      <div class="col-12">
        <button class="btn btn-outline-secondary" type="button" wire:click="back()">Voltar</button>
        <button class="btn btn-primary float-end" wire:click="validateStep" type="button" >Próximo</button>
      </div>
    </div>
  </div>
</div>
