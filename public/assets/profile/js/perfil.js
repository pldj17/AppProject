$(document).ready(function () {
    $("#tabla-data").on('submit', '.form-eliminar', function () {
        event.preventDefault();
        const form = $(this);
        swal({
            title: '¿ Está seguro que desea eliminar el registro ?',
            text: "Al eliminar esta foto también se eliminará la publicación!",
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
                    AppProject.notificaciones('El registro fue eliminado correctamente', 'AppProject', 'success');
                } else {
                    AppProject.notificaciones('El registro no pudo ser eliminado, hay recursos usandolo', 'AppProject', 'error');
                }
            },
            error: function () {
                AppProject.notificaciones('El registro no pudo ser eliminado, hay recursos usandolo', 'AppProject', 'error');
            }
        });
    }
});