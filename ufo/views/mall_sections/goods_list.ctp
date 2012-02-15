<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 商城管理 &gt;&gt; 版块管理 &gt;&gt; 商品管理 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function"><?php echo $list['MallSection']['title']?></td>
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
        <th width="40"><?=$paginator->sort('ID', 'MallGoods.id')?></td>
        <th><?=$paginator->sort('商品标题', 'MallGoods.title')?></td>
        <th><?=$paginator->sort('排序', 'MallGoods.sort_order')?></td>
        <th width="150"><div class="class-menu-function">操作</div></td>
      </tr>
      <!--信息列表开始-->
	  <?php
	  	foreach($list['MallGoods'] as $item):
	  ?>
      <tr>
        <td><input name="id[]" type="checkbox" id="id[]" value="1" /></td>
        <td><?php echo $item['id'];?></td>
        <td><?php echo $this->Html->link($item['title'], '/MallGoods/edit/'.$item['id']);?></td>
        <td class="sortOrder"><?php echo $this->Html->div('setSortOrder', $item['sort_order'], array('model' => 'MallGoods', 'id' => $item['id']));?></td>		
        <td>
        	<?php echo $this->Html->link('发布', '/ArticleWeibos/publish/'.$item['id'], array('target' => '_self'))?>
        	<?php echo $this->Html->link('预览', '/MallGoods/view/'.$item['id'], array('target' => '_blank'))?>
        	<?php echo $this->Html->link('编辑', '/MallGoods/edit/'.$item['id'], array('target' => '_self'))?>
			<?php echo $this->Html->link('删除', '/MallGoods/delete/'.$item['id'], array('target' => '_self'), '确认是否删除该商品')?>
		</td>
      </tr>
	  <?php
	  	endforeach;
	  ?>
      <!--信息列表结束-->
    </table>
    <!--通用模型信息显示结束-->
	<div class="option">
		<!-- 分页 -->
		<?php echo $this->element('page');?>
		<div class="botton">
			<input name="" type="button" value="删除" />			
		</div>
	</div>	
  </form>
</div>
</div>