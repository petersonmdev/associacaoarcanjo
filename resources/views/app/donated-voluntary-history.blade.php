@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Voluntários /</span> Historico de entregas</h4>
<div class="card">
  <h5 class="card-header">Historico de entregas de {nome do voluntário}</h5>
  <div class="card-body">
    <div class="mb-3">
      <p>Parabéns <span class="fw-bold">{nome do voluntário}</span>!</p>
      <p>Nos últimos {x} meses, você entregou <span class="fw-bold">{X}</span> cestas básicas. Ajudando <span class="fw-bold">{X}</span> pessoas de todas famílias assistidas que você é responsavel.</p>
    </div>
  </div>
</div>

<div class="row mt-3">
  <div class="col-md mb-4 mb-md-0">
    <small class="text-light fw-semibold">Histórico</small>
    <div class="accordion mt-3" id="accordionExample">
      <div class="card accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
            <table class="table card-table">
              <tbody class="table-border-bottom-0">
              <tr>
                <td><strong>Maio / 2023</strong></td>
                <td>4 Famílias</td>
                <td><span class="badge bg-label-warning me-1">Pendente</span></td>
              </tr>
              </tbody>
            </table>
          </button>
        </h2>

        <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
          <div class="accordion-body">
            <h5 class="card-header">Lista de famílias assistidos contempladas</h5>
            <div class="table-responsive text-nowrap">
              <table class="table table-hover">
                <thead>
                <tr>
                  <th>Nome</th>
                  <th>Data Recebimento</th>
                  <th>Dependentes</th>
                  <th>Status</th>
                  <th>Doação/Qtdd</th>
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
                        data-bs-html="true"
                        title="<span>Lilian Fuller</span><small class='fw-light d-block'>4 anos<small>"

                      >
                        <span class="bx bx-male dependent-male dependent-icon"></span>
                      </li>
                      <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        data-bs-html="true"
                        title="<span>Fulaninha</span><small class='fw-light d-block'>3 anos<small>"
                      >
                        <span class="bx bx-female dependent-female dependent-icon"></span>
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
                      <span class="n-dependents">&nbsp;(3)</span>
                    </ul>
                  </td>
                  <td>
                    <div class="label-status">
                      <span class="badge bg-label-primary">Entregue</span>
                    </div>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-info">Cesta básica / 1</span>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bxs-user-detail me-1"></i> Ver Cadastro
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bx-list-ul me-1"></i> Ver histórico
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
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
                        data-bs-html="true"
                        title="<span>Fulaninha</span><small class='fw-light d-block'>3 anos<small>"
                      >
                        <span class="bx bx-female dependent-female dependent-icon"></span>
                      </li>
                      <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        data-bs-html="true"
                        title="<span>Lilian Fuller</span><small class='fw-light d-block'>4 anos<small>"

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
                      <span class="n-dependents">&nbsp;(3)</span>
                    </ul>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-danger">Não Entregue</span>
                    </div>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-secondary">Não</span>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="">
                          <i class="bx bx-check me-1"></i> Entregue
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bxs-user-detail me-1"></i> Ver Cadastro
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bx-list-ul me-1"></i> Ver histórico
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
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
                        title="<span>Lilian Fuller</span><small class='fw-light d-block'>4 anos<small>"

                      >
                        <span class="bx bx-male dependent-male dependent-icon"></span>
                      </li>
                      <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        data-bs-html="true"
                        title="<span>Fulaninha</span><small class='fw-light d-block'>3 anos<small>"
                      >
                        <span class="bx bx-female dependent-female dependent-icon"></span>
                      </li>
                      <span class="n-dependents">&nbsp;(3)</span>
                    </ul>
                  </td>
                  <td>
                    <div class="label-status">
                      <span class="badge bg-label-primary">Entregue</span>
                    </div>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-info">Cesta básica / 1</span>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bxs-user-detail me-1"></i> Ver Cadastro
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bx-list-ul me-1"></i> Ver histórico
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
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
                        data-bs-html="true"
                        title="<span>Lilian Fuller</span><small class='fw-light d-block'>4 anos<small>"

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
                        title="<span>Fulaninha</span><small class='fw-light d-block'>3 anos<small>"
                      >
                        <span class="bx bx-female dependent-female dependent-icon"></span>
                      </li>
                      <span class="n-dependents">&nbsp;(3)</span>
                    </ul>
                  </td>
                  <td>
                    <div class="label-status">
                      <span class="badge bg-label-primary">Entregue</span>
                    </div>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-info">Cesta básica / 1</span>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bxs-user-detail me-1"></i> Ver Cadastro
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bx-list-ul me-1"></i> Ver histórico
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="card accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
            <table class="table card-table">
              <tbody class="table-border-bottom-0">
              <tr>
                <td><strong>Abril / 2023</strong></td>
                <td>4 Famílias</td>
                <td><span class="badge bg-label-primary me-1">Completo</span></td>
              </tr>
              </tbody>
            </table>
          </button>
        </h2>
        <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <h5 class="card-header">Lista de famílias assistidos contempladas</h5>
            <div class="table-responsive text-nowrap">
              <table class="table table-hover">
                <thead>
                <tr>
                  <th>Nome</th>
                  <th>Data Recebimento</th>
                  <th>Dependentes</th>
                  <th>Status</th>
                  <th>Doação/Qtdd</th>
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
                        data-bs-html="true"
                        title="<span>Lilian Fuller</span><small class='fw-light d-block'>4 anos<small>"

                      >
                        <span class="bx bx-male dependent-male dependent-icon"></span>
                      </li>
                      <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        data-bs-html="true"
                        title="<span>Fulaninha</span><small class='fw-light d-block'>3 anos<small>"
                      >
                        <span class="bx bx-female dependent-female dependent-icon"></span>
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
                      <span class="n-dependents">&nbsp;(3)</span>
                    </ul>
                  </td>
                  <td>
                    <div class="label-status">
                      <span class="badge bg-label-primary">Entregue</span>
                    </div>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-info">Cesta básica / 1</span>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bxs-user-detail me-1"></i> Ver Cadastro
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bx-list-ul me-1"></i> Ver histórico
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
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
                        data-bs-html="true"
                        title="<span>Fulaninha</span><small class='fw-light d-block'>3 anos<small>"
                      >
                        <span class="bx bx-female dependent-female dependent-icon"></span>
                      </li>
                      <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        data-bs-html="true"
                        title="<span>Lilian Fuller</span><small class='fw-light d-block'>4 anos<small>"

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
                      <span class="n-dependents">&nbsp;(3)</span>
                    </ul>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-primary">Entregue</span>
                    </div>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-info">Cesta básica / 1</span>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bxs-user-detail me-1"></i> Ver Cadastro
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bx-list-ul me-1"></i> Ver histórico
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
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
                        title="<span>Lilian Fuller</span><small class='fw-light d-block'>4 anos<small>"

                      >
                        <span class="bx bx-male dependent-male dependent-icon"></span>
                      </li>
                      <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        data-bs-html="true"
                        title="<span>Fulaninha</span><small class='fw-light d-block'>3 anos<small>"
                      >
                        <span class="bx bx-female dependent-female dependent-icon"></span>
                      </li>
                      <span class="n-dependents">&nbsp;(3)</span>
                    </ul>
                  </td>
                  <td>
                    <div class="label-status">
                      <span class="badge bg-label-primary">Entregue</span>
                    </div>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-info">Cesta básica / 1</span>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bxs-user-detail me-1"></i> Ver Cadastro
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bx-list-ul me-1"></i> Ver histórico
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
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
                        data-bs-html="true"
                        title="<span>Lilian Fuller</span><small class='fw-light d-block'>4 anos<small>"

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
                        title="<span>Fulaninha</span><small class='fw-light d-block'>3 anos<small>"
                      >
                        <span class="bx bx-female dependent-female dependent-icon"></span>
                      </li>
                      <span class="n-dependents">&nbsp;(3)</span>
                    </ul>
                  </td>
                  <td>
                    <div class="label-status">
                      <span class="badge bg-label-primary">Entregue</span>
                    </div>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-info">Cesta básica / 1</span>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bxs-user-detail me-1"></i> Ver Cadastro
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bx-list-ul me-1"></i> Ver histórico
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="card accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
            <table class="table card-table">
              <tbody class="table-border-bottom-0">
              <tr>
                <td><strong>Março / 2023</strong></td>
                <td>4 Famílias</td>
                <td><span class="badge bg-label-primary me-1">Completo</span></td>
              </tr>
              </tbody>
            </table>
          </button>
        </h2>
        <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-hover">
                <thead>
                <tr>
                  <th>Nome</th>
                  <th>Data Recebimento</th>
                  <th>Dependentes</th>
                  <th>Status</th>
                  <th>Doação/Qtdd</th>
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
                        data-bs-html="true"
                        title="<span>Lilian Fuller</span><small class='fw-light d-block'>4 anos<small>"

                      >
                        <span class="bx bx-male dependent-male dependent-icon"></span>
                      </li>
                      <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        data-bs-html="true"
                        title="<span>Fulaninha</span><small class='fw-light d-block'>3 anos<small>"
                      >
                        <span class="bx bx-female dependent-female dependent-icon"></span>
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
                      <span class="n-dependents">&nbsp;(3)</span>
                    </ul>
                  </td>
                  <td>
                    <div class="label-status">
                      <span class="badge bg-label-primary">Entregue</span>
                    </div>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-info">Cesta básica / 1</span>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bxs-user-detail me-1"></i> Ver Cadastro
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bx-list-ul me-1"></i> Ver histórico
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
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
                        data-bs-html="true"
                        title="<span>Fulaninha</span><small class='fw-light d-block'>3 anos<small>"
                      >
                        <span class="bx bx-female dependent-female dependent-icon"></span>
                      </li>
                      <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        data-bs-html="true"
                        title="<span>Lilian Fuller</span><small class='fw-light d-block'>4 anos<small>"

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
                      <span class="n-dependents">&nbsp;(3)</span>
                    </ul>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-primary">Entregue</span>
                    </div>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-info">Cesta básica / 1</span>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bxs-user-detail me-1"></i> Ver Cadastro
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bx-list-ul me-1"></i> Ver histórico
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
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
                        title="<span>Lilian Fuller</span><small class='fw-light d-block'>4 anos<small>"

                      >
                        <span class="bx bx-male dependent-male dependent-icon"></span>
                      </li>
                      <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        data-bs-html="true"
                        title="<span>Fulaninha</span><small class='fw-light d-block'>3 anos<small>"
                      >
                        <span class="bx bx-female dependent-female dependent-icon"></span>
                      </li>
                      <span class="n-dependents">&nbsp;(3)</span>
                    </ul>
                  </td>
                  <td>
                    <div class="label-status">
                      <span class="badge bg-label-primary">Entregue</span>
                    </div>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-info">Cesta básica / 1</span>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bxs-user-detail me-1"></i> Ver Cadastro
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bx-list-ul me-1"></i> Ver histórico
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
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
                        data-bs-html="true"
                        title="<span>Lilian Fuller</span><small class='fw-light d-block'>4 anos<small>"

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
                        title="<span>Fulaninha</span><small class='fw-light d-block'>3 anos<small>"
                      >
                        <span class="bx bx-female dependent-female dependent-icon"></span>
                      </li>
                      <span class="n-dependents">&nbsp;(3)</span>
                    </ul>
                  </td>
                  <td>
                    <div class="label-status">
                      <span class="badge bg-label-primary">Entregue</span>
                    </div>
                  </td>
                  <td>
                    <div class="label-donated">
                      <span class="badge bg-label-info">Cesta básica / 1</span>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bxs-user-detail me-1"></i> Ver Cadastro
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="bx bx-list-ul me-1"></i> Ver histórico
                        </a>
                      </div>
                    </div>
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
@endsection
