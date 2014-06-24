<?php
if ( $post_cfg['blog_api_use'] ) {
	
	$pathinfo = pathinfo( $_SERVER['PHP_SELF'] );

	$img_server = "//".$_SERVER['HTTP_HOST'].$pathinfo['dirname']."/".UPLOAD_PATH;
	
	$blog_apis = $sy['post']->blog_apis();

	for ( $i=1; $i <= 3; $i++ ) {
		if ( $in['blog_no_'.$i] ) $blog_no = $in['blog_no_'.$i];
		
		if ( $blog_apis['blog_api_url'.$i] && $blog_apis['blog_api_account'.$i] && $blog_apis['blog_api_password'.$i] ) {
			$blog_api = array(
										'api_end_point' => $blog_apis['blog_api_url'.$i], 
										'username' => $blog_apis['blog_api_account'.$i],
										'password' => $blog_apis['blog_api_password'.$i]
								);
		
			if ( $blog_api['api_end_point'] && $blog_api['username'] && $blog_api['password'] ) {
				$blog_url = $blog_api['api_end_point'];
				$user_id = $blog_api['username'];
				$blog_id = $blog_api['username'];
				$password = $blog_api['password'];
			}
			else return;
		
			$publish = true; //게시글 공게 여부 설정 
			
			$in['subject'] = stripslashes($in['subject']);
			$in['content'] = stripslashes($in['content']);
			$blog_content = trim($in['content']);
			
			$blog_content = str_replace( UPLOAD_PATH , $img_server, $blog_content );
			$blog_content = str_replace( "rn", "", $blog_content ); 
			
			$get_title = $in['subject'];
			$get_desc =	$blog_content;
			
			if ( $in['blog_category_'.$i] ) $category = $in['blog_category_'.$i];
			else $category = null;
			
			if ( $in['blog_tags_'.$i] ) $tags = $in['blog_tags_'.$i];
			else $tags = null;
		
			$return = BlogPost($get_title, $get_desc, $category, $tags, $i);

			if ( $return ->faultCode() ) {
				$str = $return->faultString();
					
				echo $str;
			}
			else {
				$return_no = $return->value()->scalarval();
					
				if ( $return_no == '1' ) continue;
				if ( $insert_id ) {	// 새로 글쓰기인 경우는 블로그 번호를 데이터 베이스에 업데이트 한다.
					$sy['db']->update(POST_DATA_TABLE, array('blog_no_'.$i=>$return_no), array('seq'=>$insert_id));
				}
			}
		} else continue;
	}
}
?>