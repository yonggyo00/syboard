<?php
if ( !$sy['mb']->is_login() ) return $sy['js']->location(lang('My_scrap error1'), site_url()); 

$no_of_post = 20;
$total_post = $sy['post']->total_my_scrap();

include_once MODEL_PATH . '/my_scrap.php';

if ( !$my_scrap_list_skin = $site_config['my_scrap_list_skin'] ) $my_scrap_list_skin = 'default';
load_skin('my_scrap_list', $my_scrap_list_skin, array('total_post'=>$total_post, 'my_scrap'=>$my_scrap));

// 페이지 네이션
$option = array ( 
				'total_post'=> $total_post,
				'page_no'=>$page_no,
				'no_of_post'=>$no_of_post,
				'no_of_page'=>5
);
	
load_skin('paging', 'default', $option);
?>