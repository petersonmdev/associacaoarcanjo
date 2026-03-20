@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastro de voluntário')

@section('content')
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Voluntários /</span> {{ $voluntary->name }}</h4>
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
    <div class="d-flex flex-column justify-content-center">
      <h4 class="mb-1 mt-3">Voluntário</h4>
      <p class="text-muted">Cadastro <span class="fw-medium">{{ '#'.sprintf('%04d', $voluntary->id) }}</span></p>
    </div>
    <div class="d-flex align-content-center flex-wrap gap-3">
      <a href="{{ route('voluntary-list') }}" class="btn btn-outline-secondary">
        <i class="bx bx-list-ul me-2"></i> Voltar
      </a>
      <a href="{{ route('voluntary-update', ['id' => $voluntary->id]) }}" class="btn btn-primary">
        <i class='bx bx-edit-alt me-2'></i> Editar
      </a>
    </div>
  </div>

  <div class="row" id="show-voluntary-{{ $voluntary->id }}">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-widget-separator-wrapper">
          <div class="card-body card-widget-separator">
            <div class="well well-lg">
              <div class="d-flex justify-content-between flex-row py-2 fs-6">
                <div class="mb-1 d-block">
                  <h5 class="mb-1 text-primary">{{ $voluntary->name }}</h5>
                  <span class="badge my-1 bg-label-{{ $voluntary->active ? 'primary' : 'danger' }}">{{ $voluntary->active ? 'Ativo' : 'Inativo' }}</span>
                  <p class="mb-1">CPF: <span class="fw-medium">{{ $voluntary->taxvat }}</span></p>
                  <p class="mb-1">Email: <span class="fw-medium">{{ $voluntary->email }}</span></p>
                  @if ($contacts)
                    <p class="mb-0">Contato(s): <span class="fw-medium">{{ $contacts->phone_number_whatsapp }}{{ $contacts->phone_number1 ? ' | '.$contacts->phone_number1 : '' }}{{ $contacts->phone_number2 ? ' | '.$contacts->phone_number2 : '' }}</span></p>
                  @endif
                </div>
                <div class="mb-1 text-xl-end">
                  <h5 class="text-primary">{{ '#'.sprintf('%04d', $voluntary->id) }}</h5>
                  <small class="text-muted d-block">Data do cadastro: {{ \Carbon\Carbon::parse($voluntary->created_at)->format('d/m/Y H:i:s') }}</small>
                  <small class="text-muted d-block">Atualizado em: {{ \Carbon\Carbon::parse($voluntary->updated_at)->format('d/m/Y H:i:s') }}</small>
                </div>
              </div>

              <hr class="my-2">

              <div class="row py-2">
                <div class="col-xl-6 col-md-6 col-sm-6 col-12 mb-2 fs-6">
                  <h5 class="pb-1 text-primary">Dados pessoais</h5>
                  <p class="mb-0">Data de nascimento: <span class="fw-medium">{{ $voluntary->dob }}</span></p>
                  <p class="mb-0">Condução: <span class="fw-medium">{{ $voluntary->driving }}</span></p>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-6 col-12 mb-2 fs-6">
                  <h5 class="pb-1 text-primary">Endereço</h5>
                  @if ($address)
                    <p class="mb-0">CEP: <span class="fw-medium">{{ $address->zipcode }}</span></p>
                    <p class="mb-0">Logradouro: <span class="fw-medium">{{ $address->address }}, {{ $address->number }}</span></p>
                    <p class="mb-0">Complemento: <span class="fw-medium">{{ $address->complement }}</span></p>
                    <p class="mb-0">Bairro: <span class="fw-medium">{{ $address->neighborhood }}</span></p>
                    <p class="mb-0"><span class="fw-medium">{{ $address->city }}-{{ $address->state }}</span></p>
                  @else
                    <p class="mb-0 text-muted">Endereço não informado.</p>
                  @endif
                </div>
              </div>

              <hr class="my-2">

              <div class="row py-2">
                <div class="col-12 fs-6">
                  <h5 class="pb-1 text-primary">Assistidos vinculados</h5>
                  <div class="list-group">
                    @forelse($assisteds as $assisted)
                      @php
                        $addresses = $assisted->addresses_info ? (array) json_decode($assisted->addresses_info) : [];
                        $addressItem = $addresses ? reset($addresses) : null;
                      @endphp
                      <a href="{{ route('assisted-show', ['id' => $assisted->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between">
                        <span>
                          <strong>{{ $assisted->name ?? '-' }}</strong>
                          <small class="d-block text-muted">Bairro: {{ $addressItem->neighborhood ?? 'não informado' }}</small>
                        </span>
                        <small class="text-muted">{{ !empty($assisted->dob) ? ((int) date_diff(date_create($assisted->dob), date_create('today'))->y . ' anos') : '' }}</small>
                      </a>
                    @empty
                      <div class="list-group-item">
                        <p class="mb-1 text-center">Nenhum assistido vinculado</p>
                      </div>
                    @endforelse
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
