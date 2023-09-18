<div class="imgContainer">
    <img id="imagenSeleccionada" class="card-img-top">
</div>
<br>
<form method="post" action="{{ route('profile.updateavatar') }}" enctype="multipart/form-data">
    @csrf
    <center>    
        <div style="width: 53%;">
            <input style="font-size: 0.8rem;" type="file" name="avatar" id="avatar" class="form-control me-2">
        </div>
    </center>
    <br>
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
</form>
<br>
@if (\Session::has('update_avatar'))
    <div class="container" style="width: 70%;">
        <div class="alert alert-success" role="alert" style="max-width: 100%; " id="alertsuccess">
            {!! \Session::get('update_avatar') !!}
        </div>
    </div>
    
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {

            var check_update_profile = `<?php if (\Session::has('update_avatar')) {
                echo 'true';
            } ?>`;

            if (check_update_profile) {
                mostrarSeccion('informacion-personal');
                cambiarTitulo('informacion-personal');
            }

        });
    </script>
@endif



<div style="color: red;">
    @if($errors->get('avatar'))
        <br>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>
        @foreach ( $errors->get('avatar') as $error)
            {{ $error }}
        @endforeach
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function (e) {
        $('#avatar').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionada').attr('src',e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>