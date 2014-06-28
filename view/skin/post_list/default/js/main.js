$(document).ready(function(){
	$("#post-list-skin .nickname").click(function() {
	
		$pos = $(this).position();
		var xpos = $pos.left;
		var ypos = $pos.top;
		
		$user_popup = $(this).parent().children(".user-popup").css({"left": xpos + 10 + "px", "top" : ypos + 25 + "px"});
		
		if ( $user_popup.css("display") == "none" ) {
			$user_popup.slideDown();
		}
		else $user_popup.slideUp();
	});
	
	$("#post-list-skin > .rows > .user-popup > .popup-sendmessage > .popup-send-message").click(function(e) {
		var popup_url = $(this).attr('popup_url');
		console.log($(this));
		layer_popup($(this), popup_url, 900, 630, 1);
		
	});
});