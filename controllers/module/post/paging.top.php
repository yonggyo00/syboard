<?php 
$option = array(
				'post_id'=>$in['post_id'],
				'deleted'=> 'N'
);

if ( $in['category'] ) $option['category'] = $in['category'];
if ( $in['sub_category'] ) $option['sub_category'] = $in['sub_category'];

if ( empty($post_cfg['no_of_post_in_list']) ) $post_cfg['no_of_post_in_list'] = 20;

$no_of_post = $post_cfg['no_of_post_in_list'];
$total_post = $sy['post']->total_post($option);
?>