<?php
if ( empty($in['page_no']) ) $page_no = 1;
else $page_no = $in['page_no'];

$my_scrap = $sy['post']->my_scrap($page_no, $no_of_post);
?>