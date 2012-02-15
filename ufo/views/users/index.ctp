<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 系统设置 &gt;&gt; 账号管理 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function"><label>
        <input type="button" name="Submit" value="新增账号" onClick="self.location.href='<?php echo $this->Html->url('/users/edit/');?>'"/>
        </label>
      </td>
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
        <th width="40"><?=$paginator->sort('ID', 'User.id')?></td>
        <th><?=$paginator->sort('用户名', 'User.username')?></td>                
        <th width="50"><?=$paginator->sort('状态', 'User.status')?></td>
        <th width="170"><?=$paginator->sort('创建时间', 'User.created')?></td>
        <th width="130"><div class="class-menu-function">操作</div></td>
      </tr>
      <!--信息列表开始-->
	  <?
	  	foreach($arrUsers as $user):
	  ?>
      <tr>
        <td><input name="id[]" type="checkbox" id="id[]" value="1" /></td>
        <td><?=$user['User']['id']?></td>
        <td><?=$this->Html->link($user['User']['username'], '/users/edit/'.$user['User']['id'])?></td>                
        <td><?=$user['User']['status'] ? '启用' : '<font color="red">停用</font>';?></td>
        <td><?=date('Y-m-d H:i', $user['User']['created'])?></td>		
        <td>
			<?=$this->Html->link('编辑', '/users/edit/'.$user['User']['id'])?>
			<?=$this->Html->link('删除', '/users/delete/'.$user['User']['id'], array('target' => '_self'), '确认是否删除该账号')?>
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