@extends("theme.$theme.app")

@section('titulo')
    Actualizar puntuación
@endsection

@section("styles")
    <link rel="stylesheet" type="text/css" href="{{asset('assets/profile/css/edit.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css') }}">
@endsection
    
@section('scripts')
    <script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    {{-- <script>var url = "{{ route('new_rating', [$perfil->id]) }}";</script> --}}
    <script>var url = "{{ route('actualizar_rating', [$data->id]) }}";</script>
@endsection

@section('title')
    <h2>Actualizar puntuación</h2>
@endsection

@section('contenido')

<div class="container-fluid">
    @include('includes.form-error')
    @include('includes.mensaje')
    {{-- <div class="row"> --}}
        {{-- <div class="col-md-3"> --}}

                    <div class="car-body">
                        <form action="{{route('actualizar_rating', [$data->id])}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off">
                            @csrf @method("put")
                            <div class="modal-body">
                                <div class="form-group" style="margin-top:15px;">
                                    <div class="row " >

                                        <div class="container star rating" style="margin-left:10%;">
                                            <input name="rating" value="5" type="radio" class="star" id="star-1"/> <label for="star-1" data-dataid="1" required></label> 
                                            <input name="rating" value="4" type="radio" class="star" id="star-2"/> <label for="star-2" data-dataid="2" required></label>  
                                            <input name="rating" value="3" type="radio" class="star" id="star-3"/> <label for="star-3" data-dataid="3" required></label>  
                                            <input name="rating" value="2" type="radio" class="star" id="star-4"/> <label for="star-4" data-dataid="4" required></label>  
                                            <input name="rating" value="1" type="radio" class="star" id="star-5"/> <label for="star-5" data-dataid="5" required></label> 
                                            {{-- {{$perfil->id}} --}}
                                        </div>
                                            <input type="hidden" name="profile_id" value="{{old('profile_id', $data->profile_id ?? '')}}">
                                        
                                    </div>
                                </div> <br><br>
                                <div class="container">
                                    <div class="form-group">
                                        <input type="title" name="title_rating" value="{{old('title_rating', $data->title_rating ?? '')}}" class="form-control" id="title" placeholder="Pon título a tu opinión">
                                    </div>
                                    <div class="form-group">
                                        <input type="title" name="description_rating" value="{{old('description_rating', $data->description_rating ?? '')}}" class="form-control" id="title" placeholder="Dinos que tal te ha parecido">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <a href="{{URL::previous()}}" class="btn btn-default"> Cancelar</a>
                                <button type="submit" name="submitRatingStar" id="submitRatingStar" class="btn btn-primary btn-sm">Actualizar</button>
                            </div>
                        </form>
                    </div>
               
{{-- </div> --}}
{{-- </div> --}}
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

