<div class="ucRight">
    <div class="head">
      <div class="icon">账号设置</div>
    </div>
    <div class="list">
      <div class="setting">
		<script type="text/javascript" src="/js/swfupload.js"></script>
		<script type="text/javascript" src="/js/swfupload.queue.js"></script>
		<script type="text/javascript" src="/js/fileprogress.js"></script>
		<script type="text/javascript" src="/js/handlers.js"></script>      	
      	<script type="text/javascript">
			var swfu;
	
			window.onload = function() {
				var settings = {
					flash_url : "/images/swfupload.swf",
					upload_url: "/upload.php",
					post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
					file_size_limit : "1 MB",
					file_types : "*.jpg;*.gif;*.png",
					file_types_description : "All Files",
					file_upload_limit : 5,
					file_queue_limit : 0,
					debug: false,
	
					// Button settings
					button_image_url: "/images/FullyTransparent_65x29.png",
					button_width: "80",
					button_height: "29",
					button_placeholder_id: "spanButtonPlaceHolder",
					button_text: '<span class="theFont">修改头像</span>',
					button_text_style: ".theFont { font-size: 12; color:#FF0099; font-weight:bold; }",
					button_text_left_padding: 7,
					button_text_top_padding: 3,
					
					// The event handler functions are defined in handlers.js
					file_queued_handler : fileQueued,
					file_queue_error_handler : fileQueueError,
					file_dialog_complete_handler : fileDialogComplete,
					upload_start_handler : uploadStart,
					upload_progress_handler : uploadProgress,
					upload_error_handler : uploadError,
					upload_success_handler : uploadSuccess,
					upload_complete_handler : uploadComplete,
					queue_complete_handler : queueComplete	// Queue plugin event
				};
	
				swfu = new SWFUpload(settings);
		     };      	      	
      	</script>     	
	  	 <?php echo $form->create('User', array('url' => '/users/setting'));?>
          	<div class="myface">
		  		<div class="img"><?php echo $this->Html->image($this->data['User']['myface'], array('width' => 65, 'height' => 65));?></div>
				<div class="options" id="spanButtonPlaceHolder">修改头像</div>
				<div class="status"></div>
		  	</div>
		  	<?php
			echo $form->input('User.username', array('label' => '昵称'));
			echo $form->input('User.email', array('label' => 'E-Mail', 'readonly' => 'readonly'));						
			echo $form->input('User.password', array('label' => '密码'));						
			echo $form->input('User.repwd', array('label' => '密码确认', 'type' => 'password'));
			echo $this->Html->div('button submit', '');
			echo $form->hidden('User.id');														
			echo $form->end();
		 ?>		  
      </div>
    </div>
</div>