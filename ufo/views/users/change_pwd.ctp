<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 系统设置 &gt;&gt; 修改密码 </div>
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
		
	<?=$form->input('User.username', array('label' => '用户名'))?>
	
	<?=$form->input('User.password', array('label' => '密码'))?>
	
	<?=$form->button('提交', array('type' => 'submit'))?>	
	
	<?=$form->hidden('User.id')?>	

	<?=$form->end()?> 
</div>
</div>