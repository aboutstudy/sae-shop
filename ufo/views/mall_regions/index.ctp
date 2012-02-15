<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 支付配送 &gt;&gt; 配送地址</div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function"><label>
        <input type="button" name="Submit" value="新增地址" onClick="self.location.href='<?php echo $this->Html->url($editURL);?>'"/>
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
        <th width="40"><?=$paginator->sort('ID', 'MallRegion.id')?></td>
        <th><?=$paginator->sort('名称', 'MallRegion.region_name')?></td>
        <th width="200"><div class="class-menu-function">操作</div></td>
      </tr>
      <!--信息列表开始-->
	  <?php
	  	foreach($list as $item):
	  ?>
      <tr>
        <td><input name="id[]" type="checkbox" id="id[]" value="1" /></td>
        <td><?php echo $item['MallRegion']['id'];?></td>
        <td><?php echo $this->Html->link($item['MallRegion']['region_name'], '/MallRegions/edit/'.$item['MallRegion']['id']);?></td>		
        <td>
        	<?php echo $this->Html->link('编辑', '/MallRegions/edit/'.$item['MallRegion']['id'], array('target' => '_self'))?>
        	<?php echo $this->Html->link('下级区域', '/MallRegions/index/'.$item['MallRegion']['id'], array('target' => '_self'))?>
        	<?php echo $this->Html->link('添加下级', '/MallRegions/edit/null/'.$item['MallRegion']['id'].'/'.($item['MallRegion']['region_type'] + 1), array('target' => '_self'))?>
			<?php echo $this->Html->link('删除', '/MallRegions/delete/'.$item['MallRegion']['id'], array('target' => '_self'), '确认是否删除该分类')?>
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