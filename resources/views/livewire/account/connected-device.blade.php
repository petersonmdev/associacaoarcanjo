<x-slot name="title">
  {{ __('Sessões Ativas') }}
</x-slot>

<x-slot name="description">
  {{ __('Gerencie e desconecte suas sessões ativas em outros dispositivos.') }}
</x-slot>

<div>
  <div class="max-w-xl text-sm text-gray-600 mb-3">
    {{ __('Caso necessário, você pode encerrar todas as sessões em outros dispositivos. Abaixo estão listadas suas sessões ativas.') }}
  </div>

  <div class="table-responsive">
    <table class="table">
      <thead>
      <tr>
        <th class="text-truncate">{{ __('Dispositivo') }}</th>
        <th class="text-truncate">{{ __('IP') }}</th>
        <th class="text-truncate">{{ __('Localização') }}</th>
        <th class="text-truncate">{{ __('Atividade recente') }}</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($this->sessions as $session)
          <tr>
            @php
              $iconClass = 'bx-md me-4';
              $userAgent = $session->user_agent;
              $isCurrentDevice = $session->is_current_device;
              $deviceText = $isCurrentDevice ? __('(Este dispositivo)') : __('(Outro dispositivo)');
            @endphp
            <td class="text-truncate text-heading fw-medium">
              @switch($userAgent['platform'])
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
              {{ $userAgent['browser'] .' no '. $userAgent['platform'] }} <small>{{ $deviceText }}</small>
            </td>
            <td class="text-truncate">{{ $session->ip_address }}</td>
            <td class="text-truncate">{{ $session->location }}</td>
            <td class="text-truncate">{{ $session->last_active }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="flex items-center mt-5">
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
                     placeholder="{{ __('Senha') }}"
                     wire:model.defer="password">
              @error('password') <span class="d-block invalid-feedback">{{ $message }}</span> @enderror
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
