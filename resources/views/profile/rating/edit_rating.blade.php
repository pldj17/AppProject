@extends("theme.$theme.app")

@section('titulo')
    Perfil
@endsection

@section("styles")
    <link rel="stylesheet" type="text/css" href="{{asset('assets/profile/css/edit.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css') }}">
@endsection

    @section('scripts')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script>var url = "{{ route('new_rating', [$perfil->id]) }}";</script>
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
                    <div class="car-body">
                        <form action="{{ route('actualizar_rating', ['id' => $data]) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group" style="margin-top:15px;">
                                    <div class="row justify-content-center " >
            
                                        <div class="container star rating" style="margin-left:10%;">
                                            <input name="rate" value="{{old('rating', $data->rating ?? '')}}" type="radio" class="star" id="star-1"/> <label for="star-1" data-dataid="1"></label>  
                                            <input name="rate" value="{{old('rating', $data->rating ?? '')}}" type="radio" class="star" id="star-2"/> <label for="star-2" data-dataid="2"></label>  
                                            <input name="rate" value="{{old('rating', $data->rating ?? '')}}" type="radio" class="star" id="star-3"/> <label for="star-3" data-dataid="3"></label>  
                                            <input name="rate" value="{{old('rating', $data->rating ?? '')}}" type="radio" class="star" id="star-4"/> <label for="star-4" data-dataid="4"></label>  
                                            <input name="rate" value="{{old('rating', $data->rating ?? '')}}" type="radio" class="star" id="star-5"/> <label for="star-5" data-dataid="5"></label> 
                                            {{-- {{$perfil->id}} --}}
                                        </div>
                                            <input type="hidden" name="profile_id" value="{{old('profile_id', $data->profile_id ?? '')}}">
                                        
                                    </div>
                                </div> <br><br>
                                <div class="form-group">
                                    <div class="form-group">
                                        <input type="title" name="title_rating" value="{{old('title_rating', $data->title_rating ?? '')}}" class="form-control" id="title" placeholder="Pon título a tu opinión">
                                    </div>
                                    <div class="form-group">
                                        <textarea type="description" name="description_rating" value="{{old('description_rating', $data->description_rating ?? '')}}" class="form-control" id="description" placeholder="Dinos que tal te ha parecido"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <a href="{{route('rating')}}" class="btn btn-default"> Cancelar</a>
                                <button type="submit" name="submitRatingStar" id="submitRatingStar" class="btn btn-primary btn-sm">Actualizar</button>
                            </div>
                        </form>
                    </div>
               
            </div>
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
                data: {rate: $('input[name="rate"]').val(), 
                profile_id: $('input[name="profile_id"]').val()
                title_rating: $('input[name="title_rating"]').val()
                description_rating: $('input[name"description_rating"]').val()
                    },
                success: function(response) {
                    $('.alert-success').fadeIn(2000);
                    $('#rate').text(response);
                }
            });
            return false;
        });              
    });    
</script>
@endsection

@endsection

