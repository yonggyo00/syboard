$(document).ready(function(){
	$("#view-comment-form #select-all").click(function() {
		$checked = $("#view-posts .row input[type='checkbox']").prop("checked");
		
		if ( $checked == false ) {
			$("#view-posts .row input[type='checkbox']").prop("checked", true);
			$(this).text("전체해제");
		}
		else {
			$("#view-posts .row input[type='checkbox']").prop("checked", false);
			$(this).text("전체선택");
		}
	});
});