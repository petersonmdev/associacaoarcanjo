<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Voluntários</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; color: #334155; font-size: 12px; margin: 0; }
        .container { padding: 24px 28px 74px 28px; }
        .header { border-bottom: 2px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 16px; }
        .brand { display: inline-block; margin-right: 12px; vertical-align: middle; }
        .brand img { width: 190px; height: auto; display: block; }
        .title-wrap { display: inline-block; vertical-align: top; }
        .title { margin: 0; font-size: 18px; color: #0f172a; }
        .subtitle { margin: 2px 0 0 0; color: #64748b; font-size: 11px; }
        .meta { float: right; text-align: right; color: #475569; font-size: 11px; }
        .clearfix::after { content: ""; display: block; clear: both; }
        .filters { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px; margin-bottom: 14px; }
        .filters strong { color: #0f172a; }
        .table { width: 100%; border-collapse: collapse; }
        .table thead th { background: #eff6ff; color: #1e3a8a; font-size: 11px; text-transform: uppercase; letter-spacing: .4px; border: 1px solid #dbeafe; padding: 8px; text-align: left; }
        .table td { border: 1px solid #e2e8f0; padding: 7px 8px; vertical-align: top; }
        .muted { color: #64748b; font-size: 10px; }
        .status-active { color: #166534; font-weight: 700; }
        .status-inactive { color: #b91c1c; font-weight: 700; }
        .footer { position: fixed; bottom: 0; left: 0; right: 0; border-top: 1px solid #e2e8f0; background: #fff; padding: 8px 28px; font-size: 10px; color: #64748b; }
        .footer .left { float: left; }
        .footer .right { float: right; }
    </style>
    @php
        $officialLogoPath = public_path('assets/img/brand/arcanjo-logo.svg');
    @endphp
</head>
<body>
<div class="container">
    <div class="header clearfix">
        <div style="float:left; width: 70%;">
            <span class="brand">
                <img src="{{ $officialLogoPath }}" alt="Logo R.C.Anjo">
            </span>
            <div class="title-wrap">
                <h1 class="title">Relatório de Voluntários</h1>
                <p class="subtitle">Associação Arcanjo - Gestão Social</p>
            </div>
        </div>
        <div class="meta">
            <div><strong>Exportado em:</strong> {{ $generatedAt->format('d/m/Y H:i:s') }}</div>
            <div><strong>Total:</strong> {{ $items->count() }} registros</div>
        </div>
    </div>

    <div class="filters">
        <strong>Filtros aplicados:</strong>
        @php
            $parts = [];
            if ($filters['status'] !== null && $filters['status'] !== '') { $parts[] = 'Status: ' . ($filters['status'] == '1' ? 'Ativos' : 'Inativos'); }
            if (!empty($filters['search'])) { $parts[] = 'Busca: ' . $filters['search']; }
        @endphp
        {{ count($parts) ? implode(' | ', $parts) : 'Sem filtros específicos' }}
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>Voluntário</th>
            <th>Assistidos</th>
            <th>Status</th>
            <th>Cadastro</th>
        </tr>
        </thead>
        <tbody>
        @forelse($items as $item)
            <tr>
                <td>
                    <strong>{{ $item->name }}</strong>
                    @if ($item->email)
                        <br><span class="muted">{{ $item->email }}</span>
                    @endif
                </td>
                <td>{{ $item->assisted_count ?? 0 }}</td>
                <td class="{{ $item->active ? 'status-active' : 'status-inactive' }}">{{ $item->active ? 'ATIVO' : 'INATIVO' }}</td>
                <td>{{ $item->created_at?->format('d/m/Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align:center;">Nenhum registro encontrado.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="footer clearfix">
    <div class="left">{{ config('app.name') }} - Relatório oficial</div>
    <div class="right"></div>
</div>
</body>
</html>
