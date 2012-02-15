<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 帮助分类管理 &gt;&gt; 编辑分类 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">分类信息</td>
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
	<?php echo $form->input('HelpType.title', array('label' => '分类名'));?>
		
	<?php echo $this->Form->input('HelpType.type', array('type' => 'select', 'options' => array('1' => '网站使用', '2' => '关于我们', '3' => '网站公告')));?>
	
	<?php echo $this->Html->div('options',$form->button('提交', array('type' => 'submit')).$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/HelpTypes/index') . '\'')));?>	
	
	<?=$form->hidden('HelpType.id')?>
	<?=$form->end()?> 
</div>
</div>