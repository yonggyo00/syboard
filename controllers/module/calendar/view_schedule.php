<?php
$_schedule = $cal->load_schedule($in['date']);
load_skin('view_calendar', 'default', array('date'=>$in['date'], 'schedule'=>$_schedule));
?>