<?php
$fields = "seq, stamp, seq_member, username, nickname, post_id, subject, secret,guest_secret, no_of_view, no_of_comment,good, bad, first_image, first_video, first_file";

// 추가 필드
if ( $add_fields ) $fields .= "," . $add_fields;

$where = " WHERE post_id='".$in['post_id']."' AND deleted <> 'Y'";

if ( $in['category'] ) $where .= " AND category='". $in['category'] . "'";
if ( $in['sub_category'] ) $where .= " AND sub_category='" . $in['sub_category'] . "'";

// 추가 조건절
if ( $add_where ) $where .= " AND " . $add_where;


$query = "SELECT $fields FROM ".POST_DATA_TABLE . $where;

if ( empty($post_cfg['no_of_post_in_list']) ) $post_cfg['no_of_post_in_list'] = 20;

$posts = $sy['post']->posts($query, $in['page_no'], $post_cfg['no_of_post_in_list'] );
?>