<?=module_css(__FILE__)?>
<?=module_javascript(__FILE__)?>
<?php
if ( !admin() ) {
	if ( !site_admin() ) return $sy['js']->location("관리자가 아닙니다.", "?" );
}
if ( empty($in['layout']) ) include_once 'menu.php';
?>