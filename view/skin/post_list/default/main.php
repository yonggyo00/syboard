<?php
/* 
 * 게시판 데이터
 * 만약 추가로 불러와야 할 필드가 있다면 $add_fields 를 사용하고, 조건절을 추가할려면 $add_where
 *  예)
 *  $add_fields = "content, content_stripped";
 *  $add_where = "seq_member=1 AND no_of_view = 0";
 */
echo skin_css($so, __FILE__);
echo skin_javascript($so, __FILE__);

$post_level = $sy['post']->post_level();


include_once MODEL_PATH . '/posts.php';

?>
<div id='post-info-top'>
	<span id='no_of_post'>등록된 글 총 <b><?=number_format($so['total_post'])?></b>개</span>
	<span id='post-level'>
		글목록 LV<b><?=$post_level['list_level']?></b>
		글보기 LV<b><?=$post_level['view_level']?></b>
		글쓰기 LV<b><?=$post_level['write_level']?></b>
		댓글 LV<b><?=$post_level['comment_write_level']?></b>
	</span>
	<div style='clear:both;'></div>
</div>
<?php
if ( $posts ) {

	// 추천 이미지
	$good_img = "<img src='".$so['path']."/img/good.png' />";
	$bad_img = "<img src='".$so['path']."/img/bad.png' />";
	
	echo "<div id='post-list-skin'>";
		foreach ( $posts as $p ) {
			$subject = stripslashes(stringcut($p['subject'] ));
			
			// 비밀글, 게스트 사용자글, 또는 일반 글에 따라 $url 변수에 경로를 할당하고, 비밀글의 경우 $secret에 비밀글이라고 표시해 준다.
			$url = $sy['post']->view_url($p['seq']);
			$secret = null;
			
			if ( $p['secret'] ) {
				 $secret = "<span class='secret'>[비밀글]</span>";
				 
				if ( !$sy['post']->my_post($p['seq_member']) && !admin() && !$sy['post']->admin() ) $url = $sy['post']->view_secret_check_url($p['seq']);
			}
			
			$nickname = stringcut($p['nickname'], 15);
			$username = stringcut($p['username'], 15);
			
			$date = date('Y-m-d H:i', $p['stamp']);
			
			// 조회수
			if ( $p['no_of_view'] ) $no_of_view = number_format($p['no_of_view']);
			else $no_of_view = null;
			
			// 코멘트 수
			if ( $p['no_of_comment'] ) $no_of_comment = "(".number_format($p['no_of_comment']).")";
			else $no_of_comment = null;
			
			// 추천
			if ( $p['good'] ) $good = "(".$good_img." ".number_format($p['good']).")";
			else $good = null;
			
			// 반대
			if ( $p['bad'] ) $bad = "(".$bad_img." ".number_format($p['bad']).")";
			else $bad = null;
			
			// 이미지가 있는 경우
			if ( $p['first_image'] ) $image = "<img src='".$so['path']."/img/image.gif' />";
			else $image = null;
			
			// 비디오가 있는 경우
			if ( $p['first_video'] ) $video = "<img style='height: 12px;' src='".$so['path']."/img/video.png' />";
			else $video = null;
			
			// 파일이 있는 경우
			if ( $p['first_file'] ) $file = "<img style='height: 13px;' src='".$so['path']."/img/file.png' />";
			else $file = null;
			
			
			// 보기 페이지의 글과 동일 할 경우
			if ( $in['seq'] == $p['seq'] ) $selected = 'selected';
			else $selected = null;
			
			if ( $p['stamp'] >= time() - ( 60 * 60 * 24) ) $new_icon = "<img src='".$so['path']."/img/new.png' />";
			else $new_icon = null;
			
			
			if ( admin() || $sy['post']->admin() ) {
				$checked = "<input class='seq' type='checkbox' name='seq[]' value='".$p['seq']."' />";
			}
			else $checked = null;
			
			if ( $p['guest_secret'] ) $user_popup = null; // 손님 글인 경우 
			else { // 일반 글
				$user_popup = "
								<div class='user-popup'>
									<div>$nickname</div>
									<div>($username)</div>
									<div class='popup-sendmessage'><a href='".$sy['ms']->sendto($p['username'])."'>쪽지보내기</a></div>
									<div><a href='".$sy['post']->search_user_post_url($p['username'])."'>작성글보기</a></div>
								</div>
							";
			}
			
			echo "
				<div class='rows $selected'>
					<a href='$url'>$checked $secret $subject $no_of_comment $good $bad  $image $video $file $new_icon</a>
					<span class='date'>$date</span>
					<span class='no_of_view'>$no_of_view</span>
					<span class='nickname'>$nickname</span>
					$user_popup
					<div style='clear:right;'></div>
				</div>
			";
		}
	echo "</div>";
}
?>