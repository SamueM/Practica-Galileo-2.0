$(document).ready(function(){

	$('#perfil1').click(function(){
		if ($("#perfil_usuario").is(":hidden")) {
			$("#perfil_usuario").slideDown("slow");
			$('#perfil1 i.fa-angle-down').addClass('fa-angle-up');
			$('#perfil1 i.fa-angle-down').removeClass('fa-angle-down');

		}else{
			$('#perfil1 i.fa-angle-up').addClass('fa-angle-down');
			$('#perfil1 i.fa-angle-up').removeClass('fa-angle-up');
			$("#perfil_usuario").slideUp("slow");
		}
	});
});
