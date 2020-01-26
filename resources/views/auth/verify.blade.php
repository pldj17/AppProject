@extends("theme.$theme.app", ['class' => 'bg-default'])

@section('content')
    @include("theme.$theme.headers.guest")


@section("scripts")
    <script src="{{ asset("assets/$theme/vendor/jquery/dist/jquery.min.js") }}"></script>
    <script src="{{ asset("assets/$theme/vendor/bootstrap/dist/js/bootstrap.bundle.min.js") }}"></script>
@endsection

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>{{ __('Verifique su dirección de correo electrónico.') }}</small>
                        </div>
                        <div>
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
                                </div>
                            @endif
                            
                            {{ __('Antes de continuar, revise su correo electrónico para obtener un enlace de verificación.') }}
                            @if (Route::has('verification.resend'))
                                {{ __('Si no recibiste el correo electrónico') }},
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('haga clic aquí para solicitar otro.') }}</button>.
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
