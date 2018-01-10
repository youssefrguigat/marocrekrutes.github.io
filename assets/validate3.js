$('document').ready(function()
    {    
	  
   // valid email pattern
   var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   
   $.validator.addMethod("validemail", function( value, element ) {
       return this.optional( element ) || eregex.test( value );
   });
   
     $("#login-form1").validate({
     
         rules:
         {
			 
              ruemail: {
                  required: true,
			      validemail: true			
                },
             rupass: {
                  required: true,
                  minlength: 8,
                  maxlength: 25
                }				 
            },
         messages:
         {
             ruemail: {
                  required:  "Ce champ est obligatoire.",
                  validemail:"Veuillez fournir une adresse électronique valide."
             },
             rupass:{
                  required: "Ce champ est obligatoire.",
                  minlength:"Veuillez fournir au moins 8 caractères.",			      
			      maxlength:"Veuillez fournir au maximum 25 caractères."
             }
         },
     errorPlacement : function(error, element) {
     $(element).closest('.form-group').find('.help-block').html(error.html());
     },
     highlight : function(element) {
     $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
     },
     unhighlight: function(element, errorClass, validClass) {
     $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
     $(element).closest('.form-group').find('.help-block').html('');
     },
     
     submitHandler: function(form) {
                    form.submit();
                }
     }); 
 });