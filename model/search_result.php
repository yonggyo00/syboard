<?php
$query = "SELECT " . $_fields . " FROM " . $_table_name;

if ( $_conds ) {
	$query .= " WHERE (".implode(" AND ", $_conds).")";
	
	if ( $ext_conds ) {
		$query .= " AND " . implode(" AND ", $ext_conds);
	}
}

$posts = $sy['post']->posts($query, $in['page_no'], $no_of_post);
?>