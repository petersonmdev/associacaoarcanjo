<div>
  <div class="table-responsive">
    <table class="table">
      <thead>
      <tr>
        <th class="text-truncate">{{ __('Dispositivo') }}</th>
        <th class="text-truncate">{{ __('IP') }}</th>
        <th class="text-truncate">{{ __('Localização') }}</th>
        <th class="text-truncate">{{ __('Última atividade') }}</th>
      </tr>
      </thead>
      <tbody>
      @if (count($this->sessions) > 0)
        @foreach ($this->sessions as $session)
          <tr class="items-center">
            <td class="text-truncate text-heading fw-medium">
              <div class="d-flex align-items-center">
                @php
                  $iconClass = 'bx-md me-4';
                  $userAgent = $session->user_agent;
                  $isCurrentDevice = $session->is_current_device;
                  $deviceText = $isCurrentDevice ? __('(Este dispositivo)') : __('');
                @endphp

                @switch($userAgent)
                  @case('Android')
                    <i class="bx bxl-android {{ $iconClass }} text-success"></i>
                    @break
                  @case('MacOS')
                  @case('iOS')
                    <i class="bx bxl-apple {{ $iconClass }}"></i>
                    @break
                  @case('Windows')
                    <i class="bx bxl-windows {{ $iconClass }} text-info"></i>
                    @break
                  @default
                    <i class="bx bx-desktop {{ $iconClass }} text-danger"></i>
                @endswitch

                <span class="text-green-500 font-bold">
                      {{ $userAgent }} <small class="text-muted">{{ $deviceText }}</small>
                    </span>
              </div>
            </td>

            <td class="text-truncate">
              <div class="text-sm text-gray-600">
                {{ $session->ip_address }}
              </div>
            </td>

            <td class="text-truncate">
              <div class="text-sm text-gray-600">
                {{ $session->location }}
              </div>
            </td>

            <td class="text-truncate">
              <div class="text-xs text-gray-500">
                {{ $session->last_active }}
              </div>
            </td>
          </tr>
        @endforeach
      @endif
      </tbody>
    </table>
  </div>

  <div class="flex items-center my-5">
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
      {{ __('Desconectar Outras Sessões') }}
    </button>
  </div>

  <div wire:ignore.self class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form wire:submit.prevent="logoutOtherBrowserSessions">
          <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">{{ __('Desconectar Outras Sessões') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            {{ __('Digite sua senha para confirmar que deseja desconectar suas sessões ativas em outros dispositivos.') }}
            <div class="mt-3">
              <input type="password" class="form-control @error('password') is-invalid @enderror"
                     placeholder="{{ __('Digite sua senha') }}"
                     wire:model.defer="password">
              <x-input-error for="password" class="text-danger" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              {{ __('Cancelar') }}
            </button>
            <button type="submit" class="btn btn-danger" wire:click="logoutOtherBrowserSessions">
              {{ __('Desconectar') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
