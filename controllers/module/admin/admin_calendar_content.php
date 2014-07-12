<?php
if ( !$skin_month = 	$in['skin_month'] ) $skin_month = date('m');

if ( !$skin_year = $in['skin_year'] ) $skin_year = date('Y');

if ( $month == 1 ) {
	$prev_month = 12;
	$next_month = $skin_month + 1;
	$prev_year = $skin_year - 1;
	$next_year = $skin_year;
}
else if ( $month == 12 ) {
	$pre_month = $skin_month - 1;
	$next_month = 1;
	$prev_year = $skin_year;
	$next_year = $skin_year + 1;
}
else {
	$prev_month = $skin_month - 1;
	$next_month = $skin_month + 1;
	$prev_year = $next_year = $skin_year;
}


$last_date_stamp = date2stamp($skin_year."-".($skin_month+1)."-1") - (60 * 60 * 24 );

$start_stamp = date2stamp(date("{$skin_year}-{$skin_month}-1"));
$start_day = date('w', $start_stamp); 
$last_date = date('d', $last_date_stamp);


$week = date('w', $last_day);
				
for( $i=0; $i < 42; $i++ ) {
	$date = $i - $start_day + 1;
					
	$today = null;
	if ( date('Y') == $skin_year && date('m') == $skin_month && date('d') == $date ) $today = 'today';
					
	$bottom_line = null;
	if ( $i > 34 ) $bottom_line = "bottom-line";
					
	if ( $i % 7  == 0 ) {
		$add_class = 'red';
		echo "<div>";
	}
	else if ( $i % 7 == 6 ) $add_class = 'blue';
	else $add_class = null;
					
	if ( $start_day > $i ) echo "<div class='cel'></div>";
	else {
			if ( $date > $last_date ) echo "<div class='cel $bottom_line'></div>";
			else {
				echo "<div class='cel cel_view_schedule $bottom_line $today $add_class' popup_url='?module=calendar&action=edit_schedule&layout=1&date=".$skin_year."-".$skin_month."-".$date."'>$date</div>";
			}
		}
	if ( $i % 7 == 6 ) {
		echo "
					<div style='clear:left;'></div>
				</div>
				";
	}
}
?>