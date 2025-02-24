<div>
  <div class="d-flex align-items-start align-items-sm-center gap-4 mb-3">
    <x-slot name="title">
      {{ __('Sessões Ativas') }}
    </x-slot>

    <x-slot name="description">
      {{ __('Gerencie e desconecte suas sessões ativas em outros navegadores e dispositivos.') }}
    </x-slot>

    <x-slot name="content">
      <div class="max-w-xl text-sm text-gray-600">
        {{ __('Caso necessário, você pode encerrar todas as sessões em outros dispositivos. Abaixo estão listadas suas sessões ativas.') }}
      </div>

      @if (count($this->sessions) > 0)
        @dd("Desgraçado!")
        <div class="mt-5 space-y-6">
          <!-- Other Browser Sessions -->
          @foreach ($this->sessions as $session)
            <div class="flex items-center">
              <div class="w-8 h-8 text-gray-500">
                @if ($session->is_current_device)
                  <span class="text-green-500 font-semibold">📌 {{ __('Este dispositivo') }}</span>
                @else
                  💻 {{ __('Outro dispositivo') }}
                @endif
              </div>

              <div class="ms-3">
                <div class="text-sm text-gray-600">
                  {{ $session->user_agent }} - {{ $session->ip_address }}
                </div>

                <div class="text-xs text-gray-500">
                  {{ __('Última atividade') }} {{ $session->last_active }}
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif

      <div class="flex items-center mt-5">
        <x-button wire:click="confirmLogout" wire:loading.attr="disabled">
          {{ __('Desconectar Outras Sessões') }}
        </x-button>

        <x-action-message class="ms-3" on="loggedOut">
          {{ __('Feito.') }}
        </x-action-message>
      </div>

      <x-dialog-modal wire:model.live="confirmingLogout">
        <x-slot name="title">
          {{ __('Desconectar Outras Sessões') }}
        </x-slot>

        <x-slot name="content">
          {{ __('Digite sua senha para confirmar que deseja desconectar suas sessões ativas em outros dispositivos.') }}

          <div class="mt-4">
            <x-input type="password" class="mt-1 block w-3/4"
                     autocomplete="current-password"
                     placeholder="{{ __('Senha') }}"
                     wire:model.live="password"
                     wire:keydown.enter="logoutOtherBrowserSessions" />

            <x-input-error for="password" class="mt-2" />
          </div>
        </x-slot>

        <x-slot name="footer">
          <x-secondary-button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
            {{ __('Cancelar') }}
          </x-secondary-button>

          <x-button class="ms-3"
                    wire:click="logoutOtherBrowserSessions"
                    wire:loading.attr="disabled">
            {{ __('Desconectar') }}
          </x-button>
        </x-slot>
      </x-dialog-modal>
    </x-slot>
  </div>
</div>
