<div class="relevance">
	<div class="relevanceTitle">
		<div class="icon">相关视频</div>
		<div class="tags">
		<?php
			foreach($arrTagForMore as $id => $tag):
				echo $this->Html->link($tag['Tag']['title'], '/Video/search/tag:'.$tag['Tag']['title']);
			endforeach;
			echo $this->Html->link('... 更多', '/Video/search/');
		?> 
		</div>
	</div>
	<div class="list">
		<ul>
		<?php foreach($relationVideo as $video):?>
			<li class="showFrame">
				<div class="video">
					<div class="img">
						<span class="iconPlayer"><?php echo $this->Html->image('/images/icon_player.png', array('url' => '/video/view/'.$video['Video']['id'], 'alt' => $video['Video']['title']));?></span>
						<?php echo $this->Html->image($video['Video']['thumb'], array('url' => '/video/view/'.$video['Video']['id'], 'alt' => $video['Video']['title'], 'width' => 122, 'height' => 90))?>
					</div>
					<div class="title">
						<span class="bigIconRed">></span>
						<?php echo $this->Html->link($video['Video']['title'], '/video/view/'.$video['Video']['id'])?>
					</div>
				</div>
			</li>
		<?php endforeach;?>	
		</ul>
	</div>
</div>