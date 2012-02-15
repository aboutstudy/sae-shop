<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 内容管理 &gt;&gt; 视频管理 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function"><label>
        <input type="button" name="Submit" value="新增视频" onClick="self.location.href='<?php echo $this->Html->url('/videos/edit');?>'"/>
        </label>
      </td>
	  <td class="menu-function"><?php echo $this->Html->link('@'.$Faker['Sina']['screen_name'], 'http://weibo.com/'.$Faker['Sina']['uid'], array('style' => 'color:red', 'target' => '_blank'));?></td>
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
        <th width="40"><?=$paginator->sort('ID', 'Video.id')?></td>
        <th><?=$paginator->sort('视频标题', 'Video.title')?></td>
        <th width="150"><div class="class-menu-function">操作</div></td>
      </tr>
      <!--信息列表开始-->
	  <?php
	  	foreach($arrList as $item):
	  ?>
      <tr>
        <td><input name="id[]" type="checkbox" id="id[]" value="1" /></td>
        <td><?php echo $item['Video']['id'];?></td>
        <td><?php echo $this->Html->link($item['Video']['title'], '/videos/edit/'.$item['Video']['id']);?></td>		
        <td>
			<?php echo $this->Html->link('发布', '/VideoWeibos/publish/'.$item['Video']['id'], array('target' => '_self'))?>        
        	<?php echo $this->Html->link('预览', '/videos/view/'.$item['Video']['id'], array('target' => '_blank'))?>
        	<?php echo $this->Html->link('编辑', '/videos/edit/'.$item['Video']['id'], array('target' => '_self'))?>
			<?php echo $this->Html->link('删除', '/videos/delete/'.$item['Video']['id'], array('target' => '_self'), '确认是否删除该文章')?>
		</td>
      </tr>
	  <?php
	  	endforeach;
	  ?>
      <!--信息列表结束-->
    </table>
    <!--通用模型信息显示结束-->
	<div class="option">
		<div class="page">
			<?php
		     echo $paginator->counter(array('format' => '<span>共 %count% 条记录 </span><span>第 %page%/%pages% 页</span> '));
		     echo $paginator->first(' 首页', null, null);
			 echo $paginator->prev(' 上一页', null, null);
			 echo $paginator->numbers(array('separator' => ' ', 'before' => '', 'after' => ''));
			 echo $paginator->next(' 下一页', null, null);
			 echo $paginator->last(' 末页', null, null);
			?>
		</div>	
		<div class="botton">
			<input name="" type="button" value="删除" />			
		</div>
	</div>	
  </form>
</div>
</div>