<div class="homeMain">
	<div class="mainLeft">
	  <div class="regLogin">		  	
		 <div class="regLoginTitle">
			<div class="icon">帮助中心  </div>
		 </div>
	  </div>	 			
	  <div class="help">
	  		<div class="title"><?php echo $this->Html->link($this->data['Help']['title'], '/Help/view/' . $this->data['Help']['help_type_id'] . '/' . $this->data['Help']['id']);?></php></div>
	  		<div class="content"><?php echo $this->data['Help']['content']?></div>
	  </div>
  	</div>
	<div class="sidebar">
		<!-- 同一分类下帮助列表 -->
		<?php echo $this->element('regLoginHelp');?>
		<!-- 客服 -->
		<?php echo $this->element('server_250');?>		
	</div>	
	<div class="div_c"></div>
</div>