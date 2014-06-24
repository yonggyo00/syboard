<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<script>
	var captcha_skin_path = '<?=$so['path']?>';
</script>
<span id='captcha'>
	<img id='captcha-image' src='<?=$so['path']?>/captcha.php' />
	<span id='captcha-change'>변경</span>
	<input type='text' name='captcha' placeholder='보안문자 입력'/>
</span>