@extends("theme.$theme.app", ['title' => __('User Profile')])

@section('titulo')
    Perfil
@endsection

@section('content')
    @include('users.partials.header', [
        'title' => auth()->user()->name
    ])   
    <div class="container-fluid mt--7">
        
        <div class="row justify-content-md-center">
            <div class="col-11 order-xl-2 mb-4 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    @if (empty(Auth::user()->profile->avatar))
                                        <img src="{{ asset('avatar/avatar.png')}}" class="card-img-top rounded-circle mx-auto d-block" style="height:150; width:250px;">
                                    @else
                                        <img src="{{ asset('uploads/profile_pictures')}}/{{ Auth::user()->profile->avatar }}" class="card-img-top d-block" style="width:250px; height:150; border-radius:50%;">  
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-default float-right">{{ __('Editar perfil') }}</a>
                        </div>
                    </div><br>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                {{-- <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading">22</span>
                                        <span class="description">{{ __('Friends') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">10</span>
                                        <span class="description">{{ __('Photos') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">{{ __('Comments') }}</span>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{ auth()->user()->name }}<span class="font-weight-light"></span>
                                <h6>Se unió el: {{date('d F, Y', strtotime(Auth::user()->created_at))}}</h6> 
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2">{{Auth::user()->profile->address}}</i>
                            </div>
                            {{-- <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>{{ __('Developer') }}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>{{Auth::user()->profile->description}}
                            </div> --}}
                            <hr class="my-4" />


                            <div class="nav-wrapper">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                    <li class="nav-item">
                                        <a href="{{ route('profile.index') }}" class="nav-link mb-sm-3 mb-md-0 "  aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fa fa-info-circle mr-2"></i>información</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('profile.gallery') }}" class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-2-tab" aria-selected="false"><i class="ni ni-image mr-2"></i>Galería</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('profile.contact') }}" class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fa fa-mobile mr-2"></i>Contacto</a>
                                    </li>
                                </ul>
                            </div>


                            @include('profile.form-gallery')


                            <hr>
                            <form action="{{ route('guardar_foto') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <strong>Imagen:</strong>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <br/>
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- @include("layouts.footers.auth") --}}

@endsection