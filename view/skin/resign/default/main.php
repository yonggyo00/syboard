<?=skin_css($so, __FILE__)?>
<?php
	$info = $sy['mb']->info($_member['seq'], '*');
?>
<div id='user-info'>
	<div id='title'>회원정보</div>
	<div><span class='sub-title'>가입일</span><?=date('Y-m-d', $info['reg_stamp'])?></div>
	<div><span class='sub-title'>아이디</span><?=$info['username']?></div>
	<div><span class='sub-title'>이름</span><?=$info['name']?></div>
	<div><span class='sub-title'>닉네임</span><?=$info['nickname']?></div>
	<div><span class='sub-title'>아이디</span><?=$info['username']?></div>
	<div><span class='sub-title'>포인트</span><?=number_format($info['point'])?></div>
	<div><span class='sub-title'>총 글수</span><?=number_format($sy['post']->no_of_post_by_user($info['seq']))?></div>
	<div><span class='sub-title'>총 댓글수</span><?=number_format($sy['post']->no_of_comment_by_user($info['seq']))?></div>
	<div id='notice'>탈퇴하시면 기존에 작성한 글을 삭제 하실 수 없습니다. 삭제를 해야 하는 글이 있다면 <a href='?module=post&action=my_posts'/>나의글</a>, <a href='?module=post&action=my_comments'/>나의 댓글</a>을 클릭하여 삭제해 주세요.</div>
	
	<input type='submit' value='탈퇴하기' onclick="return confirm('탈퇴한 아이디로는 재가입 하실 수 없습니다. 정말로 탈퇴하시겠습니까?')" />
	
	<div style='clear: right;'></div>
</div>