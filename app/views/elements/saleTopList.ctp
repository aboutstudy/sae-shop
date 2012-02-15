			<div class="region">
				<div class="top bold">
					<span class="topNew">最新</span>				
					<span class="topHot">热门</span>
					<span>畅销榜</span>
				</div>
			  <div class="content">
			  	<div class="topList">
			  	<?php foreach($saleTopList['MallGoods'] as $num => $goods):?>
			  		<?php if($num == 0):?>
					<div class="item">
						<div class="num"><span class="tagsHotBg"><?php echo str_pad(($num + 1), 2, '0', STR_PAD_LEFT);?></span></div>
						<div class="goodsCur">
							<div class="title"><?php echo $this->Html->link($goods['short_title'], '/Goods/view/' . $goods['id'], array('title' => $goods['title'], 'target' => '_blank'));?></div>
							<div class="img"><?php echo $this->Html->link($this->Html->image($goods['thumb_big'], array('width' => 135, 'height' => 135, 'alt' => $goods['short_title'])), '/Goods/view/' . $goods['id'], array('title' => $goods['title'], 'target' => '_blank', 'escape' => false));?></div>
						</div>
						<div class="div_c"></div>
					</div>
					<?php elseif($num > 0 AND $num < 3):?>
					<div class="item">
						<div class="num"><span class="tagsHotBg"><?php echo str_pad(($num + 1), 2, '0', STR_PAD_LEFT);?></span></div>
						<div class="goods">
							<div class="title"><?php echo $this->Html->link($goods['short_title'], '/Goods/view/' . $goods['id'], array('title' => $goods['title'], 'target' => '_blank'));?></div>
							<div class="img"><?php echo $this->Html->link($this->Html->image($goods['thumb_big'], array('width' => 135, 'height' => 135, 'alt' => $goods['short_title'])), '/Goods/view/' . $goods['id'], array('title' => $goods['title'], 'target' => '_blank', 'escape' => false));?></div>
						</div>
						<div class="div_c"></div>
					</div>
					<?php else:?>
					<div class="item">
						<div class="num"><span class="tagsBg"><?php echo str_pad(($num + 1), 2, '0', STR_PAD_LEFT);?></span></div>
						<div class="goods">
							<div class="title">
								<?php echo $this->Html->link($goods['short_title'], '/Goods/view/' . $goods['id'], array('title' => $goods['title'], 'target' => '_blank'));?>
							</div>
							<div class="img">
								<?php echo $this->Html->link($this->Html->image($goods['thumb_big'], array('width' => 135, 'height' => 135, 'alt' => $goods['short_title'])), '/Goods/view/' . $goods['id'], array('title' => $goods['title'], 'target' => '_blank', 'escape' => false));?>
							</div>
						</div>
						<div class="div_c"></div>
					</div>					
					<?php endif;?>
				<?php endforeach;?>										
				</div>
			  </div>
			  <div class="bottom"></div>			
			</div>