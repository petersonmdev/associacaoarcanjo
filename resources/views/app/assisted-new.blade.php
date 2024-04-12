@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastrar nova família assistida')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Assistidos /</span> Cadastrar novo assistido</h4>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

  <div class="d-flex flex-column justify-content-center">
    <h4 class="mb-1 mt-3">Novo assistido</h4>
    <p class="text-muted">Cadastre uma nova família assistida</p>
  </div>
  <div class="d-flex align-content-center flex-wrap gap-3">
    <a href="{{url()->previous()}}" class="btn btn-label-secondary">Voltar</a>
    <a href="{{route('assisted-list')}}" class="btn btn-primary">
      <i class="bx bx-list-ul me-2"></i> Todos assistidos</a>
  </div>

</div>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-body">
        <livewire:assisted-multi-step-form />
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card mb-4">
      <h4 class="card-header">Nova família</h4>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md">
            <label for="nameAssisted" class="form-label">Nome responsável</label>
            <input
              type="text"
              class="form-control"
              id="nameAssisted"
              name=""
              placeholder="Nome completo"
            />
          </div>
          <div class="col-md">
            <label for="dtNascAssisted" class="form-label">Data de nascimento</label>
            <input class="form-control" type="date" id="dtNascAssisted" />
          </div>
          <div class="col-md">
            <label for="statusAssisted" class="form-label">Status</label>
            <select class="form-select" id="statusAssisted" name="" aria-label="status">
              <option selected value="1">Ativo</option>
              <option value="2">Inativo</option>
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md">
            <label for="cpfAssisted" class="form-label">CPF</label>
            <input
              type="text"
              class="form-control"
              id="cpfAssisted"
              name=""
              placeholder="999.999.999-99"
            />
          </div>
          <div class="col-md">
            <label for="maritalStatusAssisted" class="form-label">Estado civil</label>
            <select class="form-select" id="maritalStatusAssisted" name="" aria-label="Estado civil">
              <option selected>Selecione seu estado civil</option>
              <option value="1">Solteiro(a)</option>
              <option value="2">União estável</option>
              <option value="3">Casado(a)</option>
              <option value="4">Divorciado(a)</option>
            </select>
          </div>
          <div class="col-md">
            <label for="schoolingAssisted" class="form-label">Escolaridade</label>
            <select class="form-select" id="schoolingAssisted" name="" aria-label="Escolaridade">
              <option selected>Selecione sua escolaridade</option>
              <option value="1">Ensino básico</option>
              <option value="2">Fundamental</option>
              <option value="3">Ensino médio</option>
              <option value="4">Superior (Graduação)</option>
              <option value="5">Pós-graduação</option>
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md">
            <label for="occupationAssisted" class="form-label">Profissão</label>
            <input
              type="text"
              class="form-control"
              id="occupationAssisted"
              name=""
              placeholder="Ocupação"
            />
            <div class="form-check form-switch my-2">
              <input class="form-check-input" type="checkbox" id="joblessAssisted" />
              <label class="form-check-label" for="joblessAssisted">Desempregado</label>
            </div>
          </div>
          <div class="col-md">
            <label for="emailAssisted" class="form-label">Email</label>
            <input
              type="email"
              class="form-control"
              id="emailAssisted"
              placeholder="email@gmail.com"
            />
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md">
            <label for="telAssisted" class="form-label">Telefone (Whatsapp)</label>
            <input
              type="tel"
              class="form-control"
              id="telAssisted"
              name=""
              placeholder="(99)99999-9999"
            />
          </div>
          <div class="col-md">
            <label for="telOpc1Assisted" class="form-label">Telefone (opcional)</label>
            <input
              type="tel"
              class="form-control"
              id="telOpc1Assisted"
              name=""
              placeholder="(99)99999-9999"
            />
          </div>
          <div class="col-md">
            <label for="telOpc2Assisted" class="form-label">Telefone (opcional)</label>
            <input
              type="tel"
              class="form-control"
              id="telOpc2Assisted"
              name=""
              placeholder="(99)99999-9999"
            />
          </div>
        </div>

        <hr class="my-3">

        <div class="row mb-4">
          <div class="col-md-12 my-2">
            <h5><span class="tf-icons bx bx-home"></span>&nbsp; Endereço</h5>
          </div>
          <div class="col-md">
            <label for="cepAddressAssisted" class="form-label">CEP</label>
            <input
              type="number"
              class="form-control"
              id="cepAddressAssisted"
              name=""
              placeholder="99999-999"
            />
          </div>
          <div class="col-md">
            <label for="streetAddressAssisted" class="form-label">Endereço</label>
            <input
              type="text"
              class="form-control"
              id="streetAddressAssisted"
              name=""
              placeholder="Nome da rua ou avenida"
            />
          </div>
          <div class="col-md">
            <label for="numberAddressAssisted" class="form-label">Número</label>
            <input
              type="text"
              class="form-control"
              id="numberAddressAssisted"
              name=""
              placeholder="Número"
            />
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md">
            <label for="complementAddressAssisted" class="form-label">Complemento</label>
            <input
              type="text"
              class="form-control"
              id="complementAddressAssisted"
              name=""
              placeholder="Apartamento, suíte, sala, quadra, lote, etc."
            />
          </div>
          <div class="col-md">
            <label for="neighborhoodAddressAssisted" class="form-label">Bairro</label>
            <input
              type="text"
              class="form-control"
              id="neighborhoodAddressAssisted"
              name=""
              placeholder="Bairro"
            />
          </div>
          <div class="col-md">
            <label for="cityAddressAssisted" class="form-label">Cidade</label>
            <input
              type="text"
              class="form-control"
              id="cityAddressAssisted"
              name=""
              placeholder="Cidade"
            />
          </div>
          <div class="col-md">
            <label for="stateDependentAssisted" class="form-label">Estado</label>
            <select class="form-select" id="stateDependentAssisted" name="" aria-label="Estado">
              <option selected>Selecione o estado</option>
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
          </div>
        </div>

        <hr class="my-3">

        <div class="row mb-4">
          <div class="col-md-12 my-2">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 class="m-0"><span class="tf-icons bx bx-user-plus"></span>&nbsp; Composição familiar</h5>
            </div>
          </div>
          <form class="form-repeater">
            <div data-repeater-list="group-a">
              <div data-repeater-item="">
                <div class="row">
                  <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                    <label class="form-label" for="form-repeater-1-1">Nome</label>
                    <input type="text" id="form-repeater-1-1" class="form-control" placeholder="informe completo">
                  </div>
                  <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                    <label class="form-label" for="form-repeater-1-2">Idade</label>
                    <input type="number" id="form-repeater-1-2" class="form-control" placeholder="informe a idade">
                  </div>
                  <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                    <label class="form-label" for="form-repeater-1-3">Sexo</label>
                    <select id="form-repeater-1-3" class="form-select">
                      <option selected="">Selecione o sexo</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Feminino">feminino</option>
                    </select>
                  </div>
                  <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                    <label class="form-label" for="form-repeater-1-4">Profession</label>
                    <select id="form-repeater-1-4" class="form-select">
                      <option selected="">Selecione o parentesco</option>
                      <option value="Pai">Pai</option>
                      <option value="Mae">Mãe</option>
                      <option value="Avo">Avô(ó)</option>
                      <option value="Filho">filho(a)</option>
                      <option value="Sobrinho">sobrinho(a)</option>
                      <option value="Primo">primo(a)</option>
                    </select>
                  </div>
                  <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                    <label class="form-label" for="form-repeater-1-5">Ocupação</label>
                    <input type="text" id="form-repeater-1-5" class="form-control" placeholder="informe a ocupação">
                  </div>
                  <div class="mb-3 col-lg-6 col-xl-1 col-12 mb-0 form-check form-switch my-2">
                    <label class="form-label d-block" for="form-repeater-1-6">PNE</label>
                    <input id="form-repeater-1-6" class="form-check-input m-auto" type="checkbox" >
                  </div>
                  <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
                    <button class="btn btn-outline-danger mt-4" data-repeater-delete="">
                      <i class="bx bx-x me-1"></i>
                    </button>
                  </div>
                </div>
                <hr>
              </div>
            </div>
            <div class="mb-0">
              <button class="btn btn-outline-primary" data-repeater-create="">
                <i class="tf-icons bx bx bx-add-to-queue me-1"></i>
                <span class="align-middle">Adicionar mais dependentes</span>
              </button>
            </div>
          </form>
        </div>

        <hr class="my-3">

        <div class="row mb-4">
          <div class="col-md-12 my-2">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 class="m-0"><span class="tf-icons bx bx-money"></span>&nbsp; Renda familiar</h5>
            </div>
          </div>
          <form class="form-repeater">
            <div data-repeater-list="group-a">
              <div data-repeater-item="">
                <div class="row">
                  <div class="mb-3 col-lg-6 col-xl-6 col-12 mb-0">
                    <label class="form-label" for="form-repeater-2-1">Origem da renda</label>
                    <input type="text" id="form-repeater-2-1" class="form-control" placeholder="informe a origem da renda">
                  </div>
                  <div class="mb-3 col-lg-6 col-xl-5 col-12 mb-0">
                    <label class="form-label" for="form-repeater-2-2">valor</label>
                    <div class="input-group">
                      <span class="input-group-text">R$</span>
                      <input id="form-repeater-2-2" type="number" class="form-control"  placeholder="Digite o valor" aria-label="Valor (em reais)">
                      <span class="input-group-text">,00</span>
                    </div>
                  </div>
                  <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
                    <button class="btn btn-outline-danger mt-4" data-repeater-delete="">
                      <i class="bx bx-x me-1"></i>
                    </button>
                  </div>
                </div>
                <hr>
              </div>
            </div>
            <div class="mb-0">
              <button class="btn btn-outline-primary" data-repeater-create="">
                <span class="tf-icons bx bx bx-add-to-queue"></span>
                <span class="align-middle">Adicionar Renda</span>
              </button>
            </div>
          </form>
        </div>

        <hr class="my-3">

        <div class="row mb-4">
          <div class="col-md-12 my-2">
            <h5><span class="tf-icons bx bx-message-square-dots"></span>&nbsp; Social</h5>
          </div>
          <div class="col-md">
            <label for="socialAssisted" class="form-label">Sua breve história de vida</label>
            <textarea
              class="form-control"
              id="socialAssisted"
              name=""
              placeholder="Conte um pouco da sua história"
              aria-describedby="socialAssistedHelp"></textarea>
            <div id="socialAssistedHelp" class="form-text">
              De onde veio, como estão vivendo, dificuldades
            </div>
          </div>
        </div>

        <hr class="my-3">

        <div class="row mb-4">
          <div class="col-md-12 my-2">
            <h5><span class="tf-icons bx bx-capsule"></span>&nbsp; Saúde</h5>
          </div>
          <div class="col-md">
            <label for="medicineAssisted" class="form-label">Histórico de saúde</label>
            <textarea
              class="form-control"
              id="medicineAssisted"
              name=""
              placeholder="Conte um breve histórico dos membros da família"
              aria-describedby="socialAssistedHelp"></textarea>
            <div id="socialAssistedHelp" class="form-text">
              Doenças, cirurgias feitas ou a fazer
            </div>
          </div>
          <div class="col-md">
            <label for="continuousMedicineAssisted" class="form-label">Medicamentos de uso contínuo</label>
            <textarea
              class="form-control"
              id="continuousMedicineAssisted"
              name=""
              placeholder="Quais medicamentos são de uso contínuo?"></textarea>
          </div>
        </div>

        <hr class="my-3">

        <div class="row mb-4">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="m-0"><span class="tf-icons bx bxs-face"></span>&nbsp; Voluntário responsável</h5>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddVoluntaryToAssisted">
              <span class="tf-icons bx bx bx-add-to-queue"></span>&nbsp; Vincular voluntário
            </button>
          </div>
          <!-- Modals -->
          <div class="modal fade" id="modalAddVoluntaryToAssisted" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalCenterTitle">Vincule um voluntário a este assistido</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md mb-3">
                      <label for="searchVoluntary" class="form-label">Pesquisar</label>
                      <input type="text" class="form-control" id="searchVoluntary" placeholder="Busque por outros voluntários...">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md mb-3">
                      <hr class="mb-3">
                      <p class="mb-4">Estes são os voluntários que moram <span class="fw-bold">mais próximos</span> da casa da família assistida</p>
                      <div class="table-responsive text-nowrap">
                        <table class="table">
                          <thead>
                          <tr class="text-nowrap">
                            <th>Nome</th>
                            <th>Bairro</th>
                            <th>Ações</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td>
                              <strong>Fulano Ciclano</strong>
                            </td>
                            <td>
                              <span>Sul</span>
                            </td>
                            <td>
                              <button type="button" class="btn btn-outline-primary">
                                <span class="tf-icons bx bx-user-check"></span>&nbsp;Vincular
                              </button>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <strong>Beltrano Ciclano</strong>
                            </td>
                            <td>
                              Redenção
                            </td>
                            <td>
                              <button type="button" class="btn btn-outline-primary">
                                <span class="tf-icons bx bx-user-check"></span>&nbsp;Vincular
                              </button>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <strong>Silva Silva</strong>
                            </td>
                            <td>
                              Estrela do Oriente
                            </td>
                            <td>
                              <button type="button" class="btn btn-outline-primary">
                                <span class="tf-icons bx bx-user-check"></span>&nbsp;Vincular
                              </button>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
              <tr class="text-nowrap">
                <th>#</th>
                <th>Nome</th>
                <th>Bairros de atuação</th>
                <th>Nº de Assistidos</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <!--<th scope="row">1</th>
                <td>
                    <strong>Fulano Ciclano</strong>
                </td>
                <td>
                    <div class="labels-neneighborhood">
                        <span class="badge bg-label-primary">Sul</span>
                        <span class="badge bg-label-primary">Oeste</span>
                        <span class="badge bg-label-primary">Redenção</span>
                        <span class="badge bg-label-primary">Estrela do Oriente</span>
                    </div>
                </td>
                <td>
                    <span>15</span>
                </td>
                <td>
                    <span class="badge bg-label-success">Ativo</span>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalAddVoluntaryToAssisted">
                        <span class="tf-icons bx bx-revision"></span>&nbsp; Substituir Voluntário
                    </button>
                </td>-->
                <td colspan="6" class="text-center">
                  <span>Nenhum voluntário cadastrado</span>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row mt-3">
          <div class="col-md">
            <button type="button" class="btn btn-primary">Salvar</button>
            <button type="button" class="btn btn-outline-secondary">Voltar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@livewireScripts
@endsection
