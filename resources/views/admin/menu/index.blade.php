@extends('layouts.app', ['title' => __('User Profile')])

@section('titulo')
    Sistema de menus
@endsection

@section('content')
    @include('users.partials.header1') 
    
@section("styles")
    <link href="{{asset("assets/js/jquery-nestable/jquery.nestable.css")}}" rel="stylesheet" type="text/css" />
@endsection

@section("scriptsPlugins")
    <script src="{{asset("assets/js/jquery-nestable/jquery.nestable.js")}}" type="text/javascript"></script>
@endsection

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/menu/index.js")}}" type="text/javascript"></script>
@endsection

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Menús</h2>
                    </div>
                    <div class="table-responsive">
                        @csrf
                        <div class="dd" id="nestable">
                            <ol class="dd-list">
                                @foreach ($menus as $key => $item)
                                    @if ($item["menu_id"] != 0)
                                        @break
                                    @endif
                                    @include("admin.menu.menu-item",["item" => $item])
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
    
        
    @endsection