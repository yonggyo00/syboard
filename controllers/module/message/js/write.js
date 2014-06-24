$(document).ready(function() {
	$("#file-uploader input[type='file']").change(function(){
		$("#file-uploader").submit();
	});
	
	$("body").on("click", ".insert_content", function() {
		var image_width  = $(this).parent().attr('image_width');
		var file_url = $(this).parent().attr('file_url');
		var file_name = $(this).parent().attr('filename');
		var file_no = $(this).parent().attr('file_no');
		var content;
		
		if ( image_width == 0 ) {
			// image_width가 0이면 비디오이다.
			content = "<video controls >" + 
						"<source src='"+file_url+"' type='video/mp4' />"+	
					"</video>";
		}
		else if ( image_width == 1 ) {
			// image_width가 1이면 파일 업로드 이다.
			content = "<div class='content-file-info' id='"+file_no+"'><span class='content-filename'>" + file_name + "</span><span class='file-download'>DOWNLOAD</span></div><p>&nbsp;</p>";
		}
		else {
			if ( image_width > 710 ) image_width = 710;
			content = "<div style='max-width: "+ image_width + "px;'><img src='"+ file_url + "' style='width: 100%' />";
		}
		insert_content_to_editor( content );
	});
	
	$("body").on("click", ".delete_file", function() {
		var file_no = $(this).parent().attr('file_no');
		$.ajax({
				type : "post",
				url : "?module=message&action=delete_file&layout=1&header=1",
				data : { "seq" : file_no },
				success : function(data) {
					$("#file_info span[file_no="+file_no+"]").remove();
				},
				error : function(res) {
					console.log(res);
				}
		});
	});
});

function insert_content_to_editor( data )
{
	// 이미지 삽입
	tinyMCE.execCommand('mceInsertContent', false, data);
}

function update_file_info( seq, filename, file_url, image_width ) {
	$("#file_info").append("<span class='row' file_no='"+seq+"' file_url='"+file_url+"' image_width='"+image_width+"' filename='"+filename+"'>"+filename+	
							"<span class='delete_file'>삭제</span>"+
							"<span class='insert_content'>본문삽입</span>" + 
							"</span>"
	);
}

function update_file_info_to_form ( seq ) {
	$("#message-write-module input[name='first_file']").val(seq);
}