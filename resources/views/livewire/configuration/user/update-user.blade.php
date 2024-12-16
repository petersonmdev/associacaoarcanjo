<div>
  <div class="row mb-3">
    <livewire:configuration.user.user-avatar lazy="on-load" />

    <hr class="my-0" />

    <div class="row">
      <div class="mb-3 col-md-6">
        <label for="userName" class="form-label">Nome</label>
        <input class="form-control @error('userName') is-invalid @enderror" type="text" id="userName" wire:model="userName" placeholder="Seu nome"/>
        @error('userName') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="mb-3 col-md-6">
        <label for="email" class="form-label">E-mail</label>
        <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" wire:model="email" placeholder="email@example.com"/>
        @error('email') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="mb-3 col-md-6">
        <label class="form-label" for="phoneNumber">Telefone (Whatsapp)</label>
        <div class="input-group input-group-merge">
          <span class="input-group-text">(62)</span>
          <input
            type="text"
            id="phoneNumber"
            name="phoneNumber"
            class="form-control"
            placeholder="99999-9999"
          />
        </div>
      </div>
      <div class="mb-3 col-md-6">
        <label for="roleUser" class="form-label">Cargo</label>
        <select class="form-select" id="roleUser" name="" aria-label="Cargo">
          <option selected>Selecione o cargo</option>
          <option value="1">Administrador</option>
          <option value="2">Voluntário</option>
          <option value="3">Secretário</option>
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
        <input
          type="number"
          class="form-control"
          id="cepAddressVoluntary"
          name=""
          placeholder="99999-999"
        />
      </div>
      <div class="col-md">
        <label for="streetAddressVoluntary" class="form-label">Rua</label>
        <input
          type="text"
          class="form-control"
          id="streetAddressVoluntary"
          name=""
          placeholder="Endereço"
        />
      </div>
      <div class="col-md">
        <label for="numberAddressVoluntary" class="form-label">Número</label>
        <input
          type="text"
          class="form-control"
          id="numberAddressVoluntary"
          name=""
          placeholder="Número"
        />
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md">
        <label for="neighborhoodAddressVoluntary" class="form-label">Bairro</label>
        <input
          type="text"
          class="form-control"
          id="neighborhoodAddressVoluntary"
          name=""
          placeholder="Bairro"
        />
      </div>
      <div class="col-md">
        <label for="complementAddressVoluntary" class="form-label">Complemento</label>
        <input
          type="text"
          class="form-control"
          id="complementAddressVoluntary"
          name=""
          placeholder="Endereço"
        />
      </div>
      <div class="col-md">
        <label for="cityAddressVoluntary" class="form-label">Cidade</label>
        <input
          type="text"
          class="form-control"
          id="cityAddressVoluntary"
          name=""
          placeholder="Número"
        />
      </div>
      <div class="col-md">
        <label for="stateDependentVoluntary" class="form-label">Estado</label>
        <select class="form-select" id="stateDependentVoluntary" name="" aria-label="Estado">
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
      </div>
    </div>

    <div class="mt-2">
      <a class="btn btn-outline-secondary" href="{{url()->previous()}}">Voltar</a>
      <button class="btn btn-success float-end" type="submit" wire:click="submitFormUser()" >Salvar</button>
    </div>
  </div>
</div>
