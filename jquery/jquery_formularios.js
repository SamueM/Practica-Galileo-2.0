$(document).ready(function() {
	$('#editor,#editor2').click(function(e){
		$('#registroNuevo').hide();
		$('#formularioSesion').hide();
		$(window).resize(function(){
            $('#convierteteEditor').css({
               position:'absolute',
               left: ($(window).width() - $('#convierteteEditor').outerWidth())/2,
               top: ($(window).height() - $('#convierteteEditor').outerHeight())/2
            });

        });

	// Ejecutamos la función
	$(window).resize();
	$('#convierteteEditor').show('slow');
	e.preventDefault();
	});

	$('#ini_sesion,#ini_sesion2').click(function(e){
		$('#registroNuevo').hide();
		$('#convierteteEditor').hide();
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

	$('#registrarte,#registrarte2').click(function(e){
		$('#convierteteEditor').hide();
		$('#formularioSesion').hide();
		$(window).resize(function(){
            $('#registroNuevo').css({
               position:'absolute',
               left: ($(window).width() - $('#registroNuevo').outerWidth())/2,
               top: ($(window).height() - $('#registroNuevo').outerHeight())/2
            });

        });

	// Ejecutamos la función
	$(window).resize();
	$('#registroNuevo').show('slow');
	e.preventDefault();
	});

	$('.fa').click(function(){
		$('#convierteteEditor').hide('slow');
		$('#registroNuevo').hide('slow');
		$('#formularioSesion').hide('slow');
	});

	$('.aceptar').click(function(){
		$('#convierteteEditor').hide('slow');
	});

});
