<div class="ucRight">
    <div class="head">
      <div class="icon">我的订单</div>
    </div>
	<div class="list">
		<table width="100%" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
		  	<th width="120">订单号</th>
            <th width="80">缩略图</th>
            <th>产品名称</th>
            <th width="65">订单状态</th>
            <th width="100">日期</th>
            <th width="85">操作</th>
          </tr>
          <?php if(empty($order)):?>
          <tr><td colspan="6">暂无订单<?php echo $this->Html->link(' >>> 去商城逛逛吧', '/Mall', array('class' => 'red bold'));?></td></tr>
          <?php endif;?>          
          <?php foreach($order as $item):?>
          	<?php foreach($item['MallOrderGoods'] as $goods):?>
	          <tr>
			  	<td><?php echo $this->Html->link($item['MallOrder']['order_sn'], '/MallOrder/view/' . $goods['order_id'], array('target' => '_blank'));?></td>
	            <td>
	            	<div class="goodsThumb">
	            		<?php echo $this->Html->link($this->Html->image($goods['goods_thumb'], array('width' => 80, 'height' => 80)), '/Goods/view/' . $goods['goods_id'], array('escape' => false, 'target' => '_blank'));?>
	            	</div>
	              </td>
	            <td><?php echo $this->Html->link($goods['goods_name'], '/Goods/view/' . $goods['goods_id'], array('escape' => false, 'target' => '_blank'))?></td>
	            <td>
	            	<?php echo $item['MallOrder']['pay_status_name'];?>
	            	<br />
	            	<?php echo $item['MallOrder']['order_status_name'];?>
	            </td>
	            <td><?php echo date('Y-m-d H:i', $item['MallOrder']['created'])?></td>
	            <td>
	            	<?php echo $this->Html->link('查看订单', '/MallOrder/view/' . $goods['order_id'], array('target' => '_blank'));?>
					<br />
	            	<?php if($item['MallOrder']['pay_status'] == 0) echo $this->Html->link('订单付款', '/MallCart/ucOrderPay/'.$goods['order_id'], array('class' => 'red bold'));?>	            	
	            </td>
	          </tr>
	         <?php endforeach;?> 
          <?php endforeach;?>          
          <tr>
            <th colspan="6" height="25"> <div class="pageShow">
                <div class="optionShow">
                  <input name="selectAll" id="selectAll" type="checkbox" value="" />
                  <label for="selectAll">全选</label>
                </div>
                <?php echo $this->element('pageShow');?>
                </div>
             </th>
          </tr>
        </table>
      </div>
</div>