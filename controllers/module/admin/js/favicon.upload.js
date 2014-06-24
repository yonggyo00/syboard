$(document).ready(function() {
	$("#favicon-upload #favicon-upload-form input[type='file']").change(function() {
		$("#favicon-upload #favicon-upload-form").submit();
	});
});