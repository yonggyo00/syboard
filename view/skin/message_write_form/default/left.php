<div id='left'>
	<ul id='left-top-menu'>
		<li id='write-form-button'><a href='<?=$sy['ms']->write_url()?>'>쪽지쓰기</a></li>
		<li><a href='<?=$sy['ms']->list_url()?>'>전체쪽지</a></li>
	</ul>
	<div style='clear:left;'></div>
	<ul id='left-middle-menu'>
		<li>
			<a href='<?=$sy['ms']->list_url()?>&mode=unreaded'>
				<div id='no_of_unreaded' style='text-align:center; height: 15px;'><?=number_format($sy['ms']->no_of_unreaded())?></div>
				안읽음
			</a>
		</li>
		<li>
			<a href='<?=$sy['ms']->list_url()?>&mode=important'>
				<div style='text-align:center; height: 15px;'><img src='<?=$so['path']?>/img/star_green.png' /></div>
				중요
			</a>
		</li>
		<li>
			<a href='<?=$sy['ms']->list_url()?>&mode=attached'>
				<div style='text-align:center; height: 15px;'><img src='<?=$so['path']?>/img/file.png' /></div>
				첨부
			</a>
		</li>
		<li>
			<a href='<?=$sy['ms']->list_url()?>&mode=orderbyreceiver'>
				<div style='text-align:center; height: 15px;'><img src='<?=$so['path']?>/img/to.png' /></div>
				받는사람
			</a>
		</li>
	</ul>
	<div style='clear:left;'></div>
	<ul id='left-bottom-menu'>
		<li>
			<a href='<?=$sy['ms']->list_url()?>'>
				<img src='<?=$so['path']?>/img/total_msg.png' />전체쪽지
			</a>
		</li>
		<li>
			<a href='<?=$sy['ms']->list_url()?>&mode=received_msg'>
				<img src='<?=$so['path']?>/img/received_msg.png' />받은쪽지함
			</a>
		</li>
		<li>
			<a href='<?=$sy['ms']->list_url()?>&mode=my_msg'>
				<img src='<?=$so['path']?>/img/my_msg.png' />내게쓴쪽지
			</a>
		</li>
		<li>
			<a href='<?=$sy['ms']->list_url()?>&mode=sended_msg'>
				<img src='<?=$so['path']?>/img/sended_msg.png' />보낸쪽지
			</a>
		</li>
	</ul>
</div>