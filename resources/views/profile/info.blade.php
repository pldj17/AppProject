@extends("theme.$theme.app", ['title' => __('User Profile')])

@section('titulo')
    Perfil
@endsection

@section('scripts')
    <script src="{{asset("assets/js/galeria.js")}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
@endsection

@section('content')
    @include('users.partials.header', [
        'title' => auth()->user()->name
    ])   
    <div class="container-fluid mt--7">
        
        <div class="row justify-content-md-center">
            <div class="col-xl-11 order-xl-2 mb-4 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="{{ asset('uploads/profile_pictures')}}/{{ Auth::user()->profile->avatar }}" class="zoom img-fluid">
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


                            @include('profile.tabs')


                            <p>{{ __('Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci..') }}</p>
                            <a href="#">{{ __('Más información') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- @include("layouts.footers.auth") --}}

@endsection