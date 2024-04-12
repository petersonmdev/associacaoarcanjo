@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Usuários /</span> Todos usuários</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <h5 class="card-header">Lista de usuários cadastrados</h5>
      <div class="card-body">
        <div class="mb-3">
          <label for="searchUser" class="form-label">Pesquisar</label>
          <input type="text" class="form-control" id="searchUser" placeholder="Busque usuário...">
        </div>
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
            <tr>
              <th>Nome</th>
              <th>Telefone</th>
              <th>Cargo</th>
              <th>Último acesso</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            <tr>
              <td><strong>Fulano Ciclano</strong></td>
              <td>(99)99999-9999</td>
              <td>Voluntário</td>
              <td>99/99/9999 99:99:99</td>
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
              <td><strong>Fulano Ciclano</strong></td>
              <td>(99)99999-9999</td>
              <td>Voluntário</td>
              <td>99/99/9999 99:99:99</td>
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
              <td><strong>Fulano Ciclano</strong></td>
              <td>(99)99999-9999</td>
              <td>Secretária</td>
              <td>99/99/9999 99:99:99</td>
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
              <td><strong>Fulano Ciclano</strong></td>
              <td>(99)99999-9999</td>
              <td>Administrador</td>
              <td>99/99/9999 99:99:99</td>
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
              <td><strong>Fulano Ciclano</strong></td>
              <td>(99)99999-9999</td>
              <td>Administrador</td>
              <td>99/99/9999 99:99:99</td>
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
  </div>
</div>
@endsection
