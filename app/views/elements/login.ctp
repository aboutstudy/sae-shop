<div class="region">
	<div class="top"><span class="bold">登陆</span> <span class="red">Login</span></div>
	<div class="content">
		<div class="loginForm home">
			<?php echo $form->create('User', array('url' => '/users/login'));?>
			<?php echo $this->Html->div('loginButton button submit', '');?>
			<?php echo $form->input('User.email', array('div' => 'email', 'label' => ''));?>
			<?php echo $form->input('User.password', array('div' => 'password', 'label' => ''));?>
			<div class="div_c"></div>
			<div class="reg"> 
				<?php echo $this->Html->link('注册账号', '/Users/reg');?>
				<?php echo $this->Html->link('新浪微博登陆', '/Users/login', array('class' => 'red bold'));?> 
				<!-- <a href="#">忘记密码</a> -->
			</div>
			<?php echo $form->end();?>
		</div>
	</div>
</div>