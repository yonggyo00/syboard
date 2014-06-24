$(document).ready(function() {
	$("#my-posts-skin #select-all").click(function() {
		$checkbox = $("#my-posts-skin input[type='checkbox']");
		
		if ( $checkbox.prop("checked") == false ) {
			$checkbox.prop("checked", true);
		}
		else $checkbox.prop("checked", false);
	});
});