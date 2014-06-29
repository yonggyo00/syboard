<?php
echo skin_css( $so, __FILE__ );

if ( $so['total_post']  % $so['no_of_post'] == 0) $pages =  intval( $so['total_post']  / $so['no_of_post'] );
else $pages =  intval( $so['total_post']  / $so['no_of_post'] )  + 1;

$pn = array();
$pn = array_chunk( range(1, $pages), $so['no_of_page'] );

if ( empty($in['nav_no'] ) ) $nav_no = 1;
else $nav_no = $in['nav_no'];

if ( empty($in['page_no']) ) $page_no = 1;
else $page_no = $in['page_no'];

unset( $in['nav_no'] );
unset( $in['page_no'] );

if ( $in['action'] == 'view' || array_key_exists ( 'post_id', $in ) && $in['module'] != 'admin' ) {
	$qs = "module=post&action=list&post_id=".$in['post_id'];
	if ( $in['category'] ) $qs .= "&category=$in[category]";
	if ( $in['sub_category'] ) $qs .= "&sub_category=$in[sub_category]";
}
else $qs = http_build_query ( $in );

echo "
	<div class='paging'>";
	if ( $nav_no > 1 ) {
		echo "<a class='first_page_no' href='?$qs&nav_no=1&page_no=1'>&lt;&lt;</a>";
	}
		
if ( $nav_no > 1 ) {
	echo "<a class='button' href='?$qs&nav_no=".($nav_no - 1)."&page_no=".$pn[$nav_no - 2][0] ."'>PREV</a>";
}

$start = $nav_no - 1;
for ( $i = 0; $i < $so['no_of_page'];  $i++ ) {
	if ( $no = $pn[$start][$i] ) {
		if ( $no == $page_no ) $add_class = "selected";
		else $add_class = null;
		
		echo "<a class='page_no $add_class' href='?$qs&nav_no=$nav_no&page_no=".$no."'>".$no."</a>";
	}
}
if ( $nav_no < count ( $pn ) ) {
	echo "<a class='button' href='?$qs&nav_no=".($nav_no + 1). "&page_no=".$pn[$nav_no][0]."'>NEXT</a>";
}

if ( $so['total_post'] > $so['no_of_page'] * $so['no_of_post'] ) {
	echo "<a class='last_page_no' href='?$qs&nav_no=".count( $pn ) ."&page_no=$pages'>&gt;&gt;</a>";
}

echo "</div>";
?>
