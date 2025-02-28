import Swal from '../assets/vendor/libs/sweetalert2/sweetalert2.js'
window.addEventListener('alert', (event) => {
  let data = event.detail;

  if (data.type==='warning') {
    Swal.fire({
      title: data.title,
      text: data.text,
      icon: data.type,
      showCancelButton: true,
      confirmButtonColor: "#66C732",
      cancelButtonColor: "#e6381a",
      confirmButtonText: "Sim, Remover!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Removido!",
          text: "O registro foi deletado.",
          icon: "success"
        });
      }
    });
  } else if (data.type==='save') {
    Swal.fire({
      title: data.title,
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Savar",
      denyButtonText: `Não salvar`
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        Swal.fire("Salvo!", "", "success");
      } else if (result.isDenied) {
        Swal.fire("Alterações descartadas", "", "info");
      }
    });
  } else {
    Swal.fire({
      position: (data.position) ?? 'center',
      icon: data.type,
      title: data.title,
      showConfirmButton: false,
      timer: (data.timer) ?? 1500,
    });
  }
});

window.addEventListener('livewire:initialized', (event) => {
  Livewire.hook('morph.updated', ({ el, component }) => {
    const firstInvalidElement = document.querySelector('.is-invalid');
    if (firstInvalidElement) {
      firstInvalidElement.focus();
    }
  });
});

window.addEventListener('close-modal', event => {
  const modalId = event.detail.modalId;
  const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));

  if (modal) {
    modal.hide();
  }
});

document.addEventListener('livewire:load', function () {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
});

document.addEventListener('livewire:update', function () {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
});
