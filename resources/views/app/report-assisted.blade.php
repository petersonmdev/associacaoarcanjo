@extends('layouts/contentNavbarLayout')

@section('title', 'Relatórios de familias assistidas')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-md-12">
      <div class="card text-center">
        <div class="card-body">
          <div class="avatar avatar-xl mx-auto mb-3">
            <span class="avatar-initial rounded-circle bg-label-warning">
              <i class="bx bx-code-alt fs-1"></i>
            </span>
          </div>
          <h4 class="card-title">Funcionalidade em Breve</h4>
          <p class="card-text">
            O módulo de <strong>relatórios de famílias assistidas</strong> está atualmente em fase de implementação.
          </p>
          <div class="progress mb-3 mx-auto" style="height: 8px; max-width: 300px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                 role="progressbar"
                 style="width: 80%"
                 aria-valuenow="80"
                 aria-valuemin="0"
                 aria-valuemax="100"></div>
          </div>
          <p class="text-muted small">Progresso: 80% concluído</p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
