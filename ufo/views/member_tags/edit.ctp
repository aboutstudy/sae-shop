<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 会员管理 &gt;&gt; 编辑标签 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">标签信息</td>
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
	<?php echo $form->input('MemberTag.title', array('label' => '标签名'));?>
	
	<?php
		/* 
		   MemberTag.type = 1：会员可用
						   	2：保留
						   	3：保留
							4：网站配置							
		*/					
		echo $form->input('MemberTag.type', array('label' => '版块类型', 'options' => array('1' => '会员可用', '4' => '网站配置'), 'type' => 'select', 'after' => '<div class="div_c"></div>'));
	?>
	
	<?php echo $this->Html->div('options',$form->button('提交', array('type' => 'submit')).$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/MemberTags/index') . '\'')));?>	
	
	<?=$form->hidden('MemberTag.id')?>
	<?=$form->end()?> 
</div>
</div>