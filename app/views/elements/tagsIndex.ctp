<div class="region">
	<div class="top"><span class="more">共有 <span class="red"><?php echo $videoCount;?></span> 个视频</span><span class="red bold">找视频</span></div>
	<div class="content">
		<div class="sort">
			<div class="title">分类:</div>
			<div class="tags">
				<?php foreach($categorysIndex as $item):?>
					<?php echo $this->Html->tag('span', $this->Html->link($item['Category']['title'], array('controller' => 'video', 'action' => 'search', 'category' => $item['Category']['title']), array('class' => $item['Category']['flags'])));?>
				<?php endforeach;?>						
			</div>
			<div class="div_c"></div>
			<div class="title">标签:</div>
			<div class="tags">
				<?php foreach($tagsIndex as $tag):?>
					<?php echo $this->Html->tag('span', $this->Html->link($tag['Tag']['title'], array('controller' => 'video', 'action' => 'search', 'tag' => $tag['Tag']['title']), array('class' => $tag['Tag']['flags'])));?>
				<?php endforeach;?> 					
			</div>						
			<div class="div_c"></div>
		</div>
	</div>
</div>