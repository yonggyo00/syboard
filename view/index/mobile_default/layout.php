
<? if ( empty($in['layout']) ) {?>
<?=css('css', 'layout')?>
<?=javascript('js', 'layout')?>
<div id="main-layout">
<?php
	include_once 'top.php';
 }	
	if ( first_page() ) include_once 'first_page.php';
	else echo $_contents;

if ( empty($in['layout']) ) {
	include_once 'footer.php';
}?>
</div>
