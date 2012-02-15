<div class="homeMain">
		<div class="mainLeft">
		  <div class="videoList">		  	
			<div class="listTitle">
				<div class="icon">搜索结果</div>
				<div class="conditions"><?php echo $keyword;?> </div>
			</div>			
			<div class="list">				
				<ul>
					<?php foreach($list as $num => $item):?>
					<li class="showFrame">
						<div class="video">
							<div class="iconPlayer"></div>
							<div class="img">
								<?php echo $this->Html->tag('span', $this->Html->image('/images/icon_player.png', array('url' => '/video/view/'.$item['Video']['id'])), 'iconPlayer');?>
								<?php echo $this->Html->image($item['Video']['thumb'], array('url' => '/video/view/'.$item['Video']['id'], 'width' => 122, 'height'=> 90, 'alt' => $item['Video']['title']));?>
							</div>
							<div class="title">
								<span class="bigIconRed">></span>
								<a href="#"><?php echo $this->Html->link($this->Text->truncate($item['Video']['title'], 19), '/video/view/'.$item['Video']['id']);?></a>							
							</div>
						</div>					
					</li>			
					<?php if(($num+1) % 5 == 0):?>
					</ul>					
					<div class="div_c"></div>
					<ul>
					<?php endif;?>
					<?php endforeach;?>																																				
				</ul>
				<div class="div_c"></div>
				<div class="pageShow alignCenter"> 
					<?php echo $this->element('pageShow');?>
				</div>
			</div>
		  </div>
	  </div>
		<div class="sidebar">
			<!-- 热门会员展示 -->
			<?php echo $this->element('hotUser');?>
			<!--标签列表-->
			<?php echo $this->element('tagsIndex');?>
			<!--热门、最新视频列表 -->
			<?php echo $this->element('videoTop10');?>
		</div>
		<div class="div_c"></div>
	</div>