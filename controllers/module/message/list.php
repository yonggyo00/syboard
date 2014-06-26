<?php
$no_of_post = 18;
$total_post = $sy['ms']->total_of_my_message($in['mode']);

$page_no = $sy['post']->page_no( $in['page_no'], $no_of_post );

if ( $sy['mb']->is_login() ) {
	$messages = $sy['ms']->my_message( $page_no, $no_of_post, $in['mode'] );
?>
	<form method='post' target='hiframe' id='message-list-form'>
		<input type='hidden' name='module' value='message' />
		<input type='hidden' name='action' value='list_submit' />
		<input type='hidden' name='layout' value=1 />
		<input type='hidden' name='option' value='<?=$in['mode']?>' />
		<div id='hidden-input'></div>
<?php	
	if ( !$message_list_skin = $site_config['message_list_skin'] ) $message_list_skin = 'default';
	load_skin('message_list', $message_list_skin, array('messages'=>$messages, 'total_post'=>$total_post));
?>
	</form>	
<?php
}
else $sy['js']->alert(lang('message list error1'));
// 페이지 네이션
$option = array ( 
				'total_post'=> $total_post,
				'page_no'=>$page_no,
				'no_of_post'=>$no_of_post,
				'no_of_page'=>5
);
load_skin('paging', 'default', $option);
?>