// $(document).ready(function () {
//     $("#comentario").on('submit', '.form-eliminar-comentario', function () {
//         event.preventDefault();
//         const form = $(this);
//         swal({
//             title: '¿ Está seguro que desea eliminar el comentario ?',
//             icon: 'warning',
//             buttons: {
//                 cancel: "Cancelar",
//                 confirm: "Aceptar"
//             },
//         }).then((value) => {
//             if (value) {
//                 ajaxRequest(form);
//             }
//         });
//     });

//     function ajaxRequest(form) {
//         $.ajax({
//             url: form.attr('action'),
//             type: 'POST',
//             data: form.serialize(),
//             success: function (respuesta) {
//                 if (respuesta.mensaje == "ok") {
//                     form.parents('p').remove();
//                     setTimeout(
//                         function() 
//                         {
//                            location.reload();
//                         });  
//                     AppProject.notificaciones('El comentario fue eliminado correctamente', 'AppProject', 'success');
//                 } else {
//                     AppProject.notificaciones('El comentario no pudo ser eliminado, hay recursos usandolo', 'AppProject', 'error');
//                 }
//             },
//             error: function () {
//                 AppProject.notificaciones('El comentario no pudo ser eliminado, hay recursos usandolo', 'AppProject', 'error');
//             }
//         });
//     }
// });