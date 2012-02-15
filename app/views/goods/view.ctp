<div class="mallMain">
	  <div class="rightMain">
	  	<div class="goodsHead">
			<div class="goodsTitleImg">
				<?php echo $this->Html->image($this->data['MallGoods']['img'], array('width' => 320, 'height' => 320, 'title' => $this->data['MallGoods']['title'], 'alt' => $this->data['MallGoods']['title']));?>
			</div>
			<div class="goodsDesc">
				<div class="goodsTitle"><span class="icon">></span><?php echo $this->data['MallGoods']['title'];?></div>
				<div class="goodsTitleBottom">&nbsp;</div>
				<div class="goodsPriceInfo">
					<div class="item"><span class="attrName">商品编号：</span><span><?php echo $this->data['MallGoods']['sn'];?></span></div>
					<div class="item"><span class="attrName">品牌：</span><span><?php echo $this->data['MallBrand']['title'];?></span></div>
					<div class="item"><span class="attrName">规格：</span><span><?php echo empty($this->data['MallGoods']['spec']) ? '常规':$this->data['MallGoods']['spec'];?></span></div>					
					<div class="item"><span class="attrName">产地：</span><span><?php echo $this->data['MallGoods']['origin'];?></span></div>					
					<div class="item"><span class="attrName">市场价：</span><span class="across sizePlus">￥<?php echo $this->data['MallGoods']['market_price'];?></span></div>					
					<div class="item"><span class="attrName">豆壳价：</span><span class="red bold sizePlus">￥<?php echo $this->data['MallGoods']['shop_price'];?></span></div>					
				</div>
				<div class="orderInfo">
					<div class="goodsCount">
						<span>购买数量：</span>
						<span class="negative">-</span>
						<span><input name="" type="text" id="goodsCount" value="1" /></span>						
						<span class="plus">+</span>						
					</div>
					<div class="buyButton"></div>
					<?php echo $this->Form->hidden("MallGoods.id");?>
					<script type="text/javascript">
						var GOODS_ID = <?php echo $this->data['MallGoods']['id']?>;
						var GOODS_STOCK = <?php echo $this->data['MallGoods']['stock']?>;
						var GOODS_USER_MAX = <?php echo $this->data['MallGoods']['user_max']?>;
					</script>					
				</div>			
			</div>
			<div class="div_c"></div>
		</div>
		<div class="goodsDetail">
			<div class="attrNav">
				<div class="itemLight"><span class="pointer">&nbsp;</span>详细介绍</div>			
				<div class="item"><a href="#goods_weibo_comment">微博点评</a></div>
				<div class="div_c"></div>			
			</div>
			<div class="attrContent">
				<?php echo $this->data['MallGoodsDesc']['content'];?>	
			</div>
		</div>
		<a name="goods_weibo_comment" id="goods_weibo_comment"></a>
		<div class="goodsWeibo">
			<div class="listTitle"><div class="weiboListIcon">微博点评</div></div>
			<div class="expert">
				<div class="img">
					<?php echo $this->Html->link($this->Html->image($this->data['User']['myface'], array('width' => 65, 'alt' => $this->data['User']['username'])), '/weibo/toWeibo/'.$this->data['MallGoodsWeibo']['uid'].'/'.$this->data['MallGoodsWeibo']['sid'], array('escape' => false, 'target' => '_blank'));?>
				</div>
				<div class="published">
					<span class="time">发布于  <?php echo date('m月d日 H:i', strtotime($this->data['MallGoodsWeibo']['created']));?></span>				
					<div class="red bold">
						<?php echo $this->Html->link($this->data['User']['username'], '/weibo/toWeibo/'.$this->data['MallGoodsWeibo']['uid'].'/'.$this->data['MallGoodsWeibo']['sid'], array('class' => 'red bold', 'target' => '_blank'));?>
					</div>
				</div>
				<div class="content">
					<?php echo $this->data['MallGoodsWeibo']['content'];?>
					<?php echo $this->Html->link('[马上关注]', '/weibo/toWeibo/'.$this->data['MallGoodsWeibo']['uid'].'/'.$this->data['MallGoodsWeibo']['sid'], array('class' => 'red', 'target' => '_blank'));?>				
				</div>
				<div class="div_c"></div>
		    </div>		
			<div class="commentInput">
				<div class="top">&nbsp;</div>
				<div class="formBody">
					<?php echo $this->Html->div('submitButton', '&nbsp;', array('mid' => $this->data['MallGoods']['id'], 'sType' => 'goods'));?>
					<?php echo $this->Html->div('small', '&nbsp;');?>
					<?php echo $this->Form->input('Comment.text', array('label' => false, 'type' => 'text', 'div' => 'textInput'));?>										
					<div class="div_c"></div>
					<div class="options">
						<?php echo $this->Form->input('isRepost', array('type' => 'checkbox', 'label' => '同时转发到我的微博'));?> 
						<?php echo $this->Form->input('isFollow', array('type' => 'checkbox', 'label' => '关注 '.$this->data['User']['username']));?>
						<?php echo $this->Form->hidden('MallGoodsWeibo.sid');?>
						<?php echo $this->Form->hidden('MallGoods.id');?>
						<?php echo $this->Form->hidden('MallGoodsWeibo.uid');?>												
					</div>
				</div>
				<div class="bottom">&nbsp;</div>
			</div>	
			<div class="weiboList replyList">
				<?php foreach($commentList as $num => $item):?>
				<div class="item">
					<div class="face">
						<?php echo $this->Html->link($this->Html->image($item['User']['myface'], array('width' => 50, 'height' => 50, 'alt' => $item['User']['username'])), 'http://weibo.com/n/' . $item['User']['username'], array('target' => '_blank', 'escape' => false));?>
					</div>
					<div class="contentBody">
						<div class="pointer"></div>
						<div class="published">
							<span class="time">发布于 <?php echo date('m月d日 H:i', $item['MallGoodsComment']['created']);?></span>				
							<div class="red bold"><?php echo $item['User']['username']?></div>
							<div class="div_c"></div>
						</div>
						<div class="content"><?php echo $item['MallGoodsComment']['content']?></div>
					</div>
					<div class="div_c"></div>					
				</div>
				<?php endforeach;?>			
				<div class="pageShow alignRight"><?php echo $this->element('pageShow');?></div>	
			</div>
		</div>		
		<div class="div_c"></div>
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