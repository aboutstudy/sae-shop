<div class="homeMain">
    <div class="mainLeft">
      <div class="cart">
        <div class="cartTitle">
          <div class="icon">确认付款</div>
        </div>
        <div class="setups step3">
          <div class="setup">1.提交订单</div>
          <div class="setup">2.订单确认付款</div>
          <div class="setup">3.支付成功</div>
        </div>
        <div class="orderInfo">
          <div class="desc">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th width="75" scope="row">订单号</th>
                <td><?php echo $order_sn;?></td>
              </tr>
              <tr>
                <th scope="row">支付总额</th>
                <td><?php echo sprintf("￥%01.2f (含运费)", ($goods_amount + $express_fee));?></td>
              </tr>
              <tr>
                <th scope="row">支付方式</th>
                <td><?php echo $payment_name;?></td>
              </tr>
            </table>
          </div>
          <div class="button">
          	<?php echo $paymentCode;?>
          	<!-- <input type="button" value="确认支付" />  -->
          </div>
        </div>
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