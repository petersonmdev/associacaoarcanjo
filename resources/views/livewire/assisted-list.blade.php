<div x-data>
  <div class="mb-4 d-flex">
    <div class="d-none d-md-block col-md-4">
      <div class="row">
        <div class="col-4 list-per-page">
          <select id="perpage" wire:model.live="perpage" aria-controls="DataTables_Table_0" class="form-select">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
        </div>
        <div class="col-8 assisted-status">
          <select id="statusAssisted" wire:model.live="status_assisted" aria-controls="DataTables_Table_0" class="form-select">
            <option value="">Todos status</option>
            <option value="1">Ativo</option>
            <option value="0">Inativo</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-8 align-content-end">
      <div class="add-assisted">
        <a href="{{route('assisted-new')}}" class="btn btn-primary float-md-end">
          <i class="bx bx-plus me-md-1"></i>
          Adicionar Assistido
        </a>
      </div>
    </div>
  </div>

  <div class="mb-3 d-block">
    <div class="content-search">
      <label class="form-label" for="searchAssisted">Pesquise por um assistido</label>
      <input type="text" id="searchAssisted" wire:model.live="search" class="form-control" placeholder="Busque por um assistido...">
    </div>
  </div>
  @if ($search)
    <p class="text-primary">Nome pesquisado: {{ $search }}</p>
  @endif

  <hr>

  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Dependentes</th>
        <th>Voluntário responsável</th>
        <th>Status</th>
        <th>Ações</th>
      </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      @foreach ($assisted as $item)
        <tr>
          <td>
            <a wire:key="{{ $item->id }}" href="javascript:void(0);"><span class="fw-medium">{{ '#'.sprintf('%04d', $item->id) }}</span></a>
          </td>
          <td>
            <strong>{{ $item->name }}</strong>
          </td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              @if ($item->dependents_info)
                @foreach(json_decode($item->dependents_info) as $dependent)
                  <li data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="top"
                      class="avatar avatar-xs pull-up text-body"
                      data-bs-html="true"
                      title="<span>{{ $dependent->name }}</span><small class='fw-light d-block'>{{ (int)date_diff(date_create($dependent->dob),date_create('today'))->y . " anos de idade" }}</small>"
                      aria-label="<span>{{ $dependent->name }}</span><small class='fw-light d-block'>{{ (int)date_diff(date_create($dependent->dob),date_create('today'))->y . " anos de idade" }}</small>"
                      data-bs-original-title="<span>{{ $dependent->name }}</span><small class='fw-light d-block'>{{ (int)date_diff(date_create($dependent->dob),date_create('today'))->y . " anos de idade" }}</small>">
                    <span class="bx bx-male dependent-{{$dependent->sex==='masculino' ? 'male' : 'female'}} dependent-icon"></span>
                  </li>
                @endforeach
                 <?php
                    $array = json_decode($item->dependents_info, true);
                    $numberOfElements = count($array);
                 ?>
                <li><small class="n-dependents">&nbsp;({{ $numberOfElements }})</small></li>
              @else
                <li><small class="n-dependents">&nbsp;(Sem dependentes)</small></li>
              @endif
            </ul>
          </td>
          <td>
            @if ($item->voluntary_name)
              <div class="d-flex justify-content-start align-items-center">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-2">
                    <?php
                      $works = explode(' ', $item->voluntary_name);
                      $initials = substr($works[0], 0, 1);
                      if (count($works) >=2) $initials .= substr($works[1], 0, 1);
                    ?>
                    <span class="avatar-initial rounded-circle bg-label-dark">{{$initials}}</span>
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="javascript:void(0);" class="text-body text-truncate">
                    <span class="fw-medium">{{$item->voluntary_name}}</span>
                  </a>
                  <small class="text-truncate text-muted">{{$item->voluntary_name ? "Ativo" : "Inativo"}}</small>
                </div>
              </div>
            @else
              <div class="d-block">
                <small class="fw-medium">nenhum voluntário vinculado</small>
              </div>
            @endif
          </td>
          <td>
            <div class="labels-status">
              <span class="badge bg-label-{{ $item->active ? 'primary' : 'danger' }}">{{ $item->active ? 'Ativo' : 'Inativo' }}</span>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <a href="{{route('assisted-new')}}"
                 data-bs-toggle="tooltip"
                 class="text-body"
                 data-bs-placement="top"
                 aria-label="Editar cadastro"
                 data-bs-original-title="Editar cadastro">
                <i class='bx bx-edit'></i>
              </a>
              <a href="javascript:void(0);"
                 data-bs-toggle="modal"
                 class="text-body"
                 data-bs-target="#viewRegisterAssisted{{$item->id}}"
              >
                <i class="bx bx-show mx-1"></i>
              </a>
              <div class="dropdown">
                <a href="javascript:void(0);" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                  @if ($item->contacts_info)
                    @foreach(json_decode($item->contacts_info) as $contact)
                      <a href="https://api.whatsapp.com/send?phone=55{{preg_replace('/[^0-9]/', '', $contact->whatsapp)}}" target="_blank" class="dropdown-item">Falar com
                        {{$item->name}}</a>
                      <div class="dropdown-divider"></div>
                    @endforeach
                  @endif
                  <a href="javascript:void(0);"
                     class="dropdown-item delete-record text-danger"
                     data-bs-toggle="modal"
                     data-bs-target="#modalConfirmeRemoveAssisted{{$item->id}}">
                    Deletar
                  </a>
                </div>
              </div>
            </div>
          </td>
        </tr>

        {{-- Modals --}}
        <div class="modal fade" id="modalConfirmeRemoveAssisted{{$item->id}}" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Deseja remover?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="text-wrap">Tem certeza que deseja remover o cadastro de <span class="fw-bold">{{ $item->name }}</span>?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  Fechar
                </button>
                <button type="button" class="btn btn-danger" wire:click="deleteAssisted({{ $item->id }})">Remover</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="viewRegisterAssisted{{$item->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">Cadastro completo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-column p-sm-3 p-0">
                  <div class="mb-xl-0 mb-4 d-block">
                    <h5 class="mb-1 text-primary">{{$item->name}}</h5>
                    <span class="badge my-1 bg-label-{{ $item->active ? 'primary' : 'danger' }}">{{ $item->active ? 'Ativo' : 'Inativo' }}</span>
                    <p class="mb-1">CPF: <span class="fw-medium">{{$item->taxvat}}</span></p>
                    <p class="mb-1">Email: <span class="fw-medium">{{$item->email}}</span></p>
                    @if ($item->contacts_info)
                      @foreach(json_decode($item->contacts_info) as $contact)
                        <p class="mb-0">Contato(s): <span class="fw-medium">{{$contact->whatsapp}}{{!isset($contact->phone1) ? ", ".$contact->phone1 : ''}}{{!isset($contact->phone2) ? ", ".$contact->phone2 : ''}}</span></p>
                      @endforeach
                    @endif
                  </div>
                  <div class="mb-xl-0 mb-4">
                    <h4 class="text-xl-end text-primary">{{ '#'.sprintf('%04d', $item->id) }}</h4>
                    <div class="mb-1 text-xl-end">
                      <span class="me-1">Data do cadastro:</span>
                      <span class="fw-medium">{{$item->created_at}}</span>
                    </div>
                    <div class="mb-1 text-xl-end">
                      <span class="me-1">Atualizado em:</span>
                      <span class="fw-medium">{{$item->updated_at}}</span>
                    </div>
                  </div>
                </div>
                <hr class="my-2">
                <div class="row p-sm-3 p-0">
                  <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                    <h6 class="pb-2 text-primary">Dados pessoais</h6>
                    <p class="mb-1">Data de nascimento: <span class="fw-medium">{{$item->dob}}</span></p>
                    <p class="mb-1">Estado Civil: <span class="fw-medium">{{$item->civil_status}}</span></p>
                    <p class="mb-1">Escolaridade: <span class="fw-medium">{{$item->education_level}}</span></p>
                    <p class="mb-1">Profissão: <span class="fw-medium">{{$item->profession}}</span></p>
                    <p class="mb-1">Desempregado: <span class="fw-medium">{{$item->jobless ? 'Sim' : 'Não'}}</span></p>
                  </div>
                  <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                    <h6 class="pb-2 text-primary">Endereço</h6>
                    @if ($item->addresses_info)
                      @foreach(json_decode($item->addresses_info) as $address)
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
                      @if ($item->dependents_info)
                        @foreach(json_decode($item->dependents_info) as $dependent)
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
                      @if ($item->incomes_info)
                        @foreach(json_decode($item->incomes_info) as $income)
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
                    <p class="mb-2">História de vida: <span class="fw-medium d-block">{{$item->life_history}}</span></p>
                    <p class="mb-2">Histórico de saúde: <span class="fw-medium d-block">{{$item->health_history}}</span></p>
                    <p class="mb-2">Medicamentos de uso continuo: <span class="fw-medium d-block">{{$item->continuous_medication}}</span></p>
                  </div>
                </div>
                <hr class="my-2">
                <div class="row p-sm-3 p-0">
                  <div class="col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                    <h6 class="pb-2 text-primary">Voluntário responsável</h6>
                    <div class="d-flex justify-content-start align-items-center user-name">
                      <div class="avatar-wrapper">
                        <div class="avatar avatar-sm me-2">
                          <span class="avatar-initial rounded-circle bg-label-info">{{$initials}}</span>
                        </div>
                      </div>
                      <div class="d-flex flex-column">
                        <span class="fw-medium">{{$item->voluntary_name}}</span>
                        <small class="text-truncate text-muted">{{$item->voluntary_name ? "Ativo" : "Inativo"}}</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                  Imprimir
                </button>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  Fechar
                </button>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      </tbody>
    </table>

  <div class="row">
    <div class="col-md-12 mt-5">
      {{ $assisted->links() }}
    </div>
  </div>
</div>
