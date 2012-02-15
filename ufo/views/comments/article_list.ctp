<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 内容管理 &gt;&gt; 百科评论管理 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div id="main">
  <form id="infolist" name="infolist" method="post" action="#" style="margin:0px;">
    <!--通用模型信息显示开始-->
    <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
        <th width="30">&nbsp;</td>
        <th><?=$paginator->sort('评论内容', 'ArticleComment.content')?></td>
        <th width="150"><?=$paginator->sort('评论时间', 'ArticleComment.created')?></th>
        <th width="150"><div class="class-menu-function">操作</div></td>
      </tr>
      <!--信息列表开始-->
	  <?php
	  	foreach($list as $item):
	  ?>
      <tr>
        <td><input name="id[]" type="checkbox" id="id[]" value="1" /></td>
        <td><?php echo $this->Html->link($item['ArticleComment']['content'], '/Articles/view/'.$item['ArticleComment']['article_id']);?></td>
        <td><?php echo date('Y-m-d H:i:s', $item['ArticleComment']['created'])?></td>		
        <td>
        	<?php echo $this->Html->link('预览', '/Articles/view/'.$item['Article']['id'], array('target' => '_blank'))?>
			<?php echo $this->Html->link('删除', '/Comments/delete/article/'.$item['ArticleComment']['id'], array('target' => '_self'), '确认是否删除该文章评论')?>
		</td>
      </tr>
	  <?php
	  	endforeach;
	  ?>
      <!--信息列表结束-->
    </table>
    <!--通用模型信息显示结束-->
	<div class="option">
		<?php echo $this->element('page');?>	
		<div class="botton">
			<input name="" type="button" value="删除" />			
		</div>
	</div>	
  </form>
</div>
</div>