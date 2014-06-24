<?php
include_once 'controllers/common.php';


if ( $_POST['done'] ) {
	// DB 정보가 모두 들어 오지 않으면 페이지를 리다이렉션 한다.
	if ( empty($_POST['db_user']) || empty($_POST['db_password']) || empty($_POST['database']) || empty($_POST['db_host']) || empty($_POST['username']) || empty($_POST['password']) ) {
		echo "<script>alert('Please input db user and password, database all')</script>";
		header('Location: '.$_SERVER['PHP_SELF']);
		exit;
	}
	
	$sy['debug']->log("Database Configuration will be saved to db.php in init directory.");
	// 저장될 파일 내용을 생성한다. //
	$database_config = "<?php\r\ndefine('db_host', '$_POST[db_host]');\r\n";
	$database_config .= "define('db_user', '$_POST[db_user]');\r\n";
	$database_config .= "define('db_password', '$_POST[db_password]');\r\n";
	$database_config .= "define('database', '$_POST[database]');\r\n?>";
	
	if ( $sy['file']->write_file('init/db.php', $database_config) ) {
	
		$sy['debug']->log( 'Database configuration file(db.php) has been created successfully.');
		// 파일 생성이 완료 되면, 저장된 상수를 이용하여 데이터 베이스에 연결 한다.
		include_once 'init/db.php';
		$con = mysql_connect(db_host, db_user, db_password);
		$sy['debug']->log( 'Database connected');
		
		if (mysql_query("CREATE DATABASE IF NOT EXISTS ".$_POST['database']." CHARACTER SET UTF8 COLLATE UTF8_GENERAL_CI",$con)) {
			$sy['debug']->log( 'Database name '.$_POST['database'].' has been created');
			
			if ( mysql_select_db($_POST['database'], $con) ) { // 데이터베이스가 생성이 되면 db를 선택하고
				
				$sy['debug']->log( 'Started creating tables into '.$_POST['database']);
				// 데이터 베이스가 생성이 되면, 테이블을 생성한다.
				 
					// block 테이블
					mysql_query("DROP TABLE `block`");
					
					mysql_query(
						"CREATE TABLE IF NOT EXISTS `block` (".
						"`seq` int(11) NOT NULL AUTO_INCREMENT,".
						"`seq_member` int(11) NOT NULL DEFAULT '0',".
						"`ip` varchar(100) NOT NULL DEFAULT '',".
						"PRIMARY KEY (`seq`),".
						"KEY `seq_member` (`seq_member`),".
						"KEY `ip` (`ip`)".
						") ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
					);
					
					// comment_data
					mysql_query("DROP TABLE `comment_data`");
					mysql_query(
						"CREATE TABLE IF NOT EXISTS `comment_data` (".
						"`seq` int(11) NOT NULL AUTO_INCREMENT,".
						"`seq_root` int(11) NOT NULL DEFAULT '0',".
						"`seq_parent` int(11) NOT NULL DEFAULT '0',".
						"`seq_member` int(11) NOT NULL DEFAULT '0',".
						"`stamp` int(11) NOT NULL DEFAULT '0',".
						"`username` varchar(60) NOT NULL DEFAULT '',".
						"`nickname` varchar(60) NOT NULL DEFAULT '',".
						"`content` text,".
						"`content_stripped` text,".
						"`list_order` bigint(20) NOT NULL DEFAULT '0',".
						"`good` int(11) NOT NULL DEFAULT '0',".
						"`bad` int(11) NOT NULL DEFAULT '0',".
						"`user_agent` varchar(40) NOT NULL DEFAULT '',".
						"`ip` varchar(60) NOT NULL DEFAULT '',".
						"`secret` varchar(40) NOT NULL DEFAULT '',".
						"`deleted` char(1) NOT NULL DEFAULT 'N',".
						"PRIMARY KEY (`seq`),".
						"KEY `seq_root` (`seq_root`),".
						"KEY `seq_parent` (`seq_parent`),".
						"KEY `seq_member` (`seq_member`),".
						"KEY `stamp` (`stamp`),".
						"KEY `username` (`username`),".
						"KEY `nickname` (`nickname`),".
						"KEY `deleted` (`deleted`),".
						"KEY `secret` (`secret`)".
						") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
					);
					
					// data 테이블
					mysql_query("DROP TABLE `data`");
					mysql_query(
						"CREATE TABLE IF NOT EXISTS `data` (".
						"`seq` int(11) NOT NULL AUTO_INCREMENT,".
						"`stamp` int(11) NOT NULL DEFAULT '0',".
						"`code` varchar(255) NOT NULL DEFAULT '',".
						"`gid` varchar(255) NOT NULL DEFAULT '',".
						"`filename` varchar(255) NOT NULL DEFAULT '',".
						"`mime` varchar(255) NOT NULL DEFAULT '',".
						"`type` varchar(60) NOT NULL DEFAULT '',".
						"`size` varchar(255) NOT NULL DEFAULT '0',".
						"`width` int(11) NOT NULL DEFAULT '0',".
						"`height` int(11) NOT NULL DEFAULT '0',".
						"`finished` char(1) NOT NULL DEFAULT 'N',".
						"PRIMARY KEY (`seq`),".
						"KEY `code` (`code`),".
						"KEY `gid` (`gid`)".
						") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
					);
					
					// keyword 테이블
					mysql_query("DROP TABLE `keyword`");
					mysql_query(
						"CREATE TABLE IF NOT EXISTS `keyword` (".
						"`seq` int(11) NOT NULL AUTO_INCREMENT,".
						"`domain` varchar(255) NOT NULL DEFAULT '',".
						"`keyword` varchar(255) NOT NULL DEFAULT '',".
						"`count` int(11) NOT NULL DEFAULT '1',".
						"PRIMARY KEY (`seq`),".
						"KEY `domain` (`domain`)".
						") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
					);
					
					// member 테이블
					mysql_query("DROP TABLE `member`");
					mysql_query(
						"CREATE TABLE IF NOT EXISTS `member` (".
						"`seq` int(11) NOT NULL AUTO_INCREMENT,".
						"`domain` varchar(255) NOT NULL DEFAULT '',".
						"`gid` varchar(40) NOT NULL DEFAULT '',".
						"`username` varchar(32) NOT NULL DEFAULT '',".
						"`password` varchar(45) NOT NULL DEFAULT '',".
						"`name` varchar(60) NOT NULL DEFAULT '',".
						"`nickname` varchar(60) NOT NULL DEFAULT '',".
						"`email` varchar(255) NOT NULL DEFAULT '',".
						"`mobile` varchar(60) NOT NULL DEFAULT '',".
						"`landline` varchar(60) NOT NULL DEFAULT '',".
						"`province` varchar(100) NOT NULL DEFAULT '',".
						"`city` varchar(100) NOT NULL DEFAULT '',".
						"`address` varchar(255) NOT NULL DEFAULT '',".
						"`signature` varchar(255) NOT NULL DEFAULT '',".
						"`introduction` text,".
						"`ip` varchar(60) NOT NULL DEFAULT '',".
						"`reg_stamp` int(11) NOT NULL DEFAULT '0',".
						"`block_stamp` int(11) NOT NULL DEFAULT '0',".
						"`resign_stamp` int(11) NOT NULL DEFAULT '0',".
						"`point` int(11) NOT NULL DEFAULT '0',".
						"`is_admin` char(1) NOT NULL DEFAULT '',".
						"`int_1` int(11) NOT NULL DEFAULT '0',".
						"`int_2` int(11) NOT NULL DEFAULT '0',".
						"`int_3` int(11) NOT NULL DEFAULT '0',".
						"`int_4` int(11) NOT NULL DEFAULT '0',".
						"`int_5` int(11) NOT NULL DEFAULT '0',".
						"`char_1` char(1) NOT NULL DEFAULT '',".
						"`char_2` char(1) NOT NULL DEFAULT '',".
						"`char_3` char(1) NOT NULL DEFAULT '',".
						"`char_4` char(1) NOT NULL DEFAULT '',".
						"`char_5` char(1) NOT NULL DEFAULT '',".
						"`varchar_1` varchar(255) NOT NULL DEFAULT '',".
						"`varchar_2` varchar(255) NOT NULL DEFAULT '',".
						"`varchar_3` varchar(255) NOT NULL DEFAULT '',".
						"`varchar_4` varchar(255) NOT NULL DEFAULT '',".
						"`varchar_5` varchar(255) NOT NULL DEFAULT '',".
						"`text_1` text,".
						"`text_2` text,".
						"`text_3` text,".
						"`text_4` text,".
						"`text_5` text,".
						"PRIMARY KEY (`seq`),".
						"KEY `username` (`username`),".
						"KEY `name` (`name`),".
						"KEY `password` (`password`),".
						"KEY `nickname` (`nickname`),".
						"KEY `reg_stamp` (`reg_stamp`),".
						"KEY `resign_stamp` (`resign_stamp`),".
						"KEY `email` (`email`),".
						"KEY `cellphone` (`mobile`),".
						"KEY `landline` (`landline`),".
						"KEY `domain` (`domain`),".
						"KEY `gid` (`gid`),".
						"KEY `int_1` (`int_1`),".
						"KEY `int_2` (`int_2`),".
						"KEY `int_3` (`int_3`),".
						"KEY `int_4` (`int_4`),".
						"KEY `int_5` (`int_5`),".
						"KEY `char_1` (`char_1`),".
						"KEY `char_2` (`char_2`),".
						"KEY `char_3` (`char_3`),".
						"KEY `char_4` (`char_4`),".
						"KEY `char_5` (`char_5`),".
						"KEY `varchar_1` (`varchar_1`),".
						"KEY `varchar_2` (`varchar_2`),".
						"KEY `varchar_3` (`varchar_3`),".
						"KEY `varchar_4` (`varchar_4`),".
						"KEY `varchar_5` (`varchar_5`)".
						") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
					);
					
					// message_data 테이블
					mysql_query("DROP TABLE `message_data`");
					mysql_query(
						"CREATE TABLE IF NOT EXISTS `message_data` (".
						"`seq` int(11) NOT NULL AUTO_INCREMENT,".
						"`stamp` int(11) NOT NULL DEFAULT '0',".
						"`gid` varchar(40) NOT NULL DEFAULT '',".
						"`sender` varchar(100) NOT NULL DEFAULT '',".
						"`receiver` varchar(100) NOT NULL DEFAULT '',".
						"`subject` varchar(500) NOT NULL DEFAULT '',".
						"`content` text,".
						"`first_file` int(11) NOT NULL DEFAULT '0',".
						"`important` char(1) NOT NULL DEFAULT '',".
						"`user_agent` varchar(60) NOT NULL DEFAULT '',".
						"`ip` varchar(30) NOT NULL DEFAULT 'N',".
						"`receiver_readed` char(1) NOT NULL DEFAULT 'N',".
						"`readed_stamp` int(11) NOT NULL DEFAULT '0',".
						"`sender_deleted` char(1) NOT NULL DEFAULT 'N',".
						"`receiver_deleted` char(1) NOT NULL DEFAULT 'N',".
						"PRIMARY KEY (`seq`),".
						"KEY `gid` (`gid`),".
						"KEY `sender` (`sender`),".
						"KEY `receiver` (`receiver`),".
						"KEY `receiver_readed` (`receiver_readed`),".
						"KEY `sender_deleted` (`sender_deleted`),".
						"KEY `receiver_deleted` (`receiver_deleted`),".
						"KEY `first_file` (`first_file`),".
						"KEY `important` (`important`)".
						") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
					);
					
					// popup_config 테이블
					mysql_query("DROP TABLE `popup_config`");
					mysql_query(
						"CREATE TABLE IF NOT EXISTS `popup_config` (".
						"`seq` int(11) NOT NULL AUTO_INCREMENT,".
						"`domain` varchar(255) NOT NULL DEFAULT '',".
						"`value` text,".
						"PRIMARY KEY (`seq`),".
						"KEY `domain` (`domain`)".
						") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
					);
					
					// post_config 테이블
					mysql_query("DROP TABLE `post_config`");
					mysql_query(
						"CREATE TABLE IF NOT EXISTS `post_config` (".
						"`seq` int(11) NOT NULL AUTO_INCREMENT,".
						"`post_id` varchar(255) NOT NULL DEFAULT 'default',".
						"`subject` varchar(255) NOT NULL DEFAULT 'default',".
						"`category` varchar(255) NOT NULL DEFAULT '',".
						"`show_list_category` char(1) NOT NULL DEFAULT '',".
						"`show_write_category` char(1) NOT NULL DEFAULT '',".
						"`map_use` char(1) NOT NULL DEFAULT '',".
						"`blog_api_use` char(1) NOT NULL DEFAULT '',".
						"`no_of_post_in_list` tinyint(4) NOT NULL DEFAULT '0',".
						"`post_list_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`write_form_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`write_subject_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`list_subject_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`view_post_subject_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`view_menu_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`view_subject_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`view_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`comment_list_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`comment_write_form_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`paging_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`list_category_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`write_category_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`post_list_menu_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`post_list_reminder_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`vote_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`vote_comment_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`map_skin` varchar(255) NOT NULL DEFAULT 'default',".
						"`view_with_list` char(1) NOT NULL DEFAULT '',".
						"`view_with_comment` char(1) DEFAULT NULL,".
						"`view_with_comment_list` char(1) NOT NULL DEFAULT '',".
						"`use_login_post` char(1) NOT NULL DEFAULT '',".
						"`use_secret` char(1) NOT NULL DEFAULT '',".
						"`use_view_vote` char(1) NOT NULL DEFAULT '',".
						"`use_comment_vote` char(1) NOT NULL DEFAULT '',".
						"`use_editor` char(1) NOT NULL DEFAULT '0',".
						"`show_ip_view` char(1) NOT NULL DEFAULT '',".
						"`show_ip_comment` char(1) NOT NULL DEFAULT '',".
						"`write_level` tinyint(4) NOT NULL DEFAULT '0',".
						"`list_level` tinyint(4) NOT NULL DEFAULT '0',".
						"`view_level` tinyint(4) NOT NULL DEFAULT '0',".
						"`comment_write_level` tinyint(4) NOT NULL DEFAULT '0',".
						"`point` smallint(6) NOT NULL DEFAULT '0',".
						"`comment_point` tinyint(4) NOT NULL DEFAULT '0',".
						"`no_of_post` int(11) NOT NULL DEFAULT '0',".
						"`keywords` varchar(300) NOT NULL DEFAULT '',".
						"`description` text,".
						"`admin` varchar(255) NOT NULL DEFAULT '',".
						"PRIMARY KEY (`seq`),".
						"KEY `use_login_post` (`use_login_post`),".
						"KEY `use_secret` (`use_secret`)".
						") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
				);
				
				// post_data 테이블
				mysql_query("DROP TABLE `post_data`");
				mysql_query(
					"CREATE TABLE IF NOT EXISTS `post_data` (".
					"`seq` int(11) NOT NULL AUTO_INCREMENT,".
					"`stamp` int(11) NOT NULL DEFAULT '0',".
					"`seq_member` int(11) NOT NULL DEFAULT '0',".
					"`username` varchar(60) NOT NULL DEFAULT '',".
					"`nickname` varchar(60) NOT NULL DEFAULT '',".
					"`gid` varchar(40) NOT NULL DEFAULT '',".
					"`post_id` varchar(60) NOT NULL DEFAULT '',".
					"`category` varchar(255) NOT NULL DEFAULT '',".
					"`sub_category` varchar(255) NOT NULL DEFAULT '',".
					"`subject` varchar(255) NOT NULL DEFAULT '',".
					"`content` text,".
					"`content_stripped` text,".
					"`no_of_view` int(11) NOT NULL DEFAULT '0',".
					"`no_of_comment` int(11) NOT NULL DEFAULT '0',".
					"`first_image` int(11) NOT NULL DEFAULT '0',".
					"`first_video` int(11) NOT NULL DEFAULT '0',".
					"`first_file` int(11) NOT NULL DEFAULT '0',".
					"`user_agent` varchar(255) NOT NULL DEFAULT '',".
					"`ip` varchar(255) CHARACTER SET ucs2 NOT NULL DEFAULT '',".
					"`link` varchar(255) NOT NULL DEFAULT '',".
					"`good` int(11) NOT NULL DEFAULT '0',".
					"`bad` int(11) NOT NULL DEFAULT '0',".
					"`reminder` char(1) NOT NULL DEFAULT '',".
					"`province` varchar(255) NOT NULL DEFAULT '',".
					"`region` varchar(255) NOT NULL DEFAULT '',".
					"`latitude` varchar(15) NOT NULL DEFAULT '',".
					"`longitude` varchar(15) NOT NULL DEFAULT '',".
					"`use_secret` char(1) NOT NULL DEFAULT '0',".
					"`secret` varchar(60) NOT NULL DEFAULT '',".
					"`guest_secret` varchar(40) NOT NULL DEFAULT '',".
					"`blog_no_1` varchar(255) NOT NULL DEFAULT '',".
					"`blog_no_2` varchar(255) NOT NULL DEFAULT '',".
					"`blog_no_3` varchar(255) NOT NULL DEFAULT '',".
					"`blog_category_1` varchar(255) NOT NULL DEFAULT '',".
					"`blog_category_2` varchar(255) NOT NULL DEFAULT '',".
					"`blog_category_3` varchar(255) NOT NULL DEFAULT '',".
					"`blog_tags_1` varchar(255) NOT NULL DEFAULT '',".
					"`blog_tags_2` varchar(255) NOT NULL DEFAULT '',".
					"`blog_tags_3` varchar(255) NOT NULL DEFAULT '',".
					"`int_1` int(11) NOT NULL DEFAULT '0',".
					"`int_2` int(11) NOT NULL DEFAULT '0',".
					"`int_3` int(11) NOT NULL DEFAULT '0',".
					"`int_4` int(11) NOT NULL DEFAULT '0',".
					"`int_5` int(11) NOT NULL DEFAULT '0',".
					"`char_1` char(1) NOT NULL DEFAULT '',".
					"`char_2` char(1) NOT NULL DEFAULT '',".
					"`char_3` char(1) NOT NULL DEFAULT '',".
					"`char_4` char(1) NOT NULL DEFAULT '',".
					"`char_5` char(1) NOT NULL DEFAULT '',".
					"`varchar_1` varchar(255) NOT NULL DEFAULT '',".
					"`varchar_2` varchar(255) NOT NULL DEFAULT '',".
					"`varchar_3` varchar(255) NOT NULL DEFAULT '',".
					"`varchar_4` varchar(255) NOT NULL DEFAULT '',".
					"`varchar_5` varchar(255) NOT NULL DEFAULT '',".
					"`text_1` text,".
					"`text_2` text,".
					"`text_3` text,".
					"`text_4` text,".
					"`text_5` text,".
					"`editor_used` char(1) NOT NULL DEFAULT '0',".
					"`deleted` char(1) NOT NULL DEFAULT 'N',".
					"PRIMARY KEY (`seq`),".
					"KEY `stamp` (`stamp`),".
					"KEY `seq_member` (`seq_member`),".
					"KEY `username` (`username`),".
					"KEY `nickname` (`nickname`),".
					"KEY `gid` (`gid`),".
					"KEY `post_id` (`post_id`),".
					"KEY `category` (`category`),".
					"KEY `sub_category` (`sub_category`),".
					"KEY `int_1` (`int_1`),".
					"KEY `int_2` (`int_2`),".
					"KEY `char_1` (`char_1`),".
					"KEY `char_2` (`char_2`),".
					"KEY `varchar_1` (`varchar_1`),".
					"KEY `varchar_2` (`varchar_2`),".
					"KEY `deleted` (`deleted`),".
					"KEY `first_image` (`first_image`),".
					"KEY `first_video` (`first_video`),".
					"KEY `first_file` (`first_file`)".
					") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
				);
				
				// register_auth 테이블
				mysql_query("DROP TABLE `register_auth`");
				mysql_query(
					"CREATE TABLE IF NOT EXISTS `register_auth` (".
					"`seq` int(11) NOT NULL AUTO_INCREMENT,".
					"`email` varchar(100) NOT NULL DEFAULT '',".
					"`auth_key` varchar(40) NOT NULL DEFAULT '',".
					"PRIMARY KEY (`seq`),".
					"KEY `email` (`email`),".
					"KEY `auth_key` (`auth_key`)".
					") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
				);
				
				// scrap 테이블
				mysql_query("DROP TABLE `scrap`");
				mysql_query(
					"CREATE TABLE IF NOT EXISTS `scrap` (".
					"`seq` int(11) NOT NULL AUTO_INCREMENT,".
					"`seq_member` int(11) NOT NULL DEFAULT '0',".
					"`seq_post` int(11) NOT NULL DEFAULT '0',".
					"PRIMARY KEY (`seq`)".
					") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
				);
				
				// site_config 테이블
				mysql_query("DROP TABLE `site_config`");
				mysql_query(
					"CREATE TABLE IF NOT EXISTS `site_config` (".
					"`seq` int(11) NOT NULL AUTO_INCREMENT,".
					"`title` varchar(255) NOT NULL DEFAULT '',".
					"`sub_title` varchar(255) NOT NULL DEFAULT '',".
					"`description` text,".
					"`keyword` text,".
					"`domain` varchar(255) NOT NULL DEFAULT '',".
					"`pc_url` varchar(255) NOT NULL DEFAULT '',".
					"`mobile_url` varchar(255) NOT NULL DEFAULT '',".
					"`layout` varchar(64) NOT NULL DEFAULT '',".
					"`version` int(11) NOT NULL DEFAULT '1',".
					"`login_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`login_page_skin` varchar(100) NOT NULL DEFAULT 'default',".
					"`register_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`resign_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`my_posts_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`my_comments_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`mobile_pc_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`lang_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`search_form_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`search_list_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`search_paging_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`my_scrap_list_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`current_user_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`visitor_stat_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`keyword_stat_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`message_write_form_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`message_view_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`message_list_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`view_count_delete` int(11) NOT NULL DEFAULT '30',".
					"`captcha_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`secret_check_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`guest_secret_check_skin` varchar(255) NOT NULL DEFAULT 'default',".
					"`blog_api` text,".
					"`use_cache` char(1) NOT NULL DEFAULT '',".
					"`use_debuging_log` char(1) NOT NULL DEFAULT '',".
					"`permit_nickname_change` char(1) NOT NULL DEFAULT '',".
					"`use_captcha` char(1) NOT NULL DEFAULT '',".
					"`use_capcha_in_register` char(1) NOT NULL DEFAULT '',".
					"`use_register_auth` char(1) NOT NULL DEFAULT '',".
					"`visitor_stat_minutes` int(11) NOT NULL DEFAULT '3',".
					"`search_stat_minutes` int(11) NOT NULL DEFAULT '3',".
					"`use_css_in_header` char(1) NOT NULL DEFAULT '',".
					"`use_js_in_header` char(1) NOT NULL DEFAULT '',".
					"`accounts_cannot_be_used` text,".
					"`names_cannot_be_used` text,".
					"`words_cannot_be_used` text,".
					"`not_searching_forum` varchar(1000) NOT NULL DEFAULT '',".
					"`terms_conds` text,".
					"`use_terms_conds` char(1) NOT NULL DEFAULT '',".
					"`policy` text,".
					"`use_policy` char(1) NOT NULL DEFAULT '',".
					"`register_point` int(11) NOT NULL DEFAULT '0',".
					"`level` text,".
					"`favicon_uploaded` char(1) NOT NULL DEFAULT '0',".
					"`use_facebook` char(1) NOT NULL DEFAULT '0',".
					"`use_twitter` char(1) NOT NULL DEFAULT '0',".
					"`forums` varchar(1000) NOT NULL DEFAULT '',".
					"`admin` varchar(255) NOT NULL DEFAULT '',".
					"PRIMARY KEY (`seq`),".
					"KEY `domain` (`domain`)".
					") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
				);
				
				// view_count 테이블
				mysql_query("DROP TABLE `view_count`");
				mysql_query(
					"CREATE TABLE IF NOT EXISTS `view_count` (".
					"`seq` int(11) NOT NULL AUTO_INCREMENT,".
					"`value` varchar(40) NOT NULL DEFAULT '',".
					"`stamp` int(11) NOT NULL DEFAULT '0',".
					"PRIMARY KEY (`seq`),".
					"KEY `stamp` (`stamp`),".
					"KEY `value` (`value`)".
					") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
				);
				
				
				// visitor_stat 테이블
				mysql_query("DROP TABLE `visitor_stat`");
				mysql_query(
					"CREATE TABLE IF NOT EXISTS `visitor_stat` (".
					"`seq` int(11) NOT NULL AUTO_INCREMENT,".
					"`domain` varchar(255) NOT NULL DEFAULT '',".
					"`stamp` int(11) NOT NULL DEFAULT '0',".
					"`ip` varchar(10) NOT NULL DEFAULT '',".
					"`user_agent` varchar(255) NOT NULL DEFAULT '',".
					"`language` varchar(10) NOT NULL DEFAULT '',".
					"`referer` varchar(1000) NOT NULL DEFAULT '',".
					"PRIMARY KEY (`seq`),".
					"KEY `stamp` (`stamp`),".
					"KEY `ip` (`ip`),".
					"KEY `user_agent` (`user_agent`),".
					"KEY `domain` (`domain`)".
					") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
				);
				
				// vote 테이블
				mysql_query("DROP TABLE `vote`");
				mysql_query(
					"CREATE TABLE IF NOT EXISTS `vote` (".
					"`seq` int(11) NOT NULL AUTO_INCREMENT,".
					"`seq_post` int(11) NOT NULL DEFAULT '0',".
					"`seq_member` int(11) NOT NULL DEFAULT '0',".
					"PRIMARY KEY (`seq`),".
					"KEY `seq_post` (`seq_post`),".
					"KEY `seq_member` (`seq_member`)".
					") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
				);
				
				// vote_comment 테이블
				mysql_query("DROP TABLE `vote_comment`");
				mysql_query(
					"CREATE TABLE IF NOT EXISTS `vote_comment` (".
					"`seq` int(11) NOT NULL AUTO_INCREMENT,".
					"`seq_comment` int(11) NOT NULL DEFAULT '0',".
					"`seq_member` int(11) NOT NULL DEFAULT '0',".
					"PRIMARY KEY (`seq`)".
					") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
				);
				
				$sy['debug']->log( 'Creating tables into '.$_POST['database'].' has been finished now');
				
				$sy['debug']->log( 'Creating the administrator account in member table');
								
				// 최고 관리자 계정 생성
				if ( sub_domain() ) $domain = sub_domain().".".root_domain();
				else $domain = root_domain();
				
				$option = array(
								'domain'=>$domain,
								'gid'=>gid(),
								'username'=>$_POST['username'],
								'nickname'=>'최고관리자',
								'name'=>'최고관리자',
								'password'=>md5($_POST['password']),
								'reg_stamp'=>time(),
								'ip'=>ip_2_long($_SERVER['REMOTE_ADDR']),
								'is_admin'=>'Y'
				);
				
				mysql_query(
							"INSERT INTO member (`domain`,`gid`,`username`,`nickname`,`name`,`password`,`reg_stamp`,`ip`,`is_admin`) ".
							"VALUES ('$domain','".gid()."','$_POST[username]','최고관리자','최고관리자','".md5($_POST['password'])."',".time().",'".ip_2_long($_SERVER['REMOTE_ADDR'])."','Y')"
				);
				
				// 기본 site_config 설정
				mysql_query(
					"INSERT INTO `site_config` (`seq`, `title`, `sub_title`, `description`, `keyword`, `domain`, `pc_url`, `mobile_url`, `layout`, `version`, `login_skin`, `login_page_skin`, `register_skin`, `resign_skin`, `my_posts_skin`, `my_comments_skin`, `mobile_pc_skin`, `lang_skin`, `search_form_skin`, `search_list_skin`, `search_paging_skin`, `my_scrap_list_skin`, `current_user_skin`, `visitor_stat_skin`, `keyword_stat_skin`, `message_write_form_skin`, `message_view_skin`, `message_list_skin`, `view_count_delete`, `captcha_skin`, `secret_check_skin`, `guest_secret_check_skin`, `blog_api`, `use_cache`, `use_debuging_log`, `permit_nickname_change`, `use_captcha`, `use_capcha_in_register`, `use_register_auth`, `visitor_stat_minutes`, `search_stat_minutes`, `use_css_in_header`, `use_js_in_header`, `accounts_cannot_be_used`, `names_cannot_be_used`, `words_cannot_be_used`, `not_searching_forum`, `terms_conds`, `use_terms_conds`, `policy`, `use_policy`, `register_point`, `level`, `favicon_uploaded`, `use_facebook`, `use_twitter`, `forums`, `admin`) VALUES".
					"(1, 'default', '', '', '', '$domain', '', '', 'default', 1, 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', '', 'default', 'default', 'default', 'default', 30, 'default', 'default', 'default', 'YTo5OntzOjEzOiJibG9nX2FwaV91cmwxIjtzOjA6IiI7czoxNzoiYmxvZ19hcGlfYWNjb3VudDEiO3M6MDoiIjtzOjE4OiJibG9nX2FwaV9wYXNzd29yZDEiO3M6MDoiIjtzOjEzOiJibG9nX2FwaV91cmwyIjtzOjA6IiI7czoxNzoiYmxvZ19hcGlfYWNjb3VudDIiO3M6MDoiIjtzOjE4OiJibG9nX2FwaV9wYXNzd29yZDIiO3M6MDoiIjtzOjEzOiJibG9nX2FwaV91cmwzIjtzOjA6IiI7czoxNzoiYmxvZ19hcGlfYWNjb3VudDMiO3M6MDoiIjtzOjE4OiJibG9nX2FwaV9wYXNzd29yZDMiO3M6MDoiIjt9', '1', '1', '', '1', '1', '0', 3, 3, '', '', '', '', '', '', '', '', '', '', 0, 'YToyMDp7aToxO3M6NDoiMTAwMCI7aToyO3M6NDoiMjAwMCI7aTozO3M6NDoiMzAwMCI7aTo0O3M6NDoiNDAwMCI7aTo1O3M6NDoiNTAwMCI7aTo2O3M6NDoiNjAwMCI7aTo3O3M6NDoiNzAwMCI7aTo4O3M6NDoiODAwMCI7aTo5O3M6NDoiOTAwMCI7aToxMDtzOjU6IjEwMDAwIjtpOjExO3M6NToiMTEwMDAiO2k6MTI7czo1OiIxMjAwMCI7aToxMztzOjU6IjEzMDAwIjtpOjE0O3M6NToiMTQwMDAiO2k6MTU7czo1OiIxNTAwMCI7aToxNjtzOjU6IjE2MDAwIjtpOjE3O3M6NToiMTcwMDAiO2k6MTg7czo1OiIxODAwMCI7aToxOTtzOjU6IjE5MDAwIjtpOjIwO3M6NToiMjAwMDAiO30=', '0', '0', '', '', '');"
				);
				
				
				// 기본 게시판 생성 talk(자유게시판), qna(질문과 답변)
				mysql_query(
					"INSERT INTO `post_config` (`seq`, `post_id`, `subject`, `category`, `show_list_category`, `show_write_category`, `map_use`, `blog_api_use`, `no_of_post_in_list`, `post_list_skin`, `write_form_skin`, `write_subject_skin`, `list_subject_skin`, `view_post_subject_skin`, `view_menu_skin`, `view_subject_skin`, `view_skin`, `comment_list_skin`, `comment_write_form_skin`, `paging_skin`, `list_category_skin`, `write_category_skin`, `post_list_menu_skin`, `post_list_reminder_skin`, `vote_skin`, `vote_comment_skin`, `map_skin`, `view_with_list`, `view_with_comment`, `view_with_comment_list`, `use_login_post`, `use_secret`, `use_view_vote`, `use_comment_vote`, `use_editor`, `show_ip_view`, `show_ip_comment`, `write_level`, `list_level`, `view_level`, `comment_write_level`, `point`, `comment_point`, `no_of_post`, `keywords`, `description`, `admin`) VALUES".
					"(1, 'talk', '자유게시판', '', '0', '0', '0', '0', 20, 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 0, 0, 0, 0, 50, 10, 0, '', '', ''),".
					"(2, 'qna', '질문과답변', '', '0', '0', '0', '0', 20, 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', 'default', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 0, 0, 0, 0, 50, 10, 0, '', '', '');"
				);
			}
		}
		else echo "Error creating database: " . mysql_error();
		
		mysql_close($con);
		
		
		echo '<h3>Database configuration has been done successfully</h3>';
		$path_info = pathinfo($_SERVER['PHP_SELF']);
		echo "<a href='http://".$_SERVER['HTTP_HOST'].$path_info['dirname']."'>Move to Main</a>";
		$sy['debug']->log( 'Move to Main Page after configuration.');
		
	
	} else {	
		$sy['debug']->log( 'While Database configuration file(db.php) was creating, error occurs!');
		
	}
	
}
else {
	if ( file_exists('init/db.php') ) {
		echo "<h3>Database has been configured already.</h3>";
	}
	else {
	$sy['debug']->log("Database Configuration started....");
?>	
<div id='configure'>
	<div id='title'>Welcome to SYBOARD</div>
	<div>This is initial configuration page. Please fill all in the blank below.</div>
	<form method='post' action='<?=$_SERVER['PHP_SELF']?>' autocomplete='off'>
		<input type='hidden' name='done' value=1 />
		<fieldset>
			<legend>Database Configuration</legend>
			
			<div><span class='sub-title'>HOST</span> <input type='text' name='db_host' /></div>
			<div><span class='sub-title'>USER</span> <input type='text' name='db_user' /></div>
			<div><span class='sub-title'>PASSWORD</span> <input type='password' name='db_password' /></div>
			<div><span class='sub-title'>DATABASE</span> <input type='text' name='database' /></div>
		</fieldset>
		
		<fieldset>
			<legend>Register administrator</legend>
			
			<div><span class='sub-title'>USERNAME</span> <input type='text' name='username' /></div>
			<div><span class='sub-title'>PASSWORD</span> <input type='password' name='password' /></div>
		</fieldset>
		
		<input type='submit' value='Start Configuration' />
	</form>
</div>
<style>
body {
	margin: 10px;
	padding: 0;
}
#configure {
	border: 1px solid #666666;
	padding: 10px;
	border-radius: 3px;
	font-size: 9pt;
	font-family: dotum;
}

#configure #title {
	font-family: '맑은 고딕', AppleGothic;
	font-size: 11pt;
	color: #313948;
	border-bottom: 1px solid #d5d5d5;
	padding-bottom: 5px;
	margin-bottom: 10px;
}

#configure .sub-title, #configure input[type='submit'] {
	display:inline-block;
	background-color: #6d899e;
	border: 1px solid #465a69;
	padding: 4px 10px;
	width: 70px;
	color: #ffffff;
	font-family: dotum;
	margin-right: 5px;
}

#configure input[type='submit'] {
	width: 170px;
	text-align: center;
	cursor: pointer;
}

#configure input[type='submit']:hover {
	background-color: #465a69;
}

#configure fieldset {
	border: 1px solid #898989;
	border-radius: 3px;
	padding: 10px;
	margin: 10px 0;
	background-color: #e5e5e5;
}

#configure fieldset div {
	margin-bottom: 5px;
}

#configure fieldset input[type='text'], #configure fieldset input[type='password'] {
	padding: 3px 10px;
}
</style>

	<? }?>
<? }?>