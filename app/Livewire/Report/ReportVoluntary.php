<?php

namespace App\Livewire\Report;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Voluntary;
use App\Models\Assisted;

class ReportVoluntary extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Filtros
    public $status = '';
    public $search = '';

    // Paginação
    public $perpage = 10;

    /**
     * Atualizar quando houver mudanças nos filtros
     */
    public function updatedStatus()
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

    /**
     * Obter estatísticas dos voluntários
     */
    private function getStatistics()
    {
        $totalVoluntary = Voluntary::count();
        $activeVoluntary = Voluntary::where('active', 1)->count();
        $inactiveVoluntary = Voluntary::where('active', 0)->count();
        $totalAssisted = Assisted::count();

        return [
            'total_voluntary' => $totalVoluntary,
            'active_voluntary' => $activeVoluntary,
            'inactive_voluntary' => $inactiveVoluntary,
            'total_assisted' => $totalAssisted,
        ];
    }

    /**
     * Construir a query com os filtros aplicados
     */
    private function buildQuery()
    {
        $query = Voluntary::withCount('assisted');

        // Aplicar filtro de status
        if ($this->status !== '') {
            $query->where('voluntaries.active', (int)$this->status);
        }

        // Aplicar busca por nome
        if ($this->search !== '') {
            $query->where('voluntaries.name', 'like', '%' . $this->search . '%')
                  ->orWhere('voluntaries.email', 'like', '%' . $this->search . '%');
        }

        return $query->orderBy('voluntaries.created_at', 'desc');
    }

    public function render()
    {
        $statistics = $this->getStatistics();
        $voluntaries = $this->buildQuery()->paginate($this->perpage);

        return view('livewire.report.report-voluntary', [
            'voluntaries' => $voluntaries,
            'statistics' => $statistics,
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
