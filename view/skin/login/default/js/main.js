$(document).ready(function() {
	$("#login_skin #login-form #ip-sec-layer_popup").click(function() {
		var popup_url = $(this).attr('popup_url');
		layer_popup($(this), popup_url, 340, 150);
	});
});