@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Voluntários /</span> Cadastrar novo voluntário</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h4 class="card-header">Novo voluntário</h4>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md">
            <label for="nameVoluntary" class="form-label">Nome responsável</label>
            <input
              type="text"
              class="form-control"
              id="nameVoluntary"
              name=""
              placeholder="Nome completo"
            />
          </div>
          <div class="col-md">
            <label for="dtNascVoluntary" class="form-label">Data de nascimento</label>
            <input class="form-control" type="date" id="dtNascVoluntary" />
          </div>
          <div class="col-md">
            <label for="statusVoluntary" class="form-label">Status</label>
            <select class="form-select" id="statusVoluntary" name="" aria-label="status">
              <option selected value="1">Ativo</option>
              <option value="2">Inativo</option>
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md">
            <label for="cpfVoluntary" class="form-label">CPF</label>
            <input
              type="text"
              class="form-control"
              id="cpfVoluntary"
              name=""
              placeholder="999.999.999-99"
            />
          </div>
          <div class="col-md">
            <label for="telVoluntary" class="form-label">Telefone (Whatsapp)</label>
            <input
              type="tel"
              class="form-control"
              id="telVoluntary"
              name=""
              placeholder="(99)99999-9999"
            />
          </div>
          <div class="col-md">
            <label for="emailVoluntary" class="form-label">Email</label>
            <input
              type="email"
              class="form-control"
              id="emailVoluntary"
              placeholder="email@gmail.com"
            />
          </div>
          <div class="col-md">
            <label for="drivingVoluntary" class="form-label">Condução</label>
            <select class="form-select" id="drivingVoluntary" name="" aria-label="Condução">
              <option selected>Selecione sua condução</option>
              <option value="1">Moto</option>
              <option value="2">Carro</option>
              <option value="3">Picape</option>
            </select>
          </div>
        </div>

        <hr class="my-3">

        <div class="row mb-4">
          <div class="col-md-12 my-2">
            <h5><span class="tf-icons bx bx-home"></span>&nbsp; Endereço</h5>
          </div>
          <div class="col-md">
            <label for="cepAddressVoluntary" class="form-label">CEP</label>
            <input
              type="number"
              class="form-control"
              id="cepAddressVoluntary"
              name=""
              placeholder="99999-999"
            />
          </div>
          <div class="col-md">
            <label for="streetAddressVoluntary" class="form-label">Endereço</label>
            <input
              type="text"
              class="form-control"
              id="streetAddressVoluntary"
              name=""
              placeholder="Nome da rua ou avenida"
            />
          </div>
          <div class="col-md">
            <label for="numberAddressVoluntary" class="form-label">Número</label>
            <input
              type="text"
              class="form-control"
              id="numberAddressVoluntary"
              name=""
              placeholder="Número"
            />
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md">
            <label for="complementAddressVoluntary" class="form-label">Complemento</label>
            <input
              type="text"
              class="form-control"
              id="complementAddressVoluntary"
              name=""
              placeholder="Apartamento, suíte, sala, quadra, lote, etc."
            />
          </div>
          <div class="col-md">
            <label for="neighborhoodAddressVoluntary" class="form-label">Bairro</label>
            <input
              type="text"
              class="form-control"
              id="neighborhoodAddressVoluntary"
              name=""
              placeholder="Bairro"
            />
          </div>
          <div class="col-md">
            <label for="cityAddressVoluntary" class="form-label">Cidade</label>
            <input
              type="text"
              class="form-control"
              id="cityAddressVoluntary"
              name=""
              placeholder="Cidade"
            />
          </div>
          <div class="col-md">
            <label for="stateDependentVoluntary" class="form-label">Estado</label>
            <select class="form-select" id="stateDependentVoluntary" name="" aria-label="Estado">
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
              <h5 class="m-0"><span class="tf-icons bx bx-home-heart"></span>&nbsp; Assistidos vinculados</h5>
              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddAssisted">
                <span class="tf-icons bx bx-add-to-queue"></span>&nbsp; Adicionar Assistido
              </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalAddAssisted" tabindex="-1" style="display: none;" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Vincular Assistido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md mb-3">
                        <label for="searchAssisted" class="form-label">Pesquisar</label>
                        <input type="text" class="form-control" id="searchAssisted" placeholder="Busque por outros assistidos..." aria-describedby="searchAssistedControlHelp">
                        <div id="searchAssistedControlHelp" class="form-text">
                          Busque por pelo responsável pela família ou um de seus dependentes
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md mb-3">
                        <hr class="mb-3">
                        <p class="mb-4">Estes são os assistidos <span class="fw-bold">mais próximos</span> da casa do voluntário</p>
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
                                <span>Redenção</span>
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
                                <span>Estrela do Oriente</span>
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
          </div>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
              <tr class="text-nowrap">
                <th>#</th>
                <th>Nome</th>
                <th>Dependentes</th>
                <th>Bairro</th>
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
                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                        <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                data-bs-html="true"
                                title="<span>Pedro Fuller</span><small class='fw-light d-block'>4 anos<small>"

                        >
                            <span class="bx bx-male dependent-male dependent-icon"></span>
                        </li>
                        <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                data-bs-html="true"
                                title="<span>Christina Parker</span><small class='fw-light d-block'>3 anos<small>"
                        >
                            <span class="bx bx-female dependent-female dependent-icon"></span>
                        </li>
                        <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                data-bs-html="true"
                                title="<span>Sophia Wilkerson</span><small class='fw-light d-block'>3 anos<small>"
                        >
                            <span class="bx bx-female dependent-female dependent-icon"></span>
                        </li>
                        <li><small class="n-dependents">&nbsp;(3)</small></li>
                    </ul>
                </td>
                <td>
                    <span>Sul</span>
                </td>
                <td>
                    <span class="badge bg-label-success">Ativo</span>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalConfirmeUnbindAssisted">
                        <span class="tf-icons bx bx-user-x"></span>&nbsp; Desvincular assistido
                    </button>
                </td>-->
                <td colspan="6" class="text-center">
                  <span>Nenhum assistido vinculado</span>
                </td>
              </tr>
              <!--Modal-->
              <div class="modal fade" id="modalConfirmeUnbindAssisted" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalCenterTitle">Deseja desvincular assistido?</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p class="text-wrap">Tem certeza que deseja desvincular <span class="fw-bold">{Nome do assistido}</span> de <span class="fw-bold">{Nome do voluntário}</span>?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Fechar
                      </button>
                      <button type="button" class="btn btn-danger">Remover</button>
                    </div>
                  </div>
                </div>
              </div>
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
@endsection
