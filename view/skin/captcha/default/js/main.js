$(document).ready(function() {
	$("body").on("click", "#captcha-image", function() {
		var d = new Date();
		var src = captcha_skin_path + "/captcha.php?v=" + d.getTime();
		$(this).prop("src", src);
	});
	$("body").on("click", "#captcha-change", function() {
		var d = new Date();
		var src = captcha_skin_path + "/captcha.php?v=" + d.getTime();
		$("#captcha-image").prop("src", src);
	});
});