$(document).ready(function () {
    $("#publicacion").on('submit', '.form-eliminar-publicacion', function () {
        event.preventDefault();
        const form = $(this);
        swal({
            title: '¿ Está seguro que desea eliminar esta publicación ?',
            icon: 'warning',
            buttons: {
                cancel: "Cancelar",
                confirm: "Aceptar"
            },
        }).then((value) => {
            if (value) {
                ajaxRequest(form);
            }
        });
    });

    function ajaxRequest(form) {
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function (respuesta) {
                if (respuesta.mensaje == "ok") {
                    form.parents('div').remove();
                    setTimeout(
                        function() 
                        {
                           location.reload();
                        });  
                    AppProject.notificaciones('La publicación fue eliminada correctamente', 'AppProject', 'success');
                } else {
                    AppProject.notificaciones('La publicación no pudo ser eliminada, hay recursos usandolo', 'AppProject', 'error');
                }
            },
            error: function () {
                AppProject.notificaciones('La publicación no pudo ser eliminada, hay recursos usandolo', 'AppProject', 'error');
            }
        });
    }
});