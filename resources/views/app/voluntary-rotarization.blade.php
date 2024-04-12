@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Roteirização /</span> {Nome do Voluntário}</h4>

<div class="card mb-4">
  <h5 class="card-header">Roterização de {Nome do voluntário}</h5>
  <div class="card-body">
    <div class="row mb-4">
      <div class="col-md">
        <p>Olá <span class="badge bg-label-primary">{Nome do voluntário}</span>, Selecione um mês para disponível para fazer sua roterização</p>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12 col-md-8 col-lg-4">
    <div class="row">
      <div class="col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3" style="position: relative;">
              <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title">
                  <h4 class="text-nowrap mb-2">Junho</h4>
                  <span class="badge bg-label-warning rounded-pill">2023</span>
                </div>
                <div class="mt-sm-auto">
                  <small class="text-primary text-nowrap fw-semibold">15 assistidos</small>
                  <h3 class="mb-0">0 entregues</h3>
                </div>
              </div>
              <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <a href="./voluntary-roterization-id.php" class="btn btn-outline-primary">
                  <span class="tf-icons bx bxs-map-alt"></span>&nbsp;Roterizar agora
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-8 col-lg-4">
    <div class="row">
      <div class="col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3" style="position: relative;">
              <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title">
                  <h4 class="text-nowrap text-secondary mb-2">Maio</h4>
                  <span class="badge bg-label-warning rounded-pill">2023</span>
                </div>
                <div class="mt-sm-auto">
                  <small class="text-primary text-nowrap fw-semibold">15 assistidos</small>
                  <h3 class="mb-0 text-secondary">15 entregues</h3>
                </div>
              </div>
              <div class="d-flex flex-sm-column flex-row align-items-end justify-content-between">
                <span class="badge bg-label-success">Roteiro realizado!</span>
                <a href="./voluntary-donated-history-month.php" class="btn btn-outline-secondary">
                  <span class="tf-icons bx bx-list-ul"></span>&nbsp;Ver histórico
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-8 col-lg-4">
    <div class="row">
      <div class="col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3" style="position: relative;">
              <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title">
                  <h4 class="text-nowrap text-secondary mb-2">Abril</h4>
                  <span class="badge bg-label-warning rounded-pill">2023</span>
                </div>
                <div class="mt-sm-auto">
                  <small class="text-primary text-nowrap fw-semibold">15 assistidos</small>
                  <h3 class="mb-0 text-secondary">15 entregues</h3>
                </div>
              </div>
              <div class="d-flex flex-sm-column flex-row align-items-end justify-content-between">
                <span class="badge bg-label-success">Roteiro realizado!</span>
                <a href="./voluntary-donated-history-month.php" class="btn btn-outline-secondary">
                  <span class="tf-icons bx bx-list-ul"></span>&nbsp;Ver histórico
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
