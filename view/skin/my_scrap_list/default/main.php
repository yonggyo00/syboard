<?php
echo skin_css( $so, __FILE__ );

$total_post = $so['total_post'];
$my_scrap = $so['my_scrap'];
?>
<div id='my-scrap-list-skin'>
	<div id='no_of_scrap'>내 스크랩 총<b><?=number_format($total_post)?></b>개</div>
<?php
foreach ( $my_scrap as $row ) {
	$subject = stringcut($row['subject'], 70);
	
	$view_url = $sy['post']->view_url($row['seq']);
	
	echo "
		<div class='row'>
			<a class='subject' href='$view_url'>$subject</a>
			<a class='delete' href='?module=post&action=delete_my_scrap&seq_scrap=".$row['seq_scrap']."&layout=1' target='hiframe'>삭제</a>
			<div style='clear:both;'></div>
		</div>
	";
}
?>
</div>