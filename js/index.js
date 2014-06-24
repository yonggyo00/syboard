$(document).ready(function() {
	$.ajax({
		type: "post",
		url: "?module=member&action=add_user&layout=1&header=1",
			data: {"param" : "add_user" },
			success : function(data) {
				$("#current-user").html(data);
			},
			error : function(res) {
				console.log(res);
			}
	});
	
	$(window).on('beforeunload', function() {
	
		$.ajax({
			type: "post",
			url: "?module=member&action=delete_user&layout=1&header=1",
			data: {"param" : "delete_user" },
			success : function(data) {
		
			},
			error : function(res) {
				console.log(res);
			}
		});
		
	});
	
	// 이미지 레이어 팝업
	$("#view-content img").click(function(e) {
		image_layer_popup($(this), $(this).attr('src'));
	});
	
	
	// date picker
	$( ".datepicker" ).datepicker({
		dateFormat : "yy-mm-dd",
		numberOfMonths: 1,
		showButtonPanel: true
	});
	
	
});

function layer_popup( $this, url, fwidth, fheight, scrolling ) {
	$("body").prepend(
						"<div id='layer_popup'></div>" +
						"<div id='layer_popup_content'></div>"
					);
	
	if ( typeof fwidth == 'undefined' ) fwidth = 300;
	if ( typeof fheight == 'undefined' ) fheight = 300;
	
	var subtract = 0;
	
	var height = $("body").height();
	var width = $(window).width();
	
	var content_left = (width / 2 ) - ( fwidth / 2 );
	var content_top = 0;
	
	if ( fheight >= height ) {
		height = fheight + 100; // 팝업 사이즈가 body 높이보다 크다면 body 높이를 조정한다.
		content_top = (height / 2 ) - ( fheight / 2 );
	}
	else { // 팝업 높이 보다 작다면
		var window_height = $(window).height(); // 모니터 창의 사이즈를 구하고
		
		var click_ypos = $this.position().top; // 레이어 팝업을 발생시킨 element의 y좌표를 가져오고
		
		var pages = Math.ceil(height / window_height); // 전체 높이가 모니터 창의 사이즈로 나누었을 때 몇 페이지가 되는지 구한다.
		
		var content_ypos = 0;
		
		for ( var i=1;  i <= pages; i++ ) {
			if ( click_ypos >= window_height * ( i - 1 ) && click_ypos < window_height * i ) {
				content_ypos = Math.round(window_height * ( i - 1 ) + (window_height / 2 ) - (fheight / 2));
			}
		}
		
		content_top = content_ypos;
		
	}
	
	
	var scroll_option = "";
	
	// 스크롤링이 없는 경우
	if ( typeof scrolling == 'undefined' || scrolling == 0 ) scroll_option = "scrolling='no'";
	
	$("#layer_popup").css({"width" : width + "px", "height" : height + "px"}).show();
	
	$("#layer_popup_content").css({"top": content_top + "px", "left": content_left + "px"}).show();
	
	$("#layer_popup_content").html("<iframe src='"+url+"' frameborder=0 border=0 width="+fwidth+" height="+fheight+" style='background-color: #ffffff;' " + scroll_option + " ></iframe>");

	$("#layer_popup").click(function() {
		$("#layer_popup, #layer_popup_content").remove();
	});
}

function close_layer_popup() {
	$("#layer_popup, #layer_popup_content").remove();
}


function image_layer_popup( $this, image_url) {
	
	$("body").prepend(
						"<div id='layer_popup'></div>" +
						"<div id='layer_popup_content'></div>"
					);
	
	var height = $("body").height();
	var width = $(window).width();
	
	var position = $this.position();
	var ypos = position.top;
	
	var window_height = $(window).height();
	var pages = Math.ceil(height / window_height);
	
	var loader_ypos= 0;
	var loader_xpos = width / 2;
	
	
	for ( var i = 1; i <= pages; i++ ) {
		if ( ypos >= window_height * ( i - 1 ) && ypos < window_height * i ) {
			loader_ypos = window_height * ( i - 1 ) + ( window_height / 2 );
		}
	}
	
	var loader_img = "<img id='popup-image-loader-gif' src='img/loader.gif' style='position: absolute; z-index: 30000; top: " + loader_ypos + "px; left: " + loader_xpos + "px;' />";
	$("body").append(loader_img);
	
	setTimeout(function() {
	// 이미지를 추가하고
		$("#layer_popup_content").html("<img onload='adjust_image_location( " + ypos + ","+width+","+height +")' id='layer_popup_image' src='"+image_url +"' style='max-width: 930px;' />").show();
		
		$("#layer_popup").css({"width" : width + "px", "height" : height + "px"}).show();
	
	}, 400);
	
	$("#layer_popup").click(function() {
		$("#popup-image-loader-gif").remove();
		$("#layer_popup, #layer_popup_content").remove();
	});
	
	$("#layer_popup_content").click(function() {
		$("#popup-image-loader-gif").remove();
		$("#layer_popup, #layer_popup_content").remove();
	});
}

function adjust_image_location( ypos, width, height ) {
	var layer_popup_image_width  = $("#layer_popup_image").width();
	var layer_popup_image_height = $("#layer_popup_image").height();
	
	var window_height = $(window).height();
	
	var image_left = Math.round((width / 2 ) - (layer_popup_image_width / 2 ));
	
	
	$("#layer_popup_content").css({
									"width" : layer_popup_image_width + "px", 
									"height" : layer_popup_image_height +  "px",
									"left" : image_left + "px",
									"cursor" : "pointer"
								});
	
	var image_top = 50;
	// 만약 이미지의 높이가 body height보다 큰 경우
	if ( layer_popup_image_height >= height ) {
		height = layer_popup_image + 100;
		$("#layer_popup").css("height", height + "px");
		
		image_top = Math.round((height / 2 ) - ( layer_popup_image_height / 2 ));
		
		$("#layer_popup_content").css("top", image_top);
		
	}
	else {
			
			var pages = Math.ceil(height / window_height );
			height = window_height * pages;
			$("#layer_popup").css("height", height + "px");
			
			var image_y_pos = 0;
			var substract = 0;
			
			if ( layer_popup_image_height > (window_height / 2) ) substract = 100;
			
			for ( var i = 1; i <= pages; i++ ) {
				if ( ypos >= window_height * ( i - 1 ) && ypos < window_height * i ) {
					
					image_y_pos = window_height * ( i - 1 )  + (window_height / 2 - substract);
				}
			}
			$("#layer_popup_content").css("top", image_y_pos);
	}
	$("#popup-image-loader-gif").remove();
	$("#layer_popup_content").show();
}

/* 자바스크립트 쿠기관련 함수  jQuery로 쿠기를 처리 하지 않는다. 이는 cookie 관련 라이브러리를 설치해야 하기 때문이다.*/
function createCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else var expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}

function eraseCookie(name) {
  createCookie(name,"",-1);
}



