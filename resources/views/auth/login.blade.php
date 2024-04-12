@section('title', 'Login - ARCanjo')

@section('page-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo"></x-slot>
        <div class="container-xxl">
          <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
              <x-validation-errors class="mb-4 alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </x-validation-errors>
              <!-- Register -->
              <div class="card">
                <div class="card-body">
                  <!-- Logo -->
                  <div class="app-brand justify-content-center">
                    <a href="{{url('/')}}" class="app-brand-link gap-2">
                      <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
                      <span class="app-brand-text demo text-body fw-bold">{{config('variables.templateName')}}</span>
                    </a>
                  </div>
                  <!-- /Logo -->
                  @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                      {{ session('status') }}
                    </div>
                  @endif

                  <form method="POST" class="mb-3" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                      <x-label for="email" class="form-label" value="{{ __('Email') }}" />
                      <x-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Informe seu email" required autofocus autocomplete="username" />
                    </div>

                    <div class="mb-3 form-password-toggle">
                      <div class="d-flex justify-content-between">
                        <x-label for="password" class="form-label" value="{{ __('Senha') }}" />
                        <a tabindex="-1" href="{{ route('register') }}">
                          <small>Esqueceu a senha?</small>
                        </a>
                      </div>
                      <div class="input-group input-group-merge">
                        <x-input id="password" class="form-control block w-full" type="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required autocomplete="current-password" />
                        <span class="shadow-sm input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      </div>
                    </div>

                    <div class="mb-3">
                      <x-button class="btn btn-primary d-grid w-100">
                        {{ __('Acessar') }}
                      </x-button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
