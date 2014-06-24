<? if ( $site_config['use_facebook'] || $site_config['use_twitter'] ) {?>
	<div style='margin-bottom: 10px;'>
	<?php
	/* 페이스북 LIKE, SHARE 연동 */

	if ( $site_config['use_facebook'] ) { ?>
			<div style='float: left;' class="fb-like" data-href="//<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
	<? }
	if ( $site_config['use_twitter'] ) {
			/* 트위터 Tweet, Follow 연동 */
	?>
			<span style='float:right;'>
			<a href="https://twitter.com/lyonggyo" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @lyonggyo</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			
			<a href="https://twitter.com/share" class="twitter-share-button" data-via="lyonggyo">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			</span>
	<? }?>
		<div style='clear: both;'></div>
	</div>
<? }?>