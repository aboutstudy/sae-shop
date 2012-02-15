<div class="ucRight">
    <div class="head">
      <div class="icon">账号设置</div>
    </div>
    <div class="list">
      <div class="setting">
	  	 <?php
		 	echo $form->create('User', array('url' => '/users/setting'));
			echo $this->Html->div('button submit', '');
			echo $form->input('User.username', array('label' => '昵称'));
			echo $form->input('User.email', array('label' => 'E-Mail', 'readonly' => 'readonly'));						
			echo $form->input('User.password', array('label' => '密码'));						
			echo $form->input('User.repwd', array('label' => '密码确认', 'type' => 'password'));		
			echo $form->hidden('User.id');														
			echo $form->end();
		 ?>		  
      </div>
    </div>
</div>