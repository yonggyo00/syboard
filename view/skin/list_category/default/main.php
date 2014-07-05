<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<div id='list-category-wrapper'>
<ul id='list-category'>
	<li>
		<a href='<?=$sy['post']->list_url($in['post_id'])?>'><?=lang('Post_list_category whole')?></a>
	</li>
<?php
	foreach ( $_category as $key => $value ) {
		$category_url = $sy['post']->list_url($in['post_id'], $key);
		
		$selected = null;
		if ( $key == $in['category'] ) $selected = "class='selected'";
		
		echo "<li><a href='$category_url' {$selected}>$key</a></li>";
	}
?>
</ul>
<div style='clear:left;'></div>
</div>