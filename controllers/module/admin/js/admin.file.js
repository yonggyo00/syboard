$(document).ready(function() {
	$("#admin-file #admin-file-form #select-all").click(function() {
		$checkbox = $("#admin-file #admin-file-form input[type='checkbox']");
		
		if ( $checkbox.prop("checked") == false ) {
			$checkbox.prop("checked", true);
		} else $checkbox.prop("checked", false);
	});
});