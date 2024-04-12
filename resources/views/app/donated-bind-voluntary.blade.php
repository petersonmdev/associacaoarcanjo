@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Voluntários /</span> Confiar doações</h4>

<div class="card">
  <h5 class="card-header">Confiar doações aos voluntários</h5>
  <div class="card-body">
    <div class="mb-3">
      <label for="searchVoluntary" class="form-label">Pesquisar</label>
      <input type="text" class="form-control" id="searchVoluntary" placeholder="Busque por um voluntário..." aria-describedby="searchVoluntaryHelp">
      <div id="searchVoluntaryHelp" class="form-text">
        Busque por um voluntário já cadastrado
      </div>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
        <tr>
          <th>Nome</th>
          <th>Telefone</th>
          <th>Último remessa</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        <tr>
          <td><strong>Fulano Ciclano</strong></td>
          <td>(99)99999-9999</td>
          <td>
            Junho/2023
          </td>
          <td>
            <div class="label-status">
              <span class="badge bg-label-warning">Entregas pendentes</span>
            </div>
          </td>
          <td>
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              <button type="button" class="btn btn-success" disabled>
                <span class="tf-icons bx bx-check"></span>&nbsp; Doações alocadas
              </button>
              <div class="btn-group" role="group">
                <button type="button" class="btn px-2 dropdown-toggle hide-arrow btn-outline-success" data-bs-toggle="dropdown">
                  <i class="bx bx-plus"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0)">
                    <i class="bx bx-list-ul me-1"></i> Ver histórico
                  </a>
                  <button type="button" class="dropdown-item btn" data-bs-toggle="modal" data-bs-target="#modalConfirmeRemoveDonated">
                    <i class="bx bx-trash me-1"></i> Remover doações alocadas
                  </button>
                </div>
              </div>
            </div>
            <!-- Modals -->
            <div class="modal fade" id="modalConfirmeRemoveDonated" style="display: none;" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Deseja remover?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p class="text-wrap">Tem certeza que deseja remover doações alocadas para <span class="fw-bold">{Nome do voluntário}</span>?</p>
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
          </td>
        </tr>
        <tr>
          <td><strong>Beltrano Ciclano</strong></td>
          <td>(99)99999-9999</td>
          <td>
            Maio/2023
          </td>
          <td>
            <div class="label-status">
              <span class="badge bg-label-primary">Sem doações alocadas</span>
            </div>
          </td>
          <td>
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddDonated">
                <span class="tf-icons bx bx-add-to-queue"></span>&nbsp; Confiar Doações
              </button>
              <div class="btn-group" role="group">
                <button type="button" class="btn px-2 dropdown-toggle hide-arrow btn-outline-primary" data-bs-toggle="dropdown">
                  <i class="bx bx-plus"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0)">
                    <i class="bx bx-list-ul me-1"></i> Ver histórico
                  </a>
                </div>
              </div>
            </div>
            <!-- Modals -->
            <div class="modal fade" id="modalAddDonated" tabindex="-1" style="display: none;" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Confiar doações à <small class="fw-light">{Nome do Voluntário}</small></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md mb-3">
                        <label for="tipyDonated" class="form-label">Tipo de doação</label>
                        <select class="form-select" id="tipyDonated" name="" aria-label="Tipo de doação">
                          <option selected>Selecione a doação</option>
                          <option value="1">Cesta básica</option>
                          <option value="2">Roupa usada</option>
                        </select>
                      </div>
                      <div class="col-md mb-3">
                        <label for="qtddDonated" class="form-label">Quantidade</label>
                        <input
                          type="number"
                          class="form-control"
                          id="qtddDonated"
                          name=""
                          placeholder="Qual a quanidade?"
                        />
                      </div>
                      <div class="col-md">
                        <label for="dtDonated" class="form-label">Data do recebimento</label>
                        <input class="form-control" type="date" id="dtDonated" />
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                      Fechar
                    </button>
                    <button type="button" class="btn btn-primary">Salvar</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td><strong>Fulano Ciclano</strong></td>
          <td>(99)99999-9999</td>
          <td>
            Junho/2023
          </td>
          <td>
            <div class="label-status">
              <span class="badge bg-label-info">Entregas em progresso</span>
            </div>
          </td>
          <td>
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              <button type="button" class="btn btn-success" disabled>
                <span class="tf-icons bx bx-check"></span>&nbsp; Doações alocadas
              </button>
              <div class="btn-group" role="group">
                <button type="button" class="btn px-2 dropdown-toggle hide-arrow btn-outline-success" data-bs-toggle="dropdown">
                  <i class="bx bx-plus"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0)">
                    <i class="bx bx-list-ul me-1"></i> Ver histórico
                  </a>
                  <button type="button" class="dropdown-item btn" data-bs-toggle="modal" data-bs-target="#modalConfirmeRemoveDonated">
                    <i class="bx bx-trash me-1"></i> Remover doações alocadas
                  </button>
                </div>
              </div>
            </div>
            <!-- Modals -->
            <div class="modal fade" id="modalConfirmeRemoveDonated" style="display: none;" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Deseja remover?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p class="text-wrap">Tem certeza que deseja remover doações alocadas para <span class="fw-bold">{Nome do voluntário}</span>?</p>
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
          </td>
        </tr>
        <tr>
          <td><strong>Ciclano Beltrano</strong></td>
          <td>(99)99999-9999</td>
          <td>
            Junho/2023
          </td>
          <td>
            <div class="label-status">
              <span class="badge bg-label-success">Completo</span>
            </div>
          </td>
          <td>
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              <button type="button" class="btn btn-success" disabled>
                <span class="tf-icons bx bx-check"></span>&nbsp; Doações alocadas
              </button>
              <div class="btn-group" role="group">
                <button type="button" class="btn px-2 dropdown-toggle hide-arrow btn-outline-success" data-bs-toggle="dropdown">
                  <i class="bx bx-plus"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0)">
                    <i class="bx bx-list-ul me-1"></i> Ver histórico
                  </a>
                  <button type="button" class="dropdown-item btn" data-bs-toggle="modal" data-bs-target="#modalConfirmeRemoveDonated">
                    <i class="bx bx-trash me-1"></i> Remover doações alocadas
                  </button>
                </div>
              </div>
            </div>
            <!-- Modals -->
            <div class="modal fade" id="modalConfirmeRemoveDonated" style="display: none;" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Deseja remover?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p class="text-wrap">Tem certeza que deseja remover doações alocadas para <span class="fw-bold">{Nome do voluntário}</span>?</p>
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
          </td>
        </tr>
        <tr>
          <td><strong>Cleitim da Silva</strong></td>
          <td>(99)99999-9999</td>
          <td>
            Maio/2023
          </td>
          <td>
            <div class="label-status">
              <span class="badge bg-label-primary">Sem doações alocadas</span>
            </div>
          </td>
          <td>
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddDonated">
                <span class="tf-icons bx bx-add-to-queue"></span>&nbsp; Confiar Doações
              </button>
              <div class="btn-group" role="group">
                <button type="button" class="btn px-2 dropdown-toggle hide-arrow btn-outline-primary" data-bs-toggle="dropdown">
                  <i class="bx bx-plus"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0)">
                    <i class="bx bx-list-ul me-1"></i> Ver histórico
                  </a>
                </div>
              </div>
            </div>
            <!-- Modals -->
            <div class="modal fade" id="modalAddDonated" tabindex="-1" style="display: none;" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Confiar doações à <small class="fw-light">{Nome do Voluntário}</small></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md mb-3">
                        <label for="tipyDonated" class="form-label">Tipo de doação</label>
                        <select class="form-select" id="tipyDonated" name="" aria-label="Tipo de doação">
                          <option selected>Selecione a doação</option>
                          <option value="1">Cesta básica</option>
                          <option value="2">Roupa usada</option>
                        </select>
                      </div>
                      <div class="col-md mb-3">
                        <label for="qtddDonated" class="form-label">Quantidade</label>
                        <input
                          type="number"
                          class="form-control"
                          id="qtddDonated"
                          name=""
                          placeholder="Qual a quanidade?"
                        />
                      </div>
                      <div class="col-md">
                        <label for="dtDonated" class="form-label">Data do recebimento</label>
                        <input class="form-control" type="date" id="dtDonated" />
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                      Fechar
                    </button>
                    <button type="button" class="btn btn-primary">Salvar</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td><strong>Pedrin da borracharia</strong></td>
          <td>(99)99999-9999</td>
          <td>
            Maio/2023
          </td>
          <td>
            <div class="label-status">
              <span class="badge bg-label-primary">Sem doações alocadas</span>
            </div>
          </td>
          <td>
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddDonated">
                <span class="tf-icons bx bx-add-to-queue"></span>&nbsp; Confiar Doações
              </button>
              <div class="btn-group" role="group">
                <button type="button" class="btn px-2 dropdown-toggle hide-arrow btn-outline-primary" data-bs-toggle="dropdown">
                  <i class="bx bx-plus"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0)">
                    <i class="bx bx-list-ul me-1"></i> Ver histórico
                  </a>
                </div>
              </div>
            </div>
            <!-- Modals -->
            <div class="modal fade" id="modalAddDonated" tabindex="-1" style="display: none;" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Confiar doações à <small class="fw-light">{Nome do Voluntário}</small></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md mb-3">
                        <label for="tipyDonated" class="form-label">Tipo de doação</label>
                        <select class="form-select" id="tipyDonated" name="" aria-label="Tipo de doação">
                          <option selected>Selecione a doação</option>
                          <option value="1">Cesta básica</option>
                          <option value="2">Roupa usada</option>
                        </select>
                      </div>
                      <div class="col-md mb-3">
                        <label for="qtddDonated" class="form-label">Quantidade</label>
                        <input
                          type="number"
                          class="form-control"
                          id="qtddDonated"
                          name=""
                          placeholder="Qual a quanidade?"
                        />
                      </div>
                      <div class="col-md">
                        <label for="dtDonated" class="form-label">Data do recebimento</label>
                        <input class="form-control" type="date" id="dtDonated" />
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                      Fechar
                    </button>
                    <button type="button" class="btn btn-primary">Salvar</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        </tbody>
      </table>
    </div>


    <div class="row">
      <div class="col-md-12 mt-5">
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li class="page-item first">
              <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-left"></i></a>
            </li>
            <li class="page-item prev">
              <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-left"></i></a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:void(0);">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:void(0);">2</a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="javascript:void(0);">3</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:void(0);">4</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:void(0);">5</a>
            </li>
            <li class="page-item next">
              <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-right"></i></a>
            </li>
            <li class="page-item last">
              <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-right"></i></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
@endsection
