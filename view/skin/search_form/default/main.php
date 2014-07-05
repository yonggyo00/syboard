<?=skin_css($so, __FILE__)?>
<?php
$post_ids = $sy['post']->post_ids();
$search_op = array('AND', 'OR');
?>

<div id='search-form-skin-default'>
	<span id='title'><?=lang('search form title')?></span>
	<form method='get' autocomplete='off'>
		<input type='hidden' name='module' value='post' />
		<input type='hidden' name='action' value='search' />
		
		<input type='radio' name='search_post_comment' value='post' <?if ( $in['search_post_comment'] == 'post' ) echo "checked";?> /><?=lang('search form forum_search')?>
		<input type='radio' name='search_post_comment' value='comment' <?if ( $in['search_post_comment'] == 'comment' ) echo "checked";?> /><?=lang('search form comment_search')?>
		
		<input type='checkbox' name='search_subject' value=1 <?=$in['search_subject']?'checked':''?> /><?=lang('search form subject')?>
		<input type='checkbox' name='search_content' value=1 <?=$in['search_content']?'checked':''?>/><?=lang('search form content')?>
		
		<select name='post_id'>
			<option value=''><?=lang('search form select_forum')?></option>
			<option value=''></option>
		<?php
		foreach ( $post_ids as $pid ) {
			$selected = null;
			if ( $pid['post_id'] == $in['post_id'] ) $selected = 'selected';
			echo "<option value='".$pid['post_id']."' $selected>".$pid['subject']."</option>";
		}
		?>
		</select>
		&nbsp;&nbsp;<?=lang('search form input username')?> <input type='text' name='username' value='<?=$in['username']?>' placeholder='<?=lang('search form input username')?>' />
			
		<div>
			<select name='search_op'>
				<option value=''><?=lang('search form operator')?></option>
				<option value=''></option>
				<?php
					foreach ( $search_op as $sop ) {
						$selected = null;
						if ( $in['search_op'] == $sop ) $selected = 'selected';
						echo "<option value='$sop' {$selected}>$sop</option>";
					}
				?>
			</select>
			<span id='keyword-search'>
				<input type='text' name='key' value='<?=$in['key']?>' placeholder='<?=lang('search form input keyword')?>' />
				<input type='submit' value='<?=lang('search form input search')?>' />
			</span>
		</div>
	</form>
</div>