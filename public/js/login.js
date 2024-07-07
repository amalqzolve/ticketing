  $(document).on('click', '#login_submit', function(){

         $('#kt-form').validate(  {
          rules: {
            email: {
              required: true,
              email: true
            },
            password    : "required"

            },
          messages: {
            email : {
              required: "We need your email address to contact you",
              email: "Your email address must be in the format of name@domain.com"
            },
            password      : "Please enter your password",



          },
          submitHandler: function(form) {
            form.submit();
          }
         });
});