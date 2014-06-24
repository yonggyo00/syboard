<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<div id='list-category-wrapper'>
<ul id='list-category'>
	<li>
		<a href='<?=$sy['post']->list_url($in['post_id'])?>'>전체</a>
	</li>
<?php
	foreach ( $_category as $key => $value ) {
		$category_url = $sy['post']->list_url($in['post_id'], $key);
		echo "<li><a href='$category_url'>$key</a></li>";
	}
?>
</ul>
<div style='clear:left;'></div>
</div>