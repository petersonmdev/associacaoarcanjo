@section('title', 'Registro novo usuário - ARCanjo')

@section('page-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

<x-guest-layout>
    <x-authentication-card>
      <x-slot name="logo"></x-slot>
      <x-validation-errors class="mb-4" />
      <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div class="authentication-inner">
            <!-- Register Card -->
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

                <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="mb-4">
                    <x-label for="name" class="mb-0 form-label" value="{{ __('Nome') }}" />
                    <x-input id="name" class="form-control block mt-1 w-full" type="text" name="name" placeholder="Informe seu nome" :value="old('name')" required autofocus autocomplete="name" />
                  </div>
                  <div class="mb-4">
                    <x-label for="email" class="mb-0 form-label" value="{{ __('Email') }}" />
                    <x-input id="email" class="form-control block mt-1 w-full" type="email" name="email" placeholder="Informe seu email" :value="old('email')" required autocomplete="username" />
                  </div>
                  <div class="mb-4 form-password-toggle">
                    <x-label for="password" class="mb-0 form-label" value="{{ __('Senha') }}" />
                    <div class="input-group input-group-merge">
                      <x-input id="password" class="form-control block w-full" type="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required autocomplete="new-password" />
                      <span class="shadow-sm input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                  <div class="mb-4 form-password-toggle">
                    <x-label for="password_confirmation" class="mb-0 form-label" value="{{ __('Confirme sua senha') }}" />
                    <div class="input-group input-group-merge">
                      <x-input id="password_confirmation" class="form-control block w-full" type="password" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required autocomplete="new-password" />
                      <span class="shadow-sm input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>

                  @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4 form-check">
                      <x-label for="terms" class="form-check-label">
                        <div class="flex items-center">
                          <x-checkbox class="form-check-input" name="terms" id="terms" required />

                          <div class="ms-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                            ]) !!}
                          </div>
                        </div>
                      </x-label>
                    </div>
                  @endif

                  <div class="mb-3">
                    <x-button class="btn btn-primary d-grid w-100">
                      {{ __('Registrar') }}
                    </x-button>
                  </div>

                  <p class="text-center">
                    <span>{{ __('Já é cadastrado?') }}</span>
                    <a href="{{ route('login') }}">
                      <span>Acessar conta</span>
                    </a>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

        {{--<form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>--}}
    </x-authentication-card>
</x-guest-layout>
