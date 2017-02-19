$(document).ready(function(){

	$('#perfil').click(function(){
		if ($("#perfil_usuario").is(":hidden")) {
			$("#perfil_usuario").slideDown("slow");
			$('#perfil i.fa-angle-down').addClass('fa-angle-up');
			$('#perfil i.fa-angle-down').removeClass('fa-angle-down');

		}else{
			$('#perfil i.fa-angle-up').addClass('fa-angle-down');
			$('#perfil i.fa-angle-up').removeClass('fa-angle-up');
			$("#perfil_usuario").slideUp("slow");
		}
	});
});
