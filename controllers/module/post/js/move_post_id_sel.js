$(document).ready(function(){
	$("#move-select-all").click(function() {
		$checked = $("#list-module-form .seq").prop("checked");
		
		if ( $checked == false ) {
			 $("#list-module-form .seq").prop("checked", true);
			 $(this).text("전체해제");
		}
		else {
			 $("#list-module-form .seq").prop("checked", false);
			 $(this).text("전체선택");
		}
	});
});