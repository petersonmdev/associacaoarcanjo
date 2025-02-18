<div>
  <div class="row setup-content" id="step-5">
    <div class="col-12 title-step mb-3">
      <h4 class="m-0 text-primary"><span class="tf-icons bx bx-money fs-3"></span>&nbsp;Renda familiar</h4>
      <p>Informe a renda mensal</p>
    </div>

    <div class="row">
      <div class="col-12 form-check form-switch mt-2 mb-4 pe-3 ps-3 d-flex align-items-center">
        <input id="noIncomes" class="form-check-input m-0 @error('data.no_incomes') is-invalid @enderror" type="checkbox" wire:model="data.no_incomes" wire:change="noIncomes()"/>
        <label class="form-check-label ms-2" for="noIncomes">
          <span class="d-block">Não possuo renda</span>
          <small class="d-block text-secondary">não tenho nenhum tipo de renda mensal no momento</small>
        </label>
      </div>
    </div>

    <form class="form-repeater-incomes">
      <div data-repeater-list="group-a">
        <div data-repeater-item="">
          @if(empty($data['no_incomes']) || !$data['no_incomes'])
            @if(!empty($data['incomes']) && is_array($data['incomes']))
              @foreach($data['incomes'] as $i => $income)
                <div class="item-incomes row bg-footer-theme border p-3 m-0 mb-3">
                  <div class="mb-3 col-lg-6 col-xl-6 col-12">
                    <label class="form-label" for="form-repeater-2-1">Origem da renda</label>
                    <input type="text" id="form-repeater-2-1" class="form-control @error('data.incomes.'.$i.'.name') is-invalid @enderror" wire:model="data.incomes.{{$i}}.name" placeholder="informe a origem da renda">
                    @error('data.incomes.'.$i.'.name') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
                  </div>
                  <div class="mb-3 col-lg-4 col-xl-4 col-sm-8 col-12">
                    <label class="form-label" for="form-repeater-2-2">valor da renda</label>
                    <div class="input-group">
                      <span class="input-group-text">R$</span>
                      <input id="form-repeater-2-2" type="number" class="form-control @error('data.incomes.'.$i.'.value') is-invalid @enderror" wire:model="data.incomes.{{$i}}.value" placeholder="Digite o valor da renda (em reais)">
                      <span class="input-group-text">,00</span>
                      @error('data.incomes.'.$i.'.value') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                  </div>
                  <div class="mb-3 col-md-3 col-xl-2 col-6 d-flex align-items-end">
                    <button class="btn btn-outline-danger bg-white w-100 mt-4" wire:click.prevent="removeIncome({{$i}})">
                      <i class="bx bx-x me-1"></i> Excluir
                    </button>
                  </div>
                </div>
              @endforeach
            @endif
            <div class="mb-0" wire:view>
              <button class="btn btn-outline-primary" wire:click.prevent="addIncome">
                <i class="tf-icons bx bx bx-add-to-queue me-1"></i>
                <span class="align-middle">Adicionar Renda</span>
              </button>
            </div>
          @else
            <div class="alert alert-info" role="alert">
              Por favor, esteja ciente de que ao selecionar a opção <b>'Não possuo renda'</b> você declara que atualmente não possui nenhuma fonte de renda declarável.<br><br>
              Se isso estiver correto, por favor prossiga para próxima etapa, caso contrário, revise sua seleção.
            </div>
          @endif
        </div>
      </div>
    </form>

    <hr class="mt-3">

    <div class="my-4">
      <div class="col-12">
        <button class="btn btn-outline-secondary" type="button" wire:click="back()">Voltar</button>
        <button class="btn btn-primary float-end" wire:click="validateStep" type="button" >Próximo</button>
      </div>
    </div>
  </div>
</div>
