<div>
  <div class="col-12">
    <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-6">
      <div class="flex-shrink-0 mt-1 mx-sm-0 mx-auto">
        <img src="{{ (Auth::user()->profile_photo_path) ? asset('uploads/'.Auth::user()->profile_photo_path) : asset('assets/img/avatars/avatar-default.png')}}" alt class="d-block h-auto ms-0 ms-sm-6 rounded-3 user-profile-img"/>
      </div>
      <div class="flex-grow-1 mt-3 mt-lg-5">
        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
          <div class="user-profile-info">
            <h4 class="mb-2 mt-lg-7">{{ (Auth::user()) ? Auth::user()->name : ''}}</h4>
            <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
              <li class="list-inline-item">
                <i class="bx bx-buildings me-2 align-top"></i><span class="fw-medium">Função/cargo/permissão</span>
              </li>
              <li class="list-inline-item">
                <i class='bx bx-envelope me-2 align-top'></i><span class="fw-medium">{{ Auth::user()->email }}</span>
              </li>
            </ul>
          </div>
          <a href="javascript:void(0)" class="btn btn-primary mb-1">
            <i class="bx bx-edit-alt bx-sm me-2"></i>Editar
          </a>
        </div>
      </div>
    </div>
  </div>

  <hr class="py-3">

  <div class="col-12">
    <small class="card-text text-uppercase text-muted small">Meus dados</small>
    <ul class="list-unstyled my-3 py-1">
      <li class="d-flex align-items-center mb-4"><i class="bx bx-user"></i><span class="fw-medium mx-2">Nome completo:</span> <span>{{Auth::user()->name}}</span></li>
      <li class="d-flex align-items-center mb-4"><i class="bx bx-check"></i><span class="fw-medium mx-2">Status:</span> <span>Activo</span></li>
      <li class="d-flex align-items-center mb-4"><i class="bx bx-crown"></i><span class="fw-medium mx-2">Função:</span> <span>Cargo</span></li>
    </ul>
  </div>
  <div class="col-12">
    <small class="card-text text-uppercase text-muted small">Contatos</small>
    <ul class="list-unstyled my-3 py-1">
      <li class="d-flex align-items-center mb-4"><i class='bx bxl-whatsapp' ></i><span class="fw-medium mx-2">Whatsapp:</span> <span>(99) 99999-9999</span></li>
      <li class="d-flex align-items-center mb-4"><i class="bx bx-phone"></i><span class="fw-medium mx-2">Contato 1:</span> <span>(99) 99999-9999</span></li>
      <li class="d-flex align-items-center mb-4"><i class="bx bx-phone"></i><span class="fw-medium mx-2">Contato 2:</span> <span>(99) 99999-9999</span></li>
    </ul>
  </div>
  <div class="col-12">
    <small class="card-text text-uppercase text-muted small">Endereço</small>
    <ul class="list-unstyled my-3 py-1">
      <li class="d-flex align-items-center mb-4"><i class="bx bx-home"></i><span class="fw-medium mx-2">Endereço completo:</span> <span>Rua Manoel Mendes Silva, 531. Distrito Industrial Governador Aquilino Mota Duarte. Boa Vista - RR</span></li>
    </ul>
  </div>
</div>
