$(document).ready(function() {
	$("#login_skin #login-form #ip-sec-layer_popup").click(function() {
		var popup_url = $(this).attr('popup_url');
		layer_popup($(this), popup_url, 360, 220);
	});
	
	$("#login_skin #login-form #message-popup").click(function() {
		var popup_url = $(this).attr('popup_url');
		layer_popup($(this), popup_url, 900, 630, 1);
	});
});