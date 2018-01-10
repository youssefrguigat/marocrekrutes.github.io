//Validate Rekruteur inputs
$('document').ready(function()
    {    
	  // name validation
    var nameregex = /^[a-zA-Z ]+$/;
   
   $.validator.addMethod("validname", function( value, element ) {
       return this.optional( element ) || nameregex.test( value );
   }); 
   	  // society fonction validation
    var socregex = /^[a-zA-Z\u00C0-\u024F0-9' ]*$/;
   
   $.validator.addMethod("validsoc", function( value, element ) {
       return this.optional( element ) || socregex.test( value );
   }); 
   // valid email pattern
   var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   
   $.validator.addMethod("validemail", function( value, element ) {
       return this.optional( element ) || eregex.test( value );
   });
   
     $("#register-form1").validate({
     
         rules:
         {
			 gender: {
				  required: true
			 },
             firstname: {
                  required: true,
			      validname: true,
                  minlength: 3,
			      maxlength:30
                },
		     lastname: {
                  required: true,
			      validname: true,
                  minlength: 3,
			      maxlength:30
                },
			society: {
                  required: true,
			      validsoc: true,
                  minlength: 2,
			      maxlength:40
                },
			fonction: {
                  required: true,
			      validsoc: true,
                  minlength: 2,
			      maxlength:30
                },
             userEmail: {
                  required: true,
			      validemail: true			
                },
             upass: {
                  required: true,
                  minlength: 8,
                  maxlength: 25
                },
             ucpass: {
                  required: true,
                  minlength: 8,
                  maxlength: 25,
                  equalTo: '#password'
                },
			 tel: {
				  required: true,
				  number: true,
				  minlength:10,
                  maxlength: 10
			    },
             accept: {
                  required: true
			    }				 
            },
         messages:
         {
			 gender:{
				  required:"Ce champ est obligatoire."
			 },
			 firstname: {
				  required: "Ce champ est obligatoire.",
				  validname:"Prénom avec des lettres.",
				  minlength:"Veuillez fournir au moins 3 caractères.",			      
			      maxlength:"Veuillez fournir au maximum 30 caractères."
			 },
			 lastname: {
				  required: "Ce champ est obligatoire.",
				  validname:"Nom avec des lettres.",
				  minlength:"Veuillez fournir au moins 3 caractères.",			      
			      maxlength:"Veuillez fournir au maximum 30 caractères."
			 },
			 society: {
				  required: "Ce champ est obligatoire.",
				  validsoc:"société avec des lettres et/ou chiffres.",
				  minlength:"Veuillez fournir au moins 2 caractères.",			      
			      maxlength:"Veuillez fournir au maximum 40 caractères."
			 },
			 fonction: {
				  required: "Ce champ est obligatoire.",
				  validsoc:"fonction avec des lettres et/ou chiffres.",
				  minlength:"Veuillez fournir au moins 2 caractères.",			      
			      maxlength:"Veuillez fournir au maximum 30 caractères."
			 },
             userEmail: {
                  required:  "Ce champ est obligatoire.",
                  validemail:"Veuillez fournir une adresse électronique valide."
             },
             upass:{
                  required: "Ce champ est obligatoire.",
                  minlength:"Veuillez fournir au moins 8 caractères.",			      
			      maxlength:"Veuillez fournir au maximum 25 caractères."
             },
             ucpass:{
                  required: "Ce champ est obligatoire.",
                  minlength:"Veuillez fournir au moins 8 caractères.",			      
			      maxlength:"Veuillez fournir au maximum 25 caractères.",
                  equalTo: "Veuillez fournir encore la même valeur."
             },
			 tel: {
				  required: "Ce champ est obligatoire.",
				  number: "Veuillez entrer un numéro de téléphone valide.",
				  minlength: "Veuillez entrer 10 numéro de téléphone.",
                  maxlength: "Veuillez entrer 10 numéro de téléphone1."
			 },
			 accept: {
                  required: "Veuillez bien lire et accepter les conditions générales d'utilisation."
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