<?php
echo skin_css( $so, __FILE__ );
echo skin_javascript( $so, __FILE__ );
?>

<div id='view-content'>
<?php
	include_once CONTROLLER_PATH . '/view.sns.php';
	echo $sy['post']->content($p['content'], $p['editor_used']);
?>
</div>