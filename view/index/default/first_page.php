<?=css('css', 'first_page')?>
<?=javascript('js', 'first_page')?>
<div id='fist-page'>
	<div class='row'>
		<?php
			load_skin('post_latest', 'default', array('post_id'=>'talk', 'title'=>lang('Post subject talk'), 'length'=>140, 'no_of_post'=>5));
		?>
	</div>
	<div class='row'>
		<?php
			load_skin('post_latest', 'default', array('post_id'=>'qna', 'title'=>lang('Post subject qna'), 'length'=>140, 'no_of_post'=>5));
		?>
	</div>
	<div class='row'>
		<?php
			load_skin('post_latest', 'default', array('post_id'=>'talk', 'title'=>lang('Post subject talk'), 'length'=>140, 'no_of_post'=>5));
		?>
	</div>
	<div class='row'>
		<?php
			load_skin('post_latest', 'default', array('post_id'=>'qna', 'title'=>lang('Post subject qna'), 'length'=>140, 'no_of_post'=>5));
		?>
	</div>
</div>