<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 商城管理 &gt;&gt; 订单管理 </div>
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
    <!--通用模型信息显示开始-->
    <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
        <th width="30">&nbsp;</td>
        <th width="150"><?=$paginator->sort('订单号', 'MallOrder.order_sn')?></td>
        <th><?=$paginator->sort('会员名', 'Member.username')?></td>
        <th width="70"><?=$paginator->sort('订单总额', 'MallOrder.goods_amount')?></td>
        <th width="70"><?=$paginator->sort('订单状态', 'MallOrder.order_status')?></td>
        <th width="70"><?=$paginator->sort('支付状态', 'MallOrder.pay_status')?></td>
        <th width="150"><?=$paginator->sort('创建时间', 'MallOrder.created')?></td>
        <th width="150"><div class="class-menu-function">操作</div></td>
      </tr>
      <!--信息列表开始-->
	  <?php
	  	foreach($list as $item):
	  ?>
      <tr>
        <td><input name="id[]" type="checkbox" id="id[]" value="1" /></td>
        <td><?php echo $this->Html->link($item['MallOrder']['order_sn'], '/MallOrders/view/'.$item['MallOrder']['id']);?></td>
        <td><?php echo $this->Html->link($item['Member']['username'], '/MallOrders/view/'.$item['MallOrder']['id']);?></td>
        <td><?php echo ($item['MallOrder']['goods_amount'] + $item['MallOrder']['express_fee']);?></td>
        <td><?php echo $item['MallOrder']['order_status'];?></td>
        <td><?php echo $item['MallOrder']['pay_status'];?></td>
        <td><?php echo date('Y-m-d H:i:s', $item['MallOrder']['created']);?></td>		
        <td>
        	<?php echo $this->Html->link('查看', '/MallOrders/view/'.$item['MallOrder']['id'], array('target' => '_self'))?>
			<?php echo $this->Html->link('删除', '/MallOrders/delete/'.$item['MallOrder']['id'], array('target' => '_self'), '确认是否删除该商品')?>
		</td>
      </tr>
	  <?php
	  	endforeach;
	  ?>
      <!--信息列表结束-->
    </table>
    <!--通用模型信息显示结束-->
	<div class="option">
		<!-- 分页 -->
		<?php echo $this->element('page');?>
		<div class="botton">
			<input name="" type="button" value="删除" />			
		</div>
	</div>	
  </form>
</div>
</div>