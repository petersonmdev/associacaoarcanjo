<div>
  <ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
      <a class="nav-link @if(Route::currentRouteName() === 'account-user') active @endif" href="{{ route('account-user', ['id' => Auth::user()->id]) }}">
        <i class="bx bx-user me-1"></i> {{ __('Minha conta') }}
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Route::currentRouteName() === 'account-security-user') active @endif" href="{{ route('account-security-user', ['id' => Auth::user()->id]) }}">
        <i class="bx bx-lock me-1"></i> {{ __('Segurança') }}
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Route::currentRouteName() === 'account-login-user') active @endif" href="{{ route('account-login-user', ['id' => Auth::user()->id]) }}">
        <i class='bx bx-desktop me-1'></i> {{ __('Dispositivos conectados') }}
      </a>
    </li>
  </ul>
</div>
