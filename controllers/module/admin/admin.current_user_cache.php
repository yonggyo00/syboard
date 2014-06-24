<?=module_javascript(__FILE__)?>
<?php
 $dirs = $sy['file']->readdir(USERS_PATH);
?>
<div id='admin-current-user-cache'>
	<div class='admin-title'>접속자 캐쉬관리</div>
	
	<form method='post' target='hiframe'>
		<input type='hidden' name='module' value='admin' />
		<input type='hidden' name='action' value='admin.current_user_cache_submit' />
		<input type='hidden' name='layout' value=1 />
<?php
	foreach ( $dirs as $file ) {
		$checkbox = "<input type='checkbox' name='file[]' value='".$file."' />";
		echo "<div class='row'>".$checkbox.$file."</div>";
	}
?>	
		<span id='select-all'>전체선택</span>
		<input type='submit' value='삭제' onclick="return confirm('사용자 캐쉬를 삭제하게되면 사이트 속도 저하가 일시적으로 발생할 수 있습니다. 정말 삭제하시겠습니까?')"/>
	</form>
</div>