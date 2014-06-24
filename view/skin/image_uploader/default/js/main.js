$(document).ready(function() {
	$("#image-uploader-skin #image-uploader-form input[type='file']").change(function() {
		$("#image-uploader-skin #image-uploader-form").submit();
	});
});

function image_upload_done( resized_image_path ) {
	$("#image-uploader-skin #image").html("<img src='" + resized_image_path + "' />");
}