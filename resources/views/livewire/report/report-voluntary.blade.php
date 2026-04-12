<div x-data x-cloak>
    <!-- Estatísticas Rápidas -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card bg-label-primary">
                <div class="card-body p-3 p-sm-4">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-label">Total de Voluntários</span>
                            <div class="mb-2">
                                <h3 class="mb-0">{{ $statistics['total_voluntary'] }}</h3>
                            </div>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bx bx-user-pin fs-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card bg-label-success">
                <div class="card-body p-3 p-sm-4">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-label">Voluntários Ativos</span>
                            <div class="mb-2">
                                <h3 class="mb-0">{{ $statistics['active_voluntary'] }}</h3>
                            </div>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="bx bx-check-circle fs-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card bg-label-danger">
                <div class="card-body p-3 p-sm-4">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-label">Voluntários Inativos</span>
                            <div class="mb-2">
                                <h3 class="mb-0">{{ $statistics['inactive_voluntary'] }}</h3>
                            </div>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-danger">
                                <i class="bx bx-circle fs-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card bg-label-info">
                <div class="card-body p-3 p-sm-4">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-label">Total de Assistidos</span>
                            <div class="mb-2">
                                <h3 class="mb-0">{{ $statistics['total_assisted'] }}</h3>
                            </div>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-info">
                                <i class="bx bx-group fs-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card de Filtros -->
    <div class="card mb-4">
        <div class="card-header p-0">
            <button class="accordion-button px-3 px-sm-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#voluntary-report-filters" aria-expanded="true" aria-controls="voluntary-report-filters">
                <span class="d-flex flex-column align-items-start gap-2 w-100 pe-3">
                    <span>
                        <span class="d-flex align-items-center fw-semibold text-body fs-5">
                            <i class="bx bx-filter me-2"></i>Filtros do Relatório
                        </span>
                        <span class="text-muted small">Refine os voluntários exibidos por status ou busca textual.</span>
                    </span>
                    @php
                        $activeFilters = array_values(array_filter([
                            $status !== '' ? 'Status: ' . ($status === '1' ? 'Ativos' : 'Inativos') : null,
                            $search !== '' ? 'Busca: ' . $search : null,
                        ]));
                        $visibleFilters = array_slice($activeFilters, 0, 2);
                        $hiddenFilters = array_slice($activeFilters, 2);
                        $remainingFilters = count($activeFilters) - count($visibleFilters);
                    @endphp
                    @if (count($activeFilters) > 0)
                        <span class="d-flex flex-wrap gap-2">
                            @foreach ($visibleFilters as $filterLabel)
                                <span class="badge bg-label-primary">{{ $filterLabel }}</span>
                            @endforeach
                            @if ($remainingFilters > 0)
                                <span class="badge bg-label-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ implode(' | ', $hiddenFilters) }}">+{{ $remainingFilters }} filtros</span>
                            @endif
                        </span>
                    @endif
                </span>
            </button>
        </div>
        <div id="voluntary-report-filters" class="collapse show">
            <div class="card-body p-3 p-sm-4">
            <div class="row g-3">
                <!-- Filtro: Status -->
                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label" for="status">
                        Status do Voluntário
                    </label>
                    <select id="status" wire:model.live="status" @class(['form-select', 'border-primary shadow-sm' => $status !== ''])>
                        <option value="">Todos os Status</option>
                        <option value="1">Ativos</option>
                        <option value="0">Inativos</option>
                    </select>
                </div>

                <!-- Busca por Nome ou Email -->
                <div class="col-12 col-md-6 col-lg-8">
                    <label class="form-label" for="search">
                        Pesquisar por Nome ou Email
                    </label>
                    <input type="text" id="search" wire:model.live="search" @class(['form-control', 'border-primary shadow-sm' => $search !== ''])
                           placeholder="Digite o nome ou email do voluntário...">
                </div>
            </div>

            </div>
        </div>
    </div>

    <!-- Resultados -->
    @php
        $voluntaryExportParams = array_filter([
            'status' => $status,
            'search' => $search,
        ], fn ($value) => $value !== null && $value !== '');
    @endphp
    <div class="card">
        <div class="card-header px-3 px-sm-4 py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div class="d-flex align-items-start gap-3">
                <span class="avatar avatar-sm mt-1">
                    <span class="avatar-initial rounded bg-label-primary">
                        <i class="bx bx-table fs-5"></i>
                    </span>
                </span>
                <div>
                    <h5 class="card-title mb-1">Resultado do Relatório de Voluntários</h5>
                    <p class="text-muted small mb-0">Visão consolidada dos voluntários conforme os filtros selecionados.</p>
                </div>
            </div>
            <div class="d-flex gap-2 w-100 w-md-auto">
                @if ($voluntaries->count() > 0)
                    <span class="badge bg-label-primary align-self-center">{{ $voluntaries->total() }} registros</span>
                @endif
                <a href="{{ route('report-voluntary-print', $voluntaryExportParams) }}" class="btn btn-sm btn-outline-secondary" target="_blank" rel="noopener">
                    <i class="bx bx-printer me-1"></i>Imprimir
                </a>
                <a href="{{ route('report-voluntary-export-pdf', $voluntaryExportParams) }}" class="btn btn-sm btn-outline-danger">
                    <i class="bx bx-file me-1"></i>Exportar para PDF
                </a>
                <a href="{{ route('report-voluntary-export-csv', $voluntaryExportParams) }}" class="btn btn-sm btn-outline-success">
                    <i class="bx bx-download me-1"></i>Exportar para CVS
                </a>
                <div>
                    <select wire:model.live="perpage" class="form-select form-select-sm" style="min-width: 150px;">
                        <option value="10">10 por página</option>
                        <option value="25">25 por página</option>
                        <option value="50">50 por página</option>
                        <option value="100">100 por página</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if ($voluntaries->count() > 0)
                <div class="table-responsive pb-1">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="min-width: 280px;">Voluntário</th>
                                <th class="d-none d-md-table-cell" style="min-width: 160px;">Assistidos Responsável</th>
                                <th style="min-width: 120px;">Status</th>
                                <th class="d-none d-md-table-cell" style="min-width: 120px;">Registro</th>
                                <th class="text-center" style="min-width: 96px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($voluntaries as $item)
                                <tr wire:key="voluntary-{{ $item->id }}">
                                    <td class="text-wrap">
                                        <a href="{{ route('voluntary-show', $item->id) }}" class="fw-semibold text-body">
                                            {{ $item->name }}
                                        </a>
                                        @if ($item->email)
                                            <div class="small text-muted mt-1">{{ $item->email }}</div>
                                        @endif
                                        <div class="small text-muted d-md-none mt-1">
                                            {{ $item->assisted_count ?? 0 }} assistidos
                                        </div>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <span class="badge bg-label-info">
                                            {{ $item->assisted_count ?? 0 }} assistidos
                                        </span>
                                    </td>
                                    <td>
                                        @if ($item->active)
                                            <span class="badge bg-label-success">
                                                <i class="bx bx-check-circle"></i> Ativo
                                            </span>
                                        @else
                                            <span class="badge bg-label-danger">
                                                <i class="bx bx-circle"></i> Inativo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <small class="text-muted">{{ $item->created_at->format('d/m/Y') }}</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center gap-1">
                                            <a class="btn btn-sm btn-icon btn-text-secondary" href="{{ route('voluntary-show', $item->id) }}" aria-label="Visualizar voluntário {{ $item->name }}">
                                                <i class="bx bx-show"></i>
                                            </a>
                                            <a class="btn btn-sm btn-icon btn-text-secondary" href="{{ route('voluntary-update', $item->id) }}" aria-label="Editar voluntário {{ $item->name }}">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                <div class="card-footer">
                    {{ $voluntaries->links() }}
                </div>
            @else
                <div class="alert alert-info m-3 mb-3" role="alert">
                    <i class="bx bx-info-circle me-2"></i>
                    Nenhum registro encontrado com os critérios de busca selecionados.
                </div>
            @endif
        </div>
    </div>
</div>
