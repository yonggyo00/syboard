
<? if ( empty($in['layout']) ) {?>
<?=css('css', 'layout')?>
<?=javascript('js', 'layout')?>
<div id="main-layout">
<?php
	include_once 'top.php';
	include_once 'logo_search.php';
	include_once 'menu.php';
	
	echo "<div id='main-left'>";
	
	include_once 'left.php';
	
	echo "
		</div>
		<div id='main-content'>";
 }	
	if ( first_page() ) include_once 'first_page.php';
	else echo $_contents;

if ( empty($in['layout']) ) {
	echo "
		</div>
		<div style='clear:left;'></div>
	";
	include_once 'footer.php';
echo "</div>";
}?>
