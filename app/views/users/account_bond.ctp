<div class="homeMain">
		<div class="mainLeft">
		  <div class="regLogin">		  	
			 <div class="regLoginTitle">
				<div class="icon">账号绑定</div>
			 </div>
		  </div>	 			
		  <div class="welcome">
		  	 <?php echo $this->Html->div('img', $this->Html->image($this->data['Sina']['profile_image_url']));?>
			 <div class="guide"><strong>新浪微博会员 <span class="red">@</span><?php echo $this->Html->tag('span', $this->data['Sina']['screen_name'], array('class' => 'red'));?>，欢迎您加入 <span class="red">豆壳网</span></strong></div>
			 <div class="guide">原豆壳网会员请输入登陆Email、密码进行验证绑定.新会员将注册账号自动绑定。</div>
		  </div>		 
		  <div class="div_c"></div> 			  
		  <div class="reg">
		  	 <?php
			 	echo $form->create('User', array('url' => '/users/accountBond/sina'));
				echo $this->Html->div('button submit', '');
				echo $form->input('User.username', array('label' => '昵称', 'readonly' => 'readonly', 'style' => 'background-color:#DDD'));
				echo $form->input('User.email', array('label' => 'E-Mail'));						
				echo $form->input('User.password', array('label' => '密码'));						
				echo $form->input('User.repwd', array('label' => '密码确认', 'type' => 'password'));
				echo $form->hidden('User.myface');
				echo $form->hidden('Sina.uid');
				echo $form->hidden('Sina.screen_name');
				echo $form->hidden('Sina.oauth_token');
				echo $form->hidden('Sina.oauth_token_secret');
				echo $form->hidden('Sina.description');
				echo $form->hidden('Sina.profile_image_url');				
				echo $form->hidden('Sina.friends_count');
				echo $form->hidden('Sina.followers_count');
				echo $form->hidden('Sina.statuses_count');
				echo $form->hidden('Sina.verified');
				echo $form->end();
			 ?>		 
		  </div>
	  </div>
		<div class="sidebar">
			<?php echo $this->element('hotUser');?>
			<?php echo $this->element('regLoginHelp');?>
		</div>
		<div class="div_c"></div>
	</div>