<?=skin_css($so, __FILE__)?>
<?php
$post_ids = $sy['post']->post_ids();
?>
<div id='post-list-search-form-skin'>
	<div id='title-wrapper'>
		<span id='title'><?=lang('search form title')?></span>
	</div>	
	<form method='get' autocomplete='off'>
		<input type='hidden' name='module' value='post' />
		<input type='hidden' name='action' value='search' />
		<input type='hidden' name='search_subject' value='<?=$in['search_subject']?>' />
		<input type='hidden' name='search_content' value='<?=$in['search_content']?>' />
		
		<table cellpadding=0 cellspacing=0 width='100%' border=0>
			<tr>
				<td>
					<input type='radio' name='search_post_comment' value='post' /><?=lang('search form forum')?>
					<input type='radio' name='search_post_comment' value='comment' /><?=lang('search form comment')?>
				</td>
				<td>
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
				</td>
				<td>
					<?=lang('search form username')?> <input type='text' name='username' value='<?=$in['username']?>' placeholder='<?=lang('search form input username')?>' />
				</td>
				<td>		
					<div>
						<input type='text' name='key' value='<?=$in['key']?>' placeholder='<?=lang('search form input keyword')?>' />
						<input type='submit' value='<?=lang('search form input search')?>' />
					</div>
				</td>
			</tr>
		</table>
		
	</form>
</div>