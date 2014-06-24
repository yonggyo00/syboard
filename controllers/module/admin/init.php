<?php
// 최고관리자(어드민)이 아닌 경우 리턴
if ( !admin() ) return $sy['js']->location("관리자가 아닙니다.", "?");

// 어드민 모듈에 사용될 클라스 로드 */
include_once 'class.php';
$adm = new admin();
?>
<style>
body {
	font-size: 9pt;
	color: #313131;
	margin: 0;
	padding: 0;
}

#admin-container a {
	color: #313131;
	text-decoration: none;
}

#admin-container a:hover {
	text-decoration: underline;
}

#admin-container #select-all {
	border: 1px solid #666666;
	padding: 5px 10px;
	border-radius: 3px;
	cursor: pointer;
	display: inline-block;
	background-color: #ffffff;
	position: relative;
	top: -1px;
	color: #313131;
}

#admin-container #select-all:hover {
	background-color: #666666;
	color: #ffffff;
}

#admin-container input[type='submit'], #admin-container .button {
	display: inline-block;
	padding: 4px 10px;
	border: 1px solid #666666;
	border-radius: 3px;
	background-color: #ffffff;
	cursor: pointer;
	color: #313131;
}

#admin-container .button {
	padding: 5px 10px;
}

#admin-container input[type='submit']:hover, #admin-container .button:hover {
	background-color: #666666;
	color: #ffffff;
}

#admin-container .button:hover {
	text-decoration: none;
}

#admin-container #no_of_result {
	margin: 20px 0 5px 0;
	padding: 0 10px;
}

#admin-container #no_of_result b {
	color: #333b4d;
}

#admin-container table {
	margin-bottom: 10px;
}

#admin-container table tr td {
	border-bottom: 1px solid #898989;
	padding: 10px;
	background-color: #ffffff;
}

#admin-container table #tr-header td{
	border-top: 1px solid #898989;
	background-color: #666666;
	color: #ffffff;
}


#admin-container .admin-row {
	margin-bottom: 5px;
	white-space: nowrap;
}

#admin-container .sub-title {
	display:inline-block;
	background-color: #6d899e;
	border: 1px solid #465a69;
	padding: 4px 10px;
	color: #ffffff;
	cursor: pointer;
	font-family: dotum;
	width: 170px;
	margin-right: 5px;
}

#admin-container .admin-row input[type='text'], #admin-container .admin-row select, #admin-container .admin-row input[type='password'] {
	width: 200px;
	padding: 3px 10px;
	position: relative;
	top: 1px;
	z-index: 0;
}

#admin-container .admin-row textarea {
	width: 90%;
	height: 200px;
	margin-top: 5px;
}

#admin-container .margin-bottom {
	margin-bottom: 20px;
}

#admin-container fieldset {
	border: 1px solid #666666;
	padding: 10px;
	border-radius: 5px;
	margin: 10px 0;
}

</style>