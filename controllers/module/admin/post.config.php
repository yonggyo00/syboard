<div class='admin-title'>게시판 관리</div>
<?php
if ( $in['mode'] == 'edit' || $in['mode'] == 'delete' || $in['mode'] == 'manage') {
	$filename = CACHE_PATH . '/post_cfg_'.$in['post_id'].'.cache';

	if ( file_exists($filename) ) {
		$sy['debug']->log("CACHE - $filename (Deleting Post Config(".$in['post_id'].") Cache)");
		@unlink($filename);
	}
	
	// 게시판 수정
	if ( $in['edit_done'] ) {
		$msg = null;
		if ( $adm->post_cfg_update($in) ) {
			$msg = "수정되었습니다.";
		}
		else $msg = "수정에 실패 하였습니다.";
		
		$sy['js']->alert($msg);
	}
	
	$post_cfg = $adm->post_cfg($in['post_id']);
	
	if ( $in['mode'] == 'delete' ) {?>
		<form method='post'>
			<input type="hidden" name="module" value="admin" />
			<input type="hidden" name="action" value="index" />
			<input type="hidden" name="option" value="post_config" />
			<input type="hidden" name="layout" value=1 />
			<input type='hidden' name='post_id' value='<?=$post_cfg['post_id']?>' />
			<input type='hidden' name='mode' value='delete_submit' />
			<div class='admin-sub-title'>게시판 삭제</div>
			<div class='admin-row'><span class='sub-title'>번호</span> <?=$post_cfg['seq']?></div>
			<div class='admin-row'><span class='sub-title'>아이디</span> <?=$post_cfg['post_id']?></div>
			<div class='admin-row'><span class='sub-title'>제목</span> <?=$post_cfg['subject']?></div>
			<div class='admin-row'><span class='sub-title'>글 갯수</span> <?=number_format($post_cfg['no_of_post'])?></div>
			<div>정말 삭제하시겠습니까? <input type='submit' value="삭제하기" /></div>
		</form>
	<?
	}
	else if ( $in['mode'] == 'edit' ) {
		include_once 'post.config.edit.php';
	}
	else if ( $in['mode'] == 'manage' ) {
		include_once 'post.config.manage.php';
	}
}
else {
	// 삭제인 경우 
	if ( $in['mode'] == 'delete_submit' ) {
		if ( file_exists($filename) ) {
			$sy['debug']->log("CACHE - $filename (Deleting Post Config(".$in['post_id'].") Cache)");
			@unlink($filename);
		}
		
		if ($adm->delete_post_id( $in['post_id'] ) ) {
			$sy['js']->alert($in['post_id']."가 삭제되었습니다.");
		}
	}
	
	if ( $in['create_post_id'] ) {
		if ( $in['post_id'] && $in['subject'] ) {
			if ( $adm->create_post_id( $in['post_id'], $in['subject']) ) {
				$sy['js']->alert($in['subject']."(".$in['post_id'].")이 생성되었습니다.");
			}
		}
		else {
			$sy['js']->alert("게시판 아이디와 제목을 입력해 주세요.");
		}
	}
	?>
	<div class='admin-sub-title'>게시판 추가</div>
	<form class='margin-bottom' method='post' autocomplete='off'>
		<input type="hidden" name="module" value="admin" />
		<input type="hidden" name="action" value="index" />
		<input type="hidden" name="option" value="post_config" />
		<input type="hidden" name="layout" value=1 />
		<input type="hidden" name="create_post_id" value=1 />
		<div class='admin-row'><span class='sub-title'>게시판 아이디</span> <input type="text" name="post_id" /></div>
		<div class='admin-row'><span class='sub-title'>게시판 제목</span> <input type="text" name="subject" /></div>
		<input type="submit" value="게시판 생성" />
	</form>

	<div class='admin-sub-title'>게시판 목록</div>
		<table cellpadding=0 cellspacing=0 width='100%'>
			<tr id='tr-header'>
				<td>번호</td>
				<td>아이디</td>
				<td>제목</td>
				<td>글 갯수</td>
				<td colspan=3>관리</td>
			</tr>	
	<?php
		$list = $adm->list_post_id();
		foreach ( $list as $li ) {

		ob_start();
		?>
			<form method="get">
				<input type="hidden" name="module" value="admin" />
				<input type="hidden" name="action" value="index" />
				<input type="hidden" name="option" value="post_config" />
				<input type="hidden" name="layout" value=1 />
				<input type='hidden' name='mode' value='edit' />
				<input type='hidden' name='post_id' value='<?=$li['post_id']?>' />
				<input type="submit" value="수정" />
			</form>
		<?php
		$edit = ob_get_clean();
		
		ob_start();
		?>
			<form method="post">
				<input type="hidden" name="module" value="admin" />
				<input type="hidden" name="action" value="index" />
				<input type="hidden" name="option" value="post_config" />
				<input type="hidden" name="layout" value=1 />
				<input type='hidden' name='mode' value='delete' />
				<input type='hidden' name='post_id' value='<?=$li['post_id']?>' />
				<input type="submit" value="삭제" />
			</form>
		<?php
		$delete = ob_get_clean();
		
		
		// 게시글 관리
		ob_start();
		?>
			<form method="get">
				<input type="hidden" name="module" value="admin" />
				<input type="hidden" name="action" value="index" />
				<input type="hidden" name="option" value="post_config" />
				<input type="hidden" name="layout" value=1 />
				<input type='hidden' name='mode' value='manage' />
				<input type='hidden' name='post_id' value='<?=$li['post_id']?>' />
				<input type="submit" value="글 관리" />
			</form>
		<?php
		$manage = ob_get_clean();
		
			echo "
				<tr>
					<td>$li[seq]</td>
					<td>$li[post_id]</td>
					<td>$li[subject]</td>
					<td>$li[no_of_post]</td>
					<td width=55>$delete</td>
					<td width=55>$edit</td>
					<td width=70>$manage</td>
				</tr>
				";
		}
	?>
		</table>
	<div class='admin-sub-title'>댓글 관리</div>
		<form method='post' target='hiframe'>
			<input type='hidden' name='module' value='admin' />
			<input type='hidden' name='action' value='post.config.manage_submit' />
			<input type='hidden' name='layout' value=1 />
			<input type='hidden' name='mode' value='delete_comment_all' />
			<input type='submit' value='모든 삭제표시 댓글 삭제하기' onclick="return confirm('정말로 삭제하시겠습니까?')" />
		</form>
<? }?>