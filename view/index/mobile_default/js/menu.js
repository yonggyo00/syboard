$(document).ready(function() {
	$("#site-top > #site-top-menu-row > #site-top-menu > #mobile-more-button").click(function() {
		$more_menu = $("#site-top > #site-top-menu-row > #mobile-more-button-menu");
		
		if ( $more_menu.css('display') == "none") {
			$more_menu.slideDown("slow");
		}
		else $more_menu.slideUp("slow");
	});
});