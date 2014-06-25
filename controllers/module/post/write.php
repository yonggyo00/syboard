<?php
if ( $block_no = $sy['mb']->check_block() ) return $sy['js']->back(lang('Post Write error1').$block_no);

if ( $in['post_id'] ) {
	// 레벨 확인
	$point = $sy['mb']->my_point();
	if ( $sy['mb']->level($point) < $post_cfg['write_level'] ) return $sy['js']->back(lang('Post Write error2'));

	if ( $post_cfg['use_login_post'] && !$sy['mb']->is_login() ) return $sy['js']->location(lang('Post Write error3'), "?"); 
	
	if ( ($post_cfg['use_editor'] && $in['action'] == 'write') || ($in['action'] == 'update' && $p['editor_used'] )  ) include_once 'editor_js.php';

	echo module_css(__FILE__);
	echo module_javascript(__FILE__);

	/*
	 * 게시판 글쓰기가 로드 되고 글쓰기 모드인 경우 gid를 생성하고
	 * 수정 모드 인 경우는 게시글에서 gid를 가져온다.
	 */
	$gid = null;
	$button_msg = lang('Post Write write');
	if ( $in['action'] == 'write' ) $gid = gid();
	else if ( $in['action'] == 'update' ) {
		$gid = $p['gid'];
		$button_msg = lang('Post Write update');
	}
	?>
	<div id="write-module">
	<?php
		// 제목 상단 콜백
		if ( function_exists('before_write_post_subject') ) {
			before_write_post_subject();
		}
	
		if ( !$write_subject_skin = $post_cfg['write_subject_skin'] ) $write_subject_skin = 'default';
		load_skin('write_subject', $write_subject_skin);
		
		// 제목 하단 콜백
		if ( function_exists('after_write_post_subject') ) {
			after_write_post_subject();
		}
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
		
			<?php 
				// 쓰기 폼 상단 콜백
				if ( function_exists('before_write_form') ) {
					before_write_form();
				}
			
				if ( !$write_form_skin = $post_cfg['write_form_skin'] ) $write_form_skin =  'default';
				load_skin('write_form', $write_form_skin);
				
				// 쓰기 폼 하단 콜백
				if ( function_exists('after_write_form') ) {
					after_write_form();
				}
			?>
			
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
				<input type='reset' value='<?=lang('Post Write reset')?>' />
			</div>
		</form>
		<?php
			// form 하단 콜백   
			if ( function_exists('write_form_end') ) {
				write_form_end();
			}
		?>
<?php 
	if ( ($post_cfg['use_editor'] && $in['action'] == 'write') || ($in['action'] == 'update' && $p['editor_used'] ) ) {?>
		<div id="file-uploader-wrapper">	
			<div id='file-upload-button-group'>
				<span class='file-upload-button selected' filename='image_uploader_submit'><?=lang('Post Write image')?></span>
				<span class='file-upload-button' filename='video_uploader_submit'><?=lang('Post Write video')?></span>
				<span class='file-upload-button' filename='file_uploader_submit'><?=lang('Post Write file')?></span>
			</div>
			<? include_once 'file_uploader.php';?>
		</div>
	<?}?>
	</div>
<? }
	else $sy['js']->back(lang('Post Write error4'));
?>