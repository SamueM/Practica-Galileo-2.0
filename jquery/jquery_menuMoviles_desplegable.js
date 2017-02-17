$(document).ready(function(){
	$('#menu_moviles').click(function(){
		if ($("#lista_movil").is(":hidden")) {
			$("#lista_movil").slideDown("slow");
		
		}else {
			$("#lista_movil").slideUp("slow");
		}
	});	
});