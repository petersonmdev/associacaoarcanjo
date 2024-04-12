<div>

  @if(!empty($successMessage))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 99999">
      <div id="liveToast" class="toast show align-items-center bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            {{ $successMessage }}
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>
  @endif

  <div class="row">
    <div class="col-md-4 col-xl-3 content-stepwizard border-end">
      <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step d-flex py-md-3 py-2">
            <a href="#step-1" type="button" class="me-2 fs-5 btn btn-icon {{ $currentStep != 1 ? 'btn-outline-secondary' : 'btn-primary' }}">1</a>
            <div class="text-left">
              <h6 class="m-0 {{ $currentStep === 1 ? 'text-primary' : '' }}">Dados pessoais</h6>
              <p><small>Informações pessoais do títular</small></p>
            </div>
          </div>
          <div class="stepwizard-step d-flex py-md-3 py-2">
            <a href="#step-2" type="button" class="me-2 fs-5 btn btn-icon {{ $currentStep != 2 ? 'btn-outline-secondary' : 'btn-primary' }}">2</a>
            <div class="text-left">
              <h6 class="m-0 {{ $currentStep === 2 ? 'text-primary' : '' }}">Telefones para contato</h6>
              <p><small>Informe formas para contato</small></p>
            </div>
          </div>
          <div class="stepwizard-step d-flex py-md-3 py-2">
            <a href="#step-3" type="button" class="me-2 fs-5 btn btn-icon {{ $currentStep != 3 ? 'btn-outline-secondary' : 'btn-primary' }}" disabled="disabled">3</a>
            <div class="text-left">
              <h6 class="m-0 {{ $currentStep === 3 ? 'text-primary' : '' }}">Endereço</h6>
              <p><small>Informe o endereço</small></p>
            </div>
          </div>
          <div class="stepwizard-step d-flex py-md-3 py-2">
            <a href="#step-4" type="button" class="me-2 fs-5 btn btn-icon {{ $currentStep != 4 ? 'btn-outline-secondary' : 'btn-primary' }}" disabled="disabled">4</a>
            <div class="text-left">
              <h6 class="m-0 {{ $currentStep === 4 ? 'text-primary' : '' }}">Composição familiar</h6>
              <p><small>Adicione os dependentes</small></p>
            </div>
          </div>
          <div class="stepwizard-step d-flex py-md-3 py-2">
            <a href="#step-5" type="button" class="me-2 fs-5 btn btn-icon {{ $currentStep != 5 ? 'btn-outline-secondary' : 'btn-primary' }}" disabled="disabled">5</a>
            <div class="text-left">
              <h6 class="m-0 {{ $currentStep === 5 ? 'text-primary' : '' }}">Renda familiar mensal</h6>
              <p><small>Informe a renda mensal</small></p>
            </div>
          </div>
          <div class="stepwizard-step d-flex py-md-3 py-2">
            <a href="#step-6" type="button" class="me-2 fs-5 btn btn-icon {{ $currentStep != 6 ? 'btn-outline-secondary' : 'btn-primary' }}" disabled="disabled">6</a>
            <div class="text-left">
              <h6 class="m-0 {{ $currentStep === 6 ? 'text-primary' : '' }}">Saúde familiar e social</h6>
              <p><small>Informe o histórico médico e social</small></p>
            </div>
          </div>
          <div class="stepwizard-step d-flex py-md-3 py-2">
            <a href="#step-7" type="button" class="me-2 fs-5 btn btn-icon {{ $currentStep != 7 ? 'btn-outline-secondary' : 'btn-primary' }}" disabled="disabled">7</a>
            <div class="text-left">
              <h6 class="m-0 {{ $currentStep === 7 ? 'text-primary' : '' }}">Vincular voluntário</h6>
              <p><small>Vincule um voluntário para essa família</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-8 col-xl-9 border-top border-xl-none border-md-none pt-3 pt-md-0" x-data>
      <div class="row setup-content {{ $currentStep != 1 ? 'd-none' : '' }}" id="step-1">
        <div class="col-12 title-step mb-3">
          <h4 class="m-0 text-primary">Dados pessoais</h4>
          <p>Informações pessoais do títular</p>
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
                <option selected value="1" {{{ $active == '1' ? "checked" : "" }}}>Ativo</option>
                <option value="0" {{{ $active == '0' ? "checked" : "" }}}>Inativo</option>
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
                <option value="Solteiro(a)">Solteiro(a)</option>
                <option value="União estável">União estável</option>
                <option value="Casado(a)">Casado(a)</option>
                <option value="Divorciado(a)">Divorciado(a)</option>
              </select>
              @error('civil_status') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md mb-3">
              <label for="schoolingAssisted" class="form-label">Escolaridade</label>
              <select class="form-select @error('education_level') is-invalid @enderror" id="schoolingAssisted" wire:model="education_level" aria-label="Escolaridade">
                <option selected>Selecione sua escolaridade</option>
                <option value="Não alfabetizado">Não alfabetizado</option>
                <option value="Ensino básico">Ensino básico</option>
                <option value="Fundamental">Fundamental</option>
                <option value="Ensino médio">Ensino médio</option>
                <option value="Superior (Graduação)">Superior (Graduação)</option>
                <option value="Pós-graduação">Pós-graduação</option>
              </select>
              @error('education_level') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
            </div>
          </div>

          <div class="row">
            <div class="col-md mb-3">
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

        <div class="my-4">
          <div class="col-12">
            <button class="btn btn-primary float-end" wire:click="firstStepSubmit" type="button" >Próximo</button>
          </div>
        </div>
      </div>

      <div class="row setup-content {{ $currentStep != 2 ? 'd-none' : '' }}" id="step-2">
        <div class="col-12 title-step mb-3">
          <h4 class="m-0 text-primary">Telefones para contato</h4>
          <p>Informe formas para contato</p>
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

        <div class="my-4">
          <div class="col-12">
            <button class="btn btn-outline-secondary" type="button" wire:click="back(1)">Voltar</button>
            <button class="btn btn-primary float-end" wire:click="secondStepSubmit" type="button" >Próximo</button>
          </div>
        </div>
      </div>

      <div class="row setup-content {{ $currentStep != 3 ? 'd-none' : '' }}" id="step-3">
        <div class="col-12 title-step mb-3">
          <h4 class="m-0 text-primary">Endereço</h4>
          <p>Informe o endereço</p>
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
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
                <option value="EX">Estrangeiro</option>
              </select>
              @error('state') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
            </div>
          </div>
        </div>

        <div class="my-4">
          <div class="col-12">
            <button class="btn btn-outline-secondary" type="button" wire:click="back(2)">Voltar</button>
            <button class="btn btn-primary float-end" wire:click="thirdStepSubmit" type="button" >Próximo</button>
          </div>
        </div>

      </div>

      <div class="row setup-content {{ $currentStep != 4 ? 'd-none' : '' }}" id="step-4">
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
              @foreach($dependents as $index => $dependent)
                <div class="col-12 pb-3">
                  <h5 class="text-secondary">Dependente {{$index+1}}</h5>
                </div>
                <div class="mb-3 col-md-6 col-xl-4 col-12">
                  <label class="form-label" for="dependent-name-{{$index}}">Nome</label>
                  <input type="text" id="dependent-name-{{$index}}" class="form-control @error('dependents.'.$index.'.dependent_name') is-invalid @enderror" wire:model="dependents.{{$index}}.dependent_name" placeholder="informe nome completo">
                  @error('dependents.'.$index.'.dependent_name') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3 col-md-6 col-xl-4 col-12">
                  <label class="form-label" for="dependent-dob-{{$index}}">Data de nascimento</label>
                  <input type="date" id="dependent-dob-{{$index}}" class="form-control @error('dependents.'.$index.'.dependent_dob') is-invalid @enderror" wire:model="dependents.{{$index}}.dependent_dob">
                  @error('dependents.'.$index.'.dependent_dob') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3 col-md-6 col-xl-4 col-12">
                  <label class="form-label" for="dependent-sex-{{$index}}">Sexo</label>
                  <select id="dependent-sex-{{$index}}" class="form-select @error('dependents.'.$index.'.dependent_sex') is-invalid @enderror" wire:model="dependents.{{$index}}.dependent_sex">
                    <option selected="">Selecione o sexo</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">feminino</option>
                    <option value="nao informado">Não informar</option>
                  </select>
                  @error('dependents.'.$index.'.dependent_sex') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3 col-md-6 col-xl-4 col-12">
                  <label class="form-label" for="dependent-parentage-{{$index}}">Parentesco</label>
                  <select id="dependent-parentage-{{$index}}" class="form-select @error('dependents.'.$index.'.dependent_parentage') is-invalid @enderror" wire:model="dependents.{{$index}}.dependent_parentage">
                    <option selected="">Selecione o parentesco</option>
                    <option value="avo">Avô(ó)</option>
                    <option value="conjuge">Cônjuge</option>
                    <option value="cunhado|cunhada">Cunhado(a)</option>
                    <option value="enteado|enteada">Enteado(a)</option>
                    <option value="filho|filha">Filho(a)</option>
                    <option value="genro|nora">Genro/Nora</option>
                    <option value="irmao|irma">Irmão(ã)</option>
                    <option value="mae">Mãe</option>
                    <option value="neto|neta">Neto(a)</option>
                    <option value="padastro|madrasta">Padrastro/Madrasta</option>
                    <option value="pai">Pai</option>
                    <option value="primo|prima">Primo(a)</option>
                    <option value="sobrinho|sobrinha">Sobrinho(a)</option>
                    <option value="sogro|sogra">Sogro(a)</option>
                    <option value="tio|tia">Tio(a)</option>
                  </select>
                  @error('dependents.'.$index.'.dependent_parentage') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3 col-md-6 col-xl-4 col-12">
                  <label class="form-label" for="dependent-occupation-{{$index}}">Ocupação</label>
                  <input type="text" id="dependent-occupation-{{$index}}" class="form-control @error('dependents.'.$index.'.dependent_occupation') is-invalid @enderror" wire:model="dependents.{{$index}}.dependent_occupation" placeholder="informe a ocupação">
                  @error('dependents.'.$index.'.dependent_occupation') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3 col-md-3 col-xl-2 col-6 form-check form-switch my-2">
                  <label class="form-label d-block" for="dependent-pne-{{$index}}">PNE</label>
                  <input id="dependent-pne-{{$index}}" class="form-check-input m-auto @error('dependents.'.$index.'.dependent_pne') is-invalid @enderror" type="checkbox" wire:model="dependents.{{$index}}.dependent_pne">
                  @error('dependents.'.$index.'.dependent_pne') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
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
            <button class="btn btn-outline-secondary" type="button" wire:click="back(3)">Voltar</button>
            <button class="btn btn-primary float-end" wire:click="fourthStepSubmit" type="button" >Próximo</button>
          </div>
        </div>
      </div>

      <div class="row setup-content {{ $currentStep != 5 ? 'd-none' : '' }}" id="step-5">
        <div class="col-12 title-step mb-3">
          <h4 class="m-0 text-primary">Renda familiar</h4>
          <p>Informe a renda mensal</p>
        </div>

        <div class="row">
          <div class="col-12 form-check form-switch mt-2 mb-4 pe-3 ps-3 d-flex align-items-center">
            <input id="noIncomes" class="form-check-input m-0" type="checkbox" wire:model="no_incomes" wire:change="noIncomes()"/>
            <label class="form-check-label ms-2" for="noIncomes">
              <span class="d-block">Não possuo renda</span>
              <small class="d-block text-secondary">não tenho nenhum tipo de renda mensal no momento</small>
            </label>
          </div>
        </div>

        <form class="form-repeater-incomes">
          <div data-repeater-list="group-a">
            <div data-repeater-item="">
              <div class="row">
                @foreach($incomes as $i => $income)
                  <div class="mb-3 col-lg-6 col-xl-6 col-12">
                    <label class="form-label" for="form-repeater-2-1">Origem da renda</label>
                    <input type="text" id="form-repeater-2-1" class="form-control @error('incomes.'.$i.'.name') is-invalid @enderror" wire:model="incomes.{{$i}}.name" placeholder="informe a origem da renda">
                    @error('incomes.'.$i.'.name') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
                  </div>
                  <div class="mb-3 {{($i != 0) ? 'col-lg-4 col-xl-4 col-sm-8' : 'col-lg-6 col-xl-6'}} col-12">
                    <label class="form-label" for="form-repeater-2-2">valor da renda</label>
                    <div class="input-group">
                      <span class="input-group-text">R$</span>
                      <input id="form-repeater-2-2" type="number" class="form-control @error('incomes.'.$i.'.value') is-invalid @enderror" wire:model="incomes.{{$i}}.value" placeholder="Digite o valor da renda (em reais)">
                      <span class="input-group-text">,00</span>
                      @error('incomes.'.$i.'.value') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                  </div>
                  @if($i != 0)
                    <div class="mb-3 col-md-3 col-xl-2 col-6 d-flex align-items-end">
                      <button class="btn btn-outline-danger w-100 mt-4" wire:click.prevent="removeIncome({{$i}})">
                        <i class="bx bx-x me-1"></i> Excluir
                      </button>
                    </div>
                  @endif
                  <hr class="my-2 pb-3">
                @endforeach
              </div>
            </div>
          </div>
          @if(!$no_incomes)
            <div class="mb-0">
              <button class="btn btn-outline-primary" wire:click.prevent="addIncome">
                <i class="tf-icons bx bx bx-add-to-queue me-1"></i>
                <span class="align-middle">Adicionar Renda</span>
              </button>
            </div>
          @else
            <div class="alert alert-info" role="alert">
              Por favor, esteja ciente de que ao selecionar a opção <b>'Não possuo renda'</b> você declara que atualmente não possui nenhuma fonte de renda declarável.<br><br>
              Se isso estiver correto, por favor prossiga para próxima etapa, caso contrário, revise sua seleção.
            </div>
          @endif
        </form>

        <div class="my-4">
          <div class="col-12">
            <button class="btn btn-outline-secondary" type="button" wire:click="back(4)">Voltar</button>
            <button class="btn btn-primary float-end" wire:click="fifthStepSubmit" type="button" >Próximo</button>
          </div>
        </div>
      </div>

      <div class="row setup-content {{ $currentStep != 6 ? 'd-none' : '' }}" id="step-6">
        <div class="col-12 title-step mb-3">
          <h4 class="m-0 text-primary">Saúde familiar e social</h4>
          <p>Informe o histórico médico e social</p>
        </div>

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

        <div class="my-4">
          <div class="col-12">
            <button class="btn btn-outline-secondary" type="button" wire:click="back(5)">Voltar</button>
            <button class="btn btn-primary float-end" wire:click="sixthStepSubmit" type="button" >Próximo</button>
          </div>
        </div>
      </div>

      <div class="row setup-content {{ $currentStep != 7 ? 'd-none' : '' }}" id="step-7">
        <div class="col-12 title-step mb-3">
          <h4 class="m-0 text-primary">Vincular voluntário</h4>
          <p>Vincule um voluntário para essa família</p>
        </div>

        <div class="col-12 mb-4">
          <label for="TagifyUserList" class="form-label">Pesquise pelo voluntário</label>
          <input id="TagifyUserList" name="TagifyUserList" class="form-control @error('continuous_medication') is-invalid @enderror" wire:model="continuous_medication" tabindex="-1">
          @error('voluntary_id') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
          <div class="alert alert-primary" role="alert">
            <span class="text-center">{nome do voluntário escolhido}</span>
          </div>
        </div>

        <div class="my-4">
          <div class="col-12">
            <button class="btn btn-outline-secondary" type="button" wire:click="back(6)">Voltar</button>
            <button class="btn btn-success float-end" wire:click="submitForm" type="button" >Salvar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
