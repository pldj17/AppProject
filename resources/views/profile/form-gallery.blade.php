<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Document</title>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase.js"></script>
    <link rel="manifest" href="{{ asset ('manifest.json') }}">
    
    {{-- loader --}}
    <link rel="stylesheet" href="{{asset("assets/css/loader.css")}}">
    <script src="{{asset("assets/js/galeria.js")}}"></script>

    <style>
        #demo {
            height:100%;
            position:relative;
            overflow:hidden;
        }
        #imagen{
            border-radius: 8px;
            box-shadow: 0 0 16px #3333;
        }
        .green{
            background-color:#6fb936;
        }
        .thumb{
            margin-bottom: 30px;
        }
        
        .page-top{
            margin-top:85px;
        }
        
        img.zoom {
            width: 100%;
            height: 200px;
            border-radius:5px;
            object-fit:cover;
            -webkit-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            -ms-transition: all .3s ease-in-out;
        }
                
        
        .transition {
            -webkit-transform: scale(1.2); 
            -moz-transform: scale(1.2);
            -o-transform: scale(1.2);
            transform: scale(1.2);
        }
        .modal-header {
            border-bottom: none;
        }
        .modal-title {
            color:#000;
        }
        .modal-footer{
            display:none;  
        }

        /* media query */
        @media (max-width:770px){
            #img-post{
                height: 180px;
                width: 180px;
            }
        }
        @media (max-width:755px){
            #img-post{
                height: 170px;
                width: 220px;
            }
        }
        @media (max-width:720px){
            #img-post{
                height: 200px;
                width: 200px;
            }
        }
        @media (max-width:660px){
            #img-post{
                height: 200px;
                width: 180px;
            }
        }
        @media (max-width:600px){
            #img-post{
                height: 200px;
                width: 170px;
            }
        }
        @media (max-width:570px){
            #img-post{
                height: 200px;
                width: 160px;
            }
        }
        @media (max-width:540px){
            #img-post{
                height: 200px;
                width: 150px;
            }
            #img-gallery{
                height: 150px;
            }
        }
        @media (max-width:510px){
            #img-post{
                height: 200px;
                width: 140px;
            }
            #img-gallery{
                height: 10px;
            }
        }
        @media (max-width:480px){
            #img-post{
                height: 200px;
                width: 130px;
            }
        }
        @media (max-width:450px){
            #img-post{
                height: 200px;
                width: 180px;
            }
        }
        @media (max-width:420px){
            #img-post{
                height: 200px;
                width: 170px;
            }
        }
        @media (max-width:400px){
            #img-post{
                height: 200px;
                width: 160px;
            }
        }
        @media (max-width:380px){
            #img-post{
                height: 200px;
                width: 150px;
            }
        }
        @media (max-width:360px){
            #img-post{
                height: 200px;
                width: 140px;
            }
        }
        @media (max-width:340px){
            #img-post{
                height: 200px;
                width: 130px;
            }
        }
    </style>

    {{-- assets de PWA --}}
    @laravelPWA

</head>
<body>
    <div class="row" style="margin-top:10px;" id="tabla-data">
        @foreach ($photo as $imgCollection)
            @foreach ($imgCollection->photos as $a)
                @if(empty($a->file))

                @else
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb" id="img-post">
                        @if (Auth::user()->id == $user->id)
                        <form action="{{route('eliminar_post', ['id' => $imgCollection->id])}}" class="d-inline form-eliminar" method="POST">
                            <input type="hidden" name="_method" value="delete">
                            @csrf 
                            <button type="submit" class="btn-accion-tabla eliminar" data-toggle="tooltip" data-placement="bottom" title="Eliminar este registro" style="float:right;">
                                <i class="fa fa-fw fa-times text-danger"></i>
                            </button>
                        </form>
                        @endif

                        <a href="/images/{{$a->file }}" class="fancybox" rel="ligthbox" id="img-gallery">
                            <img id="image" src="/images/{{$a->file }}" class="zoom img-fluid " data-toggle="tooltip" data-placement="bottom" title="{{$a->description}}" alt="">
                        </a>         
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
    <script>
        $(document).ready(function(){
          $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });
            
            $(".zoom").hover(function(){
                
                $(this).addClass('transition');
            }, function(){
                
                $(this).removeClass('transition');
            });
        });
        </script>
        
</body>
</html>