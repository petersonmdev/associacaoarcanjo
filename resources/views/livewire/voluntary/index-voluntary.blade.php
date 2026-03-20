<div x-data>
  @livewireStyles
    <div class="mb-4 d-flex">
    <div class="d-none d-md-block col-md-4">
      <div class="row">
        <div class="col-4 list-per-page">
          <select id="perpage" wire:model.live="perpage" aria-controls="DataTable_Tables_Voluntary" class="form-select">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
        </div>
        <div class="col-8 voluntary-status">
          <select id="statusVoluntary" wire:model.live="status_voluntary" aria-controls="DataTable_Tables_Voluntary" class="form-select">
            <option value="">Todos status</option>
            <option value="1">Ativo</option>
            <option value="0">Inativo</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-8 align-content-end">
      <div class="add-voluntary">
        <a href="{{ route('voluntary-new') }}" class="btn btn-primary float-md-end">
          <i class="bx bx-plus me-md-1"></i>
          Adicionar Voluntário
        </a>
      </div>
    </div>
  </div>

  <div class="mb-3 d-block">
    <div class="content-search">
      <label class="form-label" for="searchVoluntary">Pesquise por um voluntário</label>
      <input type="text" id="searchVoluntary" wire:model.live="search" class="form-control" placeholder="Busque por um voluntário...">
    </div>
  </div>
  @if ($search)
    <p class="text-primary">Nome pesquisado: {{ $search }}</p>
  @endif

    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
        <tr>
          <th>Nome</th>
          <th>Telefone</th>
          <th>Assistidos</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach ($voluntary as $item)
          <tr wire:key="voluntary-row-{{ $item->id }}">
          <td>
            <div class="d-flex justify-content-start align-items-center">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-2">
                      <?php
                      $works = explode(' ', $item->name);
                      $firstName = \Illuminate\Support\Str::ascii($works[0] ?? '');
                      $secondName = \Illuminate\Support\Str::ascii($works[1] ?? '');
                      $initials = strtoupper(substr($firstName, 0, 1));
                      if (count($works) >=2) $initials .= strtoupper(substr($secondName, 0, 1));
                      ?>
                    <span class="avatar-initial rounded-circle bg-label-dark">{{$initials}}</span>
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="{{ route('voluntary-show', ['id' => $item->id]) }}" class="text-body text-truncate">
                    <span class="fw-medium">{{$item->name}}</span>
                  </a>
                  <small class="text-truncate text-muted">{{$item->email}}</small>
                </div>
              </div>
          </td>
          <td>
            @if (!empty($item->contacts_info))
              <div class="flex align-items-center">
                <a href="tel:{{ json_decode($item->contacts_info)->whatsapp }}" class="text-center btn btn-outline-tertiary p-2 w-4 h-4">
                  <i class="bx bx-phone me-2"></i>
                  <span>{{ json_decode($item->contacts_info)->whatsapp }}</span>
                </a>
              </div>
            @else
              <i class="text-muted bx bx-phone-off px-2 text-center"></i>
            @endif
          </td>
          <td>
          <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
            @if ($item->assisteds_count > 0)
                @php
                  $assistedsList = array_slice(json_decode($item->assisteds) ?? [], 0, 4);
                  $totalAssistedCount = count(json_decode($item->assisteds, true) ?? []);
                @endphp
                @foreach($assistedsList as $assisted)
                  <a class="avatar avatar-xs pull-up text-body"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="{{ $assisted->name }}"
                        style="cursor: pointer;"
                        href="{{ route('assisted-show', ['id' => $assisted->id]) }}">
                    @php
                      $worksAssisted = explode(' ', $assisted->name);
                      $firstNameAssisted = \Illuminate\Support\Str::ascii($worksAssisted[0] ?? '');
                      $secondNameAssisted = \Illuminate\Support\Str::ascii($worksAssisted[1] ?? '');
                      $initialsAssisted = strtoupper(substr($firstNameAssisted, 0, 1));
                      if (count($worksAssisted) >=2) $initialsAssisted .= strtoupper(substr($secondNameAssisted, 0, 1));
                    @endphp
                    <span class="avatar-initial rounded-circle bg-label-dark">{{$initialsAssisted}}</span>
                  </a>
                @endforeach
                @if ($totalAssistedCount > 4)
                  <li><small class="w-100 text-center">&nbsp;(+{{ $totalAssistedCount - 4 }})</small></li>
                @endif
              @else
                <li><i class="text-muted bx bx-user-x"></i></li>
              @endif
              </ul>
          </td>
          <td>
            <div class="labels-status">
              <span class="badge bg-label-{{ $item->active ? 'success' : 'danger' }}">{{ $item->active ? 'Ativo' : 'Inativo' }}</span>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <a href="{{route('voluntary-update', [ 'id' => $item->id ])}}"
                 data-bs-toggle="tooltip"
                 class="text-body"
                 data-bs-placement="top"
                 title="Editar cadastro">
                <i class='bx bx-edit fs-4'></i>
              </a>
              <a href="javascript:void(0);"
                 data-bs-toggle="modal"
                 class="text-body"
                 data-bs-target="#viewRegisterVoluntary{{$item->id}}"
              >
                <i class="bx bx-show mx-2 fs-4"></i>
              </a>
              <a href="javascript:void(0);"
                 data-bs-toggle="modal"
                 class="text-body"
                 data-bs-target="#modalConfirmeRemoveVoluntary{{$item->id}}"
              >
                <i class='bx bx-trash fs-4'></i>
              </a>
            </div>
          </td>
        </tr>

        {{-- Modals --}}
        <livewire:voluntary.modals.delete-voluntary :voluntaryRegister="$item" :key="'voluntary-delete-'.$item->id" />
        <livewire:voluntary.modals.view-voluntary :voluntaryRegister="$item" :key="'voluntary-view-'.$item->id" />
        @endforeach
        </tbody>
      </table>
    </div>

    <div class="col-md-12 mt-5">
      {{ $voluntary->links(data: ['scrollTo' => false]) }}
    </div>
</div>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
