<div class="goods">
	<div class="img">
		<?php echo $this->Html->link($this->Html->image($goods['thumb_original'], array('width' => 156, 'alt' => $goods['title'], 'title' => $goods['title'])), '/Goods/view/' . $goods['id'], array('target' => '_blank', 'title' => $goods['title'], 'escape' => false));?>
	</div>
	<div class="title">
		<span class="bigIconRed">></span>
		<?php echo $this->Html->link($goods['short_title'], '/Goods/view/' . $goods['id'], array('title' => $goods['title']));?>
	</div>
	<div class="price">
		<div class="shopPrice">￥<?php echo $goods['shop_price'];?></div>
		<div class="marketPrice">￥<?php echo $goods['market_price']?></div>
	</div>
</div>