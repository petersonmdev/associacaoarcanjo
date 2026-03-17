<div>
    <div class="row mb-3">
          <div class="col-md">
            <label for="nameVoluntary" class="form-label">Nome responsável</label>
            <input
              type="text"
              class="form-control @error('formData.name') is-invalid @enderror"
              id="nameVoluntary"
              name="nameVoluntary"
              wire:model="formData.name"
                x-ref="nameVoluntary"
                x-on:focus-name-voluntary.window="$nextTick(() => $refs.nameVoluntary?.focus())"
              placeholder="Nome completo"
            />
            @error('formData.name') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="col-md">
            <label for="dtNascVoluntary" class="form-label">Data de nascimento</label>
            <input class="form-control @error('formData.dob') is-invalid @enderror" type="date" id="dtNascVoluntary" name="dtNascVoluntary" wire:model="formData.dob" />
            @error('formData.dob') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="col-md">
            <label for="statusVoluntary" class="form-label">Status</label>
            <select class="form-select @error('formData.active') is-invalid @enderror" id="statusVoluntary" name="statusVoluntary" wire:model="formData.active" aria-label="status">
              @foreach ($statuses as $status)
                <option value="{{ $status->value }}" {{ $status->value == '1' ? "checked" : "" }}>{{ $status->label() }}</option>
              @endforeach
            </select>
            @error('formData.active') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md">
            <label for="cpfVoluntary" class="form-label">CPF</label>
            <input
              type="text"
              class="form-control @error('formData.taxvat') is-invalid @enderror"
              id="cpfVoluntary"
              name="cpfVoluntary"
              x-mask="999.999.999-99"
              wire:model="formData.taxvat"
              placeholder="999.999.999-99"
            />
            @error('formData.taxvat') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="col-md">
            <label for="telVoluntary" class="form-label">Telefone (Whatsapp)</label>
            <input
              type="tel"
              class="form-control @error('formData.phone') is-invalid @enderror"
              id="telVoluntary"
              name="telVoluntary"
              x-mask="(99)99999-9999"
              wire:model="formData.phone"
              placeholder="(99)99999-9999"
            />
            @error('formData.phone') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="col-md">
            <label for="emailVoluntary" class="form-label">Email</label>
            <input
              type="email"
              class="form-control @error('formData.email') is-invalid @enderror"
              id="emailVoluntary"
              name="emailVoluntary"
              wire:model="formData.email"
              placeholder="email@gmail.com"
            />
            @error('formData.email') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="col-md">
            <label for="drivingVoluntary" class="form-label">Condução</label>
            <select class="form-select" id="drivingVoluntary" name="" aria-label="Condução" wire:model="formData.driving">
              <option selected>Selecione sua condução</option>
              @foreach ($drivingOptions as $drivingOption)
                <option value="{{ $drivingOption->value }}">{{ $drivingOption->value }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <hr class="my-3">

        <div class="row mb-4">
          <div class="col-md-12 my-2">
            <h5><span class="tf-icons bx bx-home"></span>&nbsp; Endereço</h5>
          </div>
          <div class="col-md">
            <label for="cepAddressVoluntary" class="form-label">CEP</label>
            <div class="position-relative">
              <input type="text" class="form-control @error('formData.address.zipcode') is-invalid @enderror @if ($cepError) is-invalid @endif" id="cepAddressVoluntary" x-mask="99999-999" wire:model.live="formData.address.zipcode" wire:blur="fetchAddressByCepFromZipcode" placeholder="99999-999" @if($dontKnowZipcode) disabled @endif/>
              <div
                class="position-absolute top-50 end-0 translate-middle-y me-3"
                wire:loading.flex
                wire:target="formData.address.zipcode,fetchAddressByCep"
                style="display:none;"
              >
                <div class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></div>
              </div>
            </div>
            <div class="form-check mt-2">
              <input
                class="form-check-input"
                type="checkbox"
                id="unknownZipcode"
                wire:model.live="dontKnowZipcode"
              >
              <label class="form-check-label" for="unknownZipcode">
                Não sei o CEP
              </label>
            </div>
            @error('formData.address.zipcode') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
            @if ($cepError)
              <span class="d-block invalid-feedback">{{ $cepError }}</span>
            @endif
          </div>
          <div class="col-md">
            <label for="streetAddressVoluntary" class="form-label">Endereço</label>
            <input
              type="text"
              class="form-control @error('formData.address.street') is-invalid @enderror"
              id="streetAddressVoluntary"
              name="streetAddressVoluntary"
              wire:model="formData.address.street"
              placeholder="Nome da rua ou avenida"
            />
            @error('formData.address.street') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="col-md">
            <label for="numberAddressVoluntary" class="form-label">Número</label>
            <input
              type="text"
              class="form-control @error('formData.address.number') is-invalid @enderror"
              id="numberAddressVoluntary"
              name="numberAddressVoluntary"
              wire:model="formData.address.number"
              x-ref="numberAddressVoluntary"
              x-on:focus-number-address.window="$nextTick(() => $refs.numberAddressVoluntary?.focus())"
              placeholder="Número"
            />
            @error('formData.address.number') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md">
            <label for="complementAddressVoluntary" class="form-label">Complemento</label>
            <input
              type="text"
              class="form-control @error('formData.address.complement') is-invalid @enderror"
              id="complementAddressVoluntary"
              name="complementAddressVoluntary"
              wire:model="formData.address.complement"
              placeholder="Apartamento, suíte, sala, quadra, lote, etc."
            />
            @error('formData.address.complement') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="col-md">
            <label for="neighborhoodAddressVoluntary" class="form-label">Bairro</label>
            <input
              type="text"
              class="form-control @error('formData.address.neighborhood') is-invalid @enderror"
              id="neighborhoodAddressVoluntary"
              name="neighborhoodAddressVoluntary"
              wire:model="formData.address.neighborhood"
              placeholder="Bairro"
            />
            @error('formData.address.neighborhood') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="col-md">
            <label for="cityAddressVoluntary" class="form-label">Cidade</label>
            <input
              type="text"
              class="form-control @error('formData.address.city') is-invalid @enderror"
              id="cityAddressVoluntary"
              name="cityAddressVoluntary"
              wire:model="formData.address.city"
              placeholder="Cidade"
            />
            @error('formData.address.city') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="col-md">
            <label for="stateDependentVoluntary" class="form-label">Estado</label>
            <select class="form-select @error('formData.address.state') is-invalid @enderror" id="stateDependentVoluntary" name="stateDependentVoluntary" wire:model="formData.address.state" aria-label="Estado">
              <option selected>Selecione o estado</option>
              <option value="AC">Acre</option>
              <option value="AL">Alagoas</option>
              <option value="AP">Amapá</option>
              <option value="AM">Amazonas</option>
              <option value="BA">Bahia</option>
              <option value="CE">Ceará</option>
              <option value="DF">Distrito Federal</option>
              <option value="ES">Espírito Santo</option>
              <option value="GO">Goiás</option>
              <option value="MA">Maranhão</option>
              <option value="MT">Mato Grosso</option>
              <option value="MS">Mato Grosso do Sul</option>
              <option value="MG">Minas Gerais</option>
              <option value="PA">Pará</option>
              <option value="PB">Paraíba</option>
              <option value="PR">Paraná</option>
              <option value="PE">Pernambuco</option>
              <option value="PI">Piauí</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="RN">Rio Grande do Norte</option>
              <option value="RS">Rio Grande do Sul</option>
              <option value="RO">Rondônia</option>
              <option value="RR">Roraima</option>
              <option value="SC">Santa Catarina</option>
              <option value="SP">São Paulo</option>
              <option value="SE">Sergipe</option>
              <option value="TO">Tocantins</option>
              <option value="EX">Estrangeiro</option>
            </select>
            @error('formData.address.state') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
          </div>
        </div>

        <hr class="my-3">

        <div class="row mb-4">
          <div class="col-md-12 my-2">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 class="m-0"><span class="tf-icons bx bx-home-heart"></span>&nbsp; Assistidos vinculados</h5>
              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddAssisted" wire:click="openAssistedSuggestions">
                <span class="tf-icons bx bx-add-to-queue"></span>&nbsp; Adicionar Assistido
              </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalAddAssisted" tabindex="-1" aria-labelledby="modalCenterTitle" wire:ignore.self>
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Vincular Assistido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md mb-3">
                        <label for="searchAssisted" class="form-label">Pesquisar</label>
                        <input type="text" class="form-control" id="searchAssisted" wire:model.live.debounce.300ms="searchAssisted" placeholder="Busque por outros assistidos..." aria-describedby="searchAssistedControlHelp">
                        <div id="searchAssistedControlHelp" class="form-text">
                          Busque por pelo responsável pela família ou um de seus dependentes
                          <div class="text-muted small">
                            Digite pelo menos 2 caracteres para buscar assistidos.
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md">
                        @if ($pendingTransferAssistedId)
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

                        @if (
                          filled($formData['address']['neighborhood'] ?? null)
                          && filled($formData['address']['city'] ?? null)
                          && filled($formData['address']['state'] ?? null)
                        )
                          <div class="mb-3">
                            <p class="mb-2 fw-semibold">Sugestões por endereço (mesmo bairro, cidade e estado)</p>
                            <div class="list-group">
                              @forelse ($addressSuggestedAssisteds as $addressSuggestedAssisted)
                                @php
                                  $addressList = $addressSuggestedAssisted->addresses_info ? (array) json_decode($addressSuggestedAssisted->addresses_info) : [];
                                  $addressItem = $addressList ? reset($addressList) : null;
                                @endphp
                                <div class="list-group-item d-flex justify-content-between align-items-center gap-3">
                                  <div>
                                    <div class="fw-semibold">{{ $addressSuggestedAssisted->name }}</div>
                                    <small class="text-muted">{{ $addressItem->neighborhood ?? 'Bairro não informado' }} - {{ $addressItem->city ?? 'Cidade não informada' }}/{{ $addressItem->state ?? '-' }}</small>
                                    @if (!empty($addressSuggestedAssisted->voluntary_name))
                                      <div><span class="badge bg-label-warning mt-1">Vinculado a {{ $addressSuggestedAssisted->voluntary_name }}</span></div>
                                    @else
                                      <div><span class="badge bg-label-success mt-1">Sem voluntário vinculado</span></div>
                                    @endif
                                  </div>
                                  <button type="button" class="btn btn-sm btn-outline-primary" wire:click="queueAssistedAddition({{ $addressSuggestedAssisted->id }})">
                                    <span class="tf-icons bx bx-plus"></span>&nbsp; {{ !empty($addressSuggestedAssisted->voluntary_name) ? 'Transferir vínculo' : 'Adicionar' }}
                                  </button>
                                </div>
                              @empty
                                <div class="list-group-item text-muted">
                                  Nenhum assistido encontrado para o mesmo endereço.
                                </div>
                              @endforelse
                            </div>
                          </div>
                        @endif

                        @if ($showSuggestedAssisteds && strlen(trim($searchAssisted)) >= 2)
                          <div class="list-group">
                            @forelse ($suggestedAssisteds as $suggestedAssisted)
                              @php
                                $addresses = $suggestedAssisted->addresses_info ? (array) json_decode($suggestedAssisted->addresses_info) : [];
                                $address = $addresses ? reset($addresses) : null;
                              @endphp
                              <div class="list-group-item d-flex justify-content-between align-items-center gap-3">
                                <div>
                                  <div class="fw-semibold">{{ $suggestedAssisted->name }}</div>
                                  <small class="text-muted">{{ $address->neighborhood ?? 'Bairro não informado' }}</small>
                                  @if (!empty($suggestedAssisted->voluntary_name))
                                    <div><span class="badge bg-label-warning mt-1">Vinculado a {{ $suggestedAssisted->voluntary_name }}</span></div>
                                  @else
                                    <div><span class="badge bg-label-success mt-1">Sem voluntário vinculado</span></div>
                                  @endif
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" wire:click="queueAssistedAddition({{ $suggestedAssisted->id }})">
                                  <span class="tf-icons bx bx-plus"></span>&nbsp; {{ !empty($suggestedAssisted->voluntary_name) ? 'Transferir vínculo' : 'Adicionar' }}
                                </button>
                              </div>
                            @empty
                              <div class="list-group-item text-muted">
                                Nenhum assistido encontrado.
                              </div>
                            @endforelse
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
              <tr class="text-nowrap">
                <th>#</th>
                <th>Nome</th>
                <th>Dependentes</th>
                <th>Bairro</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
              </thead>
              <tbody>
              @if ($selectedAssisteds->isEmpty())
                <tr>
                  <td colspan="6" class="text-center">
                    <span>Nenhum assistido vinculado</span>
                  </td>
                </tr>
              @else
                @foreach ($selectedAssisteds as $assisted)
                  @php
                    $dependents = $assisted->dependents_info ? (array) json_decode($assisted->dependents_info) : [];
                    $addresses = $assisted->addresses_info ? (array) json_decode($assisted->addresses_info) : [];
                    $address = $addresses ? reset($addresses) : null;
                  @endphp
                  <tr>
                    <td>
                      <strong>{{ $assisted->id }}</strong>
                    </td>
                    <td>
                      <strong>{{ $assisted->name }}</strong>
                    </td>
                    <td>
                      <span>{{ count($dependents) }}</span>
                    </td>
                    <td>
                      <span>{{ $address->neighborhood ?? '-' }}</span>
                    </td>
                    <td>
                      <span class="badge bg-label-{{ (int) $assisted->active === 1 ? 'success' : 'secondary' }}">
                        {{ (int) $assisted->active === 1 ? 'Ativo' : 'Inativo' }}
                      </span>
                    </td>
                    <td>
                      <button type="button" class="btn btn-outline-danger" wire:click="removeAssisted({{ $assisted->id }})">
                        <span class="tf-icons bx bx-user-x"></span>&nbsp; Desvincular assistido
                      </button>
                    </td>
                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label for="createUserVoluntary" class="form-label">Criar usuário para voluntário acessar este sistema</label>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="createUserVoluntary" wire:model.live="createUserVoluntary">
              <label class="form-check-label" for="createUserVoluntary">Deseja criar um usuário para este voluntário?</label>
            </div>
            @if ($createUserVoluntary)
              <div class="row mt-3">
                <div class="col-md-6 col-12 mb-3">
                  <label for="emailUserVoluntary" class="form-label">E-mail do usuário</label>
                  <input
                    type="email"
                    class="form-control @error('formData.email') is-invalid @enderror"
                    id="emailUserVoluntary"
                    name="emailUserVoluntary"
                    wire:model="formData.email"
                    @if ($formData['email'])
                      disabled
                    @endif
                    placeholder="Digite o e-mail do usuário">
                  @error('formData.email') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 col-12 mb-3">
                  <label for="passwordUserVoluntary" class="form-label">Senha do usuário</label>
                  <div class="input-group input-group-merge" x-data="{ showPassword: false }">
                    <input
                      x-bind:type="showPassword ? 'text' : 'password'"
                      class="form-control @error('formData.user_password') is-invalid @enderror"
                      id="passwordUserVoluntary"
                      name="passwordUserVoluntary"
                      wire:model="formData.user_password"
                      placeholder="Digite a senha do usuário"
                    />
                    <button type="button" class="shadow-sm input-group-text cursor-pointer" x-on:click="showPassword = !showPassword" x-bind:aria-label="showPassword ? 'Ocultar senha' : 'Mostrar senha'">
                      <i class="bx" x-bind:class="showPassword ? 'bx-show' : 'bx-hide'"></i>
                    </button>
                    @error('formData.user_password') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
                  </div>
                </div>
              </div>
            @endif
          </div>
        </div>

        <hr class="my-3">

        <div class="row mt-3">
          <div class="flex-md-12 d-flex justify-content-between gap-3">
            <button class="btn btn-outline-secondary" type="button" wire:click="back()">Voltar</button>
        <button class="btn btn-success" type="submit" wire:click="save" >Salvar</button>
          </div>
        </div>
</div>
