<?ob_start();
	$browser = array(
						'Chrome'=>'Chrome',
						'Firefox'=>'Firefox',
						'OPR'=>'Opera',
						'Trident/7.0'=>'IE11',
						'Trident/6.0' => 'IE10 ',
						'Trident/5.0' => 'IE9',
						'Android'=>'Android'
	);
?>
<select name='browser'>
	<option value=''>브라우저 선택</option>
	<option value=''></option>
<?php
	foreach ( $browser as $key => $value ) {
		$selected = null;
		if ( $in['browser'] == $key ) $selected = 'selected';
		echo "<option value='$key' $selected>$value</option>";
	}
?>
</select>
<?$sel_browser = ob_get_clean();?>
<?ob_start();
	$language = array(
						'ko' => '한국어',
						'en' => '영어',
						'zh' => '중국어',
						'tl' => '타갈로그어'
					);
?>
<select name='language'>
	<option value=''>언어선택</option>
	<option value=''></option>
<?php
	foreach ( $language as $key => $value ) {
		$selected = null;
		if ( $in['language'] == $key ) $selected = 'selected';
		echo "<option value='$key' $selected>$value</option>";
	}
?>
</select>
<?$sel_language = ob_get_clean();?>


<form method='get' autocomplete='off'>
	<input type='hidden' name='module' value='admin' />
	<input type='hidden' name='action' value='index' />
	<input type='hidden' name='option' value='referral' />
	<input type='hidden' name='layout' value=1 />
	<div class='admin-row'>
		<span class='sub-title'>도메인</span> <input type='text' name='domain' value='<?=$in['domain']?>' />
	</div>
	<div class='admin-row'>
		<span class='sub-title'>접속일</span> <input type='text' class='datepicker' name='date_begin' value='<?=$in['date_begin']?>' placeholder='시작일' />
		<input type='text' class='datepicker' name='date_end' value='<?=$in['date_end']?>' placeholder='종료일'/>
	</div>
	<div class='admin-row'>
		<span class='sub-title'>브라우저</span> <?=$sel_browser?>
		<span class='sub-title'>언어</span> <?=$sel_language?>
	</div>
	<div class='admin-row'>
		<span class='sub-title'>접속경로</span> <input type='text' name='referral' value='<?=$in['referral']?>' />
		<input type='submit' value='검색' />
	</div>
</form>
<?php
$q = array();
$conds = null;
if ( $in['domain'] ) $q[] = "domain LIKE '%".$in['domain']."%'";
if ( $in['date_begin'] ) $q[] = "stamp >= ".date2stamp($in['date_begin']);
if ( $in['date_end'] ) $q[] = "stamp < ".date2stamp($in['date_end']);
if ( $in['browser'] ) $q[] = "user_agent LIKE '%".$in['browser']."%'";
if ( $in['language'] ) $q[] = "language LIKE '".$in['language']."%'";
if ( $in['referral'] ) $q[] = "referer LIKE '%".$in['referral']."%'";

if ( $q ) $conds = " WHERE ".implode(" AND ", $q );

$total_posts = $adm->total_visitor_referral($conds);
$no_of_post = 20;
$page_no = $sy['post']->page_no($in['page_no']);

$query = "SELECT * FROM " . VISITOR_STAT_TABLE;
if ( $conds ) $query .= $conds;

$referral = $adm->visitor_referral($query, $page_no, $no_of_post);
?>