<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 内容管理 &gt;&gt; 编辑文章 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">文章信息</td>
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
	<?php echo $form->input('Article.title', array('label' => '文章标题', 'style' => 'width:280px;'));?>
	<?php echo $form->input('Article.from', array('label' => '引用来源'));?>
	<?php echo $form->input('Article.img', array('label' => '标题图片'));?>
	
	<!-- 内容变更控制 -->
	<div class="noChange">	
	<?php echo $form->input('Section', array('label' => '推荐版块', 'options' => $sections, 'type' => 'select', 'multiple' => 'checkbox', 'after' => '<div class="div_c"></div>'));?>
	
	<?php echo $form->input('Category', array('label' => '分类', 'options' => $categorys, 'type' => 'select', 'multiple' => 'checkbox', 'after' => '<div class="div_c"></div>'));?>
	
	<?php echo $form->input('Article.strTags', array('label' => '标签', 'style' => 'width:280px;'));?>
	</div>	
	
	<?php echo $this->Html->script('kindeditor');?>
	
	<?php echo $this->Javascript->codeBlock();?>
		KE.show({
			id:'ArticleContent0Content',
			width:'520px',
			height:'420px'
		});
	<?php echo $this->Javascript->blockEnd();?>
	
	
	<?php echo $form->input('ArticleContent.0.content', array('label' => '详细内容'));?>
	<?php echo $form->hidden('ArticleContent.0.id')?>
	
	<?php echo $this->Html->div('options',$form->button('提交', array('type' => 'submit')).$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/articles/index') . '\'')));?>	
	
	<?php echo $form->hidden('Article.id')?>
	<?php echo $form->end()?> 
</div>
</div>