@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Voluntários /</span> Todas voluntários</h4>

<div class="card">
  <h5 class="card-header">Lista de voluntários</h5>
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
          <th>Bairros de atuação</th>
          <th>Nº de Assistidos</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        <tr>
          <td><strong>Fulano Ciclano</strong></td>
          <td>(99)99999-9999</td>
          <td>
            <div class="labels-neneighborhood">
              <span class="badge bg-label-primary">Vila pai eterno</span>
              <span class="badge bg-label-primary">Samara</span>
            </div>
          </td>
          <td>
            25
          </td>
          <td>
            <div class="labels-status">
              <span class="badge bg-label-primary">Ativo</span>
            </div>
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="bx bx-edit-alt me-1"></i> Editar
                </a>
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="bx bxs-map-alt me-1"></i> Roterizar
                </a>
                <a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalConfirmeRemoveVoluntary">
                  <i class="bx bx-trash me-1"></i> Deletar
                </a>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td><strong>Ciclano da Silva</strong></td>
          <td>(99)99999-9999</td>
          <td>
            <div class="labels-neneighborhood">
              <span class="badge bg-label-primary">Centro</span>
              <span class="badge bg-label-primary">Oeste</span>
              <span class="badge bg-label-primary">Decolores</span>
            </div>
          </td>
          <td>
            10
          </td>
          <td>
            <div class="labels-status">
              <span class="badge bg-label-primary">Ativo</span>
            </div>
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="bx bx-edit-alt me-1"></i> Editar
                </a>
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="bx bxs-map-alt me-1"></i> Roterizar
                </a>
                <a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalConfirmeRemoveVoluntary">
                  <i class="bx bx-trash me-1"></i> Deletar
                </a>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td><strong>Beltrano Souza</strong></td>
          <td>(99)99999-9999</td>
          <td>
            <div class="labels-neneighborhood">
              <span class="badge bg-label-primary">Sul</span>
              <span class="badge bg-label-primary">Oeste</span>
              <span class="badge bg-label-primary">Redenção</span>
              <span class="badge bg-label-primary">Estrela do Oriente</span>
            </div>
          </td>
          <td>
            0
          </td>
          <td>
            <div class="labels-status">
              <span class="badge bg-label-danger">Inativo</span>
            </div>
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="bx bx-edit-alt me-1"></i> Editar
                </a>
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="bx bxs-map-alt me-1"></i> Roterizar
                </a>
                <a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalConfirmeRemoveVoluntary">
                  <i class="bx bx-trash me-1"></i> Deletar
                </a>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <strong>Silva da Silva</strong>
          </td>
          <td>(99)99999-9999</td>
          <td>
            <div class="labels-neneighborhood">
              <span class="badge bg-label-primary">Pontakayana</span>
            </div>
          </td>
          <td>
            15
          </td>
          <td>
            <div class="labels-status">
              <span class="badge bg-label-primary">Ativo</span>
            </div>
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="bx bx-edit-alt me-1"></i> Editar
                </a>
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="bx bxs-map-alt me-1"></i> Roterizar
                </a>
                <a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalConfirmeRemoveVoluntary">
                  <i class="bx bx-trash me-1"></i> Deletar
                </a>
              </div>
            </div>
          </td>
        </tr>
        </tbody>
      </table>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="modalConfirmeRemoveVoluntary" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Deseja remover?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-wrap">Tem certeza que deseja remover o cadastro de <span class="fw-bold">{Nome do voluntário}</span>?</p>
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
