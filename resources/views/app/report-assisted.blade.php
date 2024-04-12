@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Assistidos /</span> Todas famílias assistidas</h4>

<div class="card">
  <h5 class="card-header">Lista de famílias assistidos</h5>
  <div class="card-body">
    <div class="mb-3">
      <label for="searchAssisted" class="form-label">Pesquisar</label>
      <input type="text" class="form-control" id="searchAssisted" placeholder="Busque por um assistido..." aria-describedby="searchAssistedControlHelp">
      <div id="searchAssistedControlHelp" class="form-text">
        Busque por pelo responsável pela família ou um de seus dependentes
      </div>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
        <tr>
          <th>Nome</th>
          <th>Ultimo auxílio recebido</th>
          <th>Dependentes</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        <tr>
          <td><strong>Fulano Ciclano</strong></td>
          <td>99/99/9999</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Lilian Fuller"
              >
                <img src="assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Sophia Wilkerson"
              >
                <img src="assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Christina Parker"
              >
                <img src="assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
              </li>
            </ul>
          </td>
          <td>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="statusAssisted" checked="checked">
              <label for="statusAssisted">Ativo</label>
            </div>
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"
                ><i class="bx bx-edit-alt me-1"></i> Editar</a
                >
                <a class="dropdown-item" href="javascript:void(0);"
                ><i class="bx bx-trash me-1"></i> Deletar</a
                >
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td><strong>Ciclano da Silva</strong></td>
          <td>99/99/9999</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Lilian Fuller"
              >
                <img src="assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Sophia Wilkerson"
              >
                <img src="assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Christina Parker"
              >
                <img src="assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
              </li>
            </ul>
          </td>
          <td>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="statusAssisted" checked="checked">
              <label for="statusAssisted">Ativo</label>
            </div>
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"
                ><i class="bx bx-edit-alt me-1"></i> Editar</a
                >
                <a class="dropdown-item" href="javascript:void(0);"
                ><i class="bx bx-trash me-1"></i> Deletar</a
                >
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td><strong>Beltrano Souza</strong></td>
          <td>99/99/9999</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Lilian Fuller"
              >
                <img src="assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Sophia Wilkerson"
              >
                <img src="assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Christina Parker"
              >
                <img src="assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
              </li>
            </ul>
          </td>
          <td>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="statusAssisted">
              <label for="statusAssisted">Inativo</label>
            </div>
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"
                ><i class="bx bx-edit-alt me-1"></i> Editar</a
                >
                <a class="dropdown-item" href="javascript:void(0);"
                ><i class="bx bx-trash me-1"></i> Deletar</a
                >
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <strong>Silva da Silva</strong>
          </td>
          <td>99/99/9999</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Lilian Fuller"
              >
                <img src="assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Sophia Wilkerson"
              >
                <img src="assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
              </li>
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="Christina Parker"
              >
                <img src="assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
              </li>
            </ul>
          </td>
          <td>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="statusAssisted" checked="checked">
              <label for="statusAssisted">Ativo</label>
            </div>
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"
                ><i class="bx bx-edit-alt me-1"></i> Editar</a
                >
                <a class="dropdown-item" href="javascript:void(0);"
                ><i class="bx bx-trash me-1"></i> Deletar</a
                >
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
