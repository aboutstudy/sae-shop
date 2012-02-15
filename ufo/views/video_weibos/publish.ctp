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
	
	<?=$form->create('VideoWeibo', array('url' => '/VideoWeibos/publish/'.$id))?>
		
	<?=$form->input('Video.title', array('label' => '标题', 'style' => 'width:270px;'))?>	
		
	<?=$form->input('VideoWeibo.img', array('label' => '配图'))?>
	
	<?=$form->input('VideoWeibo.content', array('label' => '微博'))?>
	
	<?=$form->input('Video.status', array('before' => $form->label('发布'), 'type' => 'checkbox', 'label' => false, 'checked' => true))?>
	
	<?=$form->button('提交', array('type' => 'submit'))?>
	<?=$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/Videos/index/0') . '\''))?>
		
	<?=$form->hidden('VideoWeibo.video_id')?>
	
	<?=$form->end()?> 
</div>
</div>