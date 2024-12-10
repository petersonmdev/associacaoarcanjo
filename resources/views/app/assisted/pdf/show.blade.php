@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastro de família assistida')

@section('content')
<style>
  html,body{
    background:#fff!important
  }
  #layout-menu, #layout-navbar, .content-footer {
    display: none!important;
  }
  .layout-page {
    padding-left: 0!important;
  }
  .document-print{
    min-width:768px!important;
    font-size:15px!important
  }
  .document-print svg{
    fill:#646e78!important
  }
  .document-print *{
    color:#646e78!important
  }
  .dark-style .document-print th {
    color:#fff!important
  }

  /*Default template*/
  .flex-xl-row {
    -ms-flex-direction: row !important;
    flex-direction: row !important;
  }
</style>
<div class="document-print p-12">
  <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-column p-sm-3 p-0">
    <div class="mb-xl-0 mb-4 d-block">
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{url('/')}}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">
            <svg width="25" version="1.0" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 19.544 18.75">
              <g fill="#696cff">
                <path d="M1.335 2.24C.89 2.733.827 4.528 1.24 5.338c.175.334.365 1.033.429 1.541.159 1.319.429 1.875 1.255 2.558.477.397.731.715.731.953 0 .477.667 1.144 1.398 1.382.334.095.683.254.794.35.127.095.191.079.191-.064 0-.381-.222-.588-.985-.922-.683-.286-1.224-.874-1.017-1.08.048-.048.302 0 .588.095.62.207.651.191.413-.302-.127-.238-.556-.524-1.208-.779-.588-.238-1.16-.588-1.335-.826-.286-.397-.636-1.732-.493-1.875.079-.079 1.923.461 2.479.731.222.111.524.318.667.445.24.241.255.241.255-.077 0-.191-.238-.588-.524-.858-.381-.397-.747-.572-1.525-.715-.81-.159-1.144-.318-1.573-.747-.508-.508-.54-.604-.477-1.351.111-1.16.27-1.224 1.176-.524.985.763 2.256 1.335 4.354 1.971 2.574.794 3.512 1.446 4.036 2.86l.27.715-1.033 2.78c-.572 1.525-1.144 2.86-1.287 2.955-.397.286-.286.572.207.508.365-.048.493-.191.89-1.208l.445-1.144h.858c.683 0 .826-.048.763-.238-.064-.159-.318-.238-.779-.238h-.683l.413-1.192c.238-.651.461-1.192.508-1.192s.254.477.461 1.065c.683 1.923 1.891 4.131 2.701 4.958.906.937 1.525 1.271 2.574 1.398.651.079.779.048.779-.159 0-.143-.238-.365-.508-.493-1.128-.477-2.002-1.891-3.543-5.657-1.193-2.89-1.94-4.32-2.56-4.876s-1.589-.922-4.163-1.557C5.18 4.036 4.084 3.56 2.781 2.622c-.556-.397-1.033-.715-1.081-.715-.032 0-.191.143-.365.334"/>
                <path d="M8.819 2.383c-.715.143-2.034.636-1.939.731.032.048.334-.048.683-.191 3.035-1.271 6.944.286 8.39 3.353.842 1.748.937 3.766.27 5.45-.334.826-.334.858-.048 1.398l.286.556.429-.874c.763-1.557.953-3.607.493-5.196-1.08-3.671-4.846-5.975-8.565-5.228M3.909 13.188c.604 1.096 2.082 2.463 3.273 3.019 1.668.779 3.893.89 5.561.286.588-.207.588-.207.302-.572l-.27-.381-.937.27c-.953.286-2.526.35-3.432.159-1.398-.318-3.114-1.462-3.941-2.669-.715-1.049-1.096-1.112-.556-.111"/>
              </g>
            </svg>
          </span>
          <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span>
        </a>
      </div>
      <h5 class="mb-1 text-primary">{{$assisted->name}}</h5>
      <span class="badge my-1 bg-label-{{ $assisted->active ? 'primary' : 'danger' }}">{{ $assisted->active ? 'Ativo' : 'Inativo' }}</span>
      <p class="mb-1">CPF: <span class="fw-medium">{{$assisted->taxvat}}</span></p>
      <p class="mb-1">Email: <span class="fw-medium">{{$assisted->email}}</span></p>
      @if ($assisted->contacts_info)
        @foreach(json_decode($assisted->contacts_info) as $contact)
          <p class="mb-0">Contato(s): <span class="fw-medium">{{$contact->whatsapp}}{{!isset($contact->phone1) ? ", ".$contact->phone1 : ''}}{{!isset($contact->phone2) ? ", ".$contact->phone2 : ''}}</span></p>
        @endforeach
      @endif
    </div>
    <div class="mb-xl-0 mb-4">
      <h4 class="text-xl-end text-primary">{{ '#'.sprintf('%04d', $assisted->id) }}</h4>
      <div class="mb-1 text-xl-end">
        <span class="me-1">Data do cadastro:</span>
        <span class="fw-medium">{{$assisted->created_at}}</span>
      </div>
      <div class="mb-1 text-xl-end">
        <span class="me-1">Atualizado em:</span>
        <span class="fw-medium">{{$assisted->updated_at}}</span>
      </div>
    </div>
  </div>

  <hr class="my-2">

  <div class="row p-sm-3 p-0">
    <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
      <h6 class="pb-2 text-primary">Dados pessoais</h6>
      <p class="mb-1">Data de nascimento: <span class="fw-medium">{{$assisted->dob}}</span></p>
      <p class="mb-1">Estado Civil: <span class="fw-medium">{{$assisted->civil_status}}</span></p>
      <p class="mb-1">Escolaridade: <span class="fw-medium">{{$assisted->education_level}}</span></p>
      <p class="mb-1">Profissão: <span class="fw-medium">{{$assisted->profession}}</span></p>
      <p class="mb-1">Desempregado: <span class="fw-medium">{{$assisted->jobless ? 'Sim' : 'Não'}}</span></p>
    </div>
    <div class="col-xl-6 col-md-12 col-sm-7 col-12">
      <h6 class="pb-2 text-primary">Endereço</h6>
      @if ($assisted->addresses_info)
        @foreach(json_decode($assisted->addresses_info) as $address)
          <p class="mb-1">CEP: <span class="fw-medium">{{$address->zipcode}}</span></p>
          <p class="mb-1">Logradouro: <span class="fw-medium">{{$address->zipcode. ', ' .$address->number}}</span></p>
          <p class="mb-1">Complemento: <span class="fw-medium">{{$address->complement}}</span></p>
          <p class="mb-1">Bairro: <span class="fw-medium">{{$address->neighborhood}}</span></p>
          <p class="mb-0"><span class="fw-medium">{{$address->city.'-'.$address->state}}</span></p>
        @endforeach
      @endif
    </div>
  </div>

  <hr class="my-2">
  <div class="row p-sm-3 p-0">
    <div class="col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
      <h6 class="pb-2 text-primary">Composição famíliar</h6>
      <div class="list-group">
        @if ($assisted->dependents_info)
          @foreach(json_decode($assisted->dependents_info) as $dependent)
            <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex justify-content-between w-100 flex-xl-row flex-column flex-md-row mb-3">
                <h6 class="mb-1">{{$dependent->name}}</h6>
                <small class='text-muted'>{{ (int)date_diff(date_create($dependent->dob),date_create('today'))->y . " anos de idade" }}</small>
              </div>
              <div class="d-flex justify-content-between w-100 flex-xl-row flex-column flex-md-row">
                <p class="mb-2">Parentesco: <span class="fw-medium d-block">{{$dependent->parentage}}</span></p>
                <p class="mb-2">Profissão: <span class="fw-medium d-block">{{$dependent->profession}}</span></p>
                <p class="mb-2"><small class="text-muted d-block">PNE: {{$dependent->pne ? 'Sim' : 'Não'}}</small></p>
              </div>
            </a>
          @endforeach
        @else
          <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
            <p class="mb-1 text-center">Nenhuma dependente cadastrado</p>
          </a>
        @endif
      </div>
    </div>
  </div>

  <hr class="my-2">

  <div class="row p-sm-3 p-0">
    <div class="col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
      <h6 class="pb-2 text-primary">Renda famíliar mensal</h6>
      <div class="list-group">
        @if ($assisted->incomes_info)
          @foreach(json_decode($assisted->incomes_info) as $income)
            <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex justify-content-between">
              <div class="li-wrapper d-flex justify-content-start align-items-center">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-3">
                    <span class="avatar-initial rounded-circle bg-label-success">R$</span>
                  </div>
                </div>
                <div class="d-flex justify-content-between w-100 flex-xl-row flex-column flex-md-row">
                  <p class="mb-0 me-2">Origem: <span class="fw-medium">{{$income->name}}</span></p>
                  <p class="mb-0 me-2">Valor: <span class="fw-medium">{{$income->value}}</span></p>
                </div>
              </div>
            </a>
          @endforeach
        @else
          <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
            <p class="mb-1 text-center">Nenhum renda cadastrada</p>
          </a>
        @endif
      </div>
    </div>
  </div>

  <hr class="my-2">

  <div class="row p-sm-3 p-0">
    <div class="col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
      <h6 class="pb-2 text-primary">Saúde familiar e social</h6>
      <p class="mb-2">História de vida: <span class="fw-medium d-block">{{$assisted->life_history}}</span></p>
      <p class="mb-2">Histórico de saúde: <span class="fw-medium d-block">{{$assisted->health_history}}</span></p>
      <p class="mb-2">Medicamentos de uso continuo: <span class="fw-medium d-block">{{$assisted->continuous_medication}}</span></p>
    </div>
  </div>

  <hr class="my-2">

  <div class="row p-sm-3 p-0">
    <div class="col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
      <h6 class="pb-2 text-primary">Voluntário responsável</h6>
      <div class="d-flex justify-content-start align-items-center user-name">
        <div class="avatar-wrapper">
          <div class="avatar avatar-sm me-2">
            <span class="avatar-initial rounded-circle bg-label-info">{{!empty($initials)??$initials}}</span>
          </div>
        </div>
        <div class="d-flex flex-column">
          <span class="fw-medium">{{$assisted->voluntary_name}}</span>
          <small class="text-truncate text-muted">{{$assisted->voluntary_name ? "Ativo" : "Inativo"}}</small>
        </div>
      </div>
    </div>
  </div>

  <hr class="mt-0 mb-6">

  <div class="row">
    <div class="col-12">
      <span class="fw-medium">{{config('app.name')}}</span>
      <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future
        freelance projects. Thank You!</span>
    </div>
  </div>
</div>

<script>
  // Disparar a impressão automaticamente quando a página carregar
  window.onload = function() {
    window.print();
  };
</script>
@endsection
