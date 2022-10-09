<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a class="w-20 h-20 fill-current text-gray-500" href="{{ url('/') }}"><img src="{{asset('assets/images/logo/icons.png')}}" alt="FirstEducation" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Esqueceu sua palavra-passe? Sem problemas. Basta nos informar seu endereço de e-mail e nós lhe enviaremos um link de redefinição de palavra-passe que permitirá que você escolha uma nova.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('E-mail')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button style="background-color: #0E6A3A">
                    {{ __('REINICIALIZAÇÃO DA PALAVRA-PASSE') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
