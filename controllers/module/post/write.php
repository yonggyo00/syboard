<?php
if ( $block_no = $sy['mb']->check_block() ) return $sy['js']->back('글쓰기가 차단 되었습니다. 차단 번호 '.$block_no);

if ( $in['post_id'] ) {
	// 레벨 확인
	$point = $sy['mb']->my_point();
	if ( $sy['mb']->level($point) < $post_cfg['write_level'] ) return $sy['js']->back("레벨이 부족하여 글을 쓸 수 없습니다.");

	if ( $post_cfg['use_login_post'] && !$sy['mb']->is_login() ) return $sy['js']->location("로그인을 해 주세요", "?"); 
	
	if ( ($post_cfg['use_editor'] && $in['action'] == 'write') || ($in['action'] == 'update' && $p['editor_used'] )  ) include_once 'editor_js.php';

	if ( !$write_form_skin = $post_cfg['write_form_skin'] ) $write_form_skin =  'default';
	echo module_css(__FILE__);
	echo module_javascript(__FILE__);

	/*
	 * 게시판 글쓰기가 로드 되고 글쓰기 모드인 경우 gid를 생성하고
	 * 수정 모드 인 경우는 게시글에서 gid를 가져온다.
	 */
	$gid = null;
	$button_msg = "글쓰기";
	if ( $in['action'] == 'write' ) $gid = gid();
	else if ( $in['action'] == 'update' ) {
		$gid = $p['gid'];
		$button_msg = "글수정";
	}
	?>
	<div id="write-module">
	<?php
		if ( !$write_subject_skin = $post_cfg['write_subject_skin'] ) $write_subject_skin = 'default';
		load_skin('write_subject', $write_subject_skin);
	?>
		<form method='post' id='write-form' target='hiframe' autocomplete='off'>
			<input type='hidden' name='module' value='post' />
			<input type='hidden' name='action' value='write_submit' />
			<input type='hidden' name='layout' value=1 />
			<input type='hidden' name='post_id' value='<?=$in['post_id']?>' />
			<input type='hidden' name='first_image' value='<?=$p['first_image']?>'/>
			<input type='hidden' name='first_video' value='<?=$p['first_video']?>'/>
			<input type='hidden' name='first_file' value='<?=$p['first_file']?>'/>
			<input type='hidden' name='editor_used' value='<?=$p['editor_used']?>' />
			
		<?php
			for ( $i=1; $i <=3; $i++ ) {?>
			<input type='hidden' name='blog_no_<?=$i?>' value='<?=$p['blog_no_'.$i]?>' />
		<? }?>
			
			<input type='hidden' name='gid' value='<?=$gid?>' />
			
			<? if ( $in['action'] == 'update' ) {?>
				<input type='hidden' name='mode' value='update' />
			<?}?>
			
			<?php load_skin('write_form', $write_form_skin);?>
			
			<?php
				if ( $post_cfg['map_use'] ) { // 지도 사용 선택 되었다면,
					echo "<div id='write-module-map'>";
					if( !$map_skin = $post_cfg['map_skin'] ) $map_skin = 'default';
					load_skin('map', $map_skin, array('title'=>'지도'));
					echo "</div>";
				}
			?>
			<div id='submit-button-group'>
				<input type='submit' value='<?=$button_msg?>' />
				<input type='reset' value='취소' />
			</div>
		</form>
<?php 
	if ( ($post_cfg['use_editor'] && $in['action'] == 'write') || ($in['action'] == 'update' && $p['editor_used'] ) ) {?>
		<div id="file-uploader-wrapper">	
			<div id='file-upload-button-group'>
				<span class='file-upload-button selected' filename='image_uploader_submit'>이미지</span>
				<span class='file-upload-button' filename='video_uploader_submit'>비디오</span>
				<span class='file-upload-button' filename='file_uploader_submit'>파일</span>
			</div>
			<? include_once 'file_uploader.php';?>
		</div>
	<?}?>
	</div>
<? }
	else $sy['js']->back("잘못된 접근 입니다.");
?>