$(document).ready(function(){
  $(".titulo_tema").click(function() {
    if($(this).next().is(":visible")){
      $(this).next().slideUp("normal");
    }else{
      $(".descripcion_tema").slideUp("normal");
      $(this).next().slideDown("normal");
    }
  });
  // $(".descripcion").hide();
});
