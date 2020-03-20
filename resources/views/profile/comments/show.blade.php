<div class="card-body" id="tabla-data">
    @foreach ($post as $imgCollection)
      
          <div class="active tab-pane" id="activity">
            <div class="post">
              <div class="user-block">
                @if (empty($perfil->avatar))
                    <img src="{{ asset('avatar/avatar.png')}}" class="img-circle img-bordered-sm">
                @else
                    <img src="{{ asset('uploads/profile_pictures')}}/{{ $perfil->avatar }}"  class="img-circle img-bordered-sm">  
                @endif
                <span class="username">
                  <a href="#">{{$user->name}}</a>
                    <div class="btn-group" style="float:right;">
                      <button type="button" class="btn btn-tool" data-toggle="dropdown" style="display:">
                        <i class="fas fa-ellipsis-v"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" id="tabla-data" role="menu">
                        <a href="#" class="dropdown-item"><i class="fa fa-edit"></i>&nbsp; <small>Editar</small></a>
                        
                        @foreach ($imgCollection as $post)

                          <form action="{{route('eliminar_post', ['id' => $imgCollection->id])}}" class="d-inline form-eliminar" method="POST"   >
                            <input type="hidden" name="_method" value="delete">
                            @csrf 
                            <button type="submit"  class="btn-accion-tabla eliminar" style="margin-left:20px;" >
                              <i class="fa fa-trash text-danger"></i>&nbsp; Eliminar
                            </button>
                          </form>
                          @if ($loop->first)
                              @break
                          @endif
                        @endforeach
                      </div>
                    </div>
                </span>

                @foreach ($imgCollection as $post)
                  @if ($loop->first)
                  <span class="description" title="{{ $imgCollection->created_at->format('d-m-Y H:i') }}">{{$imgCollection->created_at->diffForHumans()}}&nbsp;<i class="far fa-clock"></i> </span>
                
              </div>
                  <p>
                    {{$imgCollection->description}}
                  </p>
                  
                  @endif
                @endforeach

              
              <div class="row" style="margin-top:10px;" id="tabla-data">

                  @foreach ($imgCollection->photos as $a)
                    @if(empty($a->file))

                    @else
                    <div class="col-lg-4 col-md-4 col-xs-6 thumb">
                      <a href="/images/{{ $a->file }}" class="fancybox" rel="ligthbox" style="width:100%; height:70%">
                        <img src="/images/{{ $a->file }}" class="zoom img-fluid" alt="" style="width:100%; height:100%">
                      </a>   
                    </div>
                    @endif
                  @endforeach
              
              </div>
              
              @if($comments->where('post_id', $imgCollection->id)->count() == 0)
              
              @else
              <p>
                <span class="float-right">
                  <a href="{{ route('mostrar_comentarios', $imgCollection->id) }}" class="link-black text-sm">
                    <i class="far fa-comments mr-1"></i> Comentarios ({{ $comments->where('post_id', $imgCollection->id)->count() }}) 
                  </a>
                </span>
              </p>
              @endif
              <br>

              {{-- comentarios --}}
              @foreach ($imgCollection as $post)
                @if ($loop->first)
                  <form class="form-horizontal" action="{{ route('guardar_comentario', [$user->id]) }}" method="POST" autocomplete="off">
                    @csrf 
                    <input type="hidden" name="post_id" value="{{ $imgCollection->id }}">
                    <div class="input-group input-group-sm mb-0">
                      <input class="form-control form-control-sm" name="message" placeholder="Agregar comentario...">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                      </div>
                    </div>
                  </form>
                @endif
              @endforeach

              <br><br>
              
              @foreach ($comments as  $comment)
                @if($comment->post_id == $imgCollection->id)
                  @if($comments->where('post_id', $imgCollection->id)->count() > 0 && $comments->where('post_id', $imgCollection->id)->count() <=2)
                    <div class="direct-chat-infos clearfix" id="comentario">
                      <div class="user-block" style="margin-top:-4%;">
                          @if (empty($comment->user->profile->avatar))
                            <img class="img-circle img-bordered-sm" src="{{ asset('avatar/avatar.png')}}" alt="user image" style="height:35px; width:35px;">
                          @else
                            <img class="img-circle img-bordered-sm" src="{{ asset('uploads/profile_pictures')}}/{{ $comment->user->profile->avatar }}" alt="user image" style="height:35px; width:35px;">
                          @endif  
                        <span class="username" id="comentario">
                          <a style="color:#007bff; font-size:14px;">{{$comment->user->name}}
                            @if (Auth::user()->id == $comment->user_id)
                              <form action="{{route('eliminar_comentario', ['id' => $comment->id])}}" class="d-inline form-eliminar-comentario" style="float:right;" method="POST">
                                  @csrf @method("delete")
                                  <button type="submit" class="btn-accion-tabla eliminar" data-toggle="tooltip" data-placement="bottom" title="Eliminar comentario">
                                      <i class="fa fa-fw fa-trash text-danger"></i>
                                  </button>
                              </form>
                            @endif
                            <a class="btn-accion-tabla" data-toggle="tooltip" data-placement="bottom" style="float:right;" title="{{$comment->created_at->diffForHumans()}}">
                              <i class="fa fa-clock"></i>
                            </a>
                          </a>
                        </span>
                        <p>
                            &nbsp;&nbsp;{{$comment->message}}
                        </p>
                        
                      </div>
                    </div>
                  @endif
                @endif
              @endforeach --}}

              {{-- @if($comments->where('post_id', $imgCollection->id)->count() > 1) 
                <div class="text-center">
                  <a href="javascript:void(0)" class="uppercase">Ver comentarios</a>
                  
                </div>
              @endif

              <hr>
          </div>
        </div>
    @endforeach
  </div>