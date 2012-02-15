<div class="homeMain">
		<div class="mainLeft">
		  <div class="regLogin">		  	
			 <div class="regLoginTitle">
				<div class="icon">会员注册</div>
			 </div>
		  </div>	 			
		  <div class="reg">
		  	 <?php
			 	echo $form->create('User', array('url' => '/users/reg'));
				echo $this->Html->div('button submit', '');
				echo $form->input('User.email', array('label' => 'E-Mail'));						
				echo $form->input('User.password', array('label' => '密码'));						
				echo $form->input('User.repwd', array('label' => '密码确认', 'type' => 'password'));																
				echo $form->end();
			 ?>
			 <div class="partner">
			 	<div class="title">使用合作网站账号登录豆壳网：</div>
				<div class="partnerList">
					<ul>
						<li class="sinaLink"><?php echo $this->Html->image('/images/sina_weibo.png', array('url' => $aurl));?></li>
						<li class="qzoneLink"><?php echo $this->Html->image('/images/connect_qzone.png', array('url' => '/Users/toQzoneConnect/'));?></li>
					</ul>
				</div>
			 </div>	 
		  </div>
	  </div>
		<div class="sidebar">
			<?php echo $this->element('hotUser');?>
			<?php echo $this->element('regLoginHelp');?>
			<!-- 客服 -->
			<?php echo $this->element('server_250');?>			
		</div>
		<div class="div_c"></div>
	</div>