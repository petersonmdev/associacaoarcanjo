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

  Livewire.on('close-modal', (data) => {
    const modalId = data.modalId;
    const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));

    if (modal) {
      modal.hide();
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

window.addEventListener('close-modal', event => {
  try {
    if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
      const modalId = event.detail.modalId;
      const modalElement = document.getElementById(modalId);
      if (modalElement) {
        const modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) {
          modal.hide();
        }
      }
    }
  } catch (e) {
    console.error('Error closing modal:', e);
  }
});

function initializeAllTooltips() {
  // Only run if bootstrap is available
  if (typeof bootstrap === 'undefined' || !bootstrap.Tooltip) {
    console.warn('Bootstrap not yet available for tooltips');
    return;
  }

  // Dispose existing tooltips to avoid duplicates
  document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
    try {
      const tooltip = bootstrap.Tooltip.getInstance(el);
      if (tooltip) tooltip.dispose();
    } catch (e) {}
  });

  // Initialize new tooltips
  document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
    try {
      new bootstrap.Tooltip(el, {
        container: 'body',
        html: true,
        sanitize: false
      });
    } catch (e) {}
  });
}

// Livewire 3+ events
document.addEventListener('livewire:navigated', () => {
  setTimeout(initializeAllTooltips, 50);
});

document.addEventListener('livewire:updated', () => {
  setTimeout(initializeAllTooltips, 50);
});

// Fallback for initial page load
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => {
    setTimeout(initializeAllTooltips, 100);
  });
} else {
  setTimeout(initializeAllTooltips, 100);
}
