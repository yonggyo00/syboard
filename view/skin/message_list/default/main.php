<?php
$messages = $so['messages'];
$total_post = $so['total_post'];

$star_green = "<img class='star' mode='checked' src='".$so['path'].'/img/star_green.png'."' />";
$star_gray = "<img class='star' mode='unchecked' src='".$so['path'].'/img/star_gray.png'."' />";
$unread = "<img src='".$so['path'].'/img/unread.png'."' />";
$readed = "<img src='".$so['path'].'/img/readed.png'."' />";
$attached = "<img src='".$so['path'].'/img/file.png'."' />";
?>
<script>
	var star_green = "<?=$star_green?>";
	var star_gray = "<?=$star_gray?>";
</script>
<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<table id='message-list-skin' cellspacing=0 cellpadding=0 width='100%' border=0>
	<tr valign='top'>
		<td width='28%'>
			<?php
				include_once 'left.php';
			?>
		</td>
		<td width='72%'>
			<table cellpadding=0 cellspacing=0 width='100%' border=0>
				<tr id='table-header' valign='top'>
					<td width=20><input type='checkbox' id='select-all' value=1 /></td>
					<td width=20 valign='middle' align='center'><img src='<?=$so['path']?>/img/star_green.png' /></td>
					<td width=20 valign='middle' align='center'><?=$attached?></td>
					<td valign='middle' align='center' valign='middle' width=20><?=$unread?></td>
					<td valign='middle' width=80>보낸이</td>
					<td valign='middle'>제목</td>
					<td valign='middle' width=100>날짜</td>
					<td valign='middle' width=100>수신</td>
				</tr>
				<?php
				foreach ( $messages as $ms ) {
					$view_url = $sy['ms']->view_url($ms['seq']);
					$subject = stringcut($ms['subject'], 33);
					$date = date('Y-m-d H:i', $ms['stamp']);
					
					if ( $ms['readed_stamp'] ) {
						$read = $readed;
						$selected = "class='selected'";
						$readed_stamp = date('Y-m-d H:i', $ms['readed_stamp']);
					}
					else {
						$read = $unread;
						$selected = null;
						$readed_stamp = null;
					}
					
					if ( $ms['first_file'] ) $file = $attached;
					else $file = null;
					
					
					if ( $ms['important'] == 'Y' ) $star = $star_green;
					else $star = $star_gray;
					
					$write_url = $sy['ms']->write_url($ms['sender']);
					
					echo "
						<tr class='row' seq='$ms[seq]'>
							<td width=20><input class='seq_check' type='checkbox' name='seq[]' value='$ms[seq]' /></td>
							<td width=20 valign='middle' align='center'>$star</td>
							<td width=20 valign='middle' align='center'>$file</td>
							<td align='center' valign='middle' width=30>$read</td>
							<td valign='middle'>
								<a $selected href='$write_url'>".$ms['sender']."</a>
							</td>
							<td valign='middle'><a $selected href='".$view_url."'>$subject</a></td>
							<td valign='middle'><span class='date'>$date</span></td>
							<td valign='middle'><span class='date'>$readed_stamp</span></td>
						</tr>
					";
				}?>
				<tr>
					<td colspan=8>
						<div id='control-pannel'>
							<span id='check_readed'>읽음</span>
							<span id='delete' onclick="return confirm('정말 삭제하시겠습니까?');">
								<img src='<?=$so['path']?>/img/x.png' />
								삭제
							</span>
							<span id='reply'>답장</span>
						</div>
					</td>
			</table>
		</td>
	</tr>
</table>