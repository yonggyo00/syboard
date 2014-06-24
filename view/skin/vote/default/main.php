<?=skin_css($so, __FILE__)?>
<div id='vote-skin'>
	<a href='?module=post&action=vote_submit&layout=1&mode=good&seq_post=<?=$p['seq']?>' target='hiframe'>찬성<span id='vote-good'>(<?=number_format($p['good'])?>)</span></a>
	<a href='?module=post&action=vote_submit&layout=1&mode=bad&seq_post=<?=$p['seq']?>' target='hiframe'>반대<span id='vote-bad'>(<?=number_format($p['bad'])?>)</span></a>
</div>