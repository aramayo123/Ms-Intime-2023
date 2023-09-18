
<div class="contenedor">
  <main>
    <div>
        @if(Auth::user()->avatar)
        <img src="{{ asset('img_profile/'.Auth::user()->avatar) }}" class="card-img-top" alt="...">
        @else
        <img src="{{ asset('img_profile/default.jpg') }}" class="card-img-top" alt="">
        @endif
    </div>
    <div class="flex70" >
      <h2 id="main__title">Bienvenid@ {{ Auth::user()->name }}</h2>
        <section id="main__content">
          <div class="container">
            Aqui podras modificar la informacion de tu perfil, solo tienes que elegir entre las opciones sugeridas que estan en la parte inferior izquierda
          </div>
        </section>
        
        <section id="informacion-personal">
          <div class="container info-profile">
            @include('profile.partials.update-avatar')
            @include('profile.partials.update-profile-information-form')
          </div>
        </section>
      
        <section id="cambiar-contraseña">
          <div class="container pass-profile">
            @include('profile.partials.update-password-form')
          </div>
        </section>

        <section id="borrar-cuenta">
          @include('profile.partials.delete-user-form')
        </section>
    </div>
  </main>
</div>
