$(document).ready(function() {
	$("#sub-admin #select-all").click(function() {
		$checkbox = $("#sub-admin input[type='checkbox']");
		
		if ( $checkbox.prop("checked") == false ) {
			$checkbox.prop("checked", true);
			$(this).text("전체해제");
		} else {
			$checkbox.prop("checked", false);
			$(this).text("전체선택");
		}
	});
});	