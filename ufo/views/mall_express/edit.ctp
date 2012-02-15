<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 支付配送 &gt;&gt; 配送方式  &gt;&gt; 编辑</div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">配送方式</td>
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
	<?php echo $form->input('MallExpress.title', array('label' => '名称'));?>
	
	<?php echo $form->input('MallExpress.description', array('label' => '备注', 'type' => 'textarea'));?>
	
	<?php echo $form->input('MallExpress.fee', array('label' => '费用'));?>	
	
	<?php echo $form->input('MallExpress.discount', array('label' => '免邮额', 'after' => $this->Html->tag('span', ' 按条件免运费额度')));?>
	
	<?php echo $form->input('MallExpress.status', array('label' => '启用', 'type' => 'checkbox'));?>
	
	<?php echo $this->Html->div('options',$form->button('提交', array('type' => 'submit')).$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/MallExpress/index') . '\'')));?>	
	
	<?=$form->hidden('MallExpress.id')?>
	<?=$form->end()?> 
</div>
</div>