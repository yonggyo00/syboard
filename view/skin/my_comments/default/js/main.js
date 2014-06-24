$(document).ready(function() {
	$("#my-comments-skin #select-all").click(function() {
		$checkbox = $("#my-comments-skin input[type='checkbox']");
		
		if ( $checkbox.prop("checked") == false ) {
			$checkbox.prop("checked", true);
		}
		else $checkbox.prop("checked", false);
	});
});