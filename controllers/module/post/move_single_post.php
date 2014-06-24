<?php
echo module_css(__FILE__);

if ( empty($in['seq']) ) return $sy['js']->back("잘못된 접근입니다.");

$p = $sy['post']->single_post($in['seq'], "seq, seq_member, subject");
if ( !admin() && !$sy['post']->admin() && !site_admin() ) {
	if ( !$sy['post']->my_post($p['seq_member'] ) ) return $sy['js']->back("본인 글이 아니면 게시글 이동을 하실 수 없습니다.");
}

if ( admin() ) $mode = 1;
else $mode = 0;

$post_ids = $sy['post']->post_ids($mode);

$info = $sy['mb']->info($p['seq_member']);

ob_start();	
echo "
	<select name='move_post_id'>
		<option value=''>게시판 선택</option>
		<option value=''></option>
";
foreach ( $post_ids as $pid ) {
	echo "<option value='".$pid['post_id']."'>".$pid['subject']."</option>";
}
echo "</select>";
$move_post_id_sel = ob_get_clean();
?>
<div id='move-single-post'>
	<div id='title'>게시글 이동</div>
	<div id='post-info'>
		<div><span class='sub-title'>작성자</span><?=$info['nickname']."(".$info['username'].")"?></div>
		<div><span class='sub-title'>글번호</span><?=number_format($p['seq'])?></div>
		<div><span class='sub-title'>제목</span><?=stringcut($p['subject'])?></div>
	</div>
	<form method='post'>
		<input type='hidden' name='module' value='post' />
		<input type='hidden' name='action' value='move_single_post_submit' />
		<input type='hidden' name='seq' value='<?=$in['seq']?>' />
		
		<a id='back-to-post' href='<?=$sy['post']->view_url($in['seq'])?>'>본 글로 되돌아가기</a>
		
		<div id='submit-button'>
			<?=$move_post_id_sel?>
			<input type='submit' value='이동' onclick="return confirm('정말 이동하시겠습니까?')" />
		</div>
		
		<div style='clear:right;'></div>
	</form>
</div>