<form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" class="d-flex" role="search">
    @csrf
    @method('put')

    <!-- CURRENT PASSWORD !--> 
    <div>
        <p>Contraseña actual</p>
        <x-text-input name="current_password" type="password" autocomplete="current-password" />
    </div>
    <!-- ERROR CURRENT PASSWORD !--> 
    <div style="color: red;">
        @if($errors->updatePassword->get('current_password'))
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
            @foreach ( $errors->updatePassword->get('current_password') as $error)
                {{ $error }}
            @endforeach
        @endif
    </div>
    <!-- NEW PASSWORD !-->
    <div>
        <p>Contraseña nueva</p>
        <x-text-input name="password" type="password" autocomplete="new-password" />
    </div>
    <!-- ERROR NEW PASSWORD !-->
    <div style="color: red;">
        @if($errors->updatePassword->get('password'))
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
            @foreach ( $errors->updatePassword->get('password') as $error)
                {{ $error }}
            @endforeach
        @endif
    </div>
    <!-- CONFIRM PASSWORD !-->
    <div>
        <p>Confirmar contraseña</p>
        <x-text-input name="password_confirmation" type="password" autocomplete="new-password" />
    </div>
    <!-- ERROR CONFIRM PASSWORD !-->
    <div style="color: red;">
        @if($errors->updatePassword->get('password_confirmation'))
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
            @foreach ( $errors->updatePassword->get('password_confirmation') as $error)
                {{ $error }}
            @endforeach
        @endif
    </div>
    <br>
    <x-primary-button class="btn btn-success">GUARDAR</x-primary-button>
    @if (session('status') === 'password-updated')
        <br>
        <br>
        <center>
            <div class="alert alert-success" role="alert" style="max-width: 70%; " id="alertsuccess">
                Se han actualizado sus datos correctamente.
            </div>
        </center>
    @endif
</form>
