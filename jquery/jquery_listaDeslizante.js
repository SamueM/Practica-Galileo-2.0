$(document).ready(function() {
	$('#conocenos ul li a').hover(function() {
		$(this).stop(true).animate( { paddingLeft:"40px" }, 600 );
	},
	function() {
		$(this).stop(true).animate( { paddingLeft:"0" }, 600 )
	})
});
