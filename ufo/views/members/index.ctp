<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 会员管理 &gt;&gt; 会员列表 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">&nbsp;</td>
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
        <th width="40"><?=$paginator->sort('ID', 'Member.id')?></td>
        <th width="120"><?=$paginator->sort('会员昵称', 'Member.username')?></td>
        <th><?=$paginator->sort('注册邮箱', 'Member.email')?></td>
        <th width="150"><?=$paginator->sort('注册时间', 'Member.created')?></td>
        <th width="120"><?=$paginator->sort('绑定微博', 'Sina.screen_name')?></td>
        <th width="150"><div class="class-menu-function">操作</div></td>
      </tr>
      <!--信息列表开始-->
	  <?php
	  	foreach($list as $item):
	  ?>
      <tr>
        <td><input name="id[]" type="checkbox" id="id[]" value="1" /></td>
        <td><?php echo $item['Member']['id'];?></td>
        <td><?php echo $this->Html->link($item['Member']['username'], '/members/edit/'.$item['Member']['id']);?></td>
        <td><?php echo $this->Html->link($item['Member']['email'], '/members/edit/'.$item['Member']['id']);?></td>
        <td><?php echo date('Y-m-d H:i:s', $item['Member']['created']);?></td>
        <td><?php echo $this->Html->link($item['Sina']['screen_name'], 'http://weibo.com/'.$item['Sina']['uid'], array('target' => '_blank'));?></td>		
        <td>
        	<?php echo $this->Html->link('编辑', '/members/edit/'.$item['Member']['id'], array('target' => '_self'))?>
			<?php echo $this->Html->link('删除', '/members/delete/'.$item['Member']['id'], array('target' => '_self'), '确认是否删除该微博账号')?>
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