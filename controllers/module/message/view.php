<?php
echo module_css(__FILE__);
echo module_javascript(__FILE__);

$message = $sy['ms']->view_message($in['seq']);


$sy['ms']->update_message_readed();


if ( !$message_view_skin = $site_config['message_view_skin'] ) $message_view_skin = 'default';
load_skin('message_view', $message_view_skin, array('message'=>$message));
?>