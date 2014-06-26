<?=css('css', 'logo_search')?>
<div id='logo-search'>
	<table cellpadding=0 cellspacing=0 border=0 width='100%'>
		<tr valign='top'>
			<td width=220>
				<div id='site-logo'>
					<a href='<?=site_url()?>'>SYBOARD</a>
				</div>
			</td>
			<td align='right'>
				<form method='get' autocomplete='off'>
					<input type='hidden' name='module' value='post' />
					<input type='hidden' name='action' value='search' />
					<input type='hidden' name='search_subject' value=1 />
					<input type='hidden' name='search_content' value=1 />
					<input type='text' placeholder='<?=lang('search word')?>' name='key' value='<?=$in['key']?>' />
					<input type='submit' value='<?=lang('search submit')?>' />
				</form>
			</td>
		</tr>
	</table>
</div>
