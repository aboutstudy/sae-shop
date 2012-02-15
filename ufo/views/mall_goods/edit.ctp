<div style="padding:5px;">
<div id="nav"><strong>您的位置:</strong> 商城管理 &gt;&gt; 编辑商品 </div>
<div id="menu">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10">&nbsp;</td>
      <td class="menu-function">商品信息</td>
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
	<?php echo $form->input('MallGoods.title', array('label' => '商品标题', 'style' => 'width:350px;'));?>
	<?php echo $form->input('MallGoods.short_title', array('label' => '短标题', 'style' => 'width:150px;'));?>
	
	<?php echo $form->input('MallGoods.sn', array('label' => '货号', 'style' => 'width:150px;'));?>
	<?php echo $form->input('MallGoods.goods_type_id', array('label' => '商品类型', 'options' => $goods_types, 'type' => 'select', 'after' => '<div class="div_c"></div>'));?>
	<?php echo $form->input('MallGoods.brand_id', array('label' => '所属品牌', 'options' => $goods_brands, 'type' => 'select', 'after' => '<div class="div_c"></div>'));?>
	<?php echo $form->input('MallGoods.spec', array('label' => '规格'));?>
	<?php echo $form->input('MallGoods.origin', array('label' => '产地'));?>
	<?php echo $form->input('MallGoods.stock', array('label' => '库存', 'style' => 'width:60px;'));?>
	<?php echo $form->input('MallGoods.user_max', array('label' => '购买限制', 'style' => 'width:60px;'));?>
	
	<?php echo $form->input('MallGoods.market_price', array('label' => '市场价', 'style' => 'width:60px;'));?>
	<?php echo $form->input('MallGoods.shop_price', array('label' => '豆壳价', 'style' => 'width:60px;'));?>
	
	<?php echo $form->input('MallGoods.promote_price', array('label' => '促销价', 'style' => 'width:60px;'));?>
	<?php echo $form->input('MallGoods.promote_start_time', array('label' => '起始'));?>
	<?php echo $form->input('MallGoods.promote_end_time', array('label' => '结束'));?>
	
	<?php echo $form->input('MallGoods.integral', array('label' => '购买积分', 'style' => 'width:60px;'));?>
	<?php echo $form->input('MallGoods.integral_give', array('label' => '赠送积分', 'style' => 'width:60px;'));?>
	
	<!-- 内容变更控制 -->
	<div class="noChange">
	<?php echo $form->input('MallSection', array('label' => '推荐版块', 'options' => $sections, 'type' => 'select', 'multiple' => 'checkbox', 'after' => '<div class="div_c"></div>'));?>
	
	<?php echo $form->input('MallCategory', array('label' => '分类', 'options' => $categorys, 'type' => 'select', 'multiple' => 'checkbox', 'after' => '<div class="div_c"></div>'));?>
	
	<?php echo $form->input('MallGoods.strTags', array('label' => '标签', 'style' => 'width:280px;'));?>
	</div>
		
	<?php echo $form->input('MallGoods.img', array('label' => '标题图片', 'after' => ' 320x320'));?>
	<?php echo $form->input('MallGoods.thumb_original', array('label' => '缩略图(原)', 'after' => ' 156x156'));?>
	<?php echo $form->input('MallGoods.thumb_big', array('label' => '缩略图(大)', 'after' => ' 135x135'));?>
	<?php echo $form->input('MallGoods.thumb_small', array('label' => '缩略图(小)', 'after' => ' 80x80'));?>
			
	<?php echo $this->Html->script('kindeditor');?>
	
	<?php echo $this->Javascript->codeBlock();?>
		KE.show({
			id:'MallGoodsDescContent',
			width:'710px',
			height:'420px'
		});
	<?php echo $this->Javascript->blockEnd();?>
	
	
	<?php echo $form->input('MallGoodsDesc.content', array('label' => '详细介绍'));?>
	<?php echo $form->hidden('MallGoodsDesc.id')?>
	
	<?php echo $this->Html->div('options',$form->button('提交', array('type' => 'submit')).$form->button('返回', array('type' => 'button', 'onclick' => 'javascript: location.href=\'' . $this->Html->url('/MallGoods/index') . '\'')));?>	
	
	<?php echo $form->hidden('MallGoods.id')?>
	<?php echo $form->end()?> 
</div>
</div>