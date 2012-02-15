<div class="region">
	<div class="top">
		<span class="sortTagsNew">视频</span>
		<span class="sortTagsHot">百科</span>					
		<span class="bold">人气榜</span>
	</div>
    <div class="content">
  	<div class="hot">
  		<?php foreach($section_12['Video'] as $num => $item):?>
  			<?php if($num < 3):?>
				<div>
					<?php echo $this->Html->tag('span', str_pad(($num + 1), 2, '0', STR_PAD_LEFT), array('class' => 'tagsHotBg'));?>
					<?php echo $this->Html->link($this->Text->truncate($item['title'], 19), '/Video/view/'.$item['id']);?>
				</div>						
			<?php else:?>
				<div>
					<?php echo $this->Html->tag('span', str_pad(($num + 1), 2, '0', STR_PAD_LEFT), array('class' => 'tagsBg'));?>
					<?php echo $this->Html->link($this->Text->truncate($item['title'], 15), '/Video/view/'.$item['id']);?>
				</div>
			<?php endif;?>
  		<?php endforeach;?>																																						
	</div>
  </div>
</div>