<?php
di ( $_member );
if ( !$sy['mb']->is_login() ) return $sy['js']->alert("잘못된 접근 입니다.");
else {
		if ( $sy['db']->update(MEMBER_TABLE, array('ip_sec_level'=>$in['ip_sec_level']), array('seq'=>$_member['seq'])) ) {
			echo "
				<script>
					alert('변경되었습니다.');
					parent.parent.location.reload();
				</script>
			";
		}
}
?> 