<div class="ucMenu">
  <div class="item">
    <div class="head">
      <div class="icon"><?php echo $this->Html->link('会员中心', '/uc/', array('class' => 'red'));?></div>
    </div>
	<div class="item">
	   <div class="title">我的商城</div>
	   <?php echo $this->Html->div('sub', $this->Html->link("订单管理", '/MallOrder/index'));?>
	   <!-- <?php echo $this->Html->div('sub', $this->Html->link("收货地址", '/MallConsignee/index'));?> -->
	   <!-- <?php echo $this->Html->div('sub', $this->Html->link("资金管理", '/MallConsignee/index'));?> -->
	   <!-- <?php echo $this->Html->div('sub', $this->Html->link("优惠券", '/MallBounds/index'));?> -->
	</div>        
	<div class="item">
	   <div class="title">我的互动</div>
	   <!-- <?php echo $this->Html->div('sub', $this->Html->link('我的收藏', '/uc/favorite'));?> -->
	   <?php echo $this->Html->div('sub', $this->Html->link('我的评论', '/uc/comment'));?>
	</div>    
    <div class="title">账号设置</div>
    <?php echo $this->Html->div('sub', $this->Html->link('账号设置', '/users/setting'));?>
    <?php echo $this->Html->div('sub', $this->Html->link('微博绑定', '/users/bondWeibo'));?>
  </div>
</div>