function comment_done() {
	var height = $("#comment-list-module").height();
	
	if ( typeof height != "object" ) {
		var position = $("#comment-list-module").position();
		$("html, body").scrollTop(height + position.top - 20);
	}
	
	window.location.reload();
	
}