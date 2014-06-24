<?=skin_css($so, __FILE__)?>
<?php
$post_ids = $sy['post']->post_ids();
?>
<div id='search-form-skin'>
	<span id='title'>검색조건</span>
	<form method='get' autocomplete='off'>
		<input type='hidden' name='module' value='post' />
		<input type='hidden' name='action' value='search' />
		<input type='hidden' name='search_subject' value='<?=$in['search_subject']?>' />
		<input type='hidden' name='search_content' value='<?=$in['search_content']?>' />
		
		<input type='radio' name='search_post_comment' value='post' <?if ( $in['search_post_comment'] == 'post' ) echo "checked";?> />게시판 검색
		<input type='radio' name='search_post_comment' value='comment' <?if ( $in['search_post_comment'] == 'comment' ) echo "checked";?> />댓글 검색
		
		<select name='post_id'>
			<option value=''>게시판 선택</option>
			<option value=''></option>
		<?php
		foreach ( $post_ids as $pid ) {
			echo "<option value='".$pid['post_id']."'>".$pid['subject']."</option>";
		}
		?>
		</select>
		&nbsp;&nbsp;아이디 입력 <input type='text' name='username' value='<?=$in['username']?>' placeholder='아이디입력' />
		<div>
			<input type='text' name='key' value='<?=$in['key']?>' placeholder='검색어 입력' />
			<input type='submit' value='검색' />
		</div>
	</form>
</div>