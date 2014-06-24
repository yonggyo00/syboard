<?php
class admin {
	
	// 중복 도메인 체크
	public function chk_site_domain( $domain ) {
		global $sy;
		return $sy['db']->count( SITE_CONFIG, array('domain'=>$domain) );
	}
	
	// 사이트 추가
	public function add_domain( $option ) {
		global $sy;
		$op = array(
			'title'=>$option['site_title'],
			'domain'=>$option['site_domain'],
			'layout'=>$option['site_layout']
			
		);
		
		return $sy['db']->insert( SITE_CONFIG, $op );
	}

    // 사이트 목록
	public function site_list ( $fields = '*') {
		global $sy;
		
		return $sy['db']->rows("SELECT $fields FROM ".SITE_CONFIG);
	}
	
	
	// 사이트 레이아웃 셀렉트 박스
	public function sel_site_layout( $layout = null ) {
		global $sy;
		
		ob_start();
		$layout_dir = $sy['file']->readdir( INDEX_PATH );
		$layout_desc = array();
		foreach ( $layout_dir as $dir ) {
			include INDEX_PATH . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . 'desc.php';
			$layout_desc[$dir] = $desc;
		}
		echo "<select name='site_layout'>
				<option value=''>레이아웃 선택</option>
				<option value=''></option>";
		foreach ( $layout_desc as $key => $value ) {
			if ( $layout ) {
				if ( $layout == $key ) $selected = 'selected';
				else $selected = null;
			}
			echo "<option value='$key' $selected>$value[name]</option>";
		}
		echo "</select>";
		$sel_site_layout = ob_get_clean();
		
		return $sel_site_layout;
	}
	
	
	// 스킨 목록을 종류 별로 가져온다.
	public function skin_list( $skinname, $skin_value = null ) {
		global $sy;
		
		ob_start();
		
		$skin_dir = $sy['file']->readdir( SKIN_PATH . '/'.$skinname );
		
		$skin_desc = array();
		foreach ( $skin_dir as $dir ) {
			include SKIN_PATH .'/'.$skinname.'/'.$dir.'/desc.php';
			$skin_desc[$dir] = $desc['name'];
		}
		echo "<select name='{$skinname}_skin'>
				<option value=''>스킨선택</option>
				<option value=''></option>";
		foreach ( $skin_desc as $key => $value ) {
			if  ( $skin_value ) {
				if ( $skin_value == $key ) $selected = 'selected';
				else $selected = null;
			}
			echo "<option value='$key' $selected>$value</option>";
		}
		echo "</select>";
		
		$sel_skin_list = ob_get_clean();
		return $sel_skin_list;
	}
	
	public function create_post_id( $post_id, $subject ) {
		global $sy;
		
		$msg = null;
		
		// 동일한 게시판 아이디가 있는지 확인 한다.
		if ( $sy['db']->count(POST_CONFIG, array('post_id'=>$post_id)) ) {
			return $sy['js']->alert("게시판 아이디가 이미 존재합니다.");
		}
		else {
			$option = array(
					'post_id'=>$post_id,
					'subject'=>$subject
			);
			
			return $sy['db']->insert(POST_CONFIG, $option);
		}
	}
	
	public function list_post_id() {
		global $sy;
		
		return $sy['db']->rows("SELECT seq, post_id, subject, no_of_post FROM ".POST_CONFIG);
	}
	
	public function post_cfg($post_id) {
		global $sy;
		
		return $sy['post']->post_cfg($post_id);
	}

	public function delete_post_id( $post_id ) {
		global $sy;
		
		return $sy['db']->delete(POST_CONFIG, array('post_id' => $post_id));	
	}
	
	public function post_cfg_update( $option ) {
		global $sy;
		unset($option['module']);
		unset($option['action']);
		unset($option['option']);
		unset($option['layout']);
		unset($option['mode']);
		unset($option['edit_done']);
		unset($option['post_id']);
		
		$seq = $option['seq'];
		
		unset($option['seq']);
		
		if ( empty($option['show_list_category']) ) $option['show_list_category'] = 0;
		if ( empty($option['show_write_category']) ) $option['show_write_category'] = 0;
		if ( empty($option['map_use']) ) $option['map_use'] = 0;
		if ( empty($option['blog_api_use']) ) $option['blog_api_use'] = 0;
		if ( empty($option['view_with_list']) ) $option['view_with_list'] = 0;
		if ( empty($option['view_with_comment']) ) $option['view_with_comment'] = 0;
		if ( empty($option['view_with_comment_list']) ) $option['view_with_comment_list'] = 0;
		if ( empty($option['use_login_post']) ) $option['use_login_post'] = 0;
		if ( empty($option['use_secret']) ) $option['use_secret'] = 0;
		if ( empty($option['show_ip_view']) ) $option['show_ip_view'] = 0;
		if ( empty($option['show_ip_comment']) ) $option['show_ip_comment'] = 0;
		if ( empty($option['use_view_vote']) ) $option['use_view_vote'] = 0;
		if ( empty($option['use_comment_vote']) ) $option['use_comment_vote'] = 0;
		if ( empty($option['view_level'] ) ) $option['view_level'] = 0;
		if ( empty($option['write_level'] ) ) $option['write_level'] = 0;
		if ( empty($option['list_level'] ) ) $option['list_level'] = 0;
		if ( empty($option['comment_write_level'] ) ) $option['comment_write_level'] = 0;
		if ( empty($option['map_use'] ) ) $option['map_use'] = 0;
		if ( empty($option['use_editor'] ) ) $option['use_editor'] = 0;
		
		if ( $option['keywords'] ) $option['keywords'] = strip_tags($option['keywords']);
		
		if ( $option['description'] ) {
			$option['description'] = str_replace("\\r\\n", "", $option['description']);
			$option['description'] = strip_tags($option['description']);
		}
		
		return $sy['db']->update(POST_CONFIG, $option, array('seq'=>$seq));
	}
	
	
	public function site_config($seq, $fields='*') {
		global $sy;
		
		$query = null;
		if ( is_numeric($seq) ) { // seq인 경우
			$query = "SELECT $fields FROM ". SITE_CONFIG . " WHERE `seq`='".$seq."'";
		}
		else $query = "SELECT $fields FROM ". SITE_CONFIG . " WHERE `domain`='".$seq."'";
		
		return $sy['db']->row($query);
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
	
	public function add_popup_config( $domain ) {
		global $sy;
		
		// 팝업 설정이 이미 존재하는지를 확인 한 후 존재하지 않는다면 팝업 설정을 생성한다.
		
		if ( !$sy['db']->count(POPUP_CONFIG_TABLE, array('domain'=>$domain)) ) {
			return $sy['db']->insert(POPUP_CONFIG_TABLE, array('domain'=>$domain));
		}
	}
	
	public function delete_popup_config($seq) {
		global $sy;
		
		return $sy['db']->delete(POPUP_CONFIG_TABLE, array('seq'=>$seq));
	}
	
	public function popup_config_list() {
		global $sy;
		
		return $sy['db']->rows("SELECT seq, domain FROM ". POPUP_CONFIG_TABLE . " ORDER BY seq DESC");
	}
	
	public function popup_config($seq = null) {
		global $sy, $site_config;
			
		if ( empty($seq) ) $seq = $site_config['domain'];
		
		$conds = null;
		
		if ( is_numeric($seq) ) { // seq 인 경우
			$conds = "`seq`=$seq";
		}
		else { // 도메인인 경우
			$conds = "`domain`='$seq'";
		}
		
		if ( $conds ) {
			return $sy['db']->row("SELECT * FROM ". POPUP_CONFIG_TABLE . " WHERE $conds");
		}
	}
	
	public function update_popup_config ( $seq, $data ) {
		global $sy;
		
		return $sy['db']->update(POPUP_CONFIG_TABLE, array('value'=>$data), array('seq'=>$seq));
	}
}
?>