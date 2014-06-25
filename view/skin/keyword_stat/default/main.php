<?=skin_css($so, __FILE__);?>
<?php
if ( !$title = $so['title'] ) $title = lang('Keyword stat title');
if ( !$no_of_keywords = $so['no_of_keywords'] ) $no_of_keywords = 7;
$keyword = $sy['post']->keyword_stat( $no_of_keywords );

$image_path = $so['path'].'/img';
$new = "<img src='".$image_path."/new.png' />";
$bar = "<img src='".$image_path."/bar.png' />";
$up = "<img src='".$image_path."/up.png' />";
$down = "<img src='".$image_path."/down.png' />";
?>
<div id='keyword-stat-default-skin'>
	<div id='title'><?=$so['title']?></div>
<?php
foreach ( $keyword as $rank=>$value ) {
	if ( array_key_exists('old_fluct', $value) && array_key_exists('new_fluct', $value) ) {
		if ( $rank < $value['old_rank'] ) $fluct = "<span class='up'>$up</span>";
		else if ( $rank > $value['old_rank'] ) $fluct = "<span class='down'>$down</span>";
		else if (  $value['old_rank'] > 7 && $rank <= 7 ) $fluct = "<span class='up'>$new</span>";
		else if ( $rank == $valu['old_rank'] ) $fluct = "<span class='no_change'>$bar</span>";
	}
	else {
		$fluct = "<span class='up'>$new</span>";
		$value['new_fluct'] = $value['count'];
	}
	
	$no = "<span class='rank'>".($rank + 1)."</span>";
	echo "
			<div class='row'>
				<span class='keyword'>$no <a href='?module=post&action=search&search_subject=1&search_content=1&key=".urlencode($value[keyword])."'>$value[keyword]</a></span>
				<span class='variation'>$value[new_fluct] $fluct</span>
				<div style='clear:right;'></div>
			</div>
		";
}
?>
</div>