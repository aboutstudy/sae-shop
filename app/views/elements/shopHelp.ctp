<?php if(isset($helpList)):?>
<div class="region">
	<div class="top red bold">购物帮助</div>
    <div class="content">
  	<div class="hot">
  		<?php foreach($helpList as $num => $item):?>
			<div>
  			<?php if($num < 3):?>
				<div>
					<?php echo $this->Html->tag('span', str_pad(($num + 1), 2, '0', STR_PAD_LEFT), array('class' => 'tagsHotBg'));?>
					<?php echo $this->Html->link($this->Text->truncate($item['Help']['title'], 19), '/Help/view/' . $item['Help']['help_type_id'] . '/' . $item['Help']['id']);?>
				</div>						
			<?php else:?>
				<div>
					<?php echo $this->Html->tag('span', str_pad(($num + 1), 2, '0', STR_PAD_LEFT), array('class' => 'tagsBg'));?>
					<?php echo $this->Html->link($this->Text->truncate($item['Help']['title'], 19), '/Help/view/' . $item['Help']['help_type_id'] . '/' . $this->data['Help']['id']);?>
				</div>
			<?php endif;?>
			</div>
		<?php endforeach;?>																																											
	</div>
  </div>
</div>
<?php endif;?>