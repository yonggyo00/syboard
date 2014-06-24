<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<?php
$posts = $so['posts'];
$total_post = $so['total_post'];
?>
<div id='my-posts-skin'>
	<div id='no_of_post'>나의 글 총 <b><?=number_format($total_post)?></b>개</div>
<?php
foreach ( $posts as $p ) {
	$view_url = $sy['post']->view_url($p['seq']);
	
	$subject = stringcut($p['subject'], 120);
	
	$checkbox = "<input type='checkbox' name='seq[]' value='".$p['seq']."' />";
?>
	<div class='row'>
		<a class='subject' href='<?=$view_url?>'><?=$checkbox.$subject?></a>
	</div>
<?}?>
	<div id='button-group'>
		<span id='select-all'>전체 선택</span>
		<input type='submit' value='삭제하기' onclick="confirm('정말로 삭제하시겠습니까?')"/>
		<div style='clear:right;'></div>
	</div>
</div>