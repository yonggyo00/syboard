<?php
	session_start();
	
	define('CAPTCHA_NUMBERS', 7 );  // 캡차 문자 수
	define('CAPTCHA_WIDTH', 120 ); // 이미지 가로 
	define('CAPTCHA_HEIGHT', 30 ); // 이미지 세로
	
	// 임의의 캐릭터 색성하기
	$characters = "";
	for ( $i = 0; $i < CAPTCHA_NUMBERS; $i++ ) {
		$characters .= chr(rand(97, 122));
	}
	
	// 캡차 문자는 md5로 암호화 하여 세션에 저장한다.
	$_SESSION['captcha'] = md5($characters);
	
	// 이미지를 담을 공간을 생성
	$img = imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);
	
	$bg_color = imagecolorallocate( $img, 242, 210, 158 ); // 배경색
	$text_color = imagecolorallocate( $img, rand(0, 125), rand(0, 125), rand(0, 125) );  // 글자색
	
	// 배경 그리기
	imagefilledrectangle( $img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color );
	
	// 임의의 선 그리기
	for ( $i = 0; $i < 10; $i++ ) {
		$line_color = imagecolorallocate( $img, rand(50, 255) , rand(50, 255), rand(50, 255) ); 
		imageline($img, 0, rand() % CAPTCHA_HEIGHT, CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $line_color );
	}
	
	// 점 뿌려 주기 
	for ( $i = 0; $i < 50; $i++ ) {
		$dot_color = imagecolorallocate( $img, rand(0, 255) , rand(0, 255), rand(0, 255) ); 
		imagesetpixel($img, rand() % CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $dot_color );
	}
	
	imagettftext( $img, 20, rand(0, 5), 5, CAPTCHA_HEIGHT - 5, $text_color, 'Courier New Bold.ttf', $characters );
	
	header( "Content-type: image/png" );
	imagepng( $img );
	
	imagedestroy( $img );
?>