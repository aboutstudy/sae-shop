<?php if(isset($newsList)):?>
<div class="title"><span class="icon"><</span>最新动态</div>
<div class="news">
	<?php foreach($newsList as $num => $item):?>
		<?php echo $this->Html->div(null, $this->Html->link($this->Text->truncate($item['Help']['title'], 19), '/Help/view/' . $item['Help']['help_type_id'] . '/' . $item['Help']['id'], array('target' => '_blank')));?>		
	<?php endforeach;?> 
</div>
<?php endif;?>