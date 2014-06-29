$(document).ready(function() {
	$("#site-top #site-top-left #site-top-message").click(function() {
		var popup_url = $(this).attr('popup_url');
		layer_popup($(this), popup_url, 900, 630, 1);
	});	
});