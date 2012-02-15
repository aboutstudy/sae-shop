<div class="ucRight">
      <div class="head">
        <div class="icon">会员中心</div>
      </div>
	  <div class="account_detail">
	  	<div class="myface"><?php echo $this->Html->link($this->Html->image($user['User']['myface'], array('width' => 65, 'height' => 65)), '/Users/setting/', array('escape' => false));?></div>
		<div class="username">
			  欢迎您
			 <?php 
			 	 $sina = $this->Session->read('sina');
				 $qzone = $this->Session->read('qzone');
				 if(isset($sina['accessToken'])){
					echo $this->Html->image('/images/icon_weibo_16x16.png', array('class' => 'ico_role'));			
                 }
				 elseif(isset($qzone['accessToken'])){
					echo $this->Html->image('/images/icon_qq_16x16.png', array('class' => 'ico_role'));
				}
             ?>   
			 <?php echo $this->Html->tag('span', $user['User']['username'], array('class' => 'red'));?>
		</div>
	  	<div><span class="bold">会员级别：</span><span>普通会员</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold">会员积分：</span><?php echo $this->Html->tag('span', sprintf("%u", $user['User']['score']));?>&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold">账号余额:</span><?php echo $this->Html->tag('span', sprintf("￥%01.2f", $user['User']['money']));?></div>		
		<div class="div_c"></div>
	  </div>
	  <div class="list">
	  	<div class="title">最近订单</div>
		<table width="100%" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
		  	<th width="120">订单号</th>
            <th width="80">缩略图</th>
            <th>产品名称</th>
            <th width="65">订单状态</th>
            <th width="100">日期</th>
            <th width="85">操作</th>
          </tr>
          <?php if(empty($order_list)):?>
          <tr><td colspan="6">暂无订单 <?php echo $this->Html->link(' >>> 去商城逛逛吧', '/Mall', array('class' => 'red bold'));?></td></tr>
          <?php endif;?>
          <?php foreach($order_list as $item):?>
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
          <tr>
            <th colspan="6" height="25"> 
               <div class="pageShow"><?php echo $this->Html->link('更多订单管理>>>', '/MallOrder/index/');?></div>
             </th>
          </tr>
        </table>
      </div>
    </div>