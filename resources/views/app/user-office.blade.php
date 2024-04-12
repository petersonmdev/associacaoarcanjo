@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Usuários /</span> Novo cargo</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Novo cargo</h5>
      <div class="card-body">
        <form id="formAccountSettings" method="POST" onsubmit="return false">
          <div class="row">
            <div class="mb-3 col-md">
              <label for="userNameRole" class="form-label">Nome do cargo</label>
              <input
                class="form-control"
                type="text"
                id="userNameRole"
                name=""
                placeholder="Seu nome"
                autofocus
              />
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-12 my-2">
              <h5><span class="tf-icons bx bx-lock-alt"></span>&nbsp; Permissões</h5>
            </div>
            <div class="col-md">
              <div class="table-responsive">
                <table class="table table-striped table-borderless border-bottom">
                  <thead>
                  <tr>
                    <th class="text-nowrap text-center" colspan="2">Assistidos</th>
                    <th class="text-nowrap text-center" colspan="2">Voluntários</th>
                    <th class="text-nowrap text-center" colspan="2">Doações</th>
                    <th class="text-nowrap text-center" rowspan="2">Roteirização</th>
                    <th class="text-nowrap text-center" rowspan="2">Vincular assistidos</th>
                    <th class="text-nowrap text-center" rowspan="2">Relatórios</th>
                  </tr>
                  <tr>
                    <th class="text-nowrap text-center">Ler</th>
                    <th class="text-nowrap text-center">Gravar</th>
                    <th class="text-nowrap text-center">Ler</th>
                    <th class="text-nowrap text-center">Gravar</th>
                    <th class="text-nowrap text-center">Ler</th>
                    <th class="text-nowrap text-center">Gravar</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>
                      <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" id="defaultCheck1" checked />
                      </div>
                    </td>
                    <td>
                      <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" id="defaultCheck2" checked />
                      </div>
                    </td>
                    <td>
                      <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" id="defaultCheck3" checked />
                      </div>
                    </td>
                    <td>
                      <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" id="defaultCheck4" checked />
                      </div>
                    </td>
                    <td>
                      <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" id="defaultCheck5" checked />
                      </div>
                    </td>
                    <td>
                      <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" id="defaultCheck6" checked />
                      </div>
                    </td>
                    <td>
                      <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" id="defaultCheck7" checked />
                      </div>
                    </td>
                    <td>
                      <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" id="defaultCheck8" checked />
                      </div>
                    </td>
                    <td>
                      <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" id="defaultCheck9" checked />
                      </div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Salvar</button>
            <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
@endsection
