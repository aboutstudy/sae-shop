<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 互动管理 &gt;&gt; 商品评论管理 </div>
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
        <th><?=$paginator->sort('评论内容', 'MallGoodsComment.content')?></td>
        <th width="150"><?=$paginator->sort('评论时间', 'MallGoodsComment.created')?></th>
        <th width="150"><div class="class-menu-function">操作</div></td>
      </tr>
      <!--信息列表开始-->
	  <?php
	  	foreach($list as $item):
	  ?>
      <tr>
        <td><input name="id[]" type="checkbox" id="id[]" value="1" /></td>
        <td><?php echo $this->Html->link($item['MallGoodsComment']['content'], '/MallGoodss/view/'.$item['MallGoodsComment']['goods_id']);?></td>
        <td><?php echo date('Y-m-d H:i:s', $item['MallGoodsComment']['created'])?></td>		
        <td>
        	<?php echo $this->Html->link('预览', '/MallGoods/view/'.$item['MallGoods']['id'], array('target' => '_blank'))?>
			<?php echo $this->Html->link('删除', '/Comments/delete/goods/'.$item['MallGoodsComment']['id'], array('target' => '_self'), '确认是否删除该视频评论')?>
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