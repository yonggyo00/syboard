<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<?php
$first_pid = null;
$i = 0;
ob_start();
echo "<ul class='post-latest-multi-forum-rotator-tap'>";
	foreach ( $so['posts'] as $pid => $title ) {
		if ( $i == 0 ) {
			$first_pid = $pid;
			$selected = "class='selected'";
		}
		else $selected = null;
		echo "<li $selected tab_no=$i post_id='$pid'>$title</li>"; 
		$i++;
	}
echo "</ul>
	  <div style='clear:both;'></div>
";
$tab = ob_get_clean();
?>
<div class='post-latest-multi-forum-rotator'>
	<?=$tab?>
	<div class='post-latest-content'>
		<?php include_once 'content.php'; ?>
	</div>
</div>