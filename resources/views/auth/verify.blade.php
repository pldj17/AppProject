@extends("theme.$theme.app")

@section('titulo')
    Verificar correo
@endsection

@section("scripts")
    <script src="{{ asset("assets/$theme/vendor/jquery/dist/jquery.min.js") }}"></script>
    <script src="{{ asset("assets/$theme/vendor/bootstrap/dist/js/bootstrap.bundle.min.js") }}"></script>
@endsection

@section('contenido')
    <div class="container-fluid">
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Verifique su dirección de correo electrónico.</h5>
            @if (session('resent'))
                Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.
            @endif
            @if (Route::has('verification.resend'))
                Si no recibiste el correo electrónico
                <form class="d-inline" method="get" action="{{ route('verification.resend') }}">
                @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Haga clic aquí para solicitar otro.</button>
                </form>
            @endif
        </div>
    </div>
@endsection
