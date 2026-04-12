<div x-data x-cloak>
    <!-- Card de Aviso de Filtros Obrigatórios -->
    @if (!$hasFilters)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><i class="bx bx-info-circle me-2"></i>Atenção!</strong> Você deve selecionar pelo menos um filtro para visualizar o relatório.
        </div>
    @endif

    <!-- Estatísticas Rápidas -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card bg-label-primary">
                <div class="card-body p-3 p-sm-4">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-label">Total de Assistidos</span>
                            <div class="mb-2">
                                <h3 class="mb-0">{{ $statistics['total_assisted'] }}</h3>
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
                            <span class="text-label">Assistidos Ativos</span>
                            <div class="mb-2">
                                <h3 class="mb-0">{{ $statistics['active_assisted'] }}</h3>
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
                            <span class="text-label">Assistidos Inativos</span>
                            <div class="mb-2">
                                <h3 class="mb-0">{{ $statistics['inactive_assisted'] }}</h3>
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
                            <span class="text-label">Total de Dependentes</span>
                            <div class="mb-2">
                                <h3 class="mb-0">{{ $statistics['total_dependents'] }}</h3>
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
            <button class="accordion-button px-3 px-sm-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#assisted-report-filters" aria-expanded="true" aria-controls="assisted-report-filters">
                <span class="d-flex flex-column align-items-start gap-2 w-100 pe-3">
                    <span>
                        <span class="d-flex align-items-center fw-semibold text-body fs-5">
                            <i class="bx bx-filter me-2"></i>Filtros do Relatório
                        </span>
                        <span class="text-muted small">Selecione ao menos um critério para gerar a listagem de famílias.</span>
                    </span>
                    @php
                        $activeFilters = array_values(array_filter([
                            $status !== '' ? 'Status: ' . ($status === '1' ? 'Ativas' : 'Inativas') : null,
                            $voluntary_id !== '' ? 'Voluntário: ' . optional($voluntaries->firstWhere('id', (int) $voluntary_id))->name : null,
                            $family_size !== '' ? 'Família: ' . ($family_size === '1' ? 'Apenas assistido' : $family_size . ' pessoas') : null,
                            ($dependent_age_min !== '' || $dependent_age_max !== '') ? 'Idade dependentes: ' . ($dependent_age_min !== '' ? $dependent_age_min : '0') . ' a ' . ($dependent_age_max !== '' ? $dependent_age_max : '+') . ' anos' : null,
                            ($show_dependents_info && $family_size !== '1') ? 'Informações dos dependentes' : null,
                            $search !== '' ? 'Busca: ' . $search : null,
                        ]));
                        $visibleFilters = array_slice($activeFilters, 0, 3);
                        $hiddenFilters = array_slice($activeFilters, 3);
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
        <div id="assisted-report-filters" class="collapse show">
            <div class="card-body p-3 p-sm-4">
            <div class="row g-3">
                <!-- Filtro: Status -->
                <div class="col-12 col-md-6 col-lg-3">
                    <label class="form-label" for="status">
                        Status das Famílias
                    </label>
                    <select id="status" wire:model.live="status" @class(['form-select', 'border-primary shadow-sm' => $status !== ''])>
                        <option value="">Selecione...</option>
                        <option value="1">Ativas</option>
                        <option value="0">Inativas</option>
                    </select>
                </div>

                <!-- Filtro: Voluntário -->
                <div class="col-12 col-md-6 col-lg-3">
                    <label class="form-label" for="voluntary_id">
                        Voluntário Responsável
                    </label>
                    <select id="voluntary_id" wire:model.live="voluntary_id" @class(['form-select', 'border-primary shadow-sm' => $voluntary_id !== ''])>
                        <option value="">Selecione...</option>
                        @foreach($voluntaries as $voluntary)
                            <option value="{{ $voluntary->id }}">{{ $voluntary->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro: Tamanho da Família -->
                <div class="col-12 col-md-6 col-lg-3">
                    <label class="form-label" for="family_size">
                        Tamanho da Família
                    </label>
                    <select id="family_size" wire:model.live="family_size" @class(['form-select', 'border-primary shadow-sm' => $family_size !== ''])>
                        <option value="">Selecione...</option>
                        <option value="1">Apenas Assistido (sem dependentes)</option>
                        <option value="2">2 pessoas</option>
                        <option value="3">3 pessoas</option>
                        <option value="4">4 pessoas</option>
                        <option value="5">5 pessoas</option>
                        <option value="6">6+ pessoas</option>
                    </select>
                </div>

                <!-- Filtro: Idade dos Dependentes -->
                @if ($family_size !== '1')
                    <div class="col-12 col-lg-3">
                        <label class="form-label" for="dependent_age_min">
                            Idade dos Dependentes
                        </label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" min="0" id="dependent_age_min" wire:model.live="dependent_age_min" @class(['form-control', 'border-primary shadow-sm' => $dependent_age_min !== '']) placeholder="Mínima">
                            </div>
                            <div class="col-6">
                                <input type="number" min="0" id="dependent_age_max" wire:model.live="dependent_age_max" @class(['form-control', 'border-primary shadow-sm' => $dependent_age_max !== '']) placeholder="Máxima">
                            </div>
                        </div>
                        <div class="form-text">Informe uma idade mínima e/ou máxima.</div>
                    </div>
                @endif

                @if ($family_size !== '1')
                    <div class="col-12 col-lg-3">
                        <label class="form-label d-block">Exibir no Resultado</label>
                        <div class="form-check form-switch mt-1">
                            <input class="form-check-input" type="checkbox" id="show_dependents_info" wire:model.live="show_dependents_info">
                            <label class="form-check-label" for="show_dependents_info">
                                Informações dos dependentes
                            </label>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Busca por Nome -->
            <div class="row mt-1 mt-sm-2">
                <div class="col-12">
                    <label class="form-label" for="search">
                        Pesquisar por Nome
                    </label>
                    <input type="text" id="search" wire:model.live="search" @class(['form-control', 'border-primary shadow-sm' => $search !== ''])
                           placeholder="Digite o nome do assistido...">
                </div>
            </div>

            </div>
        </div>
    </div>

    <!-- Resultados -->
    @if ($hasFilters)
        @php
            $assistedExportParams = array_filter([
                'status' => $status,
                'voluntary_id' => $voluntary_id,
                'family_size' => $family_size,
                'dependent_age_min' => $dependent_age_min,
                'dependent_age_max' => $dependent_age_max,
                'search' => $search,
                'show_dependents_info' => ($show_dependents_info && $family_size !== '1') ? 1 : null,
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
                        <h5 class="card-title mb-1">Resultado do Relatório de Assistidos</h5>
                        <p class="text-muted small mb-0">Famílias encontradas conforme os filtros aplicados.</p>
                    </div>
                </div>
                <div class="d-flex gap-2 w-100 w-md-auto">
                    @if ($assisted->count() > 0)
                        <span class="badge bg-label-primary align-self-center">{{ $assisted->total() }} registros</span>
                    @endif
                    <a href="{{ route('report-assisted-print', $assistedExportParams) }}" class="btn btn-sm btn-outline-secondary" target="_blank" rel="noopener">
                        <i class="bx bx-printer me-1"></i>Imprimir
                    </a>
                    <a href="{{ route('report-assisted-export-pdf', $assistedExportParams) }}" class="btn btn-sm btn-outline-danger">
                        <i class="bx bx-file me-1"></i>Exportar para PDF
                    </a>
                    <a href="{{ route('report-assisted-export-csv', $assistedExportParams) }}" class="btn btn-sm btn-outline-success">
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
                @if ($assisted->count() > 0)
                    <div class="table-responsive pb-1">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="min-width: 220px;">Nome do Assistido</th>
                                    <th class="d-none d-lg-table-cell" style="min-width: 180px;">Voluntário Responsável</th>
                                    @if(!$show_dependents_info)
                                        <th class="d-none d-md-table-cell" style="min-width: 230px;">Composição Familiar</th>
                                    @else
                                        <th class="d-none d-lg-table-cell" style="min-width: 290px;">Composição Familiar</th>
                                    @endif
                                    <th style="min-width: 120px;">Status</th>
                                    <th class="d-none d-md-table-cell" style="min-width: 120px;">Data Registro</th>
                                    <th class="text-center" style="min-width: 96px;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assisted as $item)
                                    <tr wire:key="assisted-{{ $item->id }}">
                                        <td class="text-wrap">
                                            <a href="{{ route('assisted-show', $item->id) }}" class="fw-semibold text-body">
                                                {{ $item->name }}
                                            </a>
                                            @if ($item->email)
                                                <div class="small text-muted">{{ $item->email }}</div>
                                            @endif
                                            <div class="small text-muted d-lg-none mt-1">
                                                @if ($item->voluntary)
                                                    <a href="{{ route('voluntary-show', $item->voluntary->id) }}" class="text-muted text-decoration-underline">
                                                        {{ $item->voluntary->name }}
                                                    </a>
                                                @else
                                                    Não atribuído
                                                @endif
                                            </div>
                                            <div class="small text-muted d-md-none mt-1">
                                                @if($show_dependents_info)
                                                    @if($item->dependents && $item->dependents->count() > 0)
                                                        @foreach($item->dependents as $dependent)
                                                            @php
                                                                $firstName = explode(' ', trim((string) $dependent->name))[0] ?? (string) $dependent->name;
                                                                $parentage = \App\Enums\Relationships::labelFrom($dependent->parentage) ?: 'parentesco não informado';
                                                            @endphp
                                                            <div>{{ $firstName }} ({{ $parentage }}) - {{ $dependent->dob ? \Carbon\Carbon::parse($dependent->dob)->age . ' anos' : 'idade não informada' }}</div>
                                                        @endforeach
                                                    @else
                                                        Sem dependentes
                                                    @endif
                                                    <div class="mt-1">Tamanho família: {{ ($item->dependents?->count() ?? 0) + 1 }} pessoas</div>
                                                @else
                                                    Dependentes: {{ $item->dependents?->count() ?? 0 }} | Família: {{ ($item->dependents?->count() ?? 0) + 1 }} pessoas
                                                @endif
                                            </div>
                                        </td>
                                        <td class="d-none d-lg-table-cell">
                                            @if ($item->voluntary)
                                                <a href="{{ route('voluntary-show', $item->voluntary->id) }}" class="badge bg-label-info text-decoration-none">
                                                    {{ $item->voluntary->name }}
                                                </a>
                                            @else
                                                <span class="badge bg-label-secondary">Não atribuído</span>
                                            @endif
                                        </td>
                                        @if(!$show_dependents_info)
                                            <td class="d-none d-md-table-cell">
                                                @php
                                                    $dependentCount = $item->dependents?->count() ?? 0;
                                                    $familySize = $dependentCount + 1;
                                                @endphp
                                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                    @if ($dependentCount > 0)
                                                        @foreach ($item->dependents as $dependent)
                                                            @php
                                                                $normalizedSex = strtoupper(trim((string) $dependent->sex));
                                                                $dependentSexClass = $normalizedSex === 'MASCULINO'
                                                                    ? 'male'
                                                                    : ($normalizedSex === 'FEMININO' ? 'female' : 'neutral');
                                                            @endphp
                                                            <li data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                class="avatar avatar-xs pull-up text-body"
                                                                title="{{ $dependent->name }}, {{ $dependent->dob ? \Carbon\Carbon::parse($dependent->dob)->age . ' anos' : 'idade não informada' }}">
                                                                <span class="bx bx-xs bx-male dependent-{{ $dependentSexClass }} dependent-icon"></span>
                                                            </li>
                                                        @endforeach
                                                        <li><small class="n-dependents">&nbsp;({{ $dependentCount }})</small></li>
                                                    @else
                                                        <li><small class="n-dependents">&nbsp;(Sem dependentes)</small></li>
                                                    @endif
                                                </ul>
                                                <small class="text-muted">Família: {{ $familySize }} {{ $familySize > 1 ? 'pessoas' : 'pessoa' }}</small>
                                            </td>
                                        @else
                                            <td class="d-none d-lg-table-cell text-wrap">
                                                @php
                                                    $dependentCount = $item->dependents?->count() ?? 0;
                                                    $familySize = $dependentCount + 1;
                                                @endphp
                                                <div class="mb-1">
                                                    <span class="badge bg-label-primary me-1">Dependentes: {{ $dependentCount }}</span>
                                                    <span class="badge bg-label-info">Família: {{ $familySize }} {{ $familySize > 1 ? 'pessoas' : 'pessoa' }}</span>
                                                </div>
                                                @if ($dependentCount > 0)
                                                    @foreach ($item->dependents as $dependent)
                                                        @php
                                                            $firstName = explode(' ', trim((string) $dependent->name))[0] ?? (string) $dependent->name;
                                                            $parentage = \App\Enums\Relationships::labelFrom($dependent->parentage) ?: 'parentesco não informado';
                                                        @endphp
                                                        <div class="small">
                                                            <span class="fw-semibold">{{ $firstName }} ({{ $parentage }})</span>
                                                            <span class="text-muted">- {{ $dependent->dob ? \Carbon\Carbon::parse($dependent->dob)->age . ' anos' : 'idade não informada' }}</span>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted small">Sem dependentes</span>
                                                @endif
                                            </td>
                                        @endif
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
                                                <a class="btn btn-sm btn-icon btn-text-secondary" href="{{ route('assisted-show', $item->id) }}" aria-label="Visualizar assistido {{ $item->name }}">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                                <a class="btn btn-sm btn-icon btn-text-secondary" href="{{ route('assisted-update', $item->id) }}" aria-label="Editar assistido {{ $item->name }}">
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
                        {{ $assisted->links() }}
                    </div>
                @else
                    <div class="alert alert-info m-3 mb-3" role="alert">
                        <i class="bx bx-info-circle me-2"></i>
                        Nenhum registro encontrado com os filtros selecionados.
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
