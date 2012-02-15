<div class="homeMain">
	  <div class="mainLeft">	  	 		
		  <div class="cart">
				<div class="cartTitle">
					<div class="icon">订单确认</div>
			 	</div>		  
				<div class="setups step1">
					<div class="setup">1.提交订单</div>						
					<div class="setup">2.选择支付方式</div>
					<div class="setup">3.支付成功</div>
				</div>
				<?php echo $this->Form->create(null , array('url' => '/MallCart/checkOrder'));?>
				<div class="orderGoodsList">
					<div class="title">
					  <div class="th-title">名称</div>
						<div class="th-count">数量</div>
						<div class="th-price">单价</div>
						<div class="th-subWhole">总价</div>
						<div class="th-options">删除</div>
					</div>
					<?php foreach($cartList as $num => $item):?>				
					<div class="item">
						<div class="thumb"><?php echo $this->Html->link($this->Html->image($item['MallGoods']['thumb_small'], array('width' => 80, 'height' => 80)), '/Goods/view/' . $item['MallGoods']['id'], array('escape' => false));?></div>
						<div class="short_title"><?php echo $this->Html->link($item['MallGoods']['short_title'], '/Goods/view/' . $item['MallGoods']['id']);?></div>
						<div class="count">
							<span><input type="text" class="goodsCount" id="goodsCount[<?php echo $item['MallCart']['id']?>]" value="<?php echo $item['MallCart']['goods_num'];?>" /></span>
							<input type="hidden" name="user_max" value="<?php echo $item['MallGoods']['user_max'];?>" />
							<input type="hidden" name="goods_stock" value="<?php echo $item['MallGoods']['stock'];?>" />
							<input type="hidden" name="cart_id" value="<?php echo $item['MallCart']['id'];?>" />						
						</div>
						<div class="price"><?php echo sprintf("￥<span>%01.2f</span>", $item['MallGoods']['shop_price']);?></div>
						<div class="subWhole"><?php echo sprintf("￥<span>%01.2f</span>", $item['MallGoods']['shop_price']*$item['MallCart']['goods_num']);?></div>
						<div class="options"><?php echo $this->Html->link('删除', '/MallCart/delete/' . $item['MallCart']['id']);?></div>						
						<div class="div_c"></div>						
					</div>
					<?php endforeach;?>
				</div>	
				<div class="total">
					<span>共计</span>
					<span class="red">￥</span>					
					<?php echo $this->Html->tag('span', $totalGoodsPrice, array('class' => 'red totalGoodsPrice'));?>
				</div>
				<div class="options">
					<span><input type="submit" value="提交订单" <?php if(count($cartList) == 0) echo 'disabled="true" style="color:#AAA;"'?>/></span>
					<span><input name="toShopping" type="button" value="继续购物" /></span>
				</div>
				<?php echo $this->Form->end();?>
		  </div>
		  <div class="div_c"></div> 	
	  </div>
		<div class="sidebar">
			<?php echo $this->element('shopHelp');?>
			<!-- 客服 -->
			<?php echo $this->element('server_250');?>			
		</div>
		<div class="div_c"></div>
	</div>