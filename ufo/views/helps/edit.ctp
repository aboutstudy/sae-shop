<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 帮助管理 &gt;&gt; 编辑帮助 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">帮助信息</td>
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
	<?php echo $form->input('Help.title', array('label' => '帮助标题', 'style' => 'width:280px;'));?>

	<?php echo $this->Form->input('Help.help_type_id', array('type' => 'select', 'options' => $arrHelpType, 'label' => '帮助分类'));?>	
			
	<?php echo $this->Html->script('kindeditor');?>
	
	<?php echo $this->Javascript->codeBlock();?>
		KE.show({
			id:'HelpContent',
			width:'520px',
			height:'420px'
		});
	<?php echo $this->Javascript->blockEnd();?>
	
	
	<?php echo $form->input('Help.content', array('label' => '帮助内容'));?>
	
	<?php echo $this->Html->div('options',$form->button('提交', array('type' => 'submit')).$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/Helps/index') . '\'')));?>	
	
	<?php echo $form->hidden('Help.id')?>
	<?php echo $form->end()?> 
</div>
</div>