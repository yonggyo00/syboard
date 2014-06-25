<?php
echo skin_css($so, __FILE__);
echo skin_javascript($so, __FILE__);

if ( $_comments ) {?>
	<div id="comment-list">
<?php
	foreach ( $_comments as $comment ) {
		if ( $post_cfg['show_ip_comment'] ) {
			$ip = long_2_ip($comment['ip']);
			$ip_tmp = explode(".", $ip);
			$ip_tmp[2] = "***";
			$ip = " &nbsp;<b>IP</b> " . implode(".", $ip_tmp);
		}	
		// 댓글의 댓글인 경우 
		if ( $comment['seq_parent'] ) $add_class = "comment-reply";
		else $add_class = null;
		
		// 프로필 이미지
		if ( $image_url = $sy['mb']->profile_photo($comment['seq_member'], 40, 40) ) {
			$profile_photo = "<div class='profile-photo'><img src='".$image_url."' /></div>";
		}
		else $profile_photo = null;
		
		// 서명
		$user_info = $sy['mb']->info($comment['seq_member'], "signature");
		$signature = stringcut($user_info['signature']);
		
		if ( $comment['secret'] ) $user_popup = null;
		else {
			// 팝업
			$user_popup = "
								<div class='user-popup'>
									<div><a href='".$sy['ms']->sendto($comment['username'])."'>".lang('Comment_list send message')."</a></div>
									<div><a href='".$sy['post']->search_user_post_url($comment['username'])."'>".lang('Comment_list send view posts')."</a></div>
								</div>
							";
		}
	?>
		<a class='row_anchor' name='comment_<?=$comment['seq']?>'></a>
			<div class='row <?=$add_class?>' seq='<?=$comment['seq']?>' seq_root='<?=$comment['seq_root']?>' list_order='<?=$comment['list_order']?>' nickname='<?=$comment['nickname']?>' post_id='<?=$in['post_id']?>'>
				<div class='comment-pannel'>
					<?php
						if ( $post_cfg['use_comment_vote'] ) {
							if ( !$vote_comment_skin = $post_cfg['vote_comment_skin'] ) $vote_comment_skin = 'default';
							load_skin('vote_comment', $vote_comment_skin, array('seq_comment'=>$comment['seq']));
						}
				
						if ( ($sy['mb']->is_login() && $sy['post']->is_my_comment ($comment['seq_member'])) || admin() || $sy['post']->admin() || site_admin()) {?>
							<span class='comment-edit-button'><?=lang('Comment_list edit')?></span>
							<a href='?module=post&action=comment_delete&layout=1&post_id=<?=$in['post_id']?>&seq=<?=$comment['seq']?>&seq_root=<?=$comment['seq_root']?>' target='hiframe' class='comment-delete-button' onclick='return confirm("<?=lang('Comment_list delete_msg')?>")'><?=lang('Comment_list delete')?></a>	
					<?}?>
					
					<?php
					if ( admin() || $sy['post']->admin() || site_admin()) {
						echo "<a id='scrap' href='?module=member&action=block&seq=".$comment['seq']."&layout=1&mode=comment' target='hiframe'>".lang('Comment_list block')."</a>";
					}
					?>
					<? if ( (empty($post_cfg['use_login_post']) && !$sy['mb']->is_login() ) || $sy['mb']->is_login() ) {?>
						<span class='comment-cancel-button'><?=lang('Comment_list cancel')?></span>
						<span class='comment-write-button'><?=lang('Comment_list write')?></span>
					<?}?>
				</div>
				<div class='comment-user-info'>
					<?=$profile_photo?>
					<div class='user-info'>
						<div>
						<span class='username'><b><?=lang('Comment_list Poster')?></b> <span><?=$comment['nickname']?>(<?=$comment['username']?>)</span></span><?=$ip?>
						<?=$user_popup?>
						<span class='date'><b><?=lang('Comment_list date')?></b> <?=date('Y-m-d H:i', $comment['stamp'])?></span>
						</div>
						<div class='signature'><?=$signature?></div>
					</div>
					<div style='clear:left'></div>
				</div>
				<div class='comment-content'><?=stripslashes($comment['content'])?></div>
				<div style='clear:left;'></div>
				<div class='comment-write-form' id="comment-write-form-<?=$comment['seq']?>"></div>
			</div>
	<?}?>
</div>
<?}?>