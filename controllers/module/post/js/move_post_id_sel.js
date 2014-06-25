$(document).ready(function(){
	$("#move-select-all").click(function() {
		$checked = $("#list-module-form .seq").prop("checked");
		
		if ( $checked == false ) {
			 $("#list-module-form .seq").prop("checked", true);
			 $(this).text(sm_deselect_all);
		}
		else {
			 $("#list-module-form .seq").prop("checked", false);
			 $(this).text(sm_select_all);
		}
	});
});