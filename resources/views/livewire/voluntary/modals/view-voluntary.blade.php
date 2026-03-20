<div>
  <div class="modal fade" id="viewRegisterVoluntary{{$voluntaryView->id}}" tabindex="-1" aria-labelledby="modalViewVoluntaryTitle{{$voluntaryView->id}}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalViewVoluntaryTitle{{$voluntaryView->id}}">Cadastro completo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="well well-lg">
            <div class="d-flex justify-content-between flex-row py-2 fs-6">
              <div class="mb-1 d-block">
                <h5 class="mb-1 text-primary">{{$voluntaryView->name}}</h5>
                <span class="badge my-1 bg-label-{{ $voluntaryView->active ? 'primary' : 'danger' }}">{{ $voluntaryView->active ? 'Ativo' : 'Inativo' }}</span>
                <p class="mb-1">CPF: <span class="fw-medium">{{$voluntaryView->taxvat}}</span></p>
                <p class="mb-1">Email: <span class="fw-medium">{{$voluntaryView->email}}</span></p>
                @if ($contactsView)
                  <p class="mb-0">Contato(s): <span class="fw-medium">{{$contactsView->phone_number_whatsapp}}{{($contactsView->phone_number1) ? " | ".$contactsView->phone_number1 : ''}}{{($contactsView->phone_number2) ? " | ".$contactsView->phone_number2 : ''}}</span></p>
                @endif
              </div>
              <div class="mb-1 text-xl-end">
                <h5 class="text-primary">{{ '#'.sprintf('%04d', $voluntaryView->id) }}</h5>
                <small class="text-muted d-block">Data do cadastro: {{ \Carbon\Carbon::parse($voluntaryView->created_at)->format('d/m/Y H:i:s') }}</small>
                <small class="text-muted d-block">Atualizado em: {{ \Carbon\Carbon::parse($voluntaryView->updated_at)->format('d/m/Y H:i:s') }}</small>
              </div>
            </div>

            <hr class="my-2">

            <div class="row py-2">
              <div class="col-xl-6 col-md-6 col-sm-6 col-12 mb-2 fs-6">
                <h5 class="pb-1 text-primary">Dados pessoais</h5>
                <p class="mb-0">Data de nascimento: <span class="fw-medium">{{$voluntaryView->dob}}</span></p>
                <p class="mb-0">Condução: <span class="fw-medium">{{$voluntaryView->driving}}</span></p>
              </div>
              <div class="col-xl-6 col-md-6 col-sm-6 col-12 mb-2 fs-6">
                <h5 class="pb-1 text-primary">Endereço</h5>
                @if ($addressView)
                  <p class="mb-0">CEP: <span class="fw-medium">{{$addressView->zipcode}}</span></p>
                  <p class="mb-0">Logradouro: <span class="fw-medium">{{$addressView->address}}, {{$addressView->number}}</span></p>
                  <p class="mb-0">Complemento: <span class="fw-medium">{{$addressView->complement}}</span></p>
                  <p class="mb-0">Bairro: <span class="fw-medium">{{$addressView->neighborhood}}</span></p>
                  <p class="mb-0"><span class="fw-medium">{{$addressView->city}}-{{$addressView->state}}</span></p>
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
                  @forelse($assistedsView as $assisted)
                    @php
                      $addresses = $assisted->addresses_info ? (array) json_decode($assisted->addresses_info) : [];
                      $address = $addresses ? reset($addresses) : null;
                    @endphp
                    <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex justify-content-between">
                      <span>
                        <strong>{{ $assisted->name ?? '-' }}</strong>
                        <small class="d-block text-muted">Bairro: {{ $address->neighborhood ?? 'Bairro não informado' }}</small>
                      </span>
                      <small class="text-muted">{{ !empty($assisted->dob) ? ((int)date_diff(date_create($assisted->dob),date_create('today'))->y . ' anos') : '' }}</small>
                    </a>
                  @empty
                    <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
                      <p class="mb-1 text-center">Nenhum assistido vinculado</p>
                    </a>
                  @endforelse
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
</div>
