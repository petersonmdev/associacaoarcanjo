<div>
  <div class="row" >
    <div class="col-md-4 col-xl-3 content-stepwizard border-end">
      <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step d-flex py-md-3 py-2">
            <a href="#step-1" type="button" class="me-2 fs-5 btn btn-icon {{ $current != 'assisted.create-multi-step.step-one' ? 'btn-outline-secondary' : 'btn-primary' }}">1</a>
            <div class="text-left">
              <h6 class="m-0 {{ $current === 'assisted.create-multi-step.step-one' ? 'text-primary' : '' }}">Dados pessoais</h6>
              <p><small>Informações pessoais do títular</small></p>
            </div>
          </div>
          <div class="stepwizard-step d-flex py-md-3 py-2">
            <a href="#step-2" type="button" class="me-2 fs-5 btn btn-icon {{ $current != 'assisted.create-multi-step.step-two' ? 'btn-outline-secondary' : 'btn-primary' }}">2</a>
            <div class="text-left">
              <h6 class="m-0 {{ $current === 'assisted.create-multi-step.step-two' ? 'text-primary' : '' }}">Telefones para contato</h6>
              <p><small>Informe formas para contato</small></p>
            </div>
          </div>
          <div class="stepwizard-step d-flex py-md-3 py-2">
            <a href="#step-3" type="button" class="me-2 fs-5 btn btn-icon {{ $current != 'assisted.create-multi-step.step-three' ? 'btn-outline-secondary' : 'btn-primary' }}" disabled="disabled">3</a>
            <div class="text-left">
              <h6 class="m-0 {{ $current === 'assisted.create-multi-step.step-three' ? 'text-primary' : '' }}">Endereço</h6>
              <p><small>Informe o endereço</small></p>
            </div>
          </div>
          <div class="stepwizard-step d-flex py-md-3 py-2">
            <a href="#step-4" type="button" class="me-2 fs-5 btn btn-icon {{ $current != 'assisted.create-multi-step.step-four' ? 'btn-outline-secondary' : 'btn-primary' }}" disabled="disabled">4</a>
            <div class="text-left">
              <h6 class="m-0 {{ $current === 'assisted.create-multi-step.step-four' ? 'text-primary' : '' }}">Composição familiar</h6>
              <p><small>Adicione os dependentes</small></p>
            </div>
          </div>
          <div class="stepwizard-step d-flex py-md-3 py-2">
            <a href="#step-5" type="button" class="me-2 fs-5 btn btn-icon {{ $current != 'assisted.create-multi-step.step-five' ? 'btn-outline-secondary' : 'btn-primary' }}" disabled="disabled">5</a>
            <div class="text-left">
              <h6 class="m-0 {{ $current === 'assisted.create-multi-step.step-five' ? 'text-primary' : '' }}">Renda familiar mensal</h6>
              <p><small>Informe a renda mensal</small></p>
            </div>
          </div>
          <div class="stepwizard-step d-flex py-md-3 py-2">
            <a href="#step-6" type="button" class="me-2 fs-5 btn btn-icon {{ $current != 'assisted.create-multi-step.step-six' ? 'btn-outline-secondary' : 'btn-primary' }}" disabled="disabled">6</a>
            <div class="text-left">
              <h6 class="m-0 {{ $current === 'assisted.create-multi-step.step-six' ? 'text-primary' : '' }}">Saúde familiar e social</h6>
              <p><small>Informe o histórico médico e social</small></p>
            </div>
          </div>
          <div class="stepwizard-step d-flex py-md-3 py-2">
            <a href="#step-7" type="button" class="me-2 fs-5 btn btn-icon {{ $current != 'assisted.create-multi-step.step-seven' ? 'btn-outline-secondary' : 'btn-primary' }}" disabled="disabled">7</a>
            <div class="text-left">
              <h6 class="m-0 {{ $current === 'assisted.create-multi-step.step-seven' ? 'text-primary' : '' }}">Vincular voluntário</h6>
              <p><small>Vincule um voluntário para essa família</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-8 col-xl-9 border-top border-xl-none border-md-none pt-3 pt-md-0">
      <livewire:dynamic-component :is="$current" :key="$current" :data="$formData" lazy="on-load" />
    </div>
  </div>
</div>
