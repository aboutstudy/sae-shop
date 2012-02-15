<div class="mallMain">
	  <div class="rightMain">
		  <div class="section">
		  		<div class="conditions">
					<div class="body">
						<div class="classList">
							<div class="className">分类：</div>
							<div class="itemList">
								<span class="item"><?php echo $keyword;?></span>	
							</div>
							<div class="div_c"></div>
						</div>
					</div>					
				</div>		  	
				<div class="goodsList">
					<div class="listTitle">
					  <div class="recommend">搜索结果</div>
					</div>
					<div class="div_c"></div>
					
					<div class="list">
					<?php foreach($list as $num => $goods):?>
						<?php if(($num + 1) % 4 == 1):?>
							</div>
							<div class="div_c"></div>
							<div class="list">		
						<?php endif;?>
						<?php echo $this->element('listGoods', array('goods' => $goods['MallGoods']))?>
					<?php endforeach;?>
					</div>
					<div class="div_c"></div>
									
					<div class="pageShow alignCenter">
						<?php echo $this->element('pageShow');?>
					</div>					
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