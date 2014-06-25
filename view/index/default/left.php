<div class='main-left-row'>
<?php 
	if ( !$login_skin = $site_config['login_skin'] ) $login_skin = 'default';
	load_skin('login', $login_skin ); 
?>
</div>
<div class='main-left-row'>
<?php 
	if ( !$current_user_skin = $site_config['current_user_skin'] ) $current_user_skin = 'default';
	load_skin('current_user', $current_user_skin);
?>
</div>
<div class='main-left-row'>
<?php
	if ( !$keyword_stat_skin = $site_config['keyword_stat_skin'] ) $keyword_stat_skin = 'default';
	load_skin('keyword_stat', $keyword_stat_skin, array('title'=>lang('Keyword stat title'), 'no_of_keywords'=>7));
?>
</div>
<div class='main-left-row'>
<?php
	if ( !$visitor_stat_skin = $site_config['visitor_stat_skin'] ) $visitor_stat_skin = 'default';
	load_skin('visitor_stat', $visitor_stat_skin, array('title'=>lang('Visitor stat title'), 'visitor_stat'=>$_visitor_stat));
?>
</div>