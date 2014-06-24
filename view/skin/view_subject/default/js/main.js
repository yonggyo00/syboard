$(document).ready(function() {
	$("#view-user-info #view-username").click(function() {
		$popup = $("#view-user-info #view-user-popup");
		
		if ( $popup.css("display") == 'none' ) {
			$popup.slideDown();
		} else $popup.slideUp();
	});
});