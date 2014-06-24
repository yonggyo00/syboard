$(document).ready(function(){
	$(".content-file-info .file-download").click(function() {
		var file_no = $(this).parent().attr("id");
		$("iframe[name='hiframe']").prop("src", "?module=data&action=download&layout=1&header=1&seq=" + file_no);
	});
});