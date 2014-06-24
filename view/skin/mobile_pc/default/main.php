<?=skin_css($so, __FILE__)?>
<span id='mobile-pc-skin'>
	<?php
	if ( $so['device'] == 'mobile' ) {
		$icon = "<img src='".$so['path']."/img/pc.png' />";
		echo "<a href='".site_url(). "?device=pc'>$icon</a>";
	} 
	else {
		$icon = "<img src='".$so['path']."/img/mobile.png' />";
		echo "<a href='".site_url(). "?device=mobile'>$icon</a>";
	}
	?>
</span>