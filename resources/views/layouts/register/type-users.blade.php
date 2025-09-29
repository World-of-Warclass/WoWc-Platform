<x-guest-layout>
    <x-authentication-header>

        @section('helper_text_button', __('No account yet?'))

        <x-slot name="button">
            <x-anchor-button href="{{ route('register') }}">
                <p>{{ __('Register') }}</p>
            </x-anchor-button>
        </x-slot>

    </x-authentication-header>

    <x-authentication-card>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" class="m-2  p-2">
            <h2 class="text-2xl font-semibold  mb-4 flex justify-center text-yellow-500">Elige tipo de usuario</h2>
            <div class=" flex flex-col gap-5 m-3">
                <a href="register-users">
                    <div class="text-neutral-100 bg-red-500 rounded-md px-5 py-3 border-2 border-red-500 hover:text-neutral-700 hover:bg-neutral-200 hover:border-neutral-900">
                        <div class=" text-2xl borde-2 border-orange-300 flex justify-start ml-3 gap-10" role="button">
                            <span class="icon-[ph--student-bold]"></span>
                            <p>Usuarios</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('register.institution')}}">
                    <div class="text-neutral-100 bg-red-500 rounded-md px-5 py-3 border-2 border-red-500 hover:text-neutral-700 hover:bg-neutral-200 hover:border-neutral-900">
                        <div class=" text-2xl borde-2 border-orange-300 flex justify-start ml-3 gap-10" role="button">
                            <span class="icon-[teenyicons--school-solid]"></span>
                            <p>Institucion</p>
                        </div>
                    </div>
                </a>
                    
                <div class="flex justify-center text-base">
                    <p>¿Ya tienes cuenta? <span class="text-red-500 hover:text-red-400 underline ms-2"><a href="{{ route('login') }}">Iniciar sesión</a></span></p>
                </div>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
