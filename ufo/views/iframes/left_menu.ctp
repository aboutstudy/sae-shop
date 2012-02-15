<div class="models">
	<div class="class-title">内容管理</div>
	<div class="list-content">
		<div class="list-td"><?=$this->Html->link('文章审核', '/articles/index/0/', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('文章管理', '/articles/index/1/', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('视频审核', '/videos/index/0/', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('视频管理', '/videos/index/1/', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('分类管理', '/categorys/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('标签管理', '/tags/index', array('target' => 'right-iframe'))?></div>		
	</div>
</div>
<div class="models">
	<div class="class-title">互动管理</div>
	<div class="list-content">
		<div class="list-td"><?=$this->Html->link('百科评论', '/Comments/articleList', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('视频评论', '/Comments/videoList', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('商品评论', '/Comments/goodsList', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('发微博', '/ArticleWeibos/update', array('target' => 'right-iframe'))?></div>		
	</div>
</div>
<div class="models">
	<div class="class-title">网站设置</div>
	<div class="list-content">
		<div class="list-td"><?=$this->Html->link('系统设置', '/Members/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('网站设置', '/Members/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('版块管理', '/Sections/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('帮助管理', '/Helps/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('帮助分类', '/HelpTypes/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('链接分类', '/LinkTypes/index', array('target' => 'right-iframe'))?></div>		
		<div class="list-td"><?=$this->Html->link('账号管理', '/Users/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('账号分组', '/Members/index', array('target' => 'right-iframe'))?></div>
	</div>
</div>
<div class="models">
	<div class="class-title">商城管理</div>
	<div class="list-content">
		<div class="list-td"><?=$this->Html->link('版块管理', '/MallSections/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('广告推荐', '/Links/index/1', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('商品类型', '/MallGoodsTypes/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('分类类型', '/MallCatTypes/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('分类管理', '/MallCategorys/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('品牌管理', '/MallBrands/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('商品管理', '/MallGoods/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('订单管理', '/MallOrders/index', array('target' => 'right-iframe'))?></div>
	</div>
</div>
<div class="models">
	<div class="class-title">配送支付</div>
	<div class="list-content">
		<div class="list-td"><?=$this->Html->link('配送区域', '/MallRegions/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('配送方式', '/MallExpress/index', array('target' => 'right-iframe'))?></div>
	</div>
</div>
<div class="models">
	<div class="class-title">会员管理</div>
	<div class="list-content">
		<div class="list-td"><?=$this->Html->link('会员管理', '/members/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('绑定微博管理', '/sinas/index', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('马甲管理', '/sinas/fakerList', array('target' => 'right-iframe'))?></div>
		<div class="list-td"><?=$this->Html->link('标签管理', '/member_tags/index', array('target' => 'right-iframe'))?></div>
	</div>
</div>
<style type="text/css">
<!--
body {
	margin-top: -18px;
	margin-bottom: 0px;
	padding:0 5px;
}
-->
</style>