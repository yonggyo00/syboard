<?php
class post{

	public function post_cfg( $post_id, $fields = '*' ) {
		global $sy;
		
		return $sy['db']->row("SELECT $fields FROM ".POST_CONFIG." WHERE post_id='$post_id'");
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
		if ( empty($option['use_post_list_search_form']) ) $option['use_post_list_search_form'] = 0;
		if ( empty($option['delete_cache_when_posted']) ) $option['delete_cache_when_posted'] = 0;
		
		if ( $option['keywords'] ) $option['keywords'] = strip_tags($option['keywords']);
		
		if ( $option['description'] ) {
			$option['description'] = str_replace("\\r\\n", "", $option['description']);
			$option['description'] = strip_tags($option['description']);
		}
		
		return $sy['db']->update(POST_CONFIG, $option, array('seq'=>$seq));
	}
	
	public function write( $option ) {
		global $sy, $_member, $post_cfg;
		
		if ( $post_cfg['use_editor'] ) {
			$content_start = strpos($option['content'], "<body>");
			$content_end = strpos($option['content'], "</body>");
			
			
			$content = trim(substr($option['content'], $content_start + 6, $content_end - ($content_start + 6)));
			
			$content = str_replace("\\r\\n", "", $content);
			
			$option['editor_used'] = 1; // 동적 에디터를 사용한 경우
		}
		else {
			$content = $option['content'];
		}
		
		$content_stripped = stringcut( strip_tags($content), 400 );
		
		$option['subject'] = strip_tags(xss_clean($option['subject']) );
		
		if ( $option['subject'] && $content ) {
			if ( $option['guest_username'] ) {
				$option['seq_member'] = 0;
				$option['username'] = 'GUEST';
				$option['nickname'] = $option['guest_username'];
				if ( $option['guest_secret'] ) $option['guest_secret'] = md5($option['guest_secret']);
				unset($option['guest_username']);
			}
			else {
				if ( $_member ) {
					$option['seq_member'] = $_member['seq'];
					$option['username'] = $_member['username'];
					$option['nickname'] = $_member['nickname'];
				}
			}
		
		if ( $option['secret'] ) $option['secret'] = md5($option['secret']);
		$option['content'] =xss_clean($content);
		$option['content_stripped'] = xss_clean($content_stripped);
		$option['stamp'] = time();
		$option['user_agent'] = user_agent();
		$option['ip'] = ip_2_long($_SERVER['REMOTE_ADDR']);
		
		if ( empty($option['first_image']) ) $option['first_image'] = 0;
		if ( empty($option['first_video']) ) $option['first_video'] = 0;
		if ( empty($option['first_file']) ) $option['first_file'] = 0;
		
		unset($option['module']);
		unset($option['action']);
		unset($option['layout']);
		
			return $sy['db']->insert(POST_DATA_TABLE, $option);
		}
		else {
			return $sy['js']->alert(lang('post class error1'));
		}
	}
	
	
	public function update( $option ) {
		global $sy, $post_cfg;
		
		unset($option['module']);
		unset($option['action']);
		unset($option['layout']);
		unset($option['mode']);
		if ( $option['guest_username'] ) unset($option['guest_username']);
		if ( $option['guest_secret'] ) unset($option['guest_secret']);
		
		$seq = $option['seq'];
		
		unset($option['seq']);
		
		if ( ($post_cfg['use_editor'] && $option['editor_used']) || (empty($post_cfg['use_editor']) && $option['editor_used'] ) ) {
			$content_start = strpos($option['content'], "<body>");
			$content_end = strpos($option['content'], "</body>");
			
			
			$content = trim(substr($option['content'], $content_start + 6, $content_end - ($content_start + 6)));
			
			$content = str_replace("\\r\\n", "", $content);
			$content = $sy['db']->escape($content);
		}
		else {
			$content = $sy['db']->escape($option['content']);
		}
		
		$content_stripped = stringcut( strip_tags($content), 400 );
		
		$option['subject'] = strip_tags(xss_clean($option['subject']));
		
		if ( $option['subject'] && $content ) {
			$option['content'] = xss_clean($content);
			$option['content_stripped'] = xss_clean($content_stripped);
			if ( $option['secret'] ) $option['secret'] = md5($option['secret']);
			
			if ( empty($option['use_secret']) ) $option['use_secret'] = 0;
			
			return $sy['db']->update(POST_DATA_TABLE, $option, array('seq'=> $seq));
			
		}
		else {
			return $sy['js']->alert(lang('post class error1'));
		}
	}
	
	public function delete( $seq ) {
		global $sy;
		
		return $sy['db']->update( POST_DATA_TABLE, array('deleted'=>'Y'), array('seq'=>$seq) );
	}
	
	public function delete_comment( $seq ) {
		global $sy;
		
		return $sy['db']->update( COMMENT_DATA_TABLE, array('deleted'=>'Y'), array('seq'=>$seq) );
	}
	
	public function single_post ( $seq, $fields = null ) {
		global $sy;
		
		if ( empty($fields) ) $fields = "*";
		
		return $sy['db']->row("SELECT $fields FROM " .POST_DATA_TABLE . " WHERE seq='".$seq."'");
	}
	
	public function posts ( $query, $page_no = 1, $no_of_posts = 20, $order = 'stamp DESC' ) {
		global $sy;
		
		$pno = $this->page_no($page_no);
		$start = ($pno - 1) * $no_of_posts;
		
		$query .= " ORDER BY $order LIMIT $start, $no_of_posts ";
		
		return $sy['db']->rows($query);
	}
	
	// 캐쉬된 최근글 가져오기
	public function latest_posts($query, $cache_name = null, $cache_min = 20,  $page_no = 1, $no_of_posts = 20, $order = 'stamp DESC') {
		global $sy, $site_config;
		
		$pno = $this->page_no($page_no);
		$start = ($pno - 1) * $no_of_posts;
		if ( $cache_name ) $filename = $cache_name."_".$start."_".$no_of_posts.".cache";
		else $filename = md5($query)."_".$start."_".$no_of_posts.".cache";
		
		
		$filename = CACHE_PATH . "/".$filename;
		
		$posts = null;
		
		if ( file_exists($filename) && $site_config['use_cache'] ) {
			if ( filemtime($filename) <= time() - (60 * $cache_min) ) {
				@unlink($filename);
				$sy['debug']->log("CACHE - $filename (Deleting Post Latest Cache File)");
			}
			
			
		}
		
		
		if ( file_exists($filename) && $site_config['use_cache'] ) {
			$posts  = $sy['file']->unscalar($sy['file']->read_file($filename));
			$sy['debug']->log("CACHE - $filename (Using Post Latest Cache File)");
		}
		else {
			$query .= " ORDER BY $order LIMIT $start, $no_of_posts ";
			
			$posts = $sy['db']->rows($query);
			
			$data = $sy['file']->scalar($posts);
			
			if ( $site_config['use_cache'] ) {
				$sy['file']->write_file($filename, $data);
				$sy['debug']->log("CACHE - $filename (Creating Post Latest Cache File)");
			}
		}
		
		return $posts;
		
	}
	
	
	public function page_no( $page_no ) {
		
		if ( empty($page_no) ) $page_no = 1;
		return $page_no;
	}
	
	public function total_post($option ) {
		global $sy;
		
		return $sy['db']->count(POST_DATA_TABLE, $option);
	}
	
	public function update_total_post($post_id ) {
		global $sy;
		
		$count = $sy['db']->count(POST_DATA_TABLE, array('post_id'=>$post_id));
		
		return $sy['db']->update(POST_CONFIG, array('no_of_post'=>$count), array('post_id'=>$post_id));
	}
	
	public function view_url ( $seq ) {
		global $in;
		
		$url = "?module=post&action=view&seq=".$seq;
		
		if ( $in['nav_no'] ) $url .= "&nav_no=".$in['nav_no'];
		if ( $in['page_no'] ) $url .= "&page_no=".$in['page_no'];
		
		return $url;
	}
	
	public function write_url ( $post_id ) {
		return "?module=post&action=write&post_id=".$post_id;
	}
	
	public function list_url ( $post_id, $category = null, $sub_category = null ) {
		$url = "?module=post&action=list&post_id=".$post_id;
		
		if ( $category ) $url .= "&category=".$category;
		if ( $sub_category ) $url .= "&sub_category=".$sub_category;
		
		return $url;
	}
	
	public function update_url ( $seq, $mode = 0 ) {
	
		$url = "?module=post&action=update&seq=".$seq;
		if ( $mode && !admin() && !$this->admin() && !site_admin() ) $url = $this->view_guest_secret_check_url($seq);
		
		return $url;
	}
	
	public function delete_url ( $seq, $post_id, $mode = 0 ) {
		$url = "?module=post&action=delete&seq=".$seq;
		if ( $post_id ) $url .= "&post_id=".$post_id;
		
		if ( $mode && !admin() && !$this->admin() && !site_admin()) $url = $this->view_guest_secret_check_url($seq, 1, $post_id);
		
		return $url;
	}
	
	// 비밀글인 경우
	public function view_secret_check_url ( $seq ) {
		return "?module=post&action=secret_check&seq=".$seq;
	}
	
	// 게스트 글인 경우
	public function view_guest_secret_check_url ( $seq, $mode = 0, $pid = null ) {
	
		$url = "?module=post&action=guest_secret_check&seq=".$seq;
		
		if ( $pid && $mode ) $url .= "&post_id=".$pid."&mode=1";
		
		return $url;
	}
	
	public function my_post($seq) {
		global $_member;
		
		if ( $seq == $_member['seq'] ) return 1;
	}
	
	public function admin() {
		global $sy, $in, $post_cfg, $_member;
		if ( $sy['mb']->is_login() ) {
		
			if ( $in['post_id'] ) {
				$admins = explode(",", $post_cfg['admin']);
				
				return in_array($_member['username'], $admins);
				
			}
		}
	}
	
	// 댓글 
	public function write_root_comment( $option ) {
		global $sy, $_member;
		
		unset($option['module']);
		unset($option['action']);
		unset($option['layout']);
		unset($option['header']);
		unset($option['seq']);
		unset($option['captcha']);
		unset($option['nav_no']);
		unset($option['page_no']);
		unset($option['post_id']);
		unset($option['header']);
		
		if ( $option['secret'] ) $option['secret'] = md5($option['secret']);
		
		// list_order의 root는 10000씩 증가하게 하고, 댓글의 댓글인 경우는 10001부터 증가하게 한다.
		// 댓글의 갯수는 현재 등록된 댓글 개수를 가져오고 그 등록된 수의 + 1을 하여 10000을 곱한다.
		$no_of_comment = $this->count_comment($option['seq_root']) + 1;
		
		$option['list_order'] = 10000 * $no_of_comment;
		
		$option['content'] = str_replace("\\r\\n", "", $option['content']);
		
		$option['content_stripped'] = strip_tags($option['content']);
		$option['stamp'] = time();
		
		if ( $sy['mb']->is_login() ) {
			$option['seq_member'] = $_member['seq'];
			$option['username'] = $_member['username'];
			$option['nickname'] = $_member['nickname'];
		}
		else if ( !$sy['mb']->is_login() && $option['guest_username'] ) {
			$option['seq_member'] = 0;
			$option['username'] = 'GUEST';
			$option['nickname'] = $option['guest_username'];
			unset($option['guest_username']);
		}
		
		$option['user_agent'] = user_agent();
		$option['ip'] = ip_2_long($_SERVER['REMOTE_ADDR']);
		
		$insert_id =  $sy['db']->insert(COMMENT_DATA_TABLE, $option);
		
		if ( $insert_id ) {
			// 코멘트 갯수를 증가시킨다.
			$sy['db']->update(POST_DATA_TABLE, array('no_of_comment'=>$no_of_comment), array('seq'=>$option['seq_root']));
		}
		return $insert_id;
	}
	
	public function write_child_comment( $option ) {
		global $sy, $_member;
		
		unset($option['module']);
		unset($option['action']);
		unset($option['layout']);
		unset($option['header']);
		unset($option['seq']);
		unset($option['captcha']);
		unset($option['nav_no']);
		unset($option['page_no']);
		unset($option['post_id']);
		unset($option['header']);
		
		if ( $option['secret'] ) $option['secret'] = md5($option['secret']);
		
		$no_of_comment = $this->count_comment($option['seq_root'], $option['seq_parent']) + 1;
		
		$option['list_order'] = $option['list_order'] + $no_of_comment;
		
		$option['content'] = str_replace("\\r\\n", "", $option['content']);
		
		$option['content_stripped'] = strip_tags($option['content']);
		$option['stamp'] = time();
		if ( $sy['mb']->is_login() ) {
			$option['seq_member'] = $_member['seq'];
			$option['username'] = $_member['username'];
			$option['nickname'] = $_member['nickname'];
		}
		else if ( !$sy['mb']->is_login() && $option['guest_username'] ) {
			$option['seq_member'] = 0;
			$option['username'] = 'GUEST';
			$option['nickname'] = $option['guest_username'];
			unset($option['guest_username']);
		}
		
		$option['user_agent'] = user_agent();
		$option['ip'] = ip_2_long($_SERVER['REMOTE_ADDR']);
		
		$insert_id = $sy['db']->insert(COMMENT_DATA_TABLE, $option);
		
		if ( $insert_id ) {
			$no_of_root_comment = $this->count_comment($option['seq_root']);
			// 코멘트 갯수를 증가시킨다.
			$sy['db']->update(POST_DATA_TABLE, array('no_of_comment'=>$no_of_root_comment), array('seq'=>$option['seq_root']));
		}
		return $insert_id;
		
	}
	
	public function count_comment( $seq_root, $seq_parent = null ) {
		global $sy;
		
		$option = array(
						'deleted'=>'N',
						'seq_root'=>$seq_root
		);
		
		if ( $seq_parent ) $option['seq_parent'] = $seq_parent;
		return $sy['db']->count(COMMENT_DATA_TABLE, $option);
	}
	
	public function comment_list ( $seq_root ) {
		global $sy;
		
		return $sy['db']->rows("SELECT * FROM ".COMMENT_DATA_TABLE . " WHERE `seq_root`=".$seq_root." AND deleted='N' ORDER BY list_order ASC");
	}
	// 본 글에 투표를 했는지 여부를 확인 한다.
	public function is_voted ( $seq_post, $seq_member ) {
		global $sy;
		
		return $sy['db']->count(VOTE_TABLE, array('seq_post'=>$seq_post, 'seq_member'=>$seq_member));
	}
	
	// 댓글에 투표를 했는지 여부를 확인 한다.
	public function is_comment_voted ( $seq_comment, $seq_member ) {
		global $sy;
		
		return $sy['db']->count(VOTE_COMMENT_TABLE, array('seq_comment'=>$seq_comment, 'seq_member'=>$seq_member));
	}
	
	// 투표 
	public function vote ( $option ) {
		global $sy, $_member;
		if ( $sy['mb']->is_login() ) {
			if ( $this->is_voted($option['seq_post'], $_member['seq'])) {
				return $sy['js']->alert(lang('post class already voted'));
			} else {
				$op = array(
							'seq_post'=>$option['seq_post'],
							'seq_member'=>$_member['seq']
				);
				$sy['db']->insert(VOTE_TABLE, $op );
				
				// 기존 투표 정보를 가져오고 모드에 따라 업데이트 한다.
				$p = $sy['db']->row("SELECT good, bad FROM ". POST_DATA_TABLE . " WHERE `seq`='".$option['seq_post']."'");
				
				if ( $option['mode'] == 'good' ) {
					$op1 = array('good'=>$p['good']+1);
				}
				else if ( $option['mode'] == 'bad' ) {
					$op1 = array('bad'=>$p['bad']+1);
				}
				
				$sy['db']->update(POST_DATA_TABLE, $op1, array('seq'=>$option['seq_post']));
					
				return $sy['js']->alert(lang('post class voted'));
			}
		} else {
			return $sy['js']->alert(lang('post class error2'));
		}
	}
	
	public function vote_comment ( $option ) {
		global $sy, $_member;
		if ( $sy['mb']->is_login() ) {
			if ( $this->is_comment_voted($option['seq_comment'], $_member['seq'])) {
				return $sy['js']->alert(lang('post class already voted'));
			} else {
				$op = array(
							'seq_comment'=>$option['seq_comment'],
							'seq_member'=>$_member['seq']
				);
				$sy['db']->insert(VOTE_COMMENT_TABLE, $op );
				
				// 기존 투표 정보를 가져오고 모드에 따라 업데이트 한다.
				$p = $sy['db']->row("SELECT good, bad FROM ". COMMENT_DATA_TABLE . " WHERE `seq`='".$option['seq_comment']."'");
				
				if ( $option['mode'] == 'good' ) {
					$op1 = array('good'=>$p['good']+1);
				}
				else if ( $option['mode'] == 'bad' ) {
					$op1 = array('bad'=>$p['bad']+1);
				}
				
				$sy['db']->update(COMMENT_DATA_TABLE, $op1, array('seq'=>$option['seq_comment']));
					
				return $sy['js']->alert(lang('post class voted'));
			}
		} else {
			return $sy['js']->alert(lang('post class error2'));
		}
	}
	
	public function is_my_comment ( $seq ) {
		global $_member;
		
		if ( $seq == $_member['seq'] ) return 1;

	}
	
	public function single_comment ( $seq ) {
		global $sy;
		
		return $sy['db']->row("SELECT * FROM " . COMMENT_DATA_TABLE . " WHERE `seq`='".$seq."'");
	}
	
	public function check_view_count ( $seq ) {
		global $sy;
		
		$view_count = md5(get_browser_id().$seq);
		
		return $sy['db']->count(VIEW_COUNT_TABLE, array('value'=>$view_count));
	}
	
	public function increase_view_count ( $seq ) {
		global $sy;
		
		$view_count = md5(get_browser_id().$seq);
		
		if ( $view_count ) {
			$option = array(
							'value'=>$view_count,
							'stamp'=>time()
			);
			
			$sy['db']->insert(VIEW_COUNT_TABLE, $option);
			
			// 게시글의 뷰카운트를 증가시킨다.
			$p = $sy['db']->row("SELECT no_of_view FROM " . POST_DATA_TABLE . " WHERE `seq`='".$seq."'");
			
			return $sy['db']->update(POST_DATA_TABLE, array('no_of_view'=>$p['no_of_view']+1), array('seq'=>$seq));
		}
	}
	
	public function keywords_update( $keywords ) {
		global $sy, $site_config;
		$domain = $site_config['domain'];
		
		foreach ( $keywords as $key ) {
			if ( $key ) {
				if ( $this->keyword_check($key) ) {
					// 키워드가 존재하면 카운트를 증가시킨다.
					$row = $sy['db']->row("SELECT seq, count FROM " . KEYWORD_TABLE . " WHERE `domain` = '$domain' AND `keyword`='$key'");
					
					$sy['db']->update(KEYWORD_TABLE, array('count'=>$row['count']+1), array('seq'=>$row['seq']));
				}
				else {
					$sy['db']->insert(KEYWORD_TABLE, array('domain'=>$domain, 'keyword'=>$key));
				}
			}
		}
		
	}
	
	public function keyword_check ( $keyword ) {
		global $sy, $site_config;
		$domain = $site_config['domain'];
		
		return $sy['db']->count(KEYWORD_TABLE, array('domain'=>$domain, 'keyword'=>$keyword));
	}
	
	
	// 게시판 아이디를 리턴한다. 다만  사이트 설정에서 검색되지 않도록 설정된 것은 제외한다.
	public function post_ids($bool = 0) {
		global $sy, $site_config;
		
		$not_searching = explode(",", $site_config['not_searching_forum']);

		$rows_filtered = array();
		$rows =  $sy['db']->rows("SELECT post_id, subject FROM ".POST_CONFIG." ORDER BY seq DESC");
		
		if ( $rows ) {
			foreach ( $rows as $row ) {
				if ( in_array($row['post_id'], $not_searching) && $bool != 1)  continue;
				else $rows_filtered[] = $row;
			}
		}
		
		return $rows_filtered;
	}
	
	
	// 블로그 계정 정보
	public function blog_apis() {
		global $site_config, $sy;
		
		return $sy['file']->unscalar($site_config['blog_api']);
	}
	
	
	// 금지어 체크 
	public function blocked_words ( $words ) {
		global $site_config;
		
		$bw = explode(",", $site_config['words_cannot_be_used']);
		
		$w = array();
		foreach ( $bw as $word ) {
			if ( preg_match("/$word/i", $words) ) {
				$w[] = $word;
			}
		}
		
		if ( $w ) return implode(",", $w);
	}
	
	
	// 공지 데이터 가져오기 
	public function reminder($post_id) {
		global $sy;
		
		
		return $sy['db']->rows("SELECT seq, subject FROM ".POST_DATA_TABLE." WHERE reminder='1' AND deleted='N' AND post_id='".$post_id."' ORDER BY stamp DESC");
	
	}
	
	// 게시판 존재 여부 확인 
	public function post_id_exist( $post_id ) {
		global $sy;
		
		return $sy['db']->count(POST_CONFIG, array('post_id'=>$post_id));
	}
	
	// 게시물 이동
	public function move_post ( $seq, $post_id ) {
		global $sy;
		
		return $sy['db']->update(POST_DATA_TABLE, array('post_id'=>$post_id), array('seq'=>$seq));
	}
	
	// 스크랩 
	public function scrap ( $seq ) {
		global $sy, $_member;
		
		$option = array(
						'seq_member'=>$_member['seq'],
						'seq_post' => $seq,
		);
		return $sy['db']->insert(SCRAP_TABLE, $option);
	}
	
	// 스크랩 여부 확인
	public function is_scrapped ( $seq ) {
		global $sy, $_member;
		
		$option = array(
						'seq_member'=>$_member['seq'],
						'seq_post' => $seq,
		);
		
		return $sy['db']->count(SCRAP_TABLE, $option);
	}
	
	// 스크랩 취소
	public function unscrap ( $seq ) {
		global $sy, $_member;
		
		return $sy['db']->delete(SCRAP_TABLE, array('seq'=>$seq));
	}
	
	// 스크랩한 글 가져오기
	public function my_scrap($page_no = null, $no_of_post = 20) {
		global $sy, $_member;
		
		$limit = null;
		
		if ( $page_no ) {
			$start = ( $page_no - 1 ) * $no_of_post;
			$limit = " LIMIT $start, $no_of_post ";
		}
		
		$posts = array();
		
		$rows = $sy['db']->rows("SELECT seq, seq_post FROM " . SCRAP_TABLE . " WHERE seq_member=".$_member['seq'] . " ORDER BY seq DESC $limit");
		
		foreach ( $rows as $row ) {
			$p = $this->single_post($row['seq_post'], "seq, subject");
			$p['seq_scrap'] = $row['seq'];
			$posts[] = $p;
		}
		
		return $posts;
		
	}
	
	// 스크랩한 글 갯수 
	public function total_my_scrap() {
		global $sy, $_member;
		
		$option = array(
						'seq_member'=>$_member['seq']
		);
		
		return $sy['db']->count(SCRAP_TABLE, $option);
	}
	
	
	// 키워드 통계
	public function get_keyword_data( $no_of_keyword = 10) {
		global $sy, $site_config;
	
		return $sy['db']->rows( "SELECT * FROM ".KEYWORD_TABLE. " WHERE `domain`='".$site_config['domain']."' ORDER BY count DESC LIMIT 0, $no_of_keyword" );		
	}
	
	public function keyword_stat( $no_of_keyword = 10) {
		global $sy, $site_config;

		$filename = CACHE_PATH . '/keyword_stat_'.$site_config['domain'].'.cache';
		
		$duration = 60 * $site_config['search_stat_minutes'];
		
		if ( file_exists ( $filename ) ) {
			$old_keyword_stat = $sy['file']->unscalar ( $sy['file']->read_file ( $filename ) );
		}
		else $old_keyword_stat =  $this->get_keyword_data( $no_of_keyword );	
		
		if ( !file_exists ( $filename ) || ( $old_keyword_stat && ( time() - $old_keyword_stat['time'] ) >= $duration ) ) {
		
			$new_data = $this->get_keyword_data( $no_of_keyword );	
			
			$keyword_stat = array();
			for ( $i=0; $i < count ( $new_data ); $i++ ) {
				$keyword_stat[$i]['keyword'] = $new_data[$i]['keyword'];
				$keyword_stat[$i]['count'] = $new_data[$i]['count'];
				foreach ( $old_keyword_stat as $rank => $o ) {
					if ( $new_data[$i]['keyword'] == $o['keyword'] ) {
						$keyword_stat[$i]['old_rank'] = $rank;
						$keyword_stat[$i]['old_fluct'] = $o['new_fluct'];
						$keyword_stat[$i]['new_fluct'] = $new_data[$i]['count'] - $o['count'];
					}
				}
			}
			$keyword_stat['time'] = time();
			$sy['file']->write_file ( $filename, $sy['file']->scalar ( $keyword_stat ) );
			$sy['debug']->log("CACHE - $filename (Creating Keyword Statistic Cache File)");
			
			unset ( $keyword_stat['time'] );
			return $keyword_stat;
		}
		else {
			$sy['debug']->log("CACHE - $filename (Using Keyword Statistic Cache File)");
			unset ( $old_keyword_stat['time'] );
			return $old_keyword_stat;
		}
	}
	
	// 사용자별 작성한 글 갯수 
	public function no_of_post_by_user ( $seq ) {
		global $sy;
		
		$option = array(
						'deleted'=>'N'
		);
		
		if ( is_numeric($seq) ) { // seq_member인 경우 
			$option['seq_member'] = $seq;
		} else { // username인 경우
			$option['username'] = $seq;
		}
		
		if ( $conds ) $where = " WHERE " . $conds;
		
		return $sy['db']->count(POST_DATA_TABLE, $option);
	}
	
	// 사용자별 작성한 댓글 갯수
	public function no_of_comment_by_user ( $seq ) {
		global $sy;
		
		$option = array(
						'deleted'=>'N'
		);
		
		if ( is_numeric($seq) ) { // seq_member인 경우 
			$option['seq_member'] = $seq;
		} else { // username인 경우
			$option['username'] = $seq;
		}
		
		if ( $conds ) $where = " WHERE " . $conds;
		
		return $sy['db']->count(COMMENT_DATA_TABLE, $option);
	}
	
	// 나의 글 보기, 로그인을 하지 않으면 데이터가 추출 되지 않는다.
	public function my_posts($page_no = 1, $no_of_post = 20) {
		global $sy, $_member;
		if ( $sy['mb']->is_login() ) {
			$start = ( $page_no - 1 ) * $no_of_post;
			$limit = " LIMIT $start, $no_of_post ";
			
			$query = "SELECT seq, seq_member, subject, stamp, username FROM " . POST_DATA_TABLE . " WHERE seq_member='".$_member['seq']."' AND deleted='N' ORDER BY stamp DESC $limit";
			
			return $sy['db']->rows($query);
		}
	}
	
	// 나의 글 보기, 로그인을 하지 않으면 데이터가 추출 되지 않는다.
	public function my_comments($page_no = 1, $no_of_post = 20) {
		global $sy, $_member;
		if ( $sy['mb']->is_login() ) {
			$start = ( $page_no - 1 ) * $no_of_post;
			$limit = " LIMIT $start, $no_of_post ";
			
			$query = "SELECT seq, seq_root, seq_member, content_stripped as content, stamp, username FROM " . COMMENT_DATA_TABLE . " WHERE seq_member='".$_member['seq']."' AND deleted='N' ORDER BY stamp DESC $limit";
			
			return $sy['db']->rows($query);
		}
	}
	
	// 게시판 레벨(글목록,글쓰기, 글보기, 코멘트 레벨)
	public function post_level() {
		global $post_cfg;
		
		$post_level = array(
							'list_level'=>$post_cfg['list_level'],
							'view_level'=>$post_cfg['view_level'],
							'write_level'=>$post_cfg['write_level'],
							'comment_write_level'=>$post_cfg['comment_write_level']
		);
		
		return $post_level;
	}
	
	// 사용자별 금 검색
	public function search_user_post_url( $username ) {
		return  '?module=post&action=search&search_subject=1&search_content=1&username='.$username;
	}
	
	// 게시글 본문 처리
	public function content($content, $mode = 1) {
		global $post_cfg;
		
		if ( $mode ) $content = stripslashes(stripslashes($content));
		else {
			$content = $this->escaped_textarea($content);
			$content = "<xmp>$content</xmp>";
		}
		
		return $content;
	}
	
	public function escaped_textarea($content ) {
		return stripslashes(str_replace('\r\n', "\n", $content));
	}
	
	// 게시판별 최신글 캐시 삭제 하기
	public function delete_cache_by_post_id( $post_id ) {
		global $sy;
		$files = $sy['file']->readdir(CACHE_PATH);
		di ( $files );
		foreach ( $files as $file ) {
			if ( preg_match("/^{$post_id}/", $file) ) {
				@unlink(CACHE_PATH . '/'.$file);
			}
		}
	}
	
	
	
}
?>