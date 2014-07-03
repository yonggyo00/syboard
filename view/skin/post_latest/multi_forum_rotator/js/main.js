var post_latest_multi_forum_min_no = 0;
var post_latest_multi_forum_max_no = 5;
$(document).ready(function() {
	$(".post-latest-multi-forum-rotator .post-latest-multi-forum-rotator-tap li").click(function() {
		$(".post-latest-multi-forum-rotator .post-latest-multi-forum-rotator-tap li").removeClass("selected");
		$(this).addClass("selected");
		
		// interval 증가 번호를 변경 한다.
		var tab_no = $(this).attr('tab_no');
		post_latest_multi_forum_min_no = tab_no;
		
		var post_latest_rotator_pid = $(this).attr('post_id');
		$.ajax({
				type: "get",
				url : "?skin=post_latest&dir=multi_forum_rotator&file=content&layout=1&header=1",
				data : { "pid" : post_latest_rotator_pid },
				success : function( data ) {
					$(".post-latest-multi-forum-rotator .post-latest-content").html(data);
				},
				error : function(res) {
				
				}
		});
	});
	
	setInterval(function() {
		if ( post_latest_multi_forum_min_no > post_latest_multi_forum_max_no ) {
			post_latest_multi_forum_min_no = 0;
		}
		
		$(".post-latest-multi-forum-rotator .post-latest-multi-forum-rotator-tap li[tab_no=" +post_latest_multi_forum_min_no + "]").click();
		
		post_latest_multi_forum_min_no++;
	
	}, 20000);
});