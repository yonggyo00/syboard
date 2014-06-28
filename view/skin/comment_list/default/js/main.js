$(document).ready(function() {
	$("#comment-list .row .comment-write-button").click(function(){
		var seq = $(this).parent().parent().attr('seq');
		var seq_root = $(this).parent().parent().attr('seq_root');
		var list_order = $(this).parent().parent().attr('list_order');
		var nickname = $(this).parent().parent().attr('nickname');
		var post_id = $(this).parent().parent().attr('post_id');
		
		$("#comment-write-form-" + seq).html("<iframe src='?module=post&action=comment.reply.form&layout=1&seq_parent="+seq+"&seq_root="+seq_root+"&list_order="+list_order+"&nickname="+nickname+"&post_id=" + post_id + "' border=0 frameborder=0 scrolling='no'></iframe>");
		
		$(this).siblings("#comment-list .row .comment-cancel-button").show();
		$(this).hide();
	});
	
	$("#comment-list .row .comment-cancel-button").click(function() {
		var seq = $(this).parent().parent().attr('seq');
		$(this).siblings("#comment-list .row .comment-write-button").show();
		$(this).hide();
		
		$("#comment-write-form-" + seq).html("");
	});
	
	
	$("#comment-list .row .comment-edit-button").click(function() {
		var seq = $(this).parent().parent().attr('seq');
		$(this).parent().parent().children(".comment-content").remove();
		$("#comment-write-form-" + seq).html("<iframe src='?module=post&action=comment.update.form&layout=1&seq="+seq+"' border=0 frameborder=0 scrolling='no'></iframe>");
	});
	
	$("#comment-list .row .username").click(function() {
	
		$pos = $(this).position();
		var xpos = $pos.left;
		var ypos = $pos.top;
		
		$user_popup = $(this).parent().children(".user-popup").css({"left": xpos + 40 + "px", "top" : ypos + 20 + "px"});
		
		if ( $user_popup.css("display") == "none" ) {
			$user_popup.slideDown();
		}
		else $user_popup.slideUp();
	});
	
	$("#comment-list > .row .user-popup > div > .comment-send-message").click(function() {
		var popup_url = $(this).attr('popup_url');
		layer_popup($(this), popup_url, 900, 630, 1);
	});
});
