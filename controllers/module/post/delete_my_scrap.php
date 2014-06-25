<?php
if ( empty($in['seq_scrap']) ) return $sy['js']->alert(lang('Delete_scrap error'));

$msg = null;
if ( $sy['post']->unscrap($in['seq_scrap']) ) {
	$msg = lang('Delete_scrap success');
}
else $msg = lang('Delete_scrap failed');

$sy['js']->alert($msg);
?>
<script>
	parent.location.reload();
</script>