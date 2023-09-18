<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('patch')

    <!-- NOMBRE Y APELLIDO !-->
    <label for="name">{{ __('Name') }}</label>
    <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
   
    <!-- ERRORES DEL NOMBRE Y APELLIDO !-->
    <div style="color: red;">
        @if($errors->get('name'))
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
            @foreach ( $errors->get('name') as $error)
                {{ $error }}
            @endforeach
        @endif
    </div>

     <!-- EMAIL !-->
    <div>
        <!-- CAMPO EMAIL !-->
        <label for="email">{{ __('Email') }}</label>
        <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
        
        <!-- ERRORES DEL EMAIL !-->
        <div style="color: red;">
            @if($errors->get('email'))
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
                @foreach ( $errors->get('email') as $error)
                    {{ $error }}
                @endforeach
            @endif
        </div>

        <!-- EMAIL VERIFICATION !-->
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
            <div>
                <!-- BUTTON EMAIL VERIFICATION !-->
                <p>{{ __('Your email address is unverified.') }}
                    <button form="send-verification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>
                <!-- MESSAGE EMAIL VERIFICATION SEND !-->
                @if (session('status') === 'verification-link-sent')
                    <p>
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
                <button class="btn btn-success">
                    Guardar
                </button>
            </div>
            <div class="col-md-4">
               
            </div>
        </div>
    </div>
    <!-- MESSAGE DATA SAVED !-->
    <?php if(session('status') === 'profile-updated'){ ?>
        <br>
        <center>
            <div class="alert alert-success" role="alert" style="max-width: 70%; " id="alertsuccess">
                Se han actualizado sus datos correctamente.
            </div>
        </center>
    <?php } ?>
</form>
