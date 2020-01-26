<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
 

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
</style>

</head>
<body>
    <div class="row" style="margin-top:10px;">
        @if($images->count())
            @foreach($images as $image)
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <form action="{{ route('eliminar_post',$image->id) }}" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        @csrf
                        <button type="submit" class="btn-accion-tabla eliminar" data-toggle="tooltip" data-placement="top" title="Eliminar este registro" style="float:right;">
                            <i class="fa fa-fw fa-times text-danger" ></i>
                        </button>                    
                    </form>
                    <a href="/images/{{ $image->image }}" class="fancybox" rel="ligthbox">
                        <img id="imagen" src="/images/{{ $image->image }}" class="zoom img-fluid "  alt="">
                        {{-- <div class='text-center'>
                            <small class='text-muted'>{{ $image->title }}</small>
                        </div> --}}
                    </a>
                    
                </div>
            @endforeach
        @endif 
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