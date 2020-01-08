var AppProject = function () {
    return {
        validacionGeneral: function (id, reglas, mensajes) {
            const formulario = $('#' + id);
            formulario.validate({
                rules: reglas,
                messages: mensajes,
                errorElement: 'span', //contenedor de mensaje de error de entrada predeterminado
                errorClass: 'help-block help-block-error', // clase de mensaje de error de entrada predeterminada
                focusInvalid: false, // no enfoque la última entrada inválida
                ignore: "", // validar todos los campos, incluida la entrada oculta del formulario
                highlight: function (element, errorClass, validClass) { // resaltar entradas de error
                    $(element).closest('.form-group').addClass('has-danger'); // establecer la clase de error al grupo de control
                },
                unhighlight: function (element) { // revertir el cambio realizado por resaltado
                    $(element).closest('.form-group').removeClass('has-danger'); // establecer la clase de error al grupo de control
                },
                success: function (label) {
                    label.closest('.form-group').removeClass('has-danger'); // establecer la clase de éxito al grupo de control
                },
                //indica donde colocar el error
                errorPlacement: function (error, element) {
                    if ($(element).is('select') && element.hasClass('bs-select')) {//PARA LOS SELECT BOOSTRAP
                        error.insertAfter(element);//element.next().after(error);
                    } else if ($(element).is('select') && element.hasClass('select2-hidden-accessible')) {
                        element.next().after(error);
                    } else if (element.attr("data-error-container")) {
                        error.appendTo(element.attr("data-error-container"));
                    } else {
                        error.insertAfter(element); // ubicación predeterminada para todo lo demás
                    }
                },
                invalidHandler: function (event, validator) { //mostrar alerta de error al enviar el formulario
                    
                },
                submitHandler: function (form) {
                    return true;
                }
            });
        },
        notificaciones: function (mensaje, titulo, tipo) {
            toastr.options = {
                closeButton: true,
                newestOnTop: true,
                positionClass: 'toast-top-right',
                preventDuplicates: true,
                timeOut: '5000'
            };
            if (tipo == 'error') {
                toastr.error(mensaje, titulo);
            } else if (tipo == 'success') {
                toastr.success(mensaje, titulo);
            } else if (tipo == 'info') {
                toastr.info(mensaje, titulo);
            } else if (tipo == 'warning') {
                toastr.warning(mensaje, titulo);
            }
        },
    }
}();

