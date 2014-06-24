var menu_timer;
var menu_hide_timer;

$(document).ready(function(){
	
	$(".mainmenu").mouseenter(function(){
		var menu_no = $(this).attr('menu_no');
		menu_timer = setTimeout(function() {
			$(".mainmenu ul[submenu_no='" + menu_no + "'").slideDown();
		}, 500);
	});
	
	$(".mainmenu").mouseleave(function(){
		clearTimeout(menu_timer);
		menu_hide_timer = setTimeout(function() {
			$(".mainmenu ul").slideUp(100);
		}, 300);
	});
	
	$(".mainmenu ul").mouseenter(function() {
		clearTimeout(menu_hide_timer);
	});
	
	$(".mainmenu ul").mouseleave(function() {
		$(this).hide();
	});
	
	$("#admin-top-menu .mainmenu-below-980 #top-more-button").click(function() {
		$submenu = $("#admin-submenu-below-980");
		
		if ( $submenu.css("display") == 'none' ) {
			$submenu.slideDown("slow");
		} else $submenu.slideUp("slow");
	});
});