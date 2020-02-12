// $(function () {
//     $('.select2').select2()

//     //Initialize Select2 Elements
//     $('.select2bs4').select2({
//     theme: 'bootstrap4'
//     });

// });

$(function() {
    var croppie = null;
    var el = document.getElementById('resizer');

    $.base64ImageToBlob = function(str) {
        // extraer el tipo de contenido y la carga base64 de la cadena original
        var pos = str.indexOf(';base64,');
        var type = str.substring(5, pos);
        var b64 = str.substr(pos + 8);
      
        // decodificar base64
        var imageContent = atob(b64);
      
        // crear un ArrayBuffer y una vista (como 8 bits sin firmar)
        var buffer = new ArrayBuffer(imageContent.length);
        var view = new Uint8Array(buffer);
      
        // llenar la vista, usando la base decodificada64
        for (var n = 0; n < imageContent.length; n++) {
          view[n] = imageContent.charCodeAt(n);
        }
      
        // convertir ArrayBuffer a Blob
        var blob = new Blob([buffer], { type: type });
      
        return blob;
    }

    $.getImage = function(input, croppie) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {  
                croppie.bind({
                    url: e.target.result,
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file-upload").on("change", function(event) {
        $("#myModal").modal();
        // Inicialice la instancia de croppie y asígnela a la variable global
        croppie = new Croppie(el, {
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'circle'
                },
                boundary: {
                    width: 250,
                    height: 250
                },
                enableOrientation: true //permitirá rotar la imagen.
            });
        $.getImage(event.target, croppie); 
    });

    $("#upload").on("click", function() {
        croppie.result('base64').then(function(base64) {
            $("#myModal").modal("hide"); 
            $("#profile-pic").attr("src","/avatar/ajax-loader.gif");

            // var url = "{{route('demos/jquery-image-upload')}}";
            var formData = new FormData();
            formData.append("avatar", $.base64ImageToBlob(base64));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data == "uploaded") {
                        $("#profile-pic").attr("src", base64); 
                    } else {
                        $("#profile-pic").attr("src","/avatar/avatar.png"); 
                        console.log(data['avatar']);
                    }
                },
                error: function(error) {
                    console.log(error);
                    $("#profile-pic").attr("src","/avatar/avatar.png"); 
                }
            });
        });
    });

    // Para girar la imagen hacia la izquierda o hacia la derecha
    $(".rotate").on("click", function() {
        croppie.rotate(parseInt($(this).data('deg'))); 
    });

    $('#myModal').on('hidden.bs.modal', function (e) {
        // Esta función llamará inmediatamente después del cierre del modelo.
        // Para garantizar que la antigua instancia de croppie se destruya en cada modelo cercano
        setTimeout(function() { croppie.destroy(); }, 100);
    })

});