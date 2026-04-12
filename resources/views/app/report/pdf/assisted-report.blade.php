<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Assistidos</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; color: #334155; font-size: 12px; margin: 0; }
        .container { padding: 24px 28px 74px 28px; }
        .header { border-bottom: 2px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 16px; }
        .header-row { width: 100%; }
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
</head>
<body>
@php
    $officialLogoPath = public_path('assets/img/brand/arcanjo-logo.svg');
@endphp
<div class="container">
    <div class="header clearfix">
        <div style="float:left; width: 70%;">
            <img src="{{ $officialLogoPath }}" alt="Logo R.C.Anjo">

            <div class="title-wrap">
                <h1 class="title">Relatório de Famílias Assistidas</h1>
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
            if ($filters['status'] !== null && $filters['status'] !== '') { $parts[] = 'Status: ' . ($filters['status'] == '1' ? 'Ativas' : 'Inativas'); }
            if ($voluntaryName) { $parts[] = 'Voluntário: ' . $voluntaryName; }
            if (!empty($filters['family_size'])) { $parts[] = 'Tamanho da família: ' . ($filters['family_size'] == '1' ? 'Apenas assistido' : ($filters['family_size'] == '6' ? '6+ pessoas' : $filters['family_size'] . ' pessoas')); }
            if (($filters['dependent_age_min'] ?? '') !== '' || ($filters['dependent_age_max'] ?? '') !== '') { $parts[] = 'Idade dependentes: ' . (($filters['dependent_age_min'] ?? '') !== '' ? $filters['dependent_age_min'] : '0') . ' a ' . (($filters['dependent_age_max'] ?? '') !== '' ? $filters['dependent_age_max'] : '+') . ' anos'; }
            if (!empty($filters['show_dependents_info'])) { $parts[] = 'Informações dos dependentes: Exibir'; }
            if (!empty($filters['search'])) { $parts[] = 'Busca: ' . $filters['search']; }
        @endphp
        {{ count($parts) ? implode(' | ', $parts) : 'Sem filtros específicos' }}
    </div>

    <table class="table">
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
                <td>
                    <strong>{{ $item->name }}</strong><br>
                    <span class="muted">{{ $item->email }}</span>
                </td>
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
                                <div class="muted" style="font-size: 9px; line-height: 1.3;">
                                    {{ $firstName }} ({{ $parentage }}) - {{ $dependent->dob ? \Carbon\Carbon::parse($dependent->dob)->age . ' anos' : 'idade não informada' }}
                                </div>
                            @endforeach
                        @else
                            <span class="muted">Sem dependentes</span>
                        @endif
                    </td>
                @endif
                <td class="{{ $item->active ? 'status-active' : 'status-inactive' }}">{{ $item->active ? 'ATIVO' : 'INATIVO' }}</td>
                <td>{{ $item->created_at?->format('d/m/Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ !empty($filters['show_dependents_info']) ? 6 : 5 }}" style="text-align:center;">Nenhum registro encontrado.</td>
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
