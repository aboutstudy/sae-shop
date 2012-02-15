<div class="homeMain">
	  <div class="mainLeft">	  	 		
			<div class="cart check_order">
				<?php echo $this->Form->create('MallOrder', array('url' => '/MallCart/orderPay'));?>
				<div class="cartTitle">
					<div class="icon">订单确认</div>
			 	</div>		  
				<div class="setups step2">
					<div class="setup">1.提交订单</div>						
					<div class="setup">2.订单确认付款</div>
					<div class="setup">3.支付成功</div>
				</div>
				
				<div class="orderGoodsList">
					<div class="title">
					  <div class="th-title">名称</div>
						<div class="th-count">数量</div>
						<div class="th-price">单价</div>
						<div class="th-subWhole">总价</div>
						<div class="th-options"></div>
					</div>				
					<?php foreach($cartList as $num => $item):?>				
					<div class="item">
						<div class="thumb"><?php echo $this->Html->link($this->Html->image($item['MallGoods']['thumb_small'], array('width' => 80, 'height' => 80)), '/Goods/view/' . $item['MallGoods']['id'], array('escape' => false, 'target' => '_blank'));?></div>
						<div class="short_title"><?php echo $this->Html->link($item['MallGoods']['short_title'], '/Goods/view/' . $item['MallGoods']['id'], array('target' => '_blank'));?></div>
						<div class="count">
							<?php echo $this->Html->tag('span', $item['MallCart']['goods_num']);?>																				
						</div>
						<div class="price"><?php echo sprintf("￥<span>%01.2f</span>", $item['MallGoods']['shop_price']);?></div>
						<div class="subWhole"><?php echo sprintf("￥<span>%01.2f</span>", $item['MallGoods']['shop_price']*$item['MallCart']['goods_num']);?></div>					
						<div class="div_c"></div>						
					</div>
					<?php endforeach;?>					
				</div>				
				
				<div class="address">
					<div class="title">
						<div class="icon">配送地址</div>
					</div>
					<?php foreach($consigneeList as $item):?>
					<div class="item">
			 	  	  <div class="checkbox">
				 	  	  <input name="data[consignee_id]" type="radio" value="<?php echo $item['MallConsignee']['id'];?>" checked="checked" />
				 	  </div>
						<div class="desc">
						  <label for="express-st">
						  	<?php echo $item['MallConsignee']['province'];?>省
						  	<?php echo $item['MallConsignee']['city'];?>市
						  	<?php echo $item['MallConsignee']['district'];?>
						  	街道：<?php echo $item['MallConsignee']['address'];?>
						  	邮编：<?php echo $item['MallConsignee']['zipcode'];?>
						  	收件人：<?php echo $item['MallConsignee']['consignee'];?>
						  	手机：<?php echo $item['MallConsignee']['mobile'];?>
						  	电话：<?php echo $item['MallConsignee']['tell'];?>
						  </label>
						</div>
						<div class="div_c"></div>
					</div>
					<?php endforeach;?>
					<div class="item">
				 	  	<div class="checkbox">
					 	  	<input name="data[consignee_id]" type="radio" value="0" <?php if(count($consigneeList) === 0) echo 'checked="checked"';?>/>
					 	</div>
						<div class="desc">
						  <label for="express-st" class="red bold">使用新地址 &gt;&gt;&gt;</label>
						  <div class="addressInput" <?php if(count($consigneeList) === 0) echo 'style="display:block"';?>>
						  		<table width="97%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<th width="60">收货人 </th>
									<td>
										<?php echo $this->Form->input('MallOrder.consignee', array('label' => false, 'style' => 'width:120px;', 'after' => '<span class="red bold"> *</span>'));?>
									</td>
								  </tr>
								  <tr>
									<th>省市区</th>
									<td>						
										<?php echo $this->Html->tag('span', $this->Form->input('MallOrder.province', array('options' => $regions, 'type' => 'select', 'label' => false, 'div' => false, 'empty' => '省份', 'region_type' => 1, 'onchange' => 'javascript:jQuery.getRegions(this)')));?>								  									  									  
									</td>
								  </tr>
								  <tr>
									<th>街道</th>
									<td>
										<?php echo $this->Form->input('MallOrder.address', array('label' => false, 'style' => 'width:230px;', 'after' => '<span class="red bold"> *</span>'));?>									
									</td>
								  </tr>
								  <tr>
									<th>邮编</th>
									<td>
										<?php echo $this->Form->input('MallOrder.zipcode', array('label' => false, 'style' => 'width:120px;'));?>									
									</td>
								  </tr>
								  <tr>
									<th>手机</th>
									<td>
										<?php echo $this->Form->input('MallOrder.mobile', array('label' => false, 'style' => 'width:120px;', 'after' => '<span class="error">手机号或电话至少填写一个</span>'));?>																			
									</td>
								  </tr>
								  <tr>
									<th>电话</th>
									<td>
										<?php echo $this->Form->input('MallOrder.tell', array('label' => false, 'style' => 'width:120px;'));?>								
									</td>
								  </tr>
							</table>
						  </div>
						</div>
						<div class="div_c"></div>
					</div>
				</div>		
				<div class="remark">
					<div class="title">
						<div class="icon">订单留言</div>
					</div>				
					<div class="notice">请不要超过50个字符</div>
					<div class="content">
						<?php echo $this->Form->input('MallOrder.order_remark', array('type' => 'textarea', 'label' => false));?>
					</div>
				</div>				
				<div class="express">
					<div class="title">
						<div class="icon">配送方式</div>
					</div>
					<?php echo $this->Form->input('MallOrder.express_id', array('options' =>$express, 'default' => 1, 'type' => 'radio', 'legend' => false, 'before' => '<div class="item">', 'after' => '</div>', 'separator' => '</div><div class="item">'));?>
				</div>						
				<div class="payment">
					<div class="title">
						<div class="icon">支付方式</div>
					</div>
					<!-- 
					<div class="accountInfo">
						<span>账户余额</span>
						<span class="red">￥199.00</span>
						<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
						<span>余额支付</span>					
						<span><input name="" type="text" /></span>
						<span>元</span>
					</div>
					-->
					<div class="item">
			 	  	  <div class="checkbox">
				 	  	  <input id="MallOrderPayId" name="data[MallOrder][pay_id]" type="radio" value="1" checked="checked" />
				 	  </div>
						<div class="desc">
							<div class="pic alipay">&nbsp;</div>
						</div>
						<div class="div_c"></div>
					</div>
					<div class="item">
			 	  	  <div class="checkbox">
				 	  	  <input id="MallOrderPayId" name="data[MallOrder][pay_id]" type="radio" value="2" />
				 	  </div>
						<div class="desc">
							<div class="pic tenpay">&nbsp;</div>
						</div>
						<div class="div_c"></div>
					</div>					
				</div>
				<div class="check-total">
					<div>
						<span>合计</span>
						<span class="red goods_amount"><?php echo sprintf("￥%01.2f", $goods_amount);?></span>
						<span class="red bold">+</span>
						<span>配送费用</span>
						<span class="express_fee red"><?php echo sprintf("￥%01.2f", $express_fee);?></span>
						<!-- 
						<span>+</span>
						<span>运费</span>
						<span class="red">￥5</span>
						<span>=</span>
						<span>共计</span>
						<span class="red">￥999.99</span>
						 -->
					</div>
					<!-- 
					<div>
						<span>余额支付</span>
						<span class="red">￥10</span>
						<span>优惠券</span>
						<span class="red">￥5</span>						
						<span>支付宝支付</span>
						<span class="red">￥989.99</span>
					</div>
					 -->
				</div>
				<div class="options">
					<input name="cart_goods_num" type="hidden" value="<?php echo $cart_goods_num;?>" />
					<input name="goods_amount" type="hidden" value="<?php echo $goods_amount;?>" />
					<span><input type="submit" value="确认支付" />
					</span>
					<span><input type="button" value="继续购物" onclick="javascript:location.href='/Mall/'" />
					</span>					
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