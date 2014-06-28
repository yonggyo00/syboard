<?=css('css', 'menu')?>
<ul id='site-top-menu'>
	<li><a menu-id='talk' href='?talk'>자유토론</a></li>
	<li><a menu-id='qna' href='?qna'>질문과 답변</a></li>
</ul>
<div style='clear:left;'></div>

<style>
#site-top-menu li a[menu-id='<?=$in['post_id']?>'] {
	background-color: #2f4553;
}
</style>