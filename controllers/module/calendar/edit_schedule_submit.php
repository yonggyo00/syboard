<?php
if ( empty($in['date']) ) return $sy['js']->alert("날짜값이 넘어오지 않았습니다.");


$value_exists = 0;
foreach ( $in['schedule'] as $key => $value ) {
	if ( $in['schedule'][$key] ) {
		$value_exists = 1;
		break;
	}
}

if ( empty($value_exists) ) return $sy['js']->alert("스케줄을 입력해 주세요.");

$cal->update_schedule($in);
?>
<script>
alert("스케줄이 등록/수정 되었습니다");
parent.location.reload();
</script>