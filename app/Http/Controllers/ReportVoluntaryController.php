<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voluntary;
use App\Models\Assisted;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;

class ReportVoluntaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Exibe o relatório de voluntários com filtros:
     * - Status (ativo/inativo)
     * - Busca por nome ou email
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('app.report.voluntary');
    }

    /**
     * Export the report data to CSV
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $voluntaries = $this->buildFilteredQuery($request)->get();

        $csv = "ID,Voluntário,Assistidos Responsável,Status,Data de Registro\n";

        foreach ($voluntaries as $item) {
            $status = $item->active ? 'Ativo' : 'Inativo';
            $voluntaryLabel = $item->name . ($item->email ? ' - ' . $item->email : '');
            $csv .= "\"{$item->id}\",\"{$voluntaryLabel}\",\"{$item->assisted_count}\",\"{$status}\",\"{$item->created_at->format('d/m/Y')}\"\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="relatorio-voluntarios-' . now()->format('Y-m-d-His') . '.csv"');
    }

    /**
     * Export the report data to PDF
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportPdf(Request $request)
    {
        $voluntaries = $this->buildFilteredQuery($request)->get();

        $generatedAt = now();

        $pdf = Pdf::loadView('app.report.pdf.voluntary-report', [
            'items' => $voluntaries,
            'filters' => [
                'status' => $request->status,
                'search' => $request->search,
            ],
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

        return $pdf->download('relatorio-voluntarios-' . now()->format('Y-m-d-His') . '.pdf');
    }

    /**
     * Open a clean printable report page
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function print(Request $request)
    {
        $voluntaries = $this->buildFilteredQuery($request)->get();

        return view('app.report.print.voluntary-report', [
            'items' => $voluntaries,
            'filters' => [
                'status' => $request->status,
                'search' => $request->search,
            ],
            'generatedAt' => now(),
        ]);
    }

    private function buildFilteredQuery(Request $request): Builder
    {
        $query = Voluntary::withCount('assisted');

        if ($request->filled('status')) {
            $query->where('active', (int) $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('created_at', 'desc');
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
