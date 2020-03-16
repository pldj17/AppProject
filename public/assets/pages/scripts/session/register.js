var RegisterForm = (function () {
    var handleValidation = function () {
      var form = $('#registerForm')
  
      form.validate({
        errorElement: 'span', 
        errorClass: 'help-block help-block-error',
        focusInvalid: false, 
        ignore: '', 
        rules: {
          email: {
            required: true,
            email: true
          },
          password: {
            minlength: 2,
            required: true
          },
          password_confirmation: {
            equalTo: '#password'
          }
        },
        highlight: function (element) { 
          $(element)
          .closest('.form-group .form-control').addClass('is-invalid') 
        },
        unhighlight: function (element) {
          $(element)
          .closest('.form-group .form-control').removeClass('is-invalid') 
          .closest('.form-group .form-control').addClass('is-valid') 
        },
        success: function (label) {
          label
          .closest('.form-group .form-control').removeClass('is-invalid') 
        }
      })
    }
  
    return {
      init: function () {
        handleValidation()
      }
    }
  })()
  
  jQuery(document).ready(function () {
    RegisterForm.init()
  })
  