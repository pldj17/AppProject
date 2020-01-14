$(document).ready(function () {
    AppProject.validacionGeneral('form-general');
    $('#name').on('change',function(){
        $('#slug').val($(this).val().toLowerCase().replace(/ /g, '-'))
    })
});