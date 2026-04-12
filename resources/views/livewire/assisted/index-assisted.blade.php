<div x-data>
  @livewireStyles
  <div class="mb-4 d-flex">
    <div class="d-none d-md-block col-md-4">
      <div class="row">
        <div class="col-4 list-per-page">
          <select id="perpage" wire:model.live="perpage" aria-controls="DataTables_Table_0" class="form-select">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
        </div>
        <div class="col-8 assisted-status">
          <select id="statusAssisted" wire:model.live="status_assisted" aria-controls="DataTables_Table_0" class="form-select">
            <option value="">Todos status</option>
            <option value="1">Ativo</option>
            <option value="0">Inativo</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-8 align-content-end">
      <div class="add-assisted">
        <a href="{{route('assisted-store')}}" class="btn btn-primary float-md-end">
          <i class="bx bx-plus me-md-1"></i>
          Adicionar Assistido
        </a>
      </div>
    </div>
  </div>

  <div class="mb-3 d-block">
    <div class="content-search">
      <label class="form-label" for="searchAssisted">Pesquise por um assistido</label>
      <input type="text" id="searchAssisted" wire:model.live="search" class="form-control" placeholder="Busque por um assistido...">
    </div>
  </div>
  @if ($search)
    <p class="text-primary">Nome pesquisado: {{ $search }}</p>
  @endif

  <hr>

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
        <tr wire:key="assisted-row-{{ $item->id }}">
          <td>
            <a wire:key="{{ $item->id }}" href="{{route('assisted-show', [ 'id' => $item->id ])}}">
              <span class="fw-medium">{{ '#'.sprintf('%04d', $item->id) }}</span>
            </a>
          </td>
          <td>
            <a href="{{route('assisted-show', [ 'id' => $item->id ])}}">
              <strong>{{ $item->name }}</strong>
            </a>
          </td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              @if ($item->dependents_info)
                @foreach(json_decode($item->dependents_info) as $dependent)
                  @php
                    $normalizedSex = strtoupper(trim((string) $dependent->sex));
                    $dependentSexClass = $normalizedSex === 'MASCULINO'
                      ? 'male'
                      : ($normalizedSex === 'FEMININO' ? 'female' : 'neutral');
                  @endphp
                  <li data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      class="avatar avatar-xs pull-up text-body"
                      title="{{ $dependent->name }}, {{ (int)date_diff(date_create($dependent->dob),date_create("today"))->y }} anos">
                    <span class="bx bx-xs bx-male dependent-{{$dependentSexClass}} dependent-icon"></span>
                  </li>
                @endforeach
                  <?php
                  $array = json_decode($item->dependents_info, true);
                  $numberOfElements = count($array);
                  ?>
                <li><small class="n-dependents">&nbsp;({{ $numberOfElements }})</small></li>
              @else
                <li><small class="n-dependents">&nbsp;(Sem dependentes)</small></li>
              @endif
            </ul>
          </td>
          <td>
            @if ($item->voluntary_name)
              <div class="d-flex justify-content-start align-items-center">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-2">
                      <?php
                      $works = explode(' ', $item->voluntary_name);
                      $firstName = \Illuminate\Support\Str::ascii($works[0] ?? '');
                      $secondName = \Illuminate\Support\Str::ascii($works[1] ?? '');
                      $initials = strtoupper(substr($firstName, 0, 1));
                      if (count($works) >=2) $initials .= strtoupper(substr($secondName, 0, 1));
                      ?>
                    <span class="avatar-initial rounded-circle bg-label-dark">{{$initials}}</span>
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="{{ route('voluntary-show', ['id' => $item->voluntary_id]) }}" class="text-body text-truncate">
                    <span class="fw-medium">{{$item->voluntary_name}}</span>
                  </a>
                  <small class="text-truncate text-muted">{{$item->voluntary_name ? "Ativo" : "Inativo"}}</small>
                </div>
              </div>
            @else
              <div class="d-block">
                <small class="fw-medium">nenhum voluntário vinculado</small>
              </div>
            @endif
          </td>
          <td>
            <div class="labels-status">
              <span class="badge bg-label-{{ $item->active ? 'primary' : 'danger' }}">{{ $item->active ? 'Ativo' : 'Inativo' }}</span>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <a href="{{route('assisted-update', [ 'id' => $item->id ])}}"
                 data-bs-toggle="tooltip"
                 class="text-body"
                 data-bs-placement="top"
                 aria-label="Editar cadastro"
                 data-bs-original-title="Editar cadastro">
                <i class='bx bx-edit fs-4'></i>
              </a>
              <a href="javascript:void(0);"
                 data-bs-toggle="modal"
                 class="text-body"
                 data-bs-target="#viewRegisterAssisted{{$item->id}}"
              >
                <i class="bx bx-show mx-2 fs-4"></i>
              </a>
              <a href="javascript:void(0);"
                 data-bs-toggle="modal"
                 class="text-body"
                 data-bs-target="#modalConfirmeRemoveAssisted{{$item->id}}"
              >
                <i class='bx bx-trash fs-4'></i>
              </a>
            </div>
          </td>
        </tr>

        {{-- Modals --}}
        <livewire:assisted.modals.delete-assisted :assistedRegister="$item" :key="'assisted-delete-'.$item->id" />
        <livewire:assisted.modals.view-assisted :assistedRegister="$item" :key="'assisted-view-'.$item->id" />
      @endforeach
      </tbody>
    </table>

    <div class="col-md-12 mt-5">
      {{ $assisted->links(data: ['scrollTo' => false]) }}
    </div>
  </div>
</div>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
