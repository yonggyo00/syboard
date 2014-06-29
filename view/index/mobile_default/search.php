<?=css('css', 'search')?>
<div id='site-top-search-form'>
	<form method='get' autocomplete='off'>
		<input type='hidden' name='module' value='post' />
		<input type='hidden' name='action' value='search' />
		<input type='hidden' name='search_subject' value=1 />
		<input type='hidden' name='search_content' value=1 />
		<input type='text' placeholder='<?=lang('search word')?>' name='key' value='<?=$in['key']?>' />
		<input type='submit' value='<?=lang('search submit')?>' />
	</form>
</div>