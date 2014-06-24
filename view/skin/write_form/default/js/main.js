$(document).ready(function(){
	$("#write-form-skin input[name='use_secret']").change(function() {
		var checked = $(this).prop("checked");
		if ( checked ) {
			$("#secret_password").show();
		}
		else $("#secret_password").hide();
	});
});