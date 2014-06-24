$(document).ready(function(){
	$("#message-list-skin #select-all").click(function() {
		$checked = $(this).prop("checked");
		if ( $checked == true ) {
			$("#message-list-skin .seq_check").prop("checked", true);
		}
		else {
			$("#message-list-skin .seq_check").prop("checked", false);
		}
	});
	
	$("body").on('click', "#message-list-skin .star", function() {
		var seq = $(this).parent().parent().attr('seq');
		$mode = $(this).attr('mode');
		if ( $mode == 'unchecked' ) {
			$.ajax({
					url : "?module=message&action=update_important&layout=1&header=1",
					data : { seq : seq, mode : "important" },
					type : "get",
					success : function(data) {
						
					},
					error : function(res) {
						console.log(res);
					}
			});
			$(this).parent().html(star_green);
			
		}
		else {
			$.ajax({
					url : "?module=message&action=update_important&layout=1&header=1",
					data : { seq : seq, mode : "unimportant" },
					type : "get",
					success : function(data) {
					
					},
					error : function(res) {
						console.log(res);
					}
			});
			$(this).parent().html(star_gray);
		}
	});
	
	$("#message-list-skin #control-pannel #check_readed").click(function() {
		$("#message-list-form #hidden-input").html("<input type='hidden' name='mode' value='check_readed' />");
		$("#message-list-form").submit();
		
	});
	$("#message-list-skin #control-pannel #delete").click(function() {
		$("#message-list-form #hidden-input").html("<input type='hidden' name='mode' value='delete' />");
		$("#message-list-form").submit();
		
	});
	$("#message-list-skin #control-pannel #reply").click(function() {
		$("#message-list-form #hidden-input").html("<input type='hidden' name='mode' value='reply' />");
		$("#message-list-form").submit();
		
	});
});