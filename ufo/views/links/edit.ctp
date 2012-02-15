<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 链接管理  &gt;&gt; 编辑链接</div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">链接信息</td>
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
	<?php echo $form->input('Link.title', array('label' => '链接标题'));?>
	
	<?php echo $form->input('Link.url', array('label' => '链接地址'));?>
	
	<?php echo $form->input('Link.img', array('label' => '图片'));?>
	
	<?php echo $form->input('Link.type_id', array('label' => '分类类型', 'options' => $linkTypes, 'type' => 'select', 'after' => '<div class="div_c"></div>'));?>
	
	<?php echo $this->Html->div('options',$form->button('提交', array('type' => 'submit')).$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/Links/index') . '\'')));?>	
	
	<?=$form->hidden('Link.id')?>
	<?=$form->end()?> 
</div>
</div>