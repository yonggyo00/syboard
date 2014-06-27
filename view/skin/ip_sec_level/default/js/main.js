$(document).ready(function(){
	$("#ip-sec-level-skin #ip-sec-level-form select[name='ip_sec_level']").change(function() {
		$("#ip-sec-level-skin #ip-sec-level-form").submit();
	});
	
	$("#ip-sec-level-skin #close").click(function() {
		parent.close_layer_popup();
	});
});