<?php
$_conds = array();
$conds = null;

$_conds[] = "`domain`='".$site_config['domain']."'";

if( $in['username'] ) $_conds[] = "username LIKE '%".$in['username']."%'";

if( $in['nickname'] ) $_conds[] = "nickname LIKE '%".$in['nickname']."%'";

if( $in['name'] ) $_conds[] = "name LIKE '%".$in['name']."%'";

if( $in['email'] ) $_conds[] = "email LIKE '%".$in['email']."%'";

if( $in['landline'] ) $_conds[] = "landline LIKE '%".$in['landline']."%'";
if( $in['mobile'] ) $_conds[] = "mobile LIKE '%".$in['mobile']."%'";

if ( $in['resign_user'] ) $_conds[] = "resign_stamp > 0";
if ( $in['blocked_user'] ) $_conds[] = "block_stamp > 0";

if ( $_conds ) {
	$conds = implode(" AND ", $_conds );
}

if ( $conds ) $conds = " WHERE ". $conds;


$count = $sy['db']->row("SELECT COUNT(*) as cnt FROM " . MEMBER_TABLE . $conds);

$no_of_post = 20;
$total_post = $count['cnt'];

$page_no = $sy['post']->page_no($in['page_no']);

$start = ($page_no - 1 ) * $no_of_post;

$query = "SELECT * FROM " . MEMBER_TABLE . $conds . " ORDER BY reg_stamp DESC LIMIT $start, $no_of_post";

$rows = $sy['db']->rows($query);
?>