<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if (Configure::read() == 0) { ?>
<meta http-equiv="Refresh" content="<?php echo $pause; ?>;url=<?php echo $url; ?>"/>
<?php } ?>
<title>操作提示 - 豆壳网</title>
<script type="text/javascript">
	var SITE_URL = "http://<?php echo $_SERVER['HTTP_HOST'];?>";
</script>
<?php
	
	echo $this->Html->css("index");
	echo "\n";

	echo $this->Html->script("jquery-1.3.2.min");
	echo "\n";
	echo $this->Html->script("common");
	echo "\n";	
	echo $scripts_for_layout;
?>
</head>

<body>
<div class="container">
	<div class="flashMessage">
		<div class="title"><div class="icon">操作提示</div></div>
		<div class="content">
			<div><?php echo $this->Html->link($message, $url, array('class' => 'red bold'));?></div>
			<div><?php echo $this->Html->link('【下一步】', $url);?></div>
		</div>
	</div>
</div>
</body>
</html>
