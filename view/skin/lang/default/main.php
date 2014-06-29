<?=skin_css($so, __FILE__)?>
<?php
	$flags = array(
					'ko_KR'=>"<img src='".$so['path']."/img/korea.png' />",
					'en_US'=>"<img src='".$so['path']."/img/us.png' />",			
					'tl_PH'=>"<img src='".$so['path']."/img/philippines.png' />"
				);
?>
<span id='lang-flag-skin'>
	<?php
		foreach ( $flags as $lang => $flag ) {
			echo "<a href='?lang=".$lang."'>".$flag."</a>";
		}
	?>
</span>
