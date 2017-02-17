$(document).ready(function(){	

	$('#perfil').hover(function(){
		//$('#perfil i.fa-angle-down').toggleClass('fa-angle-up');
		if ($("#perfil_usuario").is(":hidden")) {
			$("#perfil_usuario").slideDown("slow");
			$('#perfil i.fa-angle-down').addClass('fa-angle-up');
			$('#perfil i.fa-angle-down').removeClass('fa-angle-down');

		} 
		
	},function(){
		$('#perfil i.fa-angle-up').addClass('fa-angle-down');
			$('#perfil i.fa-angle-up').removeClass('fa-angle-up');
			$("#perfil_usuario").slideUp("slow");
	});

	$('.perfil li').hover(function(){
		$(this).css('border-bottom','3px solid #476E9E');
		//.animate('border-bottom','1px solid #476E9E');
	},function(){
		$(this).css('border-bottom','1px solid #476E9E');
	});

	$('li').click(function(){
		//$('#perfil i.fa-angle-down').toggleClass('fa-angle-up');
		if ($('.descripcion_tema',this).is(":hidden")) {
			$('.descripcion_tema',this).slideDown("slow");
		}else {
			$('.descripcion_tema',this).slideUp("slow");
		}
	});
});