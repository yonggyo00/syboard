<?php
class calendar {

	public function update_schedule ( $in ) {
		global $sy;
		
		$mode = null;
		
		$stamp = date2stamp($in['date']);
		
		if ( $sy['db']->count(CALENDAR_TABLE, array('stamp'=>$stamp)) ) {
			$mode = 1; // 기존에 데이터가 존재하는 경우 수정한다.
		}
		
		foreach ( $in['schedule'] as $time => $schedule ) {
			$option = array(
							'stamp' => $stamp,
							'time'=>$time,
							'schedule'=>$schedule
			);
			if ( $mode ) {
				$sy['db']->update(CALENDAR_TABLE, array('schedule'=>$schedule), array('stamp'=>$stamp, 'time'=>$time));
			} else $sy['db']->insert(CALENDAR_TABLE, $option );
		}
	}
	
	public function load_schedule( $date, $time = null ) {
		global $sy;
		
		$stamp = date2stamp($date);
		
		if ( $time ) {
			$row = $sy['db']->row("SELECT schedule FROM ".CALENDAR_TABLE . " WHERE `stamp` = {$stamp} AND `time` = '{$time}'");
			
			return $row['schedule'];
		}
		else return $sy['db']->rows("SELECT * FROM ".CALENDAR_TABLE . " WHERE `stamp` = {$stamp}");
	}
}
?>