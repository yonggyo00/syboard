<?php
	if ($p['latitude'] ) $latitude = $p['latitude'];
	else $latitude = 14.593999;
	if ($p['longitude'] ) $longitude = $p['longitude']; 
	else $longitude = 120.994260;
?>
<?=skin_css($so, __FILE__)?>
<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
<? if ( $in['action'] == 'view' ) {
	$ddcz = "true";
	$def_draggable = "false";
	$def_scrollwheel = "false";
	$def_pancontrol = "false";
}
else {
	$ddcz = "false";
	$def_draggable = "true";
	$def_scrollwheel = "true";
	$def_pancontrol = "true";
}
?>

<script>
var def_zoomval = 13;
var def_latval = <?=$latitude?>;
var def_longval = <?=$longitude?>;
var ddcz = <?=$ddcz?>;
var def_draggable = <?=$def_draggable?>;
var def_scrollwheel = <?=$def_scrollwheel?>;
var def_panControl = <?=$def_pancontrol?>;


$(document).ready(function() {
	gmap_init();
});
</script>
<?=skin_javascript($so,__FILE__)?>

<div class='default_map'>
	<div class='title'><?=$so['title']?></div>
	<input size=10 type='hidden' value="<?=$latitude?>" name='latitude' id="latval" />
	<input size=10 type='hidden' value="<?=$longitude?>" name='longitude' id="longval" />							
	<div id="map" style="width:100%; height: 300px"></div>
</div>