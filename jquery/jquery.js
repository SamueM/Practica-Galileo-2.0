$(document).ready(function() {
	$('#formularioRegistro').hide();
	$('#formularioSesion').hide();

	$('#registrarte').click(function(e){
		$('#formularioSesion').hide();
		$(window).resize(function(){
            $('#formularioRegistro').css({
               position:'absolute',
               left: ($(window).width() - $('#formularioRegistro').outerWidth())/2,
               top: ($(window).height() - $('#formularioRegistro').outerHeight())/2
            });
  
        });
  
	// Ejecutamos la función
	$(window).resize();
	$('#formularioRegistro').show('slow');
	e.preventDefault();
	
	});

	$('#ini_sesion').click(function(e){
		$('#formularioRegistro').hide();
		$(window).resize(function(){
            $('#formularioSesion').css({
               position:'absolute',
               left: ($(window).width() - $('#formularioSesion').outerWidth())/2,
               top: ($(window).height() - $('#formularioSesion').outerHeight())/2
            });
  
        });
  
	// Ejecutamos la función
	$(window).resize();
	$('#formularioSesion').show('slow');
	e.preventDefault();
	
	});

	$('.fa').click(function(){
		$('#formularioRegistro').hide('slow');
		$('#formularioSesion').hide('slow');
	});

});