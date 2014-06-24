<?php
$option = array(
	'active_popup'=>$in['active_popup'],
	'width'=>$in['width'],
	'height'=>$in['height'],
	'xpos'=>$in['xpos'],
	'ypos'=>$in['ypos'],
);

$contents = array();
foreach ( $in['content'] as $index => $c ) {
	$content_start = strpos($c, "<body>");
	$content_end = strpos($c, "</body>");
			
			
	$content = trim(substr($c, $content_start + 6, $content_end - ($content_start + 6)));
			
	$content = str_replace("\\r\\n", "", $content);
	
	$contents[$index] = $content;
}

$option['content'] = $contents;

$data = $sy['file']->scalar($option);

if ( $sy['db']->update(POPUP_CONFIG_TABLE, array('value'=>$data), array('seq'=>$in['seq'])) ) {
	echo "
		<script>
			alert('수정되었습니다.');
			parent.location.reload();
		</script>
	";
}
?>