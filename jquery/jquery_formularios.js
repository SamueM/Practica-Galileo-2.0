$(document).ready(function() {

	$('#editor').click(function(e){
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

	$('#editor2').click(function(e){
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

	$('.fa').click(function(){
		$('#convierteteEditor').hide('slow');
	});

});
