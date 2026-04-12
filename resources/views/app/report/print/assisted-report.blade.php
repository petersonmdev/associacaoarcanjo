<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impressão - Relatório de Assistidos</title>
    <style>
        body { font-family: "Segoe UI", Arial, Helvetica, sans-serif; color: #1f2937; margin: 0; background: #fff; }
        .page { padding: 18px; }
        .header { border-bottom: 2px solid #dbeafe; padding-bottom: 10px; margin-bottom: 12px; overflow: hidden; }
        .header-left { float: left; width: 70%; }
        .header-right { float: right; width: 30%; text-align: right; font-size: 11px; color: #64748b; }
        .brand { display: inline-block; vertical-align: middle; margin-right: 10px; }
        .brand img { width: 170px; height: auto; display: block; }
        .title-wrap { display: inline-block; vertical-align: middle; }
        .title { margin: 0; font-size: 34px; color: #0f172a; line-height: 1.05; }
        .subtitle { margin: 2px 0 0; font-size: 12px; color: #64748b; }
        .filters { margin: 10px 0 14px; padding: 10px 12px; border: 1px solid #dbeafe; border-radius: 6px; background: #f8fbff; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th, td { border: 1px solid #e5e7eb; padding: 7px; text-align: left; }
        th { background: #eff6ff; color: #1e3a8a; font-size: 11px; text-transform: uppercase; letter-spacing: .4px; }
        tbody tr:nth-child(even) { background: #fafafa; }
        .footer { margin-top: 14px; border-top: 1px solid #e5e7eb; padding-top: 8px; font-size: 11px; color: #6b7280; }
        .footer .left { float: left; }
        .footer .right { float: right; text-align: right; }
        .footer .page-counter { display: block; margin-top: 1px; line-height: 1.15; }
        @media print {
            @page { size: A4 portrait; margin: 12mm; }
            .no-print { display: none; }
        }
    </style>
    @php
        $officialLogoPath = asset('assets/img/brand/arcanjo-logo.svg');
    @endphp
</head>
<body>
<div class="page">
    <div class="header">
        <div class="header-left">
            <div class="brand">
                <img src="{{ $officialLogoPath }}" alt="Logo R.C.Anjo">
            </div>
            <div class="title-wrap">
                <h1 class="title">Relatório de Famílias Assistidas</h1>
                <div class="subtitle">Documento para conferência e impressão</div>
            </div>
        </div>
        <div class="header-right">
            <div><strong>Emitido em:</strong> {{ $generatedAt->format('d/m/Y H:i:s') }}</div>
            <div><strong>Total:</strong> {{ $items->count() }} registros</div>
        </div>
    </div>

    <div class="filters">
        <strong>Filtros aplicados:</strong>
        @php
            $parts = [];
            if (($filters['status'] ?? '') !== '') { $parts[] = 'Status: ' . ($filters['status'] == '1' ? 'Ativas' : 'Inativas'); }
            if (!empty($voluntaryName)) { $parts[] = 'Voluntário: ' . $voluntaryName; }
            if (($filters['family_size'] ?? '') !== '') { $parts[] = 'Família: ' . (($filters['family_size'] == '1') ? 'Apenas assistido' : (($filters['family_size'] == '6') ? '6+ pessoas' : $filters['family_size'] . ' pessoas')); }
            if (($filters['dependent_age_min'] ?? '') !== '' || ($filters['dependent_age_max'] ?? '') !== '') {
                $parts[] = 'Idade dependentes: ' . (($filters['dependent_age_min'] ?? '') !== '' ? $filters['dependent_age_min'] : '0') . ' a ' . (($filters['dependent_age_max'] ?? '') !== '' ? $filters['dependent_age_max'] : '+') . ' anos';
            }
            if (!empty($filters['show_dependents_info'])) { $parts[] = 'Informações dos dependentes: Exibir'; }
            if (($filters['search'] ?? '') !== '') { $parts[] = 'Busca: ' . $filters['search']; }
        @endphp
        {{ count($parts) ? implode(' | ', $parts) : 'Sem filtros específicos' }}
    </div>

    <table>
        <thead>
        <tr>
            <th>Nome</th>
            <th>Voluntário</th>
            @if (empty($filters['show_dependents_info']))
                <th>Dependentes</th>
            @else
                <th>Dependentes</th>
            @endif
            <th>Status</th>
            <th>Cadastro</th>
        </tr>
        </thead>
        <tbody>
        @forelse($items as $item)
            <tr>
                <td>{{ $item->name }}<br><span style="color:#6b7280; font-size:11px;">{{ $item->email }}</span></td>
                <td>{{ $item->voluntary?->name ?? 'Não atribuído' }}</td>
                @if (empty($filters['show_dependents_info']))
                    <td>{{ $item->dependents->count() }}</td>
                @else
                    <td>
                        @if ($item->dependents->count() > 0)
                            @foreach ($item->dependents as $dependent)
                                @php
                                    $firstName = explode(' ', trim((string) $dependent->name))[0] ?? (string) $dependent->name;
                                    $parentage = \App\Enums\Relationships::labelFrom($dependent->parentage) ?: 'parentesco não informado';
                                @endphp
                                <div style="color:#6b7280; font-size:11px; line-height: 1.3;">
                                    {{ $firstName }} ({{ $parentage }}) - {{ $dependent->dob ? \Carbon\Carbon::parse($dependent->dob)->age . ' anos' : 'idade não informada' }}
                                </div>
                            @endforeach
                        @else
                            <span style="color:#6b7280; font-size:11px;">Sem dependentes</span>
                        @endif
                    </td>
                @endif
                <td>{{ $item->active ? 'Ativo' : 'Inativo' }}</td>
                <td>{{ $item->created_at?->format('d/m/Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ !empty($filters['show_dependents_info']) ? 6 : 5 }}" style="text-align:center;">Nenhum registro encontrado.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="footer">
        <span class="left">{{ config('app.name') }} - Documento para impressão</span>
        <span class="right">
            <span>Gerado em {{ $generatedAt->format('d/m/Y H:i') }}</span>
            <span class="page-counter" id="printPageCounter">Este relatório possui 1 página</span>
        </span>
    </div>
</div>
<script>
    function updatePrintPageCounter() {
        const page = document.getElementById('printPageCounter');
        if (!page) return;

        const pxPerMm = 96 / 25.4;
        const printableHeightMm = 297 - 24;
        const printableHeightPx = printableHeightMm * pxPerMm;
        const totalPages = Math.max(1, Math.ceil(document.querySelector('.page').scrollHeight / printableHeightPx));

        page.textContent = `Este relatório possui ${totalPages} ${totalPages === 1 ? 'página' : 'páginas'}`;
    }

    window.onload = function () {
        updatePrintPageCounter();
        window.print();
    };
</script>
</body>
</html>
