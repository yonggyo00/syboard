<style>
	#popup-default-skin<?=$so['popup_no']?> {
		position: absolute;
		z-index: 10000000;
		border: 1px solid #666666;
		top: <?=$so['ypos']?>px;
		left: <?=$so['xpos']?>px;
		width: <?=$so['width']?>px;
		height: <?=$so['height']?>px;
		background-color: #ffffff;
		overflow: hidden;
	}
	
	#popup-default-skin<?=$so['popup_no']?> > #popup-bottom-panel<?=$so['popup_no']?> {
		background-color: #3f3f3f;
		height: 22px;
		font-size: 8.5pt;
		line-height: 22px;
		position: absolute;
		bottom: 0;
		left: 0;
		width: 94%; 
		color: #ffffff;
		padding: 0 4% 0 2%;
	}
	
	#popup-default-skin<?=$so['popup_no']?> > #popup-bottom-panel<?=$so['popup_no']?> input[type='checkbox'] {
		position: relative;
		top: 3px;
	}
	
	#popup-default-skin<?=$so['popup_no']?> > #popup-bottom-panel<?=$so['popup_no']?> #popup-close<?=$so['popup_no']?> {
		cursor: pointer;
	}
	
</style>
<script>
$(document).ready(function() {
	$("#popup-default-skin<?=$so['popup_no']?> #popup-bottom-panel<?=$so['popup_no']?> #popup-close<?=$so['popup_no']?>").click(function() {
		$("#popup-default-skin<?=$so['popup_no']?>").remove();
	});
	
	$("#popup-default-skin<?=$so['popup_no']?> #popup-bottom-panel<?=$so['popup_no']?> input[type='checkbox']").change(function() {
		if ( $(this).prop("checked") == true ) {
			createCookie('popup_<?=$so['popup_no']?>', 1, 1);
		} else {
			eraseCookie('popup_<?=$so['popup_no']?>');
		}
	});
	
});
</script>
<?php
	if ( empty($_COOKIE['popup_'.$so['popup_no']]) ) { 
?>
	<div id='popup-default-skin<?=$so['popup_no']?>'>
		<?=stripslashes($so['content'])?>
		<div id='popup-bottom-panel<?=$so['popup_no']?>'>
			<span style='float: left;'>
				<input type='checkbox' name='popup_not_showing<?=$so['popup_no']?>' value=1 />오늘하루 보이지 않기
			</span>
			<span style='float:right;' id='popup-close<?=$so['popup_no']?>'>[닫기]</span>
			<div style='clear:both;'></div>
		</div>
	</div>
<? }?>