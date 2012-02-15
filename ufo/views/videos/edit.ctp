<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 内容管理 &gt;&gt; 编辑视频 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">视频信息</td>
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
	<?php echo $form->input('Video.title', array('label' => '视频标题', 'style' => 'width:280px;'));?>
	<?php echo $form->input('Video.from', array('label' => '引用来源'));?>
	<?php echo $form->input('Video.src', array('label' => '视频地址', 'style' => 'width:280px;'));?>
	<?php echo $form->input('Video.thumb', array('label' => '缩略图', 'style' => 'width:280px;'));?>
	
	<?php echo $form->input('Video.img', array('label' => '标题图片', 'style' => 'width:280px;'));?>
	
	<!-- 内容变更控制 -->
	<div class="noChange">	
	<?php echo $form->input('Section', array('label' => '推荐版块', 'options' => $sections, 'type' => 'select', 'multiple' => 'checkbox', 'after' => '<div class="div_c"></div>'));?>
		
	<?php echo $form->input('Category', array('label' => '分类', 'options' => $categorys, 'type' => 'select', 'multiple' => 'checkbox', 'after' => '<div class="div_c"></div>'));?>
	
	<?php echo $form->input('Video.strTags', array('label' => '标签', 'style' => 'width:280px;'));?>	
	</div>	
	
	<?php echo $this->Html->script('kindeditor');?>
	
	<?php echo $this->Javascript->codeBlock();?>
		KE.show({
			id:'VideoDescContent',
			width:'510px',
			height:'420px'
		});
	<?php echo $this->Javascript->blockEnd();?>
	
	
	<?php echo $form->input('VideoDesc.content', array('label' => '视频描述'));?>
	<?php echo $form->hidden('VideoDesc.id')?>
	
	<?php echo $this->Html->div('options',$form->button('提交', array('type' => 'submit')).$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/videos/index') . '\'')));?>	
	
	<?php echo $form->hidden('Video.id')?>
	<?php echo $form->end()?> 
</div>
</div>