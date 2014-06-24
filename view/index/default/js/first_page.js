$(document).ready(function() {
	$("#layer_popup_test").click(function() {
		var popup_url = $(this).attr('popup_url');
		layer_popup( $(this), popup_url, 600, 500);
	});
});