@extends('layouts/contentNavbarLayout')

@section('title', 'Relatórios de Famílias Assistidas')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Cabeçalho -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-0"><i class="bx bx-file-export me-2"></i>Relatórios de Famílias Assistidas</h4>
            </div>
        </div>
    </div>

    @livewire('report.report-assisted')
</div>

@endsection
