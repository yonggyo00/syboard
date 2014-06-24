<?php
if ( !$vote_skin = $post_cfg['vote_skin'] ) $vote_skin = 'default';
load_skin( 'vote', $vote_skin );
?>