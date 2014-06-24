$(document).ready(function(){
	$("#post-config-manage #select-all").click(function() {
		$checkbox = $("#post-config-manage input[type='checkbox']");
		
		if ( $checkbox.prop("checked") == false ) {
			$checkbox.prop("checked", true);
		}
		else $checkbox.prop("checked", false);
	});
});