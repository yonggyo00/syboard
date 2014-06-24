<?=skin_css($so, __FILE__ )?>
<?=skin_javascript($so, __FILE__)?>
<?php
	// 만약 손님글인 경우
	if ( $p['guest_secret'] ) $mode = 1;
	else $mode = 0; // 일반 글
?>
<div id='view-menu'>
	<? if ( empty($post_cfg['use_login_post']) || ( $sy['mb']->is_login() && $post_cfg['use_login_post']) || admin() || $sy['post']->admin() ) {?>
		<a href='<?=$sy['post']->write_url($in['post_id'])?>'>글쓰기</a>
	<?}?>
	
	<?if ( admin() || $sy['post']->admin() || $sy['post']->my_post($p['seq_member']) || $p['guest_secret'] || site_admin() ) {?>
		<a href='<?=$sy['post']->update_url($in['seq'], $mode)?>'>수정</a>
		<a href='<?=$sy['post']->delete_url($in['seq'], $p['post_id'], $mode)?>' onClick="return confirm('정말로 삭제하시겠습니까?')">삭제</a>
	<?}?>
	<?php
		if ( admin() || $sy['post']->admin() || $sy['post']->my_post($p['seq_member']) || site_admin() ) {
			echo "<a href='?module=post&action=move_single_post&seq=".$p['seq']."'>이동</a>";
		}
	?>
	<?php
		if ( $sy['mb']->is_login() ) {
			if ( !$sy['post']->is_scrapped($in['seq']) ) {
				echo "<a id='scrap' href='?module=post&action=scrap&seq=".$p['seq']."' target='hiframe'>스크랩</a>";
			}
		}
	?>
	<?php
		if ( admin() || $sy['post']->admin() || site_admin() ) {
			echo "<a id='scrap' href='?module=member&action=block&seq=".$p['seq']."&layout=1' target='hiframe'>차단</a>";
		}
	?>
	<a href='<?=$sy['post']->list_url($in['post_id'])?>'>목록</a>
</div>