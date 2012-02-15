<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 商城管理 &gt;&gt; 订单详情 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div id="main">
  <form id="infolist" name="infolist" method="post" action="#" style="margin:0px;">
	<table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#CCCCCC">
		<tbody>
		  	<tr>
				<th width="70"><a>订单编号</a></th>
				<td><?php echo $this->Html->tag('span', $order['MallOrder']['order_sn']);?></td>
				<th width="70"><a>订单总额</a></th>
				<td><?php echo $this->Html->tag('span', sprintf('￥%01.2f', $order['MallOrder']['goods_amount']));?></td>
				<th width="70"><a>配送费用</a></th>
				<td><?php echo $this->Html->tag('span', sprintf('￥%01.2f', $order['MallOrder']['express_fee']));?></td>							
			</tr>	
		  	<tr>
				<th width="70"><a>付款状态</a></th>
				<td><?php echo $this->Html->tag('span', $order['MallOrder']['pay_status']);?></td>
				<th width="70"><a>付款方式</a></th>
				<td><?php echo $this->Html->tag('span', $order['MallOrder']['pay_name']);?></td>			
				<th width="70"><a>支付编号</a></th>
				<td><?php echo $this->Html->tag('span', $order['MallOrder']['pay_trade_no']);?></td>			
			</tr>
		  	<tr>
				<th width="70"><a>支付时间</a></th>
				<td colspan="5"><?php if(!empty($order['MallOrder']['pay_time'])) echo $this->Html->tag('span', date('Y-m-d H:i:s', $order['MallOrder']['pay_time']));?></td>			
			</tr>			
		  	<tr>
				<th width="70"><a>订单状态</a></th>
				<td><?php echo $this->Html->tag('span', $order['MallOrder']['order_status']);?></td>
				<th width="70"><a>配送方式</a></th>
				<td><?php echo $this->Html->tag('span', $order['MallOrder']['express_name']);?></td>			
				<th width="70"><a>配送编号</a></th>
				<td><?php echo $this->Html->tag('span', $order['MallOrder']['express_sn']);?></td>			
			</tr>
		  	<tr>
				<th width="70"><a>发货时间</a></th>
				<td colspan="5"><?php if(!empty($order['MallOrder']['delivery_time'])) echo $this->Html->tag('span', date('Y-m-d H:i:s', $order['MallOrder']['delivery_time']));?></td>			
			</tr>								
			<tr><td colspan="6"><br /></td></tr>
		  	<tr>
				<th width="70"><a>联系手机</a></th>
				<td><?php echo $this->Html->tag('span', $order['MallOrder']['mobile']);?></td>
				<th width="70"><a>联系电话</a></th>
				<td><?php echo $this->Html->tag('span', $order['MallOrder']['tell']);?></td>			
				<th width="70"><a>邮编</a></th>
				<td><?php echo $this->Html->tag('span', $order['MallOrder']['zipcode']);?></td>			
			</tr>			
		  	<tr>
				<th width="70"><a>收件人</a></th>
				<td><?php echo $this->Html->tag('span', $order['MallOrder']['consignee']);?></td>
				<th width="70"><a>会员名称</a></th>
				<td><?php echo $this->Html->tag('span', $order['Member']['username']);?></td>			
				<th width="70"><a>会员邮箱</a></th>
				<td><?php echo $this->Html->tag('span', $order['Member']['email']);?></td>			
			</tr>						
		  	<tr>
				<th width="70"><a>收货地址</a></th>
				<td colspan="5">
			  		<?php echo $this->Html->tag('span', $order['MallOrder']['province'] . '省');?>
			  		<?php echo $this->Html->tag('span', $order['MallOrder']['city'] . '市');?>
			  		<?php echo $this->Html->tag('span', $order['MallOrder']['district']);?>
			  		<?php echo $this->Html->tag('span', $order['MallOrder']['address']);?>
			  		<?php echo $this->Html->tag('span', $order['MallOrder']['consignee']);?>				
				</td>			
			</tr>					
		  	<tr>
				<th width="70"><a>订单留言</a></th>
				<td colspan="5"><?php echo $this->Html->tag('span', $order['MallOrder']['order_remark']);?></td>			
			</tr>							
	    </tbody>
	</table>  
	<br />
    <!--通用模型信息显示开始-->
    <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
        <th width="70">商品编号</td>
        <th>产品名称</td>
        <th width="70">单价</td>
        <th width="70">订购数量</td>
        <th width="70">配货状态</td>
        <th width="150"><div class="class-menu-function">操作</div></td>
      </tr>
      <!--信息列表开始-->
	  <?php
	  	foreach($order['MallOrderGoods'] as $item):
	  ?>
      <tr>
        <td><?php echo $this->Html->link($item['goods_sn'], '/MallGoods/view/'.$item['goods_id']);?></td>
        <td><?php echo $this->Html->link($item['goods_name'], '/MallGoods/view/'.$item['goods_id']);?></td>
        <td><?php echo $item['goods_price'];?></td>
        <td><?php echo $item['goods_number'];?></td>
        <td><?php echo $item['stock_status'];?></td>		
        <td>操作</td>
      </tr>
	  <?php
	  	endforeach;
	  ?>
      <!--信息列表结束-->
    </table>
    <!--通用模型信息显示结束-->
	<div class="option">
		<div class="botton">		
			<input name="" type="button" value="发货" onclick="javascript:location.href='<?php echo $this->Html->url('/MallOrders/delivery/' . $order['MallOrder']['id']);?>'"/>			
		</div>
	</div>	
  </form>
</div>
</div>