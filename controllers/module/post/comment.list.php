<?php
include_once MODEL_PATH . '/comment_list.php';
?>
<div id='comment-list-module'>
<?
if ( !$comment_list_skin = $post_cfg['comment_list_skin'] ) $comment_list_skin = 'default';
load_skin('comment_list', $comment_list_skin);
?>
</div>