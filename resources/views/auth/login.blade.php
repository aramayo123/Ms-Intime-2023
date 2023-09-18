@include('layouts.header')
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<main class="main-perfil">
    <div class="contenedorPerfil">
        <h2>Iniciar sesion</h2>
        <div>
          <form class="formPerfil" method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <label for="email">Correo electrónico</label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="errorMensaje" />


            <!-- Password -->
            <label for="password">Contraseña</label>
            <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="errorMensaje" />
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
        
                <x-primary-button class="enviarPerfil boton">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
          </form>
        </div>
    </div>
</main>
@include('layouts.footer')