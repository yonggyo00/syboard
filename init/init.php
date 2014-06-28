<?php
session_start();
		
	if (file_exists(dirname(__FILE__) . '/db.php')) {
		include_once 'db.php';
		include_once 'controllers/common.php';
		$sy['db'] = new db ( db_host, db_user, db_password, database );
		
		// �α��� ó�� �� �������� Ȯ�� �� �� ������ ��� $_member �迭�� is_admin�� �߰��Ѵ�. �̴� ��Ű Ż�뿡 ���� ����Ʈ ������ ������ ������ �����Ѵ�.
		if ( $sy['mb']->is_login() ) {
			if ( $sy['mb']->check_admin_in_db() ) {
				$_member['is_admin'] = 'Y';
			}
		}
		
		// IP ���� ó��
		include_once CONTROLLER_PATH .'/ip_sec.php';
		
		// ����Ʈ ����
		include_once MODEL_PATH . '/site_config.php';
        	   
		// PC, Mobile ������ üũ
		include_once CONTROLLER_PATH . '/device.php';
		
		// ��� ����
		include_once CONTROLLER_PATH . '/language.php';
		
		// ���ο� �湮�ڸ� �湮�� ��迡 �߰��Ѵ�.
		insert_visit_stat();
		
		// �湮�� ��� ������
		include_once MODEL_PATH . '/visitor_stat.php';
		
		// ���� ��Ʈ�� ó��
		include_once CONTROLLER_PATH . '/query_string.php';
	}
	else {
		header('Location: '. $_SERVER['REQUEST_URI'] .'db_config.php');
	}

// title, description, keyword�� �� �����͸� �����´�.
include_once MODEL_PATH . '/meta_data.php';
?>