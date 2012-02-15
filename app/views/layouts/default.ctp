<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="豆壳网,豆壳商城,豆壳,豆粉,豆饭,美容,护肤,化妆,护理,养生,美容咨询,护理咨询,化妆咨询" />
<meta name="description" content="<?php echo $title_for_layout; ?>.豆壳网专注于女性生活领域,让女人更懂美!" />

<title><?php echo $title_for_layout; ?> - 豆壳网</title>
<script type="text/javascript">
	var SITE_URL = "http://<?php echo $_SERVER['HTTP_HOST'];?>";
</script>
<?php
	
	echo $this->Html->css("index");
	echo "\n";
	echo $this->Html->script("jquery-1.3.2.min");
	echo "\n";
	echo $this->Html->script("jquery.pngFix.pack");
	echo "\n";
	echo $this->Html->script("common");
	echo "\n";
	
	echo $scripts_for_layout;
?>

</head>

<body>
<div class="container">
	<div class="header">
		<div class="logo"><?php echo $this->Html->image('/images/logo.jpg', array('title' => '豆壳网', 'alt' => '豆壳网', 'url' => '/'));?></div>
		<div class="banner">
			<!-- 顶部副导航 -->
			<cake:nocache>
				<?php echo $this->element('topNav');?>
			</cake:nocache>
			<div class="header-banner">
				<div class="header-400">&nbsp;</div>
			</div>			
			<div class="nav-main">
				<ul>
					<li<?php if(strtolower($this->params['controller']) == 'users' OR strtolower($this->params['controller']) == 'help') echo ' class="cur"';?>><?php echo $this->Html->link('首页', '/', array('title' => '豆壳网'));?></li>
					<li<?php if(strtolower($this->params['controller']) == 'video') echo ' class="cur"';?>><?php echo $this->Html->link('视频课堂', '/video/search/', array('title' => '视频课堂'));?></li>
					<li<?php if(strtolower($this->params['controller']) == 'baike') echo ' class="cur"';?>><?php echo $this->Html->link('美丽百科', '/baike/search/', array('title' => '美丽百科'));?></li>
					<li><?php echo $this->Html->link('豆壳商城', '/mall/', array('title' => '豆壳商城'));?></li>
				</ul>
				<div class="cart">共 <span class="red num_in_cart">0</span> 件商品 <span><a href="/MallCart/index/"><span class="red">去结算</span></a> </span></div>				
			</div>
		</div>
	</div>
	<!-- 通栏活动 -->
	<?php echo $this->element('bannerShow');?>	
	<!--主体开始-->
	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $content_for_layout; ?>	
	<!--主体结束-->
	<?php echo $this->element('footer');?>
</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
