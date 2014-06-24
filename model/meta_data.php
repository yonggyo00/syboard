<?php
$_meta_title = null;
$_meta_desc = null;
$_meta_keyword = null;
if ( $meta_post_content ) {
	$_meta_title = $post_cfg['subject'] . " - " . $meta_post_content['subject'];
	$_meta_desc = $meta_post_content['content_stripped'];
}
else if ( $in['post_id'] && empty($meta_post_content) ) {
	$_meta_title = $site_config['title'];
	if ( $post_cfg['subject'] ) $_meta_title .= " - " . $post_cfg['subject'];
	
	$_meta_desc = strip_tags(str_replace("\\r\\n", "", $post_cfg['description']));
}
else {
	$_meta_title = $site_config['title'];
	if ( $site_config['sub_title'] ) $_meta_title .= " - " . $site_config['sub_title'];
	
	$_meta_desc = $site_config['description'];
}

$_meta_keyword = $post_cfg['keywords'];
?>