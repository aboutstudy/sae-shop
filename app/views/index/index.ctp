<div class="homeMain">
		<div class="mainLeft">
			<div class="homeVideo">
				<div class="title"><?php echo $this->Html->link($section_01['Video'][0]['title'], '/video/view/'.$section_01['Video'][0]['id']);?></div>
				<div class="video">
					<?php echo $this->Html->image($section_01['Video'][0]['img'], array('url' => '/video/view/'.$section_01['Video'][0]['id'], 'alt' => $section_01['Video'][0]['title'], 'width' => 296, 'height' => 201))?>					
				</div>
			</div>
			<div class="headerLine">
				<div class="video">
					<div class="title"><?php echo $this->Html->link($section_02['Video'][0]['title'], '/video/view/'.$section_02['Video'][0]['id']);?></div>
					<div class="list">
						<div class="left">
							<?php 
								foreach($section_03['List'][0] as $item):
									echo '<div>&#8226; ';
									echo $this->Html->link($item['title'], '/video/view/'.$item['id'], array('title' => $item['title']));
									echo '</div>';
								endforeach;
							?>
						</div>
						<div class="right">
							<?php 
								foreach($section_03['List'][1] as $item):
									echo '<div>&#8226; ';
									echo $this->Html->link($item['title'], '/video/view/'.$item['id'], array('title' => $item['title']));
									echo '</div>';
								endforeach;
							?>
						</div>										
					</div>
				</div>
				<div class="article">
					<div class="title">美丽百科</div>
					<div class="list">
						<div class="img"><?php echo $this->Html->link($this->Html->image('http://tp2.sinaimg.cn/2113041917/180/5599120799/0', array('width' => 75, 'height' => 75, 'title' => '新浪微博：护肤知识精选 ')), 'http://weibo.com/2113041917', array('escape' => false, 'target' => '_blank'));?></div>
						<div class="right">
							<div class="hot"><?php echo $this->Html->link($section_04['Article'][0]['title'], '/baike/view/'.$section_04['Article'][0]['id']);?></div>
							
							<?php 
								foreach($section_05['Article'] as $num => $item):
									echo '<div>&#8226; ';
									echo $this->Html->link($this->Text->truncate($item['title'], 25), '/baike/view/'.$item['id'], array('title' => $item['title']));
									echo '</div>';
									if($num >= 2){
										break;
									}
								endforeach;
							?>				
						</div>
					</div>
				</div>
				<div class="div_c"></div>
			</div>
			<div class="div_c"></div>
			<!-- 商城热卖 -->
			<div class="hotGoods">
				<div class="homeMainTitle">
					<div class="icon"><?php echo $this->Html->link('商城热卖', '/Mall');?></div>
					<div class="tags">
					 	<?php echo $this->Html->link('防晒霜', '/Goods/search/category:防晒霜');?>
						<?php echo $this->Html->link('洁面', '/Goods/search/category:洁面');?>
						<?php echo $this->Html->link('面膜', '/Goods/search/category:面膜', array('class' => 'red'));?>
						<?php echo $this->Html->link('缷妆液', '/Goods/search/category:缷妆液');?>	
					 	... 										
						<?php echo $this->Html->link('更多', '/Mall');?> 
					</div>
				</div>
				<div class="list">
				  <ul>
				  <?php 
					foreach($mall_hot as $num => $item):
				  ?>				  	
					<li>
						<div class="goods">
							<div class="img"><?php echo $this->Html->link($this->Html->image($item['thumb_big'], array('width' => 135, 'height' => 135)), '/Goods/view/' . $item['id'], array('target' => '_blank', 'escape' => false));?></div>
							<div class="title"><?php echo $this->Html->link($item['short_title'], '/Goods/view/' . $item['id'], array('target' => '_blank'));?></div>
							<div class="price"><div class="shop_price"><?php echo sprintf('￥%01.2f', $item['shop_price']);?></div><div class="marketPrice"><?php echo sprintf('￥%01.2f', $item['market_price']);?></div></div>							
						</div>
					</li>
					<?php endforeach;?>
				  	<li style="padding-right:0px">
						<div class="tuan">
							<div class="img"><?php echo $this->Html->link($this->Html->image($mall_hot_big['img'], array('width' => 195, 'height' => 178)), $mall_hot_big['url'], array('target' => '_blank', 'escape' => false));?></div>
					  </div>
				  	</li>															
				  </ul>
				  <div class="div_c"></div>					
				</div>				
			</div>			
			<div class="hotVideo">
				<div class="homeMainTitle">
					<div class="icon"><?php echo $this->Html->link('视频课堂', '/Video/search/');?></div>
					<div class="tags">
						<?php echo $this->Html->link('美容', '/Video/search/category:美容');?>
						<?php echo $this->Html->link('化妆', '/Video/search/category:化妆');?>
						<?php echo $this->Html->link('护肤', '/Video/search/category:护肤');?>
						<?php echo $this->Html->link('养生', '/Video/search/category:养生');?>
						<?php echo $this->Html->link('美体', '/Video/search/category:美体');?>
					 	... 
					 	<?php echo $this->Html->link('更多', '/Video/search/');?>					
					</div>
				</div>
				<div class="list">
					<ul>
					<?php foreach($section_06['Video'] as $num => $item):?>
					<?php if($num == 4):?>
					</ul>
					<ul>					
					<?php		
						elseif($num >= 10):
							break;
						endif;
					?>
						<li class="showFrame">
							<div class="video">
								<div class="iconPlayer"></div>
								<div class="img">
									<span class="iconPlayer"><?php echo $this->Html->image('/images/icon_player.png', array('url' => '/video/view/'.$item['id']))?></span>
									<?php echo $this->Html->image($item['thumb'], array('url' => '/video/view/'.$item['id'], 'width'=>122, 'height' => 90))?>
								</div>
								<div class="title">
									<span class="bigIconRed">></span>
									<?php echo $this->Html->link($this->Text->truncate($item['title'], 19), '/video/view/'.$item['id'])?>
								</div>
							</div>
						</li>
					<?php endforeach;?>
					</ul>
                    <div class="div_c"></div>					
				</div>				
			</div>
			<div class="hotMakeup">
				<div class="homeMainTitle">
					<div class="icon"><?php echo $this->Html->link('美丽百科', '/Baike/search/');?></div>
					<div class="tags">
						<?php echo $this->Html->link('美容', '/Baike/search/category:美容');?>
						<?php echo $this->Html->link('化妆', '/Baike/search/category:化妆');?>
						<?php echo $this->Html->link('护肤', '/Baike/search/category:护肤');?>
					 	... 
					 	<?php echo $this->Html->link('更多', '/Baike/search/');?> 
					</div>
				</div>
				<div class="list" style="border-bottom:1px solid #AAAAAA;">
				  <div class="hotImg"><?php echo $this->Html->image($section_08['Article'][0]['img'], array('url' => '/baike/view/'.$section_08['Article'][0]['id'], 'width'=>135, 'height' => 181, 'title' => $section_08['Article'][0]['title'], 'alt' => $section_08['Article'][0]['title']))?></div>
				  <div class="articleList">
				  	<ul>
						<li class="hot"><?php echo $this->Html->link($this->Text->truncate($section_08['Article'][0]['title'], 19), '/baike/view/'.$section_08['Article'][0]['id'])?></li>
						<?php 
							foreach($section_07['Article'] as $num => $item):
								echo '<li>';
								echo $this->Html->link($this->Text->truncate($item['title'], 25), '/baike/view/'.$item['id'], array('title' => $item['title']));
								echo '</li>';
								if($num >= 7){
									break;
								}								
							endforeach;
						?>																								
					</ul>
				  </div>
				  <div class="expertShow">
				  	<ul>
				  	<?php foreach($user_tag_01['User'] as $num => $item):?>
						<li class="expert">
							<div class="img"><?php echo $this->Html->link($this->Html->image($item['myface'], array('width' => 55, 'height' => 55, 'alt' => $item['username'])), 'http://weibo.com/n/' . $item['username'], array('escape' => false, 'target' => '_blank', 'title' => $item['username']));?></div>
						</li>						
					<?php if($num == 2 OR $num == 5):?>	
					</ul>
				  	<ul>
				  	<?php
				  		elseif($num >= 8):
							break;
						endif;
					?>
				  	<?php endforeach;?>				  	
					</ul>										
				  </div>
				  <div class="separate">&nbsp;</div>				  
				  <div class="div_c"></div>				
				</div>
				<!-- 	
				<div class="homeShopTitle">
					<div class="icon">达人推荐</div>
					<div class="tags">瘦身 BB霜 防晒 美白 美容 彩妆 ... 更多 </div>
				</div>	
				<div class="goodsShow">
					<div class="goods"><a href="#"><img src="/images/3.jpg" width="148" height="80" border="0" /></a></div>
					<div class="goods"><img src="/images/3.jpg" width="148" height="80" /></div>
					<div class="goods"><img src="/images/3.jpg" width="148" height="80" /></div>
					<div class="goods"><img src="/images/3.jpg" width="148" height="80" /></div>																		
					<div class="div_c"></div>
				</div>
				-->			
			</div>
		</div>
		<div class="sidebar">
			<!--会员展示-->
			<?php echo $this->element('hotUser');?>
			<!--登陆框-->
			<?php echo $this->element('login');?>
			<!--标签列表-->
			<?php echo $this->element('tagsIndex');?>
			<!--热门、最新视频列表 -->
			<?php echo $this->element('videoTop10');?>
			<!-- 客服 -->
			<?php echo $this->element('server_250');?>
		</div>
		<div class="div_c"></div>
	</div>