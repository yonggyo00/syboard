$(document).ready(function() {
	$("#admin-cache #select-all").click(function() {
		$checkbox = $("#admin-cache input[type='checkbox']");
		
		if ( $checkbox.prop("checked") == false ) {
			$checkbox.prop("checked", true);
		}
		else $checkbox.prop("checked", false);
		
	});
});