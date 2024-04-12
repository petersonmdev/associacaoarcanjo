

<div>
  <div class="mb-3 d-flex">
    <div class="list-per-page me-2">
      <label>
        <select wire:model="perpage" aria-controls="DataTables_Table_0" class="form-select">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
      </label>
    </div>
    <div class="add-assisted me-2">
      <button type="button" class="btn btn-primary">
        <i class="bx bx-plus me-md-1"></i>
        Adicionar Assistido
      </button>
    </div>
    <div class="content-search">
      <input type="text" wire:model.debounce.300ms="search" class="form-control" id="searchAssisted" placeholder="Busque por um assistido...">
    </div>
    <div class="assisted-status me-2">
      <label>
        <select wire:model="status_assisted" aria-controls="DataTables_Table_0" class="form-select">
          <option value="1">Todos status</option>
          <option value="1">Ativo</option>
          <option value="0">Inativo</option>
        </select>
      </label>
    </div>
  </div>

  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Dependentes</th>
        <th>Voluntário responsável</th>
        <th>Status</th>
        <th>Ações</th>
      </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      @foreach ($assisted as $item)
        <tr>
          <td>
            <a wire:key="{{ $item->id }}" href="javascript:void(0);"><span class="fw-medium">{{ '#'.sprintf('%04d', $item->id) }}</span></a>
          </td>
          <td>
            <strong>{{ $item->name }}</strong>
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
            <div class="d-flex justify-content-start align-items-center">
              <div class="avatar-wrapper">
                <div class="avatar avatar-sm me-2">
                  <span class="avatar-initial rounded-circle bg-label-dark">ES</span>
                </div>
              </div>
              <div class="d-flex flex-column">
                <a href="javascript:void(0);" class="text-body text-truncate">
                  <span class="fw-medium">Etelvina Simone</span>
                </a>
                <small class="text-truncate text-muted">ativo</small>
              </div>
            </div>
          </td>
          <td>
            <div class="labels-status">
              <span class="badge bg-label-{{ $item->active=1 ? 'primary' : 'danger' }}">{{ $item->active=1 ? 'Ativo' : 'Inativo' }}</span>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <a href="javascript:void(0);" data-bs-toggle="tooltip" class="text-body" data-bs-placement="top" aria-label="Send Mail" data-bs-original-title="Send Mail">
                <i class='bx bx-edit-alt'></i>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" class="text-body" data-bs-placement="top" aria-label="Preview Invoice" data-bs-original-title="Preview Invoice">
                <i class="bx bx-show mx-1"></i>
              </a>
              <div class="dropdown">
                <a href="javascript:void(0);" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                  <a href="javascript:void(0);" class="dropdown-item">Falar com Voluntário</a>
                  <a href="javascript:void(0);" class="dropdown-item">Falar com assistido</a>
                  <div class="dropdown-divider"></div>
                  {{--<button wire:click="delete({{ $item->id }})">Delete</button>--}}
                  <a href="javascript:void(0);" class="dropdown-item delete-record text-danger" data-bs-toggle="modal" data-bs-target="#modalConfirmeRemoveAssisted">Deletar</a>
                </div>
              </div>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>

    <!-- Modals -->
    <div class="modal fade" id="modalConfirmeRemoveAssisted" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Deseja remover?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-wrap">Tem certeza que deseja remover o cadastro de <span class="fw-bold">{Nome do assistido}</span>?</p>
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
  </div>


  <div class="row">
    <div class="col-md-12 mt-5">
      <nav aria-label="Page navigation">
        {{ $assisted->links() }}
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
