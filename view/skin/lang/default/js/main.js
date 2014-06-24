$(document).ready(function() {
	$("#lang-default-skin select[name='lang']").change(function() {
		$(this).parent().submit();
	});
});