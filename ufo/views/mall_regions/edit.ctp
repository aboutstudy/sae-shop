<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 支付配送 &gt;&gt; 配送地区管理  &gt;&gt; 编辑地区</div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">地区信息</td>
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
	<?php echo $form->input('MallRegion.region_name', array('label' => '地区'));?>
	
	<?php echo $this->Html->div('options',$form->button('提交', array('type' => 'submit')).$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/MallRegions/index') . '\'')));?>	
	
	<?=$form->hidden('MallRegion.id')?>
	<?=$form->hidden('MallRegion.parent_id')?>
	<?=$form->hidden('MallRegion.region_type')?>
	<?=$form->end()?> 
</div>
</div>