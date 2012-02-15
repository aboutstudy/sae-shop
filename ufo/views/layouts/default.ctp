<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title_for_layout; ?> - Weibo Tools</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
	//echo $this->Html->css('cake.generic');
	//echo $this->Html->css("index", NULL, array('inline' => FALSE));
	echo $this->Html->css("index");
	echo "\n";
	
	echo $this->Html->script("admin");
	echo "\n";
	echo $this->Html->script("http://lib.sinaapp.com/js/jquery/1.3.2/jquery.min.js");
	echo "\n";
	echo $this->Html->script("common");			
	echo "\n";	
	echo $scripts_for_layout;
?>

</head>
<body>
<?php echo $this->Session->flash('auth'); ?>
<?php echo $content_for_layout; ?>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
