<?=css('css', 'logo_search')?>
<div id='site-top-logo-search'>
	<div id='site-logo'>
		<a href='?'>SYBOARD</a>
	</div>
	<div id='site-top-search-bar'>
		<form method='get' autocomplete='off'>
			<input type='hidden' name='module' value='post' />
			<input type='hidden' name='action' value='search' />
			<input type='hidden' name='search_subject' value=1 />
			<input type='hidden' name='search_content' value=1 />
			<input type='hidden' name='search_op' value='OR' />
			
			<input type='text' placeholder='<?=lang('search word')?>' name='key' value='<?=$in['key']?>' />
			<input type='submit' value='<?=lang('search submit')?>' />
		</form>
	</div>
	<div style='clear:both;'></div>
</div>
