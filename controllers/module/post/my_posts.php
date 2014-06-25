<?php
if ( !$sy['mb']->is_login() ) return $sy['js']->location(lang('My_post error1'), site_url());

$page_no = $sy['post']->page_no($in['page_no']);
$no_of_post = 20;
$total_post = $sy['post']->no_of_post_by_user($_member['seq']);

$posts = $sy['post']->my_posts($page_no, $no_of_post);
?>

<form method='post' target='hiframe'>  
	<input type='hidden' name='module' value='post' />
	<input type='hidden' name='action' value='my_posts_submit' />
	<input type='hidden' name='layout' value=1 />
	<input type='hidden' name='seq_member' value='<?=$_member['seq']?>' />
	<?php
	if ( !$my_posts_skin = $site_config['my_posts_skin'] ) $my_posts_skin = 'default';
	load_skin('my_posts', $my_posts_skin, array('posts'=>$posts, 'total_post'=>$total_post));
	?>
</form>
<?php
// 페이지 네이션
$option = array ( 
				'total_post'=> $total_post,
					'page_no'=>$page_no,
					'no_of_post'=>$no_of_post,
					'no_of_page'=>10
);
	
load_skin('paging', 'default', $option);
?>