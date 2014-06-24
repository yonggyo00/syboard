<?php
$_pc = popup_config();
$popup_config = $sy['file']->unscalar($_pc['value']);

// 팝업 데이터 처리, 팝업 스킨에 데이터를 전달하여 처리한다.
for( $i=1; $i <= 5; $i++ ) {
	if ( $popup_config['active_popup'][$i] ) {
		$_pd = array(
					'popup_no'=>$i,
					'width'=>$popup_config['width'][$i],
					'height'=>$popup_config['height'][$i],
					'xpos'=>$popup_config['xpos'][$i],
					'ypos'=>$popup_config['ypos'][$i],
					'content'=>$popup_config['content'][$i]
		);
	
		load_skin('popup', 'default', $_pd);
	}
}
?>