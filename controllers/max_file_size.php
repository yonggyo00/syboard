<?php
// 최대 업로드 가능한 용량 지정 
if ( !$max_image_file_size = $site_config['max_image_file_size'] ) $max_image_file_size = 5242880;
if ( !$max_video_file_size = $site_config['max_video_file_size'] ) $max_video_file_size = 5242880;
if ( !$max_file_size = $site_config['max_file_size'] ) $max_file_size = 5242880;

define('MAX_IMAGE_FILE_SIZE', $max_image_file_size);
define('MAX_VIDEO_FILE_SIZE', $max_video_file_size);
define('MAX_FILE_UPLOAD_SIZE', $max_file_size); 
?>