<div id='left'>
	<ul id='left-top-menu'>
		<li id='write-form-button'><a href='<?=$sy['ms']->write_url()?>'><?=lang('message list left write')?></a></li>
		<li><a href='<?=$sy['ms']->list_url()?>'><?=lang('message list left whole')?></a></li>
	</ul>
	<div style='clear:left;'></div>
	<ul id='left-middle-menu'>
		<li>
			<a href='<?=$sy['ms']->list_url()?>&mode=unreaded'>
				<div id='no_of_unreaded' style='text-align:center; height: 15px;'><?=number_format($sy['ms']->no_of_unreaded())?></div>
				<?=lang('message list left unread')?>
			</a>
		</li>
		<li>
			<a href='<?=$sy['ms']->list_url()?>&mode=important'>
				<div style='text-align:center; height: 15px;'><img src='<?=$so['path']?>/img/star_green.png' /></div>
				<?=lang('message list left important')?>
			</a>
		</li>
		<li>
			<a href='<?=$sy['ms']->list_url()?>&mode=attached'>
				<div style='text-align:center; height: 15px;'><img src='<?=$so['path']?>/img/file.png' /></div>
				<?=lang('message list left attached')?>
			</a>
		</li>
		<li>
			<a href='<?=$sy['ms']->list_url()?>&mode=orderbyreceiver'>
				<div style='text-align:center; height: 15px;'><img src='<?=$so['path']?>/img/to.png' /></div>
				<?=lang("message list left receiver")?>
			</a>
		</li>
	</ul>
	<div style='clear:left;'></div>
	<ul id='left-bottom-menu'>
		<li>
			<a href='<?=$sy['ms']->list_url()?>'>
				<img src='<?=$so['path']?>/img/total_msg.png' /><?=lang('message list left whole')?>
			</a>
		</li>
		<li>
			<a href='<?=$sy['ms']->list_url()?>&mode=received_msg'>
				<img src='<?=$so['path']?>/img/received_msg.png' /><?=lang('message list left received')?>
			</a>
		</li>
		<li>
			<a href='<?=$sy['ms']->list_url()?>&mode=my_msg'>
				<img src='<?=$so['path']?>/img/my_msg.png' /><?=lang('message list left self_message')?>
			</a>
		</li>
		<li>
			<a href='<?=$sy['ms']->list_url()?>&mode=sended_msg'>
				<img src='<?=$so['path']?>/img/sended_msg.png' /><?=lang('message list left sent')?>
			</a>
		</li>
	</ul>
</div>