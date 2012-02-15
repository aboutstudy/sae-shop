<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 订单管理 &gt;&gt; 订单发货 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div id="main">
	
	<?php echo $form->create();?>		
	<?php echo $form->input('MallOrder.order_sn', array('label' => '订单编号', 'disabled' => true));?>
	
	<?php echo $form->input('MallOrder.express_sn', array('label' => '配送编号'));?>
	
	<?php echo $this->Html->div('options',$form->button('提交', array('type' => 'submit')).$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/MallOrder/view/' . $this->data['MallOrder']['id']) . '\'')));?>	
	
	<?=$form->hidden('MallOrder.id')?>
	<?=$form->end()?> 
</div>
</div>