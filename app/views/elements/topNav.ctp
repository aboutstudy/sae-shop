<div class="nav-top">
	<ul>
		<li><?php echo $this->Html->link('关于我们', '/Help/view/2/7/');?></li>
		<li><a href="#" class="bookmark_us">收藏本站</a></li>
		<li><?php echo $this->Html->link('帮助中心', '/Help/view/1');?></li>
		<?php
			$userAuth = $this->Session->read('Auth'); 
			if(isset($userAuth['User'])):
		?>
		<li><?php echo $this->Html->link('会员中心', '/uc/');?></li>
		<li><?php echo $this->Html->link('退出', '/users/loginOut');?></li>					
		<li>
		<?php
			//判断是否绑定新浪微博账号
				$sina = $this->Session->read('sina');
				$qzone = $this->Session->read('qzone');
				if(isset($sina['accessToken'])){
					echo $this->Html->image('/images/icon_weibo_16x16.png', array('class' => 'ico_role'));			
                }
				elseif(isset($qzone['accessToken'])){
					echo $this->Html->image('/images/icon_qq_16x16.png', array('class' => 'ico_role'));
				}

				if(empty($userAuth['User']['username'])){
					echo $this->Html->link('会员', '/uc/', array('style' => 'color:#FF0099;'));					
				}
				else{
					echo $this->Html->link($userAuth['User']['username'], '/uc/', array('style' => 'color:#FF0099;'));
				}				
			?>
		</li>
		<li>欢迎您</li>
		<?php else:?>
		<li><?php echo $this->Html->link('登陆', '/users/login');?></li>
		<li><?php echo $this->Html->link('注册', '/users/reg');?></li>					
		<?php endif;?>
	</ul>
</div>