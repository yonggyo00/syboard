$(document).ready(function(){
	$("#message-list-skin > #control-pannel > #select-all").click(function() {
		$checked = $("#message-list-skin > .row > .subject > .seq_check");
		if ( $checked.prop('checked') == false ) {
			$checked.prop("checked", true);
			$(this).text(sm_deselect_all);
		}
		else {
			$checked.prop("checked", false);
			$(this).text(sm_select_all);
		}
	});
	

	$("#message-list-skin > #control-pannel #check_readed").click(function() {
		$("#message-list-form #hidden-input").html("<input type='hidden' name='mode' value='check_readed' />");
		$("#message-list-form").submit();
		
	});
	$("#message-list-skin > #control-pannel #delete").click(function() {
		$("#message-list-form #hidden-input").html("<input type='hidden' name='mode' value='delete' />");
		$("#message-list-form").submit();
		
	});
	$("#message-list-skin > #control-pannel #reply").click(function() {
		$("#message-list-form #hidden-input").html("<input type='hidden' name='mode' value='reply' />");
		$("#message-list-form").submit();
		
	});
	
});