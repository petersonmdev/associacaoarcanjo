<div>
  <div class="modal fade printable" id="viewRegisterAssisted{{$assistedView->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel4">Cadastro completo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="printThis">
          <div class="well well-lg">
            <div class="d-flex justify-content-between flex-row py-2 fs-6">
              <div class="mb-1 d-block">
                <h5 class="mb-1 text-primary">{{$assistedView->name}}</h5>
                <span class="badge my-1 bg-label-{{ $assistedView->active ? 'primary' : 'danger' }}">{{ $assistedView->active ? 'Ativo' : 'Inativo' }}</span>
                <p class="mb-1">CPF: <span class="fw-medium">{{$assistedView->taxvat}}</span></p>
                <p class="mb-1">Email: <span class="fw-medium">{{$assistedView->email}}</span></p>
                @if ($contactsView)
                  <p class="mb-0">Contato(s): <span class="fw-medium">{{$contactsView->phone_number_whatsapp}}{{($contactsView->phone_number1) ? " | ".$contactsView->phone_number1 : ''}}{{($contactsView->phone_number2) ? " | ".$contactsView->phone_number2 : ''}}</span></p>
                @endif
              </div>
              <div class="mb-1">
                <h5 class="text-xl-end text-primary">{{ '#'.sprintf('%04d', $assistedView->id) }}</h5>
                <div class="mb-1 text-xl-end">
                  <span class="me-1">Data do cadastro:</span>
                  <span class="fw-medium">{{DateTime::createFromFormat('Y-m-d H:i:s', $assistedView->created_at)->format('d/m/Y H:i:s')}}</span>
                </div>
                <div class="mb-1 text-xl-end">
                  <span class="me-1">Atualizado em:</span>
                  <span class="fw-medium">{{DateTime::createFromFormat('Y-m-d H:i:s', $assistedView->updated_at)->format('d/m/Y H:i:s')}}</span>
                </div>
              </div>
            </div>

            <hr class="my-2">

            <div class="row py-2">
              <div class="col-xl-6 col-md-6 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-2 fs-6">
                <h5 class="pb-1 text-primary">Dados pessoais</h5>
                <p class="mb-0">Data de nascimento: <span class="fw-medium">{{$assistedView->dob}}</span></p>
                <p class="mb-0">Estado Civil: <span class="fw-medium">{{$assistedView->civil_status}}</span></p>
                <p class="mb-0">Escolaridade: <span class="fw-medium">{{$assistedView->education_level}}</span></p>
                <p class="mb-0">Profissão: <span class="fw-medium">{{$assistedView->profession}}</span></p>
                <p class="mb-0">Desempregado: <span class="fw-medium">{{$assistedView->jobless ? 'Sim' : 'Não'}}</span></p>
              </div>
              <div class="col-xl-6 col-md-6 col-sm-7 col-12">
                <h5 class="pb-1 text-primary">Endereço</h5>
                @if ($addressView)
                  <p class="mb-0">CEP: <span class="fw-medium">{{$addressView->zipcode}}</span></p>
                  <p class="mb-0">Logradouro: <span class="fw-medium">{{$addressView->zipcode. ', ' .$addressView->number}}</span></p>
                  <p class="mb-0">Complemento: <span class="fw-medium">{{$addressView->complement}}</span></p>
                  <p class="mb-0">Bairro: <span class="fw-medium">{{$addressView->neighborhood}}</span></p>
                  <p class="mb-0"><span class="fw-medium">{{$addressView->city.'-'.$addressView->state}}</span></p>
                @endif
              </div>
            </div>

            <hr class="my-2">

            <div class="row py-2">
              <div class="col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-2 fs-6">
                <h5 class="pb-1 text-primary">Composição famíliar</h5>
                <div class="list-group">
                  @if ($dependentsView)
                    @foreach($dependentsView as $dependent)
                      <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex justify-content-between w-100 flex-xl-row flex-column flex-md-row">
                          <p class="mb-0"><b>{{$dependent->name}}</b></p>
                          <small class='text-muted'>{{ (int)date_diff(date_create($dependent->dob),date_create('today'))->y . " anos de idade" }}</small>
                        </div>
                        <div class="d-flex justify-content-between w-100 flex-xl-row flex-column flex-md-row">
                          <p class="mb-0">Parentesco: <span class="fw-medium">{{$dependent->parentage}}</span></p>
                          <p class="mb-0">Profissão: <span class="fw-medium">{{$dependent->profession}}</span></p>
                          <p class="mb-0"><small class="text-muted d-block">PNE: {{$dependent->pne ? 'Sim' : 'Não'}}</small></p>
                        </div>
                      </a>
                    @endforeach
                  @else
                    <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
                      <p class="mb-1 text-center">Nenhum dependente cadastrado</p>
                    </a>
                  @endif
                </div>
              </div>
            </div>

            <hr class="my-2">

            <div class="row py-2">
              <div class="col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-2 fs-6">
                <h5 class="pb-1 text-primary">Renda famíliar mensal</h5>
                <div class="list-group">
                  @if ($incomesView)
                    @foreach($incomesView as $income)
                      <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex justify-content-between">
                        <div class="li-wrapper d-flex justify-content-start align-items-center">
                          <div class="avatar-wrapper">
                            <div class="avatar avatar-sm me-3">
                              <span class="avatar-initial rounded-circle bg-label-success">R$</span>
                            </div>
                          </div>
                          <div class="d-flex justify-content-between flex-row">
                            <p class="mb-0 mx-3">Origem: <span class="fw-medium">{{$income->name}}</span></p>
                            <p class="mb-0 mx-3">Valor: <span class="fw-medium">R$ {{number_format($income->incomes, 2, ',', '.')}}</span></p>
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

            <div class="row py-2">
              <div class="col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-2 fs-6">
                <h5 class="pb-2 text-primary">Saúde familiar e social</h5>
                <p class="mb-1">História de vida: <span class="fw-medium">{{$assistedView->life_history}}</span></p>
                <p class="mb-1">Histórico de saúde: <span class="fw-medium">{{$assistedView->health_history}}</span></p>
                <p class="mb-1">Medicamentos de uso continuo: <span class="fw-medium">{{$assistedView->continuous_medication}}</span></p>
              </div>
            </div>

            <hr class="my-2">

            <div class="row py-2">
              <div class="col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-2">
                <h5 class="pb-1 text-primary">Voluntário responsável</h5>
                <div class="d-flex justify-content-start align-items-center user-name">
                  <div class="avatar-wrapper">
                    <div class="avatar avatar-sm me-2">
                      @php
                        $works = explode(' ', $voluntaryView->name);
                        $initials = substr($works[0], 0, 1);
                        if (count($works) >=2) $initials .= substr($works[1], 0, 1);
                      @endphp
                      <span class="avatar-initial rounded-circle bg-label-info">{{$initials}}</span>
                    </div>
                  </div>
                  <div class="d-flex flex-column">
                    <span class="fw-medium">{{$voluntaryView->name}}</span>
                    <small class="text-truncate text-muted">{{$voluntaryView->active ? "Ativo" : "Inativo"}}</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Fechar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
