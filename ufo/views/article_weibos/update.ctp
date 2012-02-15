<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 内容管理 &gt;&gt; 发布内容微博 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">微博信息</td>
      <td class="menu-function"><?php echo $this->Html->link('@'.$Faker['Sina']['screen_name'], '/', array('style' => 'color:red'));?></td>
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
		
	<?=$form->input('ArticleWeibo.img', array('label' => '配图'))?>
	
	<?=$form->input('ArticleWeibo.content', array('label' => '微博'))?>
	
	<?=$form->button('提交', array('type' => 'submit'))?>
	<?=$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/ArticleWeibos/update') . '\''))?>
	
	<?=$form->end()?> 
</div>
</div>