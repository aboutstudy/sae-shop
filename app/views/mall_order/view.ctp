<div class="ucRight order">
      <div class="head">
        <div class="icon">订单详情</div>
      </div>
	  <div class="orderDetail">
	  	<div class="item"><span class="bold">订单编号：</span><?php echo $this->Html->tag('span', $order['MallOrder']['order_sn']);?></div>
	  	<div class="item"><span class="bold">订单总额：</span><?php echo $this->Html->tag('span', sprintf("￥%01.2f", $order['MallOrder']['goods_amount']), array('class' => 'bold red'));?></div>
	  	<div class="item"><span class="bold">配送费用：</span><?php echo $this->Html->tag('span', sprintf("￥%01.2f", $order['MallOrder']['express_fee']), array('class' => 'bold red'));?></div>				
	  	<div class="item">
	  		<div style="width:135px; float:left;">
	  			<span class="bold">付款状态：</span><?php echo $this->Html->tag('span', $order['MallOrder']['pay_status_name']);?>
	  		</div>
	  		<div style="width:160px; float:left;">	
	  			<span class="bold">付款方式：</span><?php echo $this->Html->tag('span', $order['MallOrder']['pay_name'], array('class' => 'red bold'));?>
	  		</div>
	  		<div style="width:170px; float:left;">	
	  			<span class="bold">付款时间：</span><span></span><?php if(!empty($order['MallOrder']['pay_time'])) echo $this->Html->tag('span', date('Y-m-d H:i', $order['MallOrder']['pay_time']));?>
	  		</div>	  		
	  		<div style="width:275px; float:left;">
	  			<span class="bold">支付编号：</span><?php echo $this->Html->tag('span', $order['MallOrder']['pay_trade_no']);?>
	  		</div>	  		
	  		<div class="div_c"></div>	
	  	</div>	  	
	  	<div class="item">
	  		<div style="width:135px; float:left;">
	  			<span class="bold">订单状态：</span><?php echo $this->Html->tag('span', $order['MallOrder']['order_status_name']);?>
	  		</div>	
	  		<div style="width:160px; float:left;">
	  			<span class="bold">配送方式：</span><?php echo $this->Html->tag('span', $order['MallOrder']['express_name'], array('class' => 'red bold'));?>
	  		</div>	  		
	  		<div style="width:170px; float:left;">	
	  			<span class="bold">发货时间：</span><?php if(!empty($order['MallOrder']['delivery_time'])) echo $this->Html->tag('span', date('Y-m-d H:i', $order['MallOrder']['delivery_time']));?>
	  		</div>
	  		<div style="width:275px; float:left;">	
	  			<span class="bold">快递单号：</span><?php echo $this->Html->tag('span', $order['MallOrder']['express_sn']);?>
	  		</div>	  			  		
	  		<div class="div_c"></div>	
	  	</div>
	  	<div class="item"><span class="bold">收件地址：</span>
	  		<?php echo $this->Html->tag('span', $order['MallOrder']['province'] . '省');?>
	  		<?php echo $this->Html->tag('span', $order['MallOrder']['city'] . '市');?>
	  		<?php echo $this->Html->tag('span', $order['MallOrder']['district']);?>
	  		<?php echo $this->Html->tag('span', $order['MallOrder']['address']);?>
	  		<?php echo $this->Html->tag('span', $order['MallOrder']['consignee']);?>	
		</div>		
	  	<div class="item"><span class="bold">邮编：</span><?php echo $this->Html->tag('span', $order['MallOrder']['zipcode']);?></div>		
	  	<div class="item"><span class="bold">手机：</span><?php echo $this->Html->tag('span', $order['MallOrder']['mobile']);?></div>		
	  	<div class="item"><span class="bold">电话：</span><?php echo $this->Html->tag('span', $order['MallOrder']['tell']);?></div>
	  	<div class="item"><span class="bold">留言：</span><?php echo $this->Html->tag('span', $order['MallOrder']['order_remark']);?></div>
	  </div>
      <div class="list">
        <table width="100%" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="80">缩略图</th>
            <th>商品名称</th>
            <th width="60">单价</th>
            <th width="60">数量</th>			
          </tr>
          <?php foreach($order['MallOrderGoods'] as $goods):?>
          <tr>
            <td><div class="goodsThumb"><?php echo $this->Html->link($this->Html->image($goods['goods_thumb'], array('width' => 80, 'height' => 80, 'title' => $goods['goods_name'], 'alt' => $goods['goods_name'])), '/Goods/view/' . $goods['goods_id'], array('target' => '_blank', 'escape' => false));?></div></td>
            <td><?php echo $this->Html->link($goods['goods_name'], '/Goods/view/' . $goods['goods_id'], array('target' => '_blank'));?></td>
            <td><?php echo sprintf("￥%01.2f", $goods['goods_price']);?></td>
            <td><?php echo $goods['goods_number'];?></td>			
          </tr>
          <?php endforeach;?>
          <tr>
            <th colspan="4" height="25">
				<div class="options">
					<?php 
						if(empty($order['MallOrder']['pay_trade_no'])){
							echo "<span><input type=\"button\" value=\"确认支付\" onclick=\"javascript:location.href='/MallCart/ucOrderPay/".$order['MallOrder']['id']."'\" /></span>";
						}					
					?>
				</div>
			</th>
          </tr>
        </table>
      </div>
    </div>