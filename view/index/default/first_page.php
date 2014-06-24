<?=css('css', 'first_page')?>
<?=javascript('js', 'first_page')?>
<div id='fist-page'>
	<div class='row'>
		<?php
			load_skin('post_latest', 'default', array('post_id'=>'talk', 'title'=>'자유토론', 'length'=>140, 'no_of_post'=>10));
		?>
	</div>
	<div class='row'>
		<?php
			load_skin('post_latest', 'default', array('post_id'=>'qna', 'title'=>'질문과 답변', 'length'=>140, 'no_of_post'=>10));
		?>
	</div>
	<div class='row'>
		<span popup_url='?page=layer_popup_test&layout=1' id='layer_popup_test'>레이어팝업테스트</span>
	</div>
</div>