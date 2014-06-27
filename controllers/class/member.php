<?php
class member {

	// Register URL
	public function register_url() {
		global $site_config;
		
		$url = "?module=member&action=register";
		
		if ( $site_config['use_register_auth'] ) {
			$url = "?module=member&action=register_auth";
		}
		
		return $url;
	}
	
	// 회원 가입 처리 
	public function register( $option ) {
		global $sy;
		
		unset($option['module']);
		unset($option['action']);
		unset($option['layout']);
		unset($option['confirm_password']);
		unset($option['header']);
		unset($option['captcha']);
		unset($option['auth_key']);
		
		// 사이트 설정 가져오기  1차, 2차 도메인만 체크 한다.
		if ( sub_domain() ) $domain = sub_domain().".".root_domain();
		else $domain = root_domain();
		
		$option['domain'] = $domain;
		$option['password'] = md5($option['password']);
		$option['reg_stamp'] = time();
		$option['ip'] = ip_2_long($_SERVER['REMOTE_ADDR']);
		
		return $sy['db']->insert(MEMBER_TABLE, $option);
	}
	
	// 회원정보 수정
	public function update( $option ) {
		global $sy;
		
		unset($option['module']);
		unset($option['action']);
		unset($option['layout']);
		unset($option['confirm_password']);
		unset($option['header']);
		unset($option['username']);
		unset($option['captcha']);
		unset($option['auth_key']);
		
		$seq = $option['seq'];
		unset($option['seq']);
		
		if ( $option['password'] ) $option['password'] = md5($option['password']);
		else unset($option['password']);
		
		return $sy['db']->update(MEMBER_TABLE, $option, array('seq'=>$seq));
		
	}
	
	// 회원 가입 중복 확인 처리 
	// 아이디 체크
	public function username_check( $username ) {
		global $sy;
		
		return $sy['db']->count(MEMBER_TABLE, array('username'=>$username));
	}
	
	// 닉네임 체크
	public function nickname_check( $nickname ) {
		global $sy;
		
		return $sy['db']->count(MEMBER_TABLE, array('nickname'=>$nickname));
	}
	
	// 사용금지 아이디, 닉네임 체크 
	public function check_account_nickname_for_cannot_be_used( $username ) {
		global $sy, $site_config;
		
		$accounts = array();
		$accounts = explode(",", $site_config['accounts_cannot_be_used']);
		return in_array($username, $accounts);
	}
	
	// 사용금지 이름 체크
	public function check_name_for_cannot_be_used ( $name ) {
		global $sy, $site_config;
		
		$names = array();
		$names = explode(",", $site_config['names_cannot_be_used']);
		return in_array($name, $names);
	}
	
	
	// 로그인 하기
	public function login($username, $password, $auto_login = 0, $ip_sec = 0) {
		global $sy;
		
		$row = $sy['db']->row("SELECT * FROM ". MEMBER_TABLE. " WHERE `username`='$username' AND `password`='".md5($password)."'");
		
		if ( $row ) {
			$login_info = array(
								'seq'=>$row['seq'],
								'gid'=>$row['gid'],
								'username'=>$row['username'],
								'name'=>$row['name'],
								'nickname'=>$row['nickname'],
								'block_stamp'=>$row['block_stamp'],
								'resign_stamp'=>$row['resign_stamp'],
			);
			
			/* IP 보안 옵션이 체크 되었다면, IP_SECURITY 테이블에 seq_member와 ip를 등록한다.
			 *  만약 이미 존재한다면, ip만 업데이트 한다.
			 *  또한 member 테이블의 use_ip_sec을 1로 업데이트 한다.
			*/
			if ( $ip_sec ) {
				// member 테이블의 use_ip_sec을 1로 업데이트 한다.
				if ( $sy['db']->update(MEMBER_TABLE, array('use_ip_sec'=>1), array('seq'=>$row['seq']) ) ) {
				   // 업데이트가 완료되었다면 ip security 테이블을 처리 한다.
				
					if ( $this->ip_sec_user_exists($row['seq']) ) { // 존재한다면 아이피 업데이트 
						$sy['db']->update(IP_SECURITY_TABLE, array('ip'=>ip_2_long($_SERVER['REMOTE_ADDR'])), array('seq_member'=>$row['seq']));
					}
					else { // 존재 하지 않는다면 테이블 추가
						$sy['db']->insert(IP_SECURITY_TABLE, array('seq_member'=>$row['seq'], 'ip'=>ip_2_long($_SERVER['REMOTE_ADDR'])));
					}
				}
			}
			else {
				// IP 보안 옵션이 체크 되지 않았다면, use_ip_sec을 0으로 업데이트 한다,
				$sy['db']->update(MEMBER_TABLE, array('use_ip_sec'=>0), array('seq'=>$row['seq']));
			}
			
			// 쿠키 지속 지간
			if ( $auto_login ) $expire_time = time() + ( 60 * 60 * 24 * 365 );
			else $expire_time = 0;
			
			setcookie(md5('login_info'), $sy['file']->scalar($login_info), $expire_time, "/", COOKIE_DOMAIN);
			
			$login_info['IP'] = $_SERVER['REMOTE_ADDR']; // 사용자 캐시에만 저장한다. 이는 통계를 위한 용도
			$login_info['time'] = time();
			$sy['file']->write_file(USERS_PATH . "/" . get_browser_id().".user", $sy['file']->scalar($login_info));
			
			return 1;
		}
	}
	
	// ip sec 확인 
	public function ip_sec_ip($seq_member) {
		global $sy;
		
		if ( $row = $sy['db']->row("SELECT ip FROM ". IP_SECURITY_TABLE . " WHERE `seq_member`='".$seq_member."'") ) {
			return $row['ip'];
		}
	}
	
	// ip sec에 등록된 사용자가 있는지 확인 한다.
	public function ip_sec_user_exists($seq_member) {
		global $sy;
		
		$option = array(
						'seq_member'=>$seq_member,
		);
		
		return $sy['db']->count(IP_SECURITY_TABLE, $option);
	}
	
	
	public function logout(){
		global $sy;
		$_SESSION = array();
		session_unset();
		session_destroy();
		
		if ( isset( $_COOKIE[session_name()])) {
			setcookie(session_name(), '', time() - 3600, "/", COOKIE_DOMAIN);
		}
		
		setcookie(md5('login_info'), '', time - 3600, "/", COOKIE_DOMAIN);
		
		$this->guest();
	}
	
	public function is_login() {
		global $_member;
		
		if ( $_member ) return 1;
	}
	
	// 탈퇴
	public function resign() {
		global $sy, $_member;
		
		if ( $_member ) {
			if ( $result = $sy['db']->update(MEMBER_TABLE, array('resign_stamp'=>time()), array('seq'=>$_member['seq']))) {
			
				// 정상적으로 탈퇴된 경우 로그아웃 한다.
				$this->logout();
				
				return $result;
			}
		}
	}
	
	// 탈퇴 여부 확인
	public function is_resign($seq) {
		global $sy;
		
		$conds = array();
		if ( is_numeric($seq) ) { // seq인 경우 
			$conds[] = "`seq` = '$seq'";
		} else { // username인 경우
			$conds[] = "`username`= '$seq'";
		}
		
		if ( $conds ) $where = " WHERE " . implode( " AND ", $conds );
	
		$row = $sy['db']->row("SELECT resign_stamp FROM ". MEMBER_TABLE. $where);
	
		return $row['resign_stamp'];
	}
	
	public function guest() {
		global $sy;
		if ( file_exists(USERS_PATH . "/" . get_browser_id().".stamp") ) {
			@unlink(USERS_PATH . "/" . get_browser_id().".stamp");
		}
		$sy['file']->write_file(USERS_PATH . "/" . get_browser_id().".user", 'GUEST');
	}
	
	public function current_user() {
		global $sy, $_member;
		
		$current_user = array();
		$current_user['guest'] = 0;
		$current_user['online'] = 0;
		
		$files = $sy['file']->readdir(USERS_PATH);
		if ( $files ) {
			foreach ( $files as $file ) {
				$data = $sy['file']->read_file(USERS_PATH . '/'.$file);
				$file_name = explode(".", $file);
				
				if ( empty($file_name[0]) ) @unlink(USERS_PATH . "/". $file);
				
				if ( $data == 'GUEST') {
					$current_user['guest']++;
				}
				else {
					if ( is_numeric($data) ) {
						// 5분 이상 활동이 없는 로그인한 회원은 자동으로 현재 접속자에서 제외시킨다.
						if ( $data <=  time() - (60 * 5)) {
							$file_names = explode(".", $file);
							@unlink(USERS_PATH . "/". $file);
							$sy['file']->write_file(USERS_PATH . "/".$file_names[0].".user", '');
						}
					}
					else {
						if ( $data ) {
							
							$_current_user = $sy['file']->unscalar($data);
							
							$current_user['users'][$_current_user['username']] = "<a href='?module=message&action=write&receiver=".$_current_user['username']."'>".$_current_user['nickname']."(".$_current_user['username'].")</a>";
							
							$sy['file']->write_file(USERS_PATH . "/" . get_browser_id() . '.stamp', time());	
						}
					}
				}
			}
		}
		$current_user['online'] = count($current_user['users']);
	
		return $current_user;
	}
	
	public function admin() {
		global $_member;
		if ( $_member['is_admin'] == 'Y' ) return 1;
	}
	
	public function info( $seq = null, $fields = null ) {
		global $sy, $_member;
		
		$where = null;
		
		if ( empty($fields) ) $fields = "seq, username, nickname, name";
		
		if ( $seq ) {
			if ( is_numeric($seq) ) $where = "`seq`=".$seq;
			else $where = "username = '".$seq."'";
		}
		else $where = "username = '".$_member['username']."'";
		
		if ( $where ) $where = " WHERE " . $where;
		
		return $sy['db']->row("SELECT $fields FROM ". MEMBER_TABLE . $where);
	}
	
	// 사용자 차단
	public function block( $seq ) {
		global $sy;
		
		$p = $sy['post']->single_post($seq, "seq_member,username,ip");
		
		$option = array(
						'seq_member'=>$p['seq_member'],
						'ip'=>$p['ip']
		);
		
		if ( $insert = $sy['db']->insert(BLOCK_TABLE, $option) ) {
			// 차단 테이블에 추가되었다면, 해당 사용자의 회원정보에 block_stamp를 업데이트 한다.
			$sy['db']->update(MEMBER_TABLE, array('block_stamp'=>time()), array('seq'=>$p['seq_member']));
			
			return $insert;
		}
	}
	
	// 코멘트 사용자 차단
	public function comment_block( $seq ) {
		global $sy;
		
		$p = $sy['db']->row("SELECT seq_member,username,ip FROM ". COMMENT_DATA_TABLE . " WHERE `seq`='$seq'");
		
		$option = array(
						'seq_member'=>$p['seq_member'],
						'ip'=>$p['ip']
		);
		
		if ( $insert = $sy['db']->insert(BLOCK_TABLE, $option) ) {
			// 차단 테이블에 추가되었다면, 해당 사용자의 회원정보에 block_stamp를 업데이트 한다.
			$sy['db']->update(MEMBER_TABLE, array('block_stamp'=>time()), array('seq'=>$p['seq_member']));
			
			return $insert_id;
		}
	}
	
	// 사용자 차단해제
	public function unblock( $seq ) {
		global $sy;
		
		$row = $sy['db']->row("SELECT seq_member FROM ".BLOCK_TABLE. " WHERE `seq`='".$seq."'");
		
		if ( $result =  $sy['db']->delete(BLOCK_TABLE, array('seq'=>$seq)) ) {
			// 차단 테이블에서 제거 되었다면, 해당 사용자의 회원정보에 block_stamp를 0으로 업데이트 한다.
			
			$sy['db']->update(MEMBER_TABLE, array('block_stamp'=>0), array('seq'=>$row['seq_member']));
			
			return $result;
		}
	}
	
	// 차단 확인
	public function check_block($seq = null) {
		global $sy, $_member;
		
		$ip = ip_2_long($_SERVER['REMOTE_ADDR']);
		
		$block_no = null;
		
		$member = null;
		
		$p = $sy['post']->single_post($in['seq'], "seq_member");
		
		if ( $seq ) $member = $p['seq_member'];
		else $member = $_member['seq'];
		
		
		if ($row = $sy['db']->row("SELECT seq FROM ".BLOCK_TABLE . " WHERE `ip`='".$ip."'")) $block_no = $row['seq'];
		
		if ( $row = $sy['db']->row("SELECT seq FROM ". BLOCK_TABLE. " WHERE `seq_member`='{$member}'") ) $block_no = $row['seq'];
		
		return $block_no;
	}
	
	// 코멘트 차단 확인
	public function check_comment_block($seq = null ) {
		global $sy, $_member;
		
		$ip = ip_2_long($_SERVER['REMOTE_ADDR']);
		
		$block_no = null;
		
		$member = null;
		
		$p = $sy['db']->row("SELECT seq_member FROM " .COMMENT_DATA_TABLE . " WHERE `seq`='$seq'");
		
		if ( $seq ) $member = $p['seq_member'];
		else $member = $_member['seq'];
		
		
		if ($row = $sy['db']->row("SELECT seq FROM ".BLOCK_TABLE . " WHERE `ip`='".$ip."'")) $block_no = $row['seq'];
		
		if ( $row = $sy['db']->row("SELECT seq FROM ". BLOCK_TABLE. " WHERE `seq_member`='{$member}'") ) $block_no = $row['seq'];
		
		return $block_no;
	}
	
	// 차단 회원 리스트
	public function block_list($page_no = 1, $no_of_post = 20, $domain = null) {
		global $sy;
		
		$start = ($page_no - 1 ) * $no_of_post;
		
		$limit= " LIMIT $start, $no_of_post ";
		
		$conds = null;
		if ( $domain ) $conds = " WHERE `domain`='".$doamin."'"; 
		
		$query = "SELECT * FROM ". BLOCK_TABLE . " $conds ORDER BY seq DESC $limit";
		
		$rows = $sy['db']->rows($query);
		
		return $rows;
	}
	
	// 총 차단 회원 수
	public function total_block_list($domain = null) {
		global $sy;
		
		$conds = null;
		if ( $domain ) $conds = " WHERE `domain`='".$doamin."'"; 
		
		$query = "SELECT COUNT(*) as cnt FROM " . BLOCK_TABLE.$conds;
		
		$row = $sy['db']->row($query);
		
		return $row['cnt'];
	}
	
	// 포인트 가져오기
	public function my_point() {
		global $sy, $_member;
		
		$row =  $sy['db']->row("SELECT point FROM ".MEMBER_TABLE." WHERE seq='".$_member['seq']."'");
		
		return $row['point'];
	}
	
	// 포인트 업데이트
	public function update_my_point( $comment = null) {
		global $sy, $_member, $post_cfg;
		
		$current_point = $this->my_point();
		if ( $comment ) { // 코멘트 인 경우
			$add_point = $post_cfg['comment_point'];
		}
		else { // 일반 글인 경우 
			$add_point = $post_cfg['point'];
		}
		
		$point = $current_point + $add_point;
		
		return $sy['db']->update(MEMBER_TABLE, array('point'=>$point), array('seq'=>$_member['seq']));
	}
	
	// 프로파일 사진 가져오기
	public function profile_photo( $gid, $width = 100, $height = 100 ) {
		global $sy;
		
		if ( is_numeric($gid) ) { // seq_member가 들어온 경우
			$info = $this->info($gid, "gid");
			$g = $info['gid'];
		}
		else $g = $gid;
		
		$files = $sy['file']->files_by_gid($g);
		
		return imageresize ( $files[0]['seq'], $width, $height );
		
	}
	
	
	// 이메일 체크
	public function check_email( $email ) {
		global $sy;
		
		return $sy['db']->count(MEMBER_TABLE, array('email'=>$email));
	}
	
	// 아이디 찾기
	public function find_username($name, $email) {
		global $sy;
		
		$row = $sy['db']->row("SELECT username FROM " . MEMBER_TABLE . " WHERE name='".$name."' AND email='".$email."'");
		
		return $row['username'];
	}
	
	// 비밀번호 찾기에서 사용자 확인
	public function validate_username($username, $email ) {
		global $sy;
		
		$row = $sy['db']->row("SELECT seq, name FROM " . MEMBER_TABLE . " WHERE username='".$username."' AND email='".$email."'");
		
		return $row;
	}
	
	// 로그인 URL 
	public function login_url() {
		
		return "?module=member&action=login_page";
	}
	
	// 포인트별 레벨 체크
	public function level( $point) {
		global $site_config, $sy;
		
		if ( empty($point) ) $point = 0;
		
		$level = array();
		$level = $sy['file']->unscalar($site_config['level']);
		$level[0] = 0;
		$rank = 1;
		for ( $i=1; $i< 21; $i++ ) {
			if ( $point >= $level[$i-1] && $point > $level[$i] ) $rank = $i;
			else break;
		}
		
		return $rank;
	}
	
	// 가입 인증 주소
	public function register_auth_confirm_url( $auth_key ) {
		
		$url = site_url() . "/?module=member&action=register&auth_key=".$auth_key;
		
		return $url;
	}
	
	// 회원가입 인증 시도가 있었는지 확인
	public function check_register_auth ( $email ) {
		global $sy;
		
		$row = $sy['db']->row("SELECT auth_key FROM " . REGISTER_AUTH_TABLE . " WHERE `email`= '".$email."'");
		
		return $row['auth_key'];
	}
	
	
	// 회원가입 인증 테이블에 추가
	public function insert_register_auth( $option ) {
		global $sy;
		
		$op = array(
					'email'=>$option['email'],
					'auth_key'=>$option['auth_key']
		);
		
		return $sy['db']->insert(REGISTER_AUTH_TABLE, $op);
	}
	
	// 가입 인증 된 이메일 주소
	public function register_auth_email($auth_key) {
		global $sy;
		
		$row = $sy['db']->row("SELECT email FROM " . REGISTER_AUTH_TABLE . " WHERE `auth_key`='".$auth_key."'");
		
		return $row['email'];
	}
	
	public function check_admin_in_db() {
		global $sy, $_member;
		
		$row = $sy['db']->row("SELECT is_admin FROM " . MEMBER_TABLE . " WHERE `seq`='".$_member['seq']."'");
		
		if ( $row['is_admin'] == 'Y' ) return 1;
	}
	
	public function current_user_update() {
		global $sy;
		
		$dirs = $sy['file']->readdir(USERS_PATH);
		$files = array();
		if ( $dirs ) {
			foreach ( $dirs as $file ) {
				$name = explode(".", $file);
				$files[$name[0]][] = $name[1];
			}
			
			foreach ( $files as $key => $value ) {
				if ( count($value) == 1 ) { // 로그인 기록이 없는 경우.
					//파이어 폭스에서는 beforeunload가 동작하지 않기 때문에 로그인 하지 않은 경우는 10분에 한번씩 확인을 한다,
					if ( filemtime(USERS_PATH . '/'.$key.".".$value[0]) <= time() - (60 * 10) ) {
						@unlink(USERS_PATH . '/'.$key.".".$value[0]);
					}
				}
			}
		}
	}
	
	// visitor_referral
	public function visitor_referral($query = null, $page_no = 1, $no_of_posts = 20) {
		global $sy;
			
		if ( empty($query) ) $query = "SELECT * FROM " . VISITOR_STAT_TABLE;
			
		$start = ( $page_no - 1 ) * $no_of_posts;
			
		$query .= " ORDER BY stamp DESC LIMIT $start, $no_of_posts";
			
		return $sy['db']->rows($query);
			
	}
	
	public function total_visitor_referral($conds = null) {
		global $sy;
		$query = "SELECT COUNT(*) as cnt FROM " . VISITOR_STAT_TABLE;
			
		if ( $conds ) $query .= $conds;
			
		$count = $sy['db']->row($query);
			
		return $count['cnt'];
	}
}
?>