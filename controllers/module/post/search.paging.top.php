<?php
$count_query = "SELECT COUNT(*) as cnt FROM " . $_table_name;

$_conds = array();
$ext_conds = array();

if ( empty($in['search_op']) ) $in['search_op'] = 'OR'; 

if ( $_keywords ) {
	if ( $in['search_op'] == 'OR' ) {
		if ( $in['search_subject'] && $in['search_content'] ) {
			$_q = array();
			foreach ( $_keywords as $_key ) {
				$_q[] = "subject LIKE '%".$_key."%' OR content LIKE '%".$_key."%'";
			}
			
			$_conds[] = "( ".implode(' OR ', $_q) . " )";
		}
	}
	else {
		if ( $in['search_subject'] ) {
			if ( $in['search_post_comment'] == 'post' ) {
				foreach ( $_keywords as $_key ) {
					$_conds[] = "subject LIKE '%".$_key."%'";
				}
			}
		}

		if ( $in['search_content'] ) {
			foreach ( $_keywords as $_key ) {
				$_conds[] = "content LIKE '%".$_key."%'";
			}
		}
	}
	
	if ( empty($_conds) ) {
		if ( $in['search_post_comment'] == 'post' ) {
			foreach ( $_keywords as $_key ) {
				$_conds[] = "subject LIKE '%".$_key."%'";
			}
		}
		else {
			foreach ( $_keywords as $_key ) {
				$_conds[] = "content LIKE '%".$_key."%'";
			}
		}
	}
	
}
$_conds[] = "deleted='N'";

if ( $in['username'] ) {
	$_conds[] = "username='".$in['username']."'";
}

if ( $_conds ) {
	
	$count_query .= " WHERE (".implode(" AND ", $_conds). ")";
	
	if ( $in['post_id'] ) {
		if ( $in['search_post_comment'] == 'post' )  {
			$ext_conds[] = "post_id='" . $in['post_id'] . "'";
		}
	}
	
	$ext_conds[] = "deleted='N'";
	if ( $ext_conds ) {
		$count_query .= " AND " . implode(" AND ", $ext_conds);
	}

}

$count = $sy['db']->row($count_query);

$no_of_post = 20;
$total_post = $count['cnt'];
?>