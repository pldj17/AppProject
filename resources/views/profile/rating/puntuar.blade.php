@extends("theme.$theme.app")

@section('titulo')
    Perfil
@endsection

@section("styles")
    <link rel="stylesheet" type="text/css" href="{{asset('assets/profile/css/edit.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css') }}">
@endsection

@section('scripts')
<script>var url = "{{ route('new_rating', [$perfil->id]) }}";</script>
{{-- <script>
    $(function(){
        
        $(".click").click(function(e) {
            $http.post("/", {data})
            e.preventDefault();
            var data = $(this).attr("value");
            alert(data);    
        });
    
    });
</script> --}}
@endsection

@section('title')
    <h2>Mi perfil</h2>
@endsection

@section('contenido')

<div class="container-fluid">
    @include('includes.form-error')
    @include('includes.mensaje')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            @include('profile.ProfileImage')

            <!-- About Me Box -->
            @if (($perfil->private == 1))
            @include('profile.about_me')
            @endif
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
            @if (($perfil->private == 1))
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                        <a class="nav-link " href="{{route('perfil',  ['id' => $user->id])}}">
                            Actividades
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route("perfil_post", ['id' => $user->id])}}">
                                Fotos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('perfil_contact', ['id' => $user->id])}}">
                                Contactos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('rating', ['id' => $user->id])}}">
                                Calificar
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                    <a class="nav-link " href="{{route('perfil',  ['id' => $user->id])}}">
                        Mi información
                    </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            Favoritos
                        </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">
                        <i class="far fa-question-circle"  style="margin-top:40%" data-toggle="tooltip" data-placement="bottom" title="Acerca de..."></i>
                    </a>
                    </li>
                    {{-- <li class="nav-item" >
                        <a class="nav-link" href="#settings" data-toggle="tab"  style="float:right;">
                        <i class="far fa-question-circle"  style="margin-top:40%" data-toggle="tooltip" data-placement="bottom" title="Acerca de..."></i>
                        </a>
                    </li> --}}
                </ul>
                </div>
            @endif
                <div class="card-body">
                    <div class="tab-content">
                        
                        <div class="card-body">

                            <div class="card-body">
                                <div class="row">
                                  <div class="col-md-8">
                                    <p class="text-center">
                                      <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                    </p>
                
                                    <div class="chart">
                                        <div class="form-group">
                                    
                                            <div class="row justify-content-center">
                                                <h1 style="font-size:500%;">{{bcdiv($avgStar, '1', 1)}}</h1>
                                                
                                            </div> 
                                            @include('profile.rating.rating')
                                          </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <form action="{{ route('new_rating', [$perfil->id]) }}" method="post">
                                        @csrf
                                        <div class="form-group" style="margin-top:26px;">
                                            <div class="row justify-content-center">
                                              <h5>Elige una clasificación por estrellas</h5>
                                            </div><br>
                                            <div class="row justify-content-center " >

                                                <div class="star_content rating">
                                                    <i class="fas fa-star fa-2x b1"><input name="rate" value="1" type="hidden" class="star" style="opacity:0;"/> </i> 
                                                    <i class="fas fa-star fa-2x b2"><input name="rate" value="2" type="hidden" class="star" style="opacity:0;"/> </i> 
                                                    <i class="fas fa-star fa-2x b3"><input name="rate" value="3" type="hidden" class="star" style="opacity:0;"/> </i> 
                                                    <i class="fas fa-star fa-2x b4"><input name="rate" value="4" type="hidden" class="star" style="opacity:0;"/> </i> 
                                                    <i class="fas fa-star fa-2x b5"><input name="rate" value="5" type="hidden" class="star" style="opacity:0;"/> </i>
                                                    {{-- {{$perfil->id}} --}}
                                                </div>
                                                    <input type="hidden" name="profile_id" value="{{ $perfil->id }}">
                                                
                                            </div>
                                            
                                        </div>
                                        <button type="submit" name="submitRatingStar" id="submitRatingStar" class="btn btn-primary btn-sm" style="float:right;">Enviar puntuación</button>
                                    </form>
                                  </div>
                                </div>
                              </div>

                            {{-- <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    
                                    <div class="row justify-content-center">
                                        <h1 style="font-size:500%;">{{bcdiv($avgStar, '1', 1)}}</h1>
                                        @include('profile.rating.rating')
                                    </div> 
                                  </div>
                                </div>


                                <div class="row" style="margin-rigth:50px;">
                                    <div id="content" class="col-lg-12">
                                        <div class="alert alert-success" style="display: none;">Rating recibido: <span id="rate"></span></div>
                                        <form action="{{ route('new_rating', [$perfil->id]) }}" method="post">
                                            @csrf
                                            <div class="form-group" style="margin-top:26px;">
                                                <div class="row justify-content-center">
                                                  <h5>Elige una clasificación por estrellas</h5>
                                                </div><br>
                                                <div class="row justify-content-center " >
    
                                                    <div class="star_content rating">
                                                        <i class="fas fa-star fa-2x b1"><input name="rate" value="1" type="hidden" class="star" style="opacity:0;"/> </i> 
                                                        <i class="fas fa-star fa-2x b2"><input name="rate" value="2" type="hidden" class="star" style="opacity:0;"/> </i> 
                                                        <i class="fas fa-star fa-2x b3"><input name="rate" value="3" type="hidden" class="star" style="opacity:0;"/> </i> 
                                                        <i class="fas fa-star fa-2x b4"><input name="rate" value="4" type="hidden" class="star" style="opacity:0;"/> </i> 
                                                        <i class="fas fa-star fa-2x b5"><input name="rate" value="5" type="hidden" class="star" style="opacity:0;"/> </i>
                                                        {{$perfil->id}}
                                                    </div>
                                                        <input type="hidden" name="profile_id" value="{{ $perfil->id }}">
                                                    
                                                </div>
                                                
                                            </div>
                                            <button type="submit" name="submitRatingStar" id="submitRatingStar" class="btn btn-primary btn-sm" style="float:right;">Enviar puntuación</button>
                                        </form>
                                    </div>
                                </div> --}}


                                {{-- <div class="col-sm-8">
                                    <form method="POST" action="{{ route('new_rating', '[$perfil->id])') }}" id="formulario">
                                        @csrf
                                        <div class="form-group" style="margin-top:26px;">
                                            <div class="row justify-content-center">
                                              <h5>Elige una clasificación por estrellas</h5>
                                            </div><br>
                                            <div class="row justify-content-center rating" >

                                                <li class="list-inline-item b1 click" value="5">
                                                    <i class="fas fa-star fa-2x "></i>
                                                </li>
                                                <li class="list-inline-item b2 click" value="4">
                                                    <i class="fas fa-star fa-2x "></i>
                                                </li>
                                                <li class="list-inline-item b3 click" value="3">
                                                    <i class="fas fa-star fa-2x "></i>
                                                </li>
                                                <li class="list-inline-item b4 click" value="2">
                                                    <i class="fas fa-star fa-2x "></i>
                                                </li>
                                                <li class="list-inline-item b5 click" value="1">
                                                    <i class="fas fa-star fa-2x "></i>
                                                </li>

                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-2 offset-md-10">
                                                <button type="submit" class="btn btn-primary" id="BtnRegistrar">
                                                    Enviar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div> --}}
                            {{-- </div> --}}
                            
                              
                    </div>
                </div>
        </div>
    </div>
</div>

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('input.star').rating();
        $('button#submitRatingStar').on('click', function() {
            $.ajax({
                type: "POST",
                url: url,
                data: {rate: $('input[name="rate"]').val(), profile_id: $('input[name="profile_id"]').val()},
                success: function(response) {
                    $('.alert-success').fadeIn(2000);
                    $('#rate').text(response);
                }
            });
            return false;
        });              
    });    
</script>
{{-- <script>
    $(function(){
        
        $(".click").click(function(e) {
            e.preventDefault();
            var data = $(this).attr("value");
            alert(data);    
        });
    
    });
</script> --}}
@endsection
@endsection

