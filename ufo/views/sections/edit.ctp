<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 网站设置 &gt;&gt; 版块管理 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">版块信息</td>
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
	<?php echo $form->input('Section.title', array('label' => '版块名称'));?>
		
	<?php echo $form->input('Section.type', array('label' => '版块类型', 'options' => array('1' => '文章', '2' => '视频'), 'type' => 'select', 'after' => '<div class="div_c"></div>'));?>
	
	<?php echo $this->Html->div('options',$form->button('提交', array('type' => 'submit')).$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/sections/index') . '\'')));?>	
	
	<?=$form->hidden('Section.id')?>
	<?=$form->end()?> 
</div>
</div>