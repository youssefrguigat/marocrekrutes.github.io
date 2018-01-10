//Validate Rekruteur inputs
$('document').ready(function()
    {    
	  // name validation
    var nameregex = /^[a-zA-Z\u00C0-\u024F ]+$/;
   
   $.validator.addMethod("validname", function( value, element ) {
       return this.optional( element ) || nameregex.test( value );
   }); 
   	  // society fonction validation
    var socregex = /^[a-zA-Z\u00C0-\u024F0-9' ]*$/;
   
   $.validator.addMethod("validsoc", function( value, element ) {
       return this.optional( element ) || socregex.test( value );
   }); 
   
   
     $("#UpdateForm").validate({
     
         rules:
         {
			 
			entreprise: {
			      validsoc: true,
                  minlength: 2,
			      maxlength:100
                },
			fonctionU: {
			      validsoc: true,
                  minlength: 2,
			      maxlength:80
                },				
			 tel: {
				  number: true,
				  minlength:10,
                  maxlength: 10
			    },
			siteweb: {
                  url: true,
                  maxlength: 60
			    },
            descriptionU: {
                  maxlength: 2000
			    }			
            },
         messages:
         {
			 entreprise: {
			      validsoc: "Soci&eacute;t&eacute; avec des lettres et/ou chiffres.",
				  minlength:"Veuillez fournir au moins 2 caract&egrave;res.",			      
			      maxlength:"Veuillez fournir au maximum 100 caract&egrave;res."
                },
			fonctionU: {
			      validsoc: "Fonction avec des lettres et/ou chiffres.",
				  minlength:"Veuillez fournir au moins 2 caract&egrave;res.",			      
			      maxlength:"Veuillez fournir au maximum 80 caract&egrave;res."
                },				
			 tel: {
				  number: "Veuillez entrer un numéro de t&eacute;l&eacute;phone valide.",
				  minlength: "Veuillez entrer 10 num&eacute;ro de t&eacute;l&eacute;phone.",
                  maxlength: "Veuillez entrer 10 num&eacute;ro de t&eacute;l&eacute;phone."
			    },
			siteweb: {
                  url: "Veuillez entrer un url valide.",
                  maxlength: "url trop longue!!!."
			    },
            descriptionU: {
                  maxlength: "Veuillez fournir au maximum 2000 caract&egrave;res."
			    }
         },
		 
     errorPlacement : function(error, element) {
     $(element).closest('.group').find('.error_msg').html(error.html());
     },
     highlight : function(element) {
     $(element).closest('.group').removeClass('has-success').addClass('has-error');
     },
     unhighlight: function(element, errorClass, validClass) {
     $(element).closest('.group').removeClass('has-error').addClass('has-success');
     $(element).closest('.group').find('.error_msg').html('');
     },
     
     submitHandler: function(form) {
                    form.submit();
                }
     }); 
 });