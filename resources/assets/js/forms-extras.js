"use strict";

document.addEventListener('livewire:load', function () {
  Livewire.on('hideSuccessMessage', (timeout) => {
    setTimeout(() => {
      Livewire.emit('messageHidden');
    }, timeout);
  });
});

