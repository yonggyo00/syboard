$(document).ready(function() {
	$("body").on("click", "#current-user #current_users .current-user-message", function() {
		var popup_url = $(this).attr('popup_url');
		layer_popup($(this), popup_url, 900, 630, 1);
	});
});