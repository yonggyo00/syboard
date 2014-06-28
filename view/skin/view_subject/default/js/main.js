$(document).ready(function() {
	$("#view-user-info #view-username").click(function() {
		$popup = $("#view-user-info #view-user-popup");
		
		if ( $popup.css("display") == 'none' ) {
			$popup.slideDown();
		} else $popup.slideUp();
	});
	
	$("#view-user-info #right #user-info #view-user-popup #view-send-message").click(function() {
		var popup_url = $(this).attr('popup_url');
		layer_popup($(this), popup_url, 900, 630, 1);
	});
});