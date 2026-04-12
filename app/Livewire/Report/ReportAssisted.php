<?php

namespace App\Livewire\Report;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Assisted;
use App\Models\Voluntary;
use App\Models\Dependent;
use Illuminate\Database\Eloquent\Builder;

class ReportAssisted extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Filtros obrigatórios
    public $status = '';
    public $voluntary_id = '';
    public $family_size = '';
    public $dependent_age_min = '';
    public $dependent_age_max = '';
    public $show_dependents_info = false;

    // Paginação
    public $perpage = 10;
    public $search = '';

    /**
     * Validar que pelos menos um filtro obrigatório foi selecionado
     */
    public function validateFilters()
    {
        if ($this->status === '' && $this->voluntary_id === '' && $this->family_size === '' && $this->dependent_age_min === '' && $this->dependent_age_max === '') {
            return false;
        }
        return true;
    }

    /**
     * Atualizar quando houver mudanças nos filtros
     */
    public function updatedStatus()
    {
        $this->resetPage();
    }

    public function updatedVoluntaryId()
    {
        $this->resetPage();
    }

    public function updatedFamilySize()
    {
        if ($this->family_size === '1') {
            $this->dependent_age_min = '';
            $this->dependent_age_max = '';
            $this->show_dependents_info = false;
        }

        $this->resetPage();
    }

    public function updatedDependentAgeMin()
    {
        $this->resetPage();
    }

    public function updatedDependentAgeMax()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerpage()
    {
        $this->resetPage();
    }

    public function updatedShowDependentsInfo()
    {
        $this->resetPage();
    }

    /**
     * Construir a query com os filtros aplicados
     */
    private function buildQuery(): Builder
    {
        $query = Assisted::with(['voluntary', 'dependents'])
            ->select('assisteds.*');

        // Aplicar filtro de status (ativo/inativo)
        if ($this->status !== '') {
            $query->where('assisteds.active', (int)$this->status);
        }

        // Aplicar filtro por voluntário responsável
        if ($this->voluntary_id !== '') {
            $query->where('assisteds.voluntary_id', $this->voluntary_id);
        }

        // Aplicar filtro por tamanho da família
        if ($this->family_size !== '') {
            $query->leftJoin('dependents', 'assisteds.id', '=', 'dependents.assisted_id')
                ->groupBy('assisteds.id');

            $familySize = (int)$this->family_size;
            if ($familySize == 1) {
                // Apenas assistidos sem dependentes
                $query->havingRaw('COUNT(dependents.id) = 0');
            } elseif ($familySize >= 6) {
                // Assistido + 5 ou mais dependentes
                $query->havingRaw('COUNT(dependents.id) >= 5');
            } else {
                // Assistido + dependentes
                $query->havingRaw('COUNT(dependents.id) = ?', [$familySize - 1]);
            }
        }

        // Aplicar filtro por idade dos dependentes
        if ($this->dependent_age_min !== '' || $this->dependent_age_max !== '') {
            $this->applyDependentAgeFilter($query);
        }

        // Aplicar busca por nome
        if ($this->search !== '') {
            $query->where('assisteds.name', 'like', '%' . $this->search . '%');
        }

        return $query->orderBy('assisteds.created_at', 'desc');
    }

    /**
     * Aplicar filtro de idade dos dependentes
     */
    private function applyDependentAgeFilter(Builder $query)
    {
        $minAge = $this->dependent_age_min !== '' ? max(0, (int) $this->dependent_age_min) : null;
        $maxAge = $this->dependent_age_max !== '' ? max(0, (int) $this->dependent_age_max) : null;

        if ($minAge !== null && $maxAge !== null && $minAge > $maxAge) {
            [$minAge, $maxAge] = [$maxAge, $minAge];
        }

        $query->whereHas('dependents', function ($q) use ($minAge, $maxAge) {
            if ($maxAge !== null) {
                $q->where('dependents.dob', '>=', now()->subYears($maxAge + 1)->addDay()->startOfDay());
            }

            if ($minAge !== null) {
                $q->where('dependents.dob', '<=', now()->subYears($minAge)->endOfDay());
            }
        });
    }

    /**
     * Obter estatísticas dos dados filtrados
     */
    private function getStatistics()
    {
        $baseQuery = Assisted::with('dependents');

        if ($this->status !== '') {
            $baseQuery->where('active', (int)$this->status);
        }

        if ($this->voluntary_id !== '') {
            $baseQuery->where('voluntary_id', $this->voluntary_id);
        }

        $totalAssisted = $baseQuery->count();
        $activeAssisted = Assisted::where('active', 1)->count();
        $inactiveAssisted = Assisted::where('active', 0)->count();
        $totalDependents = Dependent::count();

        return [
            'total_assisted' => $totalAssisted,
            'active_assisted' => $activeAssisted,
            'inactive_assisted' => $inactiveAssisted,
            'total_dependents' => $totalDependents,
        ];
    }

    /**
     * Obter lista de voluntários para filtro
     */
    private function getVoluntaries()
    {
        return Voluntary::where('active', 1)
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    public function render()
    {
        $statistics = $this->getStatistics();
        $voluntaries = $this->getVoluntaries();
        $hasFilters = $this->validateFilters();

        $assisted = $hasFilters
            ? $this->buildQuery()->paginate($this->perpage)
            : collect();

        return view('livewire.report.report-assisted', [
            'assisted' => $assisted,
            'statistics' => $statistics,
            'voluntaries' => $voluntaries,
            'hasFilters' => $hasFilters,
        ]);
    }

    public function placeholder()
    {
        return <<<'HTML'
            <div class="m-auto text-center">
                <p class="mt-4 mb-2 text-center text-primary">Carregando relatório...</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: rgba(105, 108, 255, 1); transform: scaleX(-1);">
                    <path d="M12 22c5.421 0 10-4.579 10-10h-2c0 4.337-3.663 8-8 8s-8-3.663-8-8c0-4.336 3.663-8 8-8V2C6.579 2 2 6.58 2 12c0 5.421 4.579 10 10 10z">
                        <animateTransform attributeName="transform" type="rotate" dur=".4s" values="0 12 12;360 12 12;" repeatCount="indefinite"></animateTransform>
                    </path>
                </svg>
            </div>
            HTML;
    }
}
