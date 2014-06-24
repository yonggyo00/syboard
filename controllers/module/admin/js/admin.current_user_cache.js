$(document).ready(function() {
	$("#admin-current-user-cache").click(function() {
		$checkbox = $("#admin-current-user-cache input[type='checkbox']");
		
		if ( $checkbox.prop("checked") == false ) {
			$checkbox.prop("checked", true);
		}
		else $checkbox.prop("checked", false);
		
	});
});