@include('layouts.header')

<main class="main-perfil">
    <div class="contenedorPerfil">
        <h2>Registrarse</h2>
        <div class="registrarse" id="seccion-reg">
          <form class="formPerfil" method="POST" action="{{ route('register') }}">
            @csrf
             <!-- Name -->
            <label for="name">Nombre</label>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="errorMensaje" />

            <!-- Email Address -->
            <label for="email">Correo electrónico</label> 
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="errorMensaje" />
                
            <!-- Password -->
            <label for="password">Contraseña</label>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="errorMensaje" />

            <!-- Confirm Password -->
            <label for="passwordConfirmation">Confirmar contraseña</label>
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="errorMensaje" />

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
    
                <x-primary-button class="enviarPerfil boton">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
          </form>
        </div>
    </div>
</main>
@include('layouts.footer')