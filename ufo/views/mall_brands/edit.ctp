<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 商城设置 &gt;&gt; 商品品牌管理  &gt;&gt; 编辑品牌</div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">品牌信息</td>
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
	<?php echo $form->input('MallBrand.title', array('label' => '品牌名称'));?>
	<?php echo $form->input('MallBrand.logo', array('label' => 'LOGO'));?>
	
	<?php echo $this->Html->div('options',$form->button('提交', array('type' => 'submit')).$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/MallBrands/index') . '\'')));?>	
	
	<?=$form->hidden('MallBrand.id')?>
	<?=$form->end()?> 
</div>
</div>