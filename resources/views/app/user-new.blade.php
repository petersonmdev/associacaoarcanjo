@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Usuários /</span> Novo cadastro</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Novo usuário</h5>
      <!-- Account -->
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img
            src="assets/img/avatars/1.png"
            alt="user-avatar"
            class="d-block rounded"
            height="100"
            width="100"
            id="uploadedAvatar"
          />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Adicionar nova foto</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input
                type="file"
                id="upload"
                class="account-file-input"
                hidden
                accept="image/png, image/jpeg"
              />
            </label>
            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
              <i class="bx bx-reset d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Remover foto</span>
            </button>

            <p class="text-muted mb-0">JPG, GIF ou PNG permitidos. Tamanho máximo de 800kb</p>
          </div>
        </div>
      </div>
      <hr class="my-0" />
      <div class="card-body">
        <form id="formAccountSettings" method="POST" onsubmit="return false">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="userName" class="form-label">Nome</label>
              <input
                class="form-control"
                type="text"
                id="userName"
                name=""
                placeholder="Seu nome"
                autofocus
              />
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input
                class="form-control"
                type="text"
                id="email"
                name="email"
                placeholder="email@example.com"
              />
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
            <button type="submit" class="btn btn-primary me-2">Salvar</button>
            <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
@endsection
