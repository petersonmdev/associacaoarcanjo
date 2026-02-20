<div x-data>
  @livewireStyles
  <style>
    .tooltip {
      position: absolute;
      z-index: 9999;
      opacity: 1;
      top: -5px;
      transform: translateY(calc(-50% - 5px));
      visibility: visible;
    }

    .tooltip-arrow {
      position: absolute;
      border-style: solid;
      border-width: 5px 5px 0 5px;
      border-color: #222 transparent transparent transparent;
      bottom: -5px;
      left: 50%;
      transform: translateX(-50%);
    }

    .tooltip-inner {
      background-color: #222;
      color: #fff;
      padding: 5px 10px;
      border-radius: 4px;
      font-size: 14px;
      margin: 0 auto;
    }
  </style>
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
        <tr>
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

{{--            <ul class="position-relative list-unstyled users-list m-0 avatar-group d-flex align-items-center" x-data="{tooltip:false}">--}}
{{--              @if ($item->dependents_info)--}}
{{--                @foreach(json_decode($item->dependents_info) as $dependent)--}}
{{--                  <li--}}
{{--                    class="bg-[#535353]"--}}
{{--                    x-on:mouseenter="tooltip=true"--}}
{{--                    x-on:mouseleave="tooltip=false">--}}
{{--                    <span class="bx bx-xs bx-male dependent-{{$dependent->sex === 'MASCULINO' ? 'male' : 'female'}} dependent-icon"></span>--}}
{{--                  </li>--}}
{{--                  <div x-show="tooltip" x-cloak>--}}
{{--                    <div class="tooltip bs-tooltip-top" role="tooltip">--}}
{{--                      <div class="tooltip-arrow"></div>--}}
{{--                      <div class="tooltip-inner">--}}
{{--                        <span>{{ $dependent->name .'-'. strtolower($dependent->sex)}}</span><small class="fw-light d-block">{{ (int)date_diff(date_create($dependent->dob),date_create("today"))->y . " anos de idade" }}</small>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                @endforeach--}}
{{--                  <?php--}}
{{--                  $array = json_decode($item->dependents_info, true);--}}
{{--                  $numberOfElements = count($array);--}}
{{--                  ?>--}}
{{--                <li><small class="n-dependents">&nbsp;({{ $numberOfElements }})</small></li>--}}
{{--              @else--}}
{{--                <li><small class="n-dependents">&nbsp;(Sem dependentes)</small></li>--}}
{{--              @endif--}}
{{--            </ul>--}}


{{--            <div class="relative" x-data="{tooltip:false}">--}}
{{--              <button--}}
{{--                type="button"--}}
{{--                class="btn btn-primary"--}}
{{--                x-on:mouseenter="tooltip=true"--}}
{{--                x-on:mouseleave="tooltip=false">--}}
{{--                Top--}}
{{--              </button>--}}
{{--              <div x-show="tooltip" x-cloak>--}}
{{--                <div class="tooltip bs-tooltip-top" role="tooltip">--}}
{{--                  <div class="tooltip-arrow"></div>--}}
{{--                  <div class="tooltip-inner">--}}
{{--                    <i class='bx bx-bell bx-xs'></i> <span>Tooltip on teste</span>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}

            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              @if ($item->dependents_info)
                @foreach(json_decode($item->dependents_info) as $dependent)
                  <li data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="top"
                      class="avatar avatar-xs pull-up text-body"
                      data-bs-html="true"
                      data-bs-original-title='<span>{{ $dependent->name .'-'. $dependent->sex}}</span><small class="fw-light d-block">{{ (int)date_diff(date_create($dependent->dob),date_create("today"))->y . " anos de idade" }}</small>'>
                    <span class="bx bx-xs bx-male dependent-{{$dependent->sex === 'MASCULINO' ? 'male' : 'female'}} dependent-icon"></span>
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
                      $initials = substr($works[0], 0, 1);
                      if (count($works) >=2) $initials .= substr($works[1], 0, 1);
                      ?>
                    <span class="avatar-initial rounded-circle bg-label-dark">{{$initials}}</span>
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="javascript:void(0);" class="text-body text-truncate">
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
{{--              <div class="dropdown">--}}
{{--                <a href="javascript:void(0);" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                  <i class="bx bx-dots-vertical-rounded"></i>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-end">--}}
{{--                  @if ($item->contacts_info)--}}
{{--                    @foreach(json_decode($item->contacts_info) as $contact)--}}
{{--                      <a href="https://api.whatsapp.com/send?phone=55{{preg_replace('/[^0-9]/', '', $contact->whatsapp)}}" target="_blank" class="dropdown-item">Falar com--}}
{{--                        {{$item->name}}</a>--}}
{{--                      <div class="dropdown-divider"></div>--}}
{{--                    @endforeach--}}
{{--                  @endif--}}
{{--                  <a href="javascript:void(0);"--}}
{{--                     class="dropdown-item delete-record text-danger"--}}
{{--                     data-bs-toggle="modal"--}}
{{--                     data-bs-target="#modalConfirmeRemoveAssisted{{$item->id}}">--}}
{{--                    Deletar--}}
{{--                  </a>--}}
{{--                </div>--}}
{{--              </div>--}}
            </div>
          </td>
        </tr>

        {{-- Modals --}}
        <livewire:assisted.modals.delete-assisted :assistedRegister="$item" lazy="on-load" />
        <livewire:assisted.modals.view-assisted :assistedRegister="$item" lazy="on-load" />
      @endforeach
      </tbody>
    </table>

    <div class="row">
      <div class="col-md-12 mt-5">
        {{ $assisted->links(data: ['scrollTo' => false]) }}
      </div>
    </div>
  </div>
</div>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Script para inicializar tooltips -->
<script>
  /*document.addEventListener('livewire:load', function () {
    console.log('testeeee')
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  });

  document.addEventListener('livewire:update', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  });*/
</script>
