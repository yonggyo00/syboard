<?php
if ( empty($in['seq_member']) ) return $sy['js']->back("잘못된 접근 입니다.");


echo module_css(__FILE__);
echo module_javascript(__FILE__);

$query = "SELECT seq, stamp, subject, deleted FROM " . POST_DATA_TABLE . " WHERE seq_member='".$in['seq_member']."'";

// 사용자 정보 
$info = $sy['mb']->info($in['seq_member']);

$no_of_post = 40;
$total_post = $sy['db']->count(POST_DATA_TABLE, array('seq_member'=>$in['seq_member']));

$page_no = $sy['post']->page_no($in['page_no']);

$posts = $sy['post']->posts ( $query, $page_no, $no_of_post );
?>
<form method='get' target='hiframe'>
	<input type='hidden' name='module' value='sub_admin' />
	<input type='hidden' name='action' value='view_post_submit' />
	<input type='hidden' name='layout' value=1 />
	
	<div id='view-posts'>
		<div id='user-info'>
			<div id='title'>글쓴이 정보</div>
			<div><span class='sub-title'>아이디</span><?=$info['username']?></div>
			<div><span class='sub-title'>이름</span><?=$info['name']?></div>
			<div><span class='sub-title'>닉네임</span><?=$info['nickname']?></div>
		</div>
	<?php
	foreach ( $posts as $p ) {
		$view_url = $sy['post']->view_url($p['seq']);
		$subject = stringcut($p['subject'], 90);
		if ( $p['deleted'] == 'Y' ) $deleted = "<b>(삭제된글)</b>";
		else $deleted = null;
		
		$checkbox = "<input type='checkbox' name='seq[]' value='".$p['seq']."' />";
		
		echo "
			<div class='row'>
				<a href='$view_url' target='_blank'>$checkbox $deleted $subject</a>
			</div>
		";
	}
	?>
	</div>
	<div>
		<span id='select-all'>전체선택</span>
		<input type='submit' value='삭제' onclick="return confirm('정말 삭제하시겠습니까?')" />
	</div>
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