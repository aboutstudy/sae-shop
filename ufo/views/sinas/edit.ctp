﻿<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 会员管理 &gt;&gt; 编辑会员 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">账号信息</td>
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
	
	<?=$form->create()?>	
		
	<?=$form->input('Member.username', array('label' => '用户名'))?>
	
	<?=$form->input('Member.password', array('label' => '密码'))?>
	
	<?=$form->input('Sina.oauth_token', array('label' => 'token'))?>
	
	<?=$form->input('Sina.oauth_token_secret', array('label' => 'secret'))?>
	
	<?=$form->input('Member.is_faker', array('before' => $form->label('马甲'), 'type' => 'checkbox', 'label' => false))?>
	
	<?=$form->button('提交', array('type' => 'submit'))?>
	<?=$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/sinas/index') . '\''))?>
	
	
	<?=$form->hidden('Member.id')?>	

	<?=$form->end()?> 
</div>
</div>