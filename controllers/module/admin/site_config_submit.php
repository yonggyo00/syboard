<?php
if ( $in['site_domain'] && $in['site_title'] && $in['site_layout'] ) {
	if ( $adm->chk_site_domain($in['site_domain']) ) {
		echo "<script>
				alert('도메인이 이미 존재합니다')
				window.history.back();
			</script>";
	}
	else {
		$msg = null;
		if ( $adm->add_domain( $in ) ) {
			$msg = "사이트가 추가되었습니다.";
			// 사이트가 정삭적으로 추가되었을 경우 팝업 설정을 위한 popup_config 테이블에 도메인으로 데이터를 생성한다.
			
			$adm->add_popup_config( $in['site_domain'] );
			
		}
		else $msg = "사이트 추가에 실패 하였습니다.";
		echo "<script>
				alert('$msg')
				window.location.href='".$_SERVER['REQUEST_URI']."';
			</script>";
		
	}
}
else {
	echo "<script>
			alert('도메인, 사이트이름을 기입하고, 사이트 레이아웃을 선택해 주세요.')
			window.history.back();
		</script>";
}
?>