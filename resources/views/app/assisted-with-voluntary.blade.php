@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Vincular assistidos /</span> Famílias não assistidas</h4>

<div class="card">
  <h5 class="card-header mb-3">Assistidos ainda não vinculados <small class="badge bg-secondary fs-tiny">6 / 1450</small></h5>
  <div class="card-body">
    <!-- Modal -->
    <div class="modal fade" id="modalAddVoluntary" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title w-100" id="modalCenterTitle">Vincular Voluntário</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md mb-3">
                <p class="mb-4">Estes são os voluntários <span class="fw-bold">mais próximos</span> de <span class="badge bg-label-primary">{Nome do Assistido}</span>, residente no bairro <span class="badge bg-label-primary">sul</span></p>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                    <tr class="text-nowrap">
                      <th>Nome</th>
                      <th>Bairro</th>
                      <th>Nº assistidos</th>
                      <th>Distância</th>
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
                        <span>15</span>
                      </td>
                      <td>
                        <span>1,2km</span>
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
                        <span>10</span>
                      </td>
                      <td>
                        <span>2,0km</span>
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
                        <span>8</span>
                      </td>
                      <td>
                        <span>3,1km</span>
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

            <hr class="mb-3">

            <div class="row">
              <div class="col-md mb-3">
                <label for="searchAssisted" class="form-label">Pesquisar por outros voluntários</label>
                <input type="text" class="form-control" id="searchAssisted" placeholder="Nome do voluntário...">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
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
        <tbody class="table-border-bottom-0">
        <tr>
          <th scope="row">1</th>
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
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddVoluntary">
              <span class="tf-icons bx bx-add-to-queue"></span>&nbsp; Vincular voluntário
            </button>
          </td>
        </tr>
        <tr>
          <th scope="row">2</th>
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
                title="<span>Sophia Wilkerson</span><small class='fw-light d-block'>3 anos<small>"
              >
                <span class="bx bx-female dependent-female dependent-icon"></span>
              </li>
              <li><small class="n-dependents">&nbsp;(3)</small></li>
            </ul>
          </td>
          <td>
            <span>Redenção</span>
          </td>
          <td>
            <span class="badge bg-label-success">Ativo</span>
          </td>
          <td>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddVoluntary">
              <span class="tf-icons bx bx-add-to-queue"></span>&nbsp; Vincular voluntário
            </button>
          </td>
        </tr>
        <tr>
          <th scope="row">3</th>
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
              <li><small class="n-dependents">&nbsp;(1)</small></li>
            </ul>
          </td>
          <td>
            <span>Oeste</span>
          </td>
          <td>
            <span class="badge bg-label-success">Ativo</span>
          </td>
          <td>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddVoluntary">
              <span class="tf-icons bx bx-add-to-queue"></span>&nbsp; Vincular voluntário
            </button>
          </td>
        </tr>
        <tr>
          <th scope="row">4</th>
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
              <li><small class="n-dependents">&nbsp;(3)</small></li>
            </ul>
          </td>
          <td>
            <span>Bairro Santuário</span>
          </td>
          <td>
            <span class="badge bg-label-success">Ativo</span>
          </td>
          <td>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddVoluntary">
              <span class="tf-icons bx bx-add-to-queue"></span>&nbsp; Vincular voluntário
            </button>
          </td>
        </tr>
        <tr>
          <th scope="row">5</th>
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
              <li><small class="n-dependents">&nbsp;(4)</small></li>
            </ul>
          </td>
          <td>
            <span>Vila Pai Eterno</span>
          </td>
          <td>
            <span class="badge bg-label-success">Ativo</span>
          </td>
          <td>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddVoluntary">
              <span class="tf-icons bx bx-add-to-queue"></span>&nbsp; Vincular voluntário
            </button>
          </td>
        </tr>
        <tr>
          <th scope="row">6</th>
          <td>
            <strong>Beltrano Ciclano</strong>
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
              <li><small class="n-dependents">&nbsp;(2)</small></li>
            </ul>
          </td>
          <td>
            <span>Sul</span>
          </td>
          <td>
            <span class="badge bg-label-success">Ativo</span>
          </td>
          <td>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddVoluntary">
              <span class="tf-icons bx bx-add-to-queue"></span>&nbsp; Vincular voluntário
            </button>
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
