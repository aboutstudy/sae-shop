<div class="mallMain">
		<div class="rightMain">
			<div class="mallHeader">
				<div class="focus">
						<?php foreach($focusList as $num => $item):?>
							<?php if($num == 0):?>								
								<?php echo $this->Html->div('img', $this->Html->link($this->Html->image($item['Link']['img'], array('width' => 543, 'height' => 249)), $item['Link']['url'], array('escape' => false, 'target' => '_blank')));?>
								<div class="title">							
								<?php echo $this->Html->div('item onFocus', $this->Html->link($item['Link']['title'], $item['Link']['url'], array('target' => '_blank')), array('focusPic' => $item['Link']['img'], 'focusUrl' => $item['Link']['url']));?>
							<?php else:?>
								<?php echo $this->Html->div('item outFocus', $this->Html->link($item['Link']['title'], $item['Link']['url'], array('target' => '_blank')), array('focusPic' => $item['Link']['img'], 'focusUrl' => $item['Link']['url']));?>
							<?php endif;?>
						<?php endforeach;?>
			  	  				</div>	
				</div>
				<div class="dayPromotion">
					<div class="bd"><a href="http://weibo.com/doucl" title="豆壳网官方微博" alt="豆壳网官方微博"><img src="/images/follow.jpg" width="183" height="58" title="豆壳网官方微博" alt="豆壳网官方微博"/></a></div>
					<!-- 商城最新动态 -->				
					<?php echo $this->element('mallNews');?>				
				</div>
				<div class="div_c"></div>
			</div>
			<div class="section">
				<div class="goodsList recommendList">		
					<div class="listTitle">
						<div class="tags">
						 	<?php echo $this->Html->link('防晒霜', '/Goods/search/category:防晒霜');?>
							<?php echo $this->Html->link('洁面', '/Goods/search/category:洁面');?>
							<?php echo $this->Html->link('面膜', '/Goods/search/category:面膜', array('class' => 'red'));?>
							<?php echo $this->Html->link('缷妆液', '/Goods/search/category:缷妆液');?>	
						 	... 										
							<?php echo $this->Html->link('更多', '/Mall');?> 						
						</div>
						<div class="recommend">推荐产品</div>
					</div>				
					<div class="list">					
					<?php foreach($recommendList['MallGoods'] as $num => $goods):?>
						<?php if($num >= 8): break; endif;?>
						<?php if(($num + 1) % 4 == 1):?>
							</div>
							<div class="div_c"></div>
							<div class="list">		
						<?php endif;?>
						<?php echo $this->element('listGoods', array('goods' => $goods))?>
					<?php endforeach;?>
					</div>
					<div class="div_c"></div>							
					
				</div>			
			</div>
			<!-- 通栏热门推广产品 -->
			<div class="section">
				<div class="mall_home_hot_l"><a href="http://www.doucl.com/Goods/view/14" target="_blank" title="雅诗兰黛即时修护特润精华露 15ml（小棕瓶）"><img src="/images/mall_hot_l.jpg" alt="雅诗兰黛即时修护特润精华露 15ml（小棕瓶）" /></a></div>
				<div class="mall_home_hot_r"><a href="http://www.doucl.com/Goods/view/4" target="_blank" title="新版菲奥娜水漾CC霜"><img src="/images/mall_hot_r.jpg" alt="新版菲奥娜水漾CC霜" /></a></div>
				<div class="div_c"></div>
			</div>			
			<div class="section">			
				<div class="goodsList hotList">
				<div class="listTitle">
				  <div class="tags">
					 	<?php echo $this->Html->link('香水', '/Goods/search/category:香水');?>
						<?php echo $this->Html->link('面霜', '/Goods/search/category:面霜');?>
						<?php echo $this->Html->link('睫毛膏', '/Goods/search/category:睫毛膏', array('class' => 'red'));?>
						<?php echo $this->Html->link('BB霜', '/Goods/search/category:BB霜');?>	
					 	... 										
						<?php echo $this->Html->link('更多', '/Mall');?> 				  
				  </div>
				  <div class="recommend">畅销产品</div>
				</div>				
					<div class="list">
					<?php foreach($hotList['MallGoods'] as $num => $goods):?>
						<?php if($num >= 20): break; endif;?>
						<?php if(($num + 1) % 4 == 1):?>
							</div>
							<div class="div_c"></div>
							<div class="list">		
						<?php endif;?>
						<?php echo $this->element('listGoods', array('goods' => $goods))?>
					<?php endforeach;?>
					</div>
					<div class="div_c"></div>
					<div class="more_goods"><a href="/Goods/search/" class="red">&lt;&lt;&lt; 查看其他商品 &gt;&gt;&gt;</a></div>
				</div>			
			</div>
		</div>
		<div class="sidebar">
			<!-- 分类目录 -->
			<?php echo $this->element('mallCategory', array('catTypeList' => $catTypeList));?>
			<!-- 畅销榜 -->
			<?php echo $this->element('saleTopList', array('list' => $saleTopList));?>			
			<!-- 
			<div class="region">
				<div class="top bold">您最近浏览过</div>
			    <div class="content">
					<div class="historyList">
						<div class="item">
							<div class="img"><img src="/images/goods_03.jpg" width="80" height="80" /></div>
							<div class="title"><span class="bigIconRed">></span>丝塔芙洗面奶</div>
							<div class="price red bold">￥187.99</div>
							<div class="div_c"></div>
						</div>
						<div class="item">
							<div class="img"><img src="/images/goods_01.jpg" width="80" height="80" /></div>
							<div class="title"><span class="bigIconRed">></span>丝塔芙洗面奶</div>
							<div class="price red bold">￥187.99</div>
							<div class="div_c"></div>
						</div>
						<div class="item">
							<div class="img"><img src="/images/history_goods_01.jpg" width="80" height="80" /></div>
							<div class="title"><span class="bigIconRed">></span>丝塔芙洗面奶</div>
							<div class="price red bold">￥187.99</div>
							<div class="div_c"></div>
						</div>
					</div>
				</div>
			  <div class="bottom"></div>			
			</div>
			-->
			<!-- 客服 -->
			<?php echo $this->element('server_250');?>			
		</div>		
		<div class="div_c"></div>
	</div>