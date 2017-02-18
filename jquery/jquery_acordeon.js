$(document).ready(function(){
       $(".titulo_tema").click(function() {
         $(".descripcion_tema").slideUp("normal");
         $(this).next().slideDown("normal");
       });
       $(".descripcion").hide();
     });
