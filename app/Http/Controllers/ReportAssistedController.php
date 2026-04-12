<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assisted;
use App\Models\Voluntary;
use App\Models\Dependent;
use App\Enums\Relationships;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;

class ReportAssistedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Exibe o relatório de famílias assistidas com filtros obrigatórios:
     * - Status (ativo/inativo)
     * - Voluntário responsável
     * - Tamanho da família
     * - Faixa etária dos dependentes
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('app.report.assisted');
    }

    /**
     * Export the report data to CSV
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $assisted = $this->buildFilteredQuery($request)->get();
        $showDependentsInfo = $request->boolean('show_dependents_info') && (string) $request->family_size !== '1';

        $csv = "ID,Nome,Email,Voluntário,";
        $csv .= "Dependentes";
        $csv .= ",Status,Data de Registro\n";

        foreach ($assisted as $item) {
            $status = $item->active ? 'Ativo' : 'Inativo';
            $dependents = $item->dependents->count();
            $voluntaryName = $item->voluntary?->name ?? 'N/A';
            $csv .= "\"{$item->id}\",\"{$item->name}\",\"{$item->email}\",\"{$voluntaryName}\",";

            if ($showDependentsInfo) {
                $dependentsInfo = $item->dependents->map(function ($dependent) {
                    $firstName = explode(' ', trim((string) $dependent->name))[0] ?? (string) $dependent->name;
                    $parentage = Relationships::labelFrom($dependent->parentage) ?: 'parentesco não informado';

                    if (!$dependent->dob) {
                        return $firstName . ' (' . $parentage . ') - idade não informada';
                    }

                    return $firstName . ' (' . $parentage . ') - ' . \Carbon\Carbon::parse($dependent->dob)->age . ' anos';
                })->implode(' | ');

                $csv .= "\"{$dependentsInfo}\"";
            } else {
                $csv .= "\"{$dependents}\"";
            }

            $csv .= ",\"{$status}\",\"{$item->created_at->format('d/m/Y')}\"\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="relatorio-assistidos-' . now()->format('Y-m-d-His') . '.csv"');
    }

    /**
     * Export the report data to PDF
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportPdf(Request $request)
    {
        $assisted = $this->buildFilteredQuery($request)->get();

        $filters = [
            'status' => $request->status,
            'voluntary_id' => $request->voluntary_id,
            'family_size' => $request->family_size,
            'dependent_age_min' => $request->dependent_age_min,
            'dependent_age_max' => $request->dependent_age_max,
            'show_dependents_info' => $request->boolean('show_dependents_info') && (string) $request->family_size !== '1',
            'search' => $request->search,
        ];

        $voluntaryName = null;
        if (!empty($request->voluntary_id)) {
            $voluntaryName = Voluntary::where('id', $request->voluntary_id)->value('name');
        }

        $generatedAt = now();

        $pdf = Pdf::loadView('app.report.pdf.assisted-report', [
            'items' => $assisted,
            'filters' => $filters,
            'voluntaryName' => $voluntaryName,
            'generatedAt' => $generatedAt,
        ])->setPaper('a4', 'portrait');

        $pdf->render();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $fontMetrics = $dompdf->getFontMetrics();

        $generatedLine = 'Gerado em ' . $generatedAt->format('d/m/Y H:i');
        $fontSize = 8;
        $rightMargin = 28;
        $color = [0.39, 0.45, 0.55];

        $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) use ($generatedLine, $fontSize, $rightMargin, $color) {
            $font = $fontMetrics->get_font('DejaVu Sans', 'normal');
            $line1 = $generatedLine;
            $line2 = 'Página ' . $pageNumber . ' de ' . $pageCount;

            $xRight = $canvas->get_width() - $rightMargin;
            $line1Width = $fontMetrics->getTextWidth($line1, $font, $fontSize);
            $line2Width = $fontMetrics->getTextWidth($line2, $font, $fontSize);

            $canvas->text($xRight - $line1Width, 798, $line1, $font, $fontSize, $color);
            $canvas->text($xRight - $line2Width, 808, $line2, $font, $fontSize, $color);
        });

        return $pdf->download('relatorio-assistidos-' . now()->format('Y-m-d-His') . '.pdf');
    }

    /**
     * Open a clean printable report page
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function print(Request $request)
    {
        $assisted = $this->buildFilteredQuery($request)->get();

        $filters = [
            'status' => $request->status,
            'voluntary_id' => $request->voluntary_id,
            'family_size' => $request->family_size,
            'dependent_age_min' => $request->dependent_age_min,
            'dependent_age_max' => $request->dependent_age_max,
            'show_dependents_info' => $request->boolean('show_dependents_info') && (string) $request->family_size !== '1',
            'search' => $request->search,
        ];

        $voluntaryName = null;
        if (!empty($request->voluntary_id)) {
            $voluntaryName = Voluntary::where('id', $request->voluntary_id)->value('name');
        }

        return view('app.report.print.assisted-report', [
            'items' => $assisted,
            'filters' => $filters,
            'voluntaryName' => $voluntaryName,
            'generatedAt' => now(),
        ]);
    }

    private function buildFilteredQuery(Request $request): Builder
    {
        $query = Assisted::with(['voluntary', 'dependents'])
            ->select('assisteds.*');

        if ($request->filled('status')) {
            $query->where('assisteds.active', (int) $request->status);
        }

        if ($request->filled('voluntary_id')) {
            $query->where('assisteds.voluntary_id', $request->voluntary_id);
        }

        if ($request->filled('family_size')) {
            $query->leftJoin('dependents', 'assisteds.id', '=', 'dependents.assisted_id')
                ->groupBy('assisteds.id');

            $familySize = (int) $request->family_size;
            if ($familySize === 1) {
                $query->havingRaw('COUNT(dependents.id) = 0');
            } elseif ($familySize >= 6) {
                $query->havingRaw('COUNT(dependents.id) >= 5');
            } else {
                $query->havingRaw('COUNT(dependents.id) = ?', [$familySize - 1]);
            }
        }

        if ($request->filled('dependent_age_min') || $request->filled('dependent_age_max')) {
            $minAge = $request->filled('dependent_age_min') ? max(0, (int) $request->dependent_age_min) : null;
            $maxAge = $request->filled('dependent_age_max') ? max(0, (int) $request->dependent_age_max) : null;

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

        if ($request->filled('search')) {
            $query->where('assisteds.name', 'like', '%' . $request->search . '%');
        }

        return $query->orderBy('assisteds.created_at', 'desc');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
