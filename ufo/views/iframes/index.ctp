<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<link href="css/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
</head>
<body>
<div class="container">
	<div class="message"><?php echo $this->Session->flash('auth'); ?></div>
	<div class="main">
		<div class="ticketCheck">
		  <label>证件号码 </label>
		  <label>
		  <input type="text" name="ticket" />
		  </label>
		  <label>
		  <input type="button" class="ticketCheckSubmit" name="Submit" value="提交" />
		  </label>
		</div>
		<div class="login">
		  <?=$form->create(null, array('url' => '/users/login'))?>
		  	<?=$form->input('User.username', array('label' => '账号', 'maxLength' => 30))?>
		  	
			<?=$form->input('User.password', array('label' => '密码', 'maxLength' => 30))?>		  	
			
			<?=$form->button('登陆', array('type' => 'submit', 'class' => 'loginSubmit'))?>
			<?=$this->Html->link(' 下载客户端', '/printer.rar', array('target' => '_blank', 'style' => 'color:red; font-weight:bold; text-decoration:none;'))?>
	      <?=$form->end()?>
	    </div>
	</div>
	<div class="footer">版权所有：人寿任我行 </div>
</div>
</body>
</html>