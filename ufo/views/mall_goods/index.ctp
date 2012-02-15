<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 商城管理 &gt;&gt; 商品管理 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function"><label>
        <input type="button" name="Submit" value="新增商品" onClick="self.location.href='<?php echo $this->Html->url('/MallGoods/edit');?>'"/>
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
        <th width="40"><?=$paginator->sort('ID', 'MallGoods.id')?></td>
        <th><?=$paginator->sort('商品标题', 'MallGoods.title')?></td>
        <th width="40"><?=$paginator->sort('库存', 'MallGoods.stock')?></td>
        <th><?=$paginator->sort('排序', 'MallGoods.sort_order')?></td>
        <th width="150"><div class="class-menu-function">操作</div></td>
      </tr>
      <!--信息列表开始-->
	  <?php
	  	foreach($list as $item):
	  ?>
      <tr>
        <td><input name="id[]" type="checkbox" id="id[]" value="1" /></td>
        <td><?php echo $item['MallGoods']['id'];?></td>
        <td><?php if(!empty($item['MallGoodsWeibo']['id'])) echo $this->Html->link($this->Html->image('/images/icon_weibo_16x16.png'), 'http://www.doucl.com/weibo/toWeibo/'.$item['MallGoodsWeibo']['uid'].'/'.$item['MallGoodsWeibo']['sid'], array('target' => '_blank', 'escape' => false))?> <?php echo $this->Html->link($item['MallGoods']['title'], '/MallGoods/edit/'.$item['MallGoods']['id']);?></td>
        <td><?php echo $item['MallGoods']['stock'];?></td>
        <td class="sortOrder"><?php echo $this->Html->div('setSortOrder', $item['MallGoods']['sort_order'], array('model' => $this->params['controller'], 'id' => $item['MallGoods']['id']));?></td>		
        <td>
        	<?php echo $this->Html->link('发布', '/MallGoodsWeibos/publish/'.$item['MallGoods']['id'], array('target' => '_self'))?>
        	<?php echo $this->Html->link('预览', '/MallGoods/view/'.$item['MallGoods']['id'], array('target' => '_blank'))?>
        	<?php echo $this->Html->link('编辑', '/MallGoods/edit/'.$item['MallGoods']['id'], array('target' => '_self'))?>
			<?php echo $this->Html->link('删除', '/MallGoods/delete/'.$item['MallGoods']['id'], array('target' => '_self'), '确认是否删除该商品')?>
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