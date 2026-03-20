<div>
  <div class="row mb-3">
    <div class="col-md-12 mt-2 mb-4">
      <h5 class="m-0 text-primary d-flex align-items-center"><span class="tf-icons bx bx-info-circle fs-3 me-2"></span>Dados pessoais</h5>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-12 col-md-6 mb-3">
          <label for="nameVoluntary" class="form-label">Nome completo</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameVoluntary" wire:model="name" placeholder="Nome completo"/>
          @error('name') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-3 mb-3">
          <label for="dtNascVoluntary" class="form-label">Data de nascimento</label>
          <input class="form-control @error('dob') is-invalid @enderror" type="date" wire:model="dob" id="dtNascVoluntary" />
          @error('dob') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-3 mb-3">
          <label for="statusVoluntary" class="form-label">Status</label>
          <select class="form-select @error('active') is-invalid @enderror" id="statusVoluntary" wire:model="active" aria-label="status">
            @foreach ($statuses as $status)
              <option value="{{ $status->value }}" @selected($active == $status->value)>{{ $status->label() }}</option>
            @endforeach
          </select>
          @error('active') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-4 mb-3">
          <label for="cpfVoluntary" class="form-label">CPF</label>
          <input type="text" class="form-control @error('taxvat') is-invalid @enderror" id="cpfVoluntary" x-mask="999.999.999-99" wire:model="taxvat" placeholder="999.999.999-99"/>
          @error('taxvat') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-4 mb-3">
          <label for="emailVoluntary" class="form-label">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailVoluntary" wire:model="email" placeholder="email@gmail.com" />
          @error('email') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-4 mb-3">
          <label for="phoneVoluntary" class="form-label">Celular (Whatsapp)</label>
          <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phoneVoluntary" x-mask="(99)99999-9999" wire:model="phone" placeholder="(99)99999-9999"/>
          @error('phone') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6 mb-3">
          <label for="drivingVoluntary" class="form-label">Categoria de habilitação</label>
          <select class="form-select @error('driving') is-invalid @enderror" id="drivingVoluntary" wire:model="driving" aria-label="Habilitação">
            <option value="" selected>Selecione uma categoria</option>
            @foreach ($drivings as $drv)
              <option value="{{ $drv->name }}" @selected($driving == $drv->name)>{{ $drv->value }}</option>
            @endforeach
          </select>
          @error('driving') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>
    </div>

    <hr class="mt-5 mb-3">

    <div class="col-md-12 mt-2 mb-4">
      <h5 class="m-0 text-primary d-flex align-items-center"><span class="tf-icons bx bx-home fs-3 me-2"></span>Endereço</h5>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-12 col-md-4 col-xl mb-3">
          <label for="cepVoluntary" class="form-label">CEP</label>
          <div class="position-relative">
            <input type="text" class="form-control @error('zipcode') is-invalid @enderror @if($cepError) is-invalid @endif"
              id="cepVoluntary" x-mask="99999-999"
              wire:model.live="zipcode"
              wire:blur="fetchAddressByCepFromZipcode"
              x-ref="numberVoluntary"
              x-on:focus-number-voluntary.window="$nextTick(() => $refs.numberVoluntary?.focus())"
              placeholder="99999-999"
              @if($dontKnowZipcode) disabled @endif/>
            <div class="position-absolute top-50 end-0 translate-middle-y me-3"
              wire:loading.flex
              wire:target="zipcode,fetchAddressByCep"
              style="display:none;">
              <div class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></div>
            </div>
          </div>
          <div class="form-check mt-2">
            <input class="form-check-input" type="checkbox" id="unknownZipcode"
              wire:model.live="dontKnowZipcode"
              @checked($dontKnowZipcode)>
            <label class="form-check-label" for="unknownZipcode">Não sei o CEP</label>
          </div>
          @error('zipcode') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          @if($cepError) <span class="d-block text-danger small mt-1">{{ $cepError }}</span> @endif
        </div>
        <div class="col-12 col-md-5 col-xl mb-3">
          <label for="streetVoluntary" class="form-label">Endereço</label>
          <input type="text" class="form-control @error('street') is-invalid @enderror" id="streetVoluntary" wire:model="street" placeholder="Nome da rua ou avenida"/>
          @error('street') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-3 col-xl mb-3">
          <label for="numberVoluntary" class="form-label">Número</label>
          <input type="text" class="form-control @error('number') is-invalid @enderror" id="numberVoluntary" wire:model="number" placeholder="Número" />
          @error('number') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6 mb-3">
          <label for="complementVoluntary" class="form-label">Complemento</label>
          <input type="text" class="form-control @error('complement') is-invalid @enderror" id="complementVoluntary" wire:model="complement" placeholder="Apartamento, suíte, sala, etc." />
          @error('complement') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-6 mb-3">
          <label for="neighborhoodVoluntary" class="form-label">Bairro</label>
          <input type="text" class="form-control @error('neighborhood') is-invalid @enderror" id="neighborhoodVoluntary" wire:model="neighborhood" placeholder="Bairro"/>
          @error('neighborhood') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-6 mb-3">
          <label for="cityVoluntary" class="form-label">Cidade</label>
          <input type="text" class="form-control @error('city') is-invalid @enderror" id="cityVoluntary" wire:model="city" placeholder="Cidade"/>
          @error('city') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-6 mb-3">
          <label for="stateVoluntary" class="form-label">Estado</label>
          <select class="form-select @error('state') is-invalid @enderror" id="stateVoluntary" wire:model="state" aria-label="Estado">
            <option value="" selected>Selecione o estado</option>
            @foreach ($states as $s)
              <option value="{{ $s->name }}" @selected($state == $s->name)>{{ $s->value }}</option>
            @endforeach
          </select>
          @error('state') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>
    </div>



    <hr class="mt-5 mb-3">

    <div class="col-md-12 mt-2 mb-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="m-0 text-primary d-flex align-items-center"><span class="tf-icons bx bx-home-heart fs-3 me-2"></span>Assistidos vinculados</h5>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddAssisted" wire:click="openAssistedSuggestions">
          <span class="tf-icons bx bx-add-to-queue"></span>&nbsp; Adicionar Assistido
        </button>
      </div>

      {{-- Modal de vínculo --}}
      <div class="modal fade" id="modalAddAssisted" tabindex="-1" aria-labelledby="modalAssistedTitle" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalAssistedTitle">Vincular Assistido</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md mb-3">
                  <label for="searchAssisted" class="form-label">Pesquisar</label>
                  <input type="text" class="form-control" id="searchAssisted"
                    wire:model.live.debounce.300ms="searchAssisted"
                    placeholder="Busque por um assistido..."
                    aria-describedby="searchAssistedHelp">
                  <div id="searchAssistedHelp" class="form-text text-muted small">
                    Busque pelo responsável pela família ou um de seus dependentes.
                    Digite pelo menos 2 caracteres para buscar.
                  </div>
                </div>
              </div>

              @if($pendingTransferAssistedId)
                <div class="alert alert-warning mb-3" role="alert">
                  <div class="fw-semibold mb-1">Assistido já vinculado</div>
                  <div class="mb-2">
                    O assistido <strong>{{ $pendingTransferAssistedName }}</strong> está vinculado ao voluntário
                    <strong>{{ $pendingTransferVoluntaryName }}</strong>. Se continuar, o vínculo será transferido para este novo voluntário.
                  </div>
                  <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-warning" wire:click="confirmTransferAndAddAssisted">
                      Confirmar transferência
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" wire:click="cancelTransferAssisted">
                      Cancelar
                    </button>
                  </div>
                </div>
              @endif

              @if(filled($neighborhood) && filled($city) && filled($state))
                <div class="mb-3">
                  <p class="mb-2 fw-semibold">Sugestões por endereço (mesmo bairro, cidade e estado)</p>
                  <div class="list-group">
                    @forelse($addressSuggestedAssisteds as $addressSuggested)
                      @php
                        $addrList = $addressSuggested->addresses_info ? (array) json_decode($addressSuggested->addresses_info) : [];
                        $addrItem = $addrList ? reset($addrList) : null;
                      @endphp
                      <div class="list-group-item d-flex justify-content-between align-items-center gap-3">
                        <div>
                          <div class="fw-semibold">{{ $addressSuggested->name }}</div>
                          <small class="text-muted">{{ $addrItem->neighborhood ?? 'Bairro não informado' }} - {{ $addrItem->city ?? 'Cidade não informada' }}/{{ $addrItem->state ?? '-' }}</small>
                          @if(!empty($addressSuggested->voluntary_name))
                            <div><span class="badge bg-label-warning mt-1">Vinculado a {{ $addressSuggested->voluntary_name }}</span></div>
                          @else
                            <div class="d-flex align-items-center gap-2 mt-1">
                              <span class="badge bg-label-primary">Prioritário</span>
                              <span class="badge bg-label-success">Sem voluntário vinculado</span>
                            </div>
                          @endif
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" wire:click="queueAssistedAddition({{ $addressSuggested->id }})">
                          <span class="tf-icons bx bx-plus"></span>&nbsp; {{ !empty($addressSuggested->voluntary_name) ? 'Transferir vínculo' : 'Adicionar' }}
                        </button>
                      </div>
                    @empty
                      <div class="list-group-item text-muted bg-[#4359710a]">
                        Nenhum assistido no mesmo bairro.
                      </div>
                    @endforelse
                  </div>
                </div>
              @endif

              @if($showSuggestedAssisteds && strlen(trim($searchAssisted)) >= 2)
                <div class="list-group">
                  @forelse($suggestedAssisteds as $suggested)
                    @php
                      $addrs = $suggested->addresses_info ? (array) json_decode($suggested->addresses_info) : [];
                      $addr  = $addrs ? reset($addrs) : null;
                    @endphp
                    <div class="list-group-item d-flex justify-content-between align-items-center gap-3">
                      <div>
                        <div class="fw-semibold">{{ $suggested->name }}</div>
                        <small class="text-muted">{{ $addr->neighborhood ?? 'Bairro não informado' }}</small>
                        @if(!empty($suggested->voluntary_name))
                          <div><span class="badge bg-label-warning mt-1">Vinculado a {{ $suggested->voluntary_name }}</span></div>
                        @else
                          <div class="d-flex align-items-center gap-2 mt-1">
                            <span class="badge bg-label-primary">Prioritário</span>
                            <span class="badge bg-label-success">Sem voluntário vinculado</span>
                          </div>
                        @endif
                      </div>
                      <button type="button" class="btn btn-sm btn-outline-primary" wire:click="queueAssistedAddition({{ $suggested->id }})">
                        <span class="tf-icons bx bx-plus"></span>&nbsp; {{ !empty($suggested->voluntary_name) ? 'Transferir vínculo' : 'Adicionar' }}
                      </button>
                    </div>
                  @empty
                    <div class="list-group-item text-muted bg-[#4359710a]">Nenhum assistido encontrado.</div>
                  @endforelse
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>

      {{-- Tabela de assistidos vinculados --}}
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nome</th>
              <th>Bairro</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            @forelse($selectedAssisteds as $assisted)
              @php
                $addrs = $assisted->addresses_info ? (array) json_decode($assisted->addresses_info) : [];
                $addr  = $addrs ? reset($addrs) : null;
              @endphp
              <tr>
                <td><strong>{{ $assisted->id }}</strong></td>
                <td><strong>{{ $assisted->name }}</strong></td>
                <td>{{ $addr->neighborhood ?? '-' }}</td>
                <td>
                  <span class="badge bg-label-{{ (int)$assisted->active === 1 ? 'success' : 'secondary' }}">
                    {{ (int)$assisted->active === 1 ? 'Ativo' : 'Inativo' }}
                  </span>
                </td>
                <td>
                  <button type="button" class="btn btn-sm btn-outline-danger" wire:click="removeAssisted({{ $assisted->id }})">
                    <span class="tf-icons bx bx-user-x"></span>&nbsp; Desvincular
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-muted">Nenhum assistido vinculado</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <hr class="mt-5 mb-3">

    <div class="mt-3">
      <div class="d-md-flex d-block justify-content-between flex-row-reverse gap-3">
        <button class="w-100 w-md-auto btn btn-lg btn-success mb-3" type="submit" wire:click="submitFormUser()">Salvar</button>
        <a class="w-100 w-md-auto btn btn-outline-secondary mb-3" href="{{ route('voluntary-list') }}"><i class="bx bx-list-ul me-2"></i> Voltar</a>
      </div>
    </div>
  </div>
</div>
