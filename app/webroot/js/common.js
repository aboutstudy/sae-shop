$(document).ready(function(){
	//获取购物车商品数量，异步更新
	jQuery.ajaxGetCartNum();
	
	//pngFix
	$(".iconPlayer").pngFix();
	
	//操作消息提示框
	$(".message").fadeOut(2500);
	
	//首页登陆框
	$(".home .submit").click(function(){
		$(this).parent().submit();
	});	
	//会员注册提交					   
	$(".reg .submit").click(function(){
		//邮箱格式校验
		//密码校验
		if($("#UserPassword").val().length < 6){
			$("#UserPassword").next(".validate").remove();
			$("#UserPassword").after("<div class='validate'>密码长度不得低于6个字符！</div>");
			return false;
		}
		if($("#UserRepwd").val() != $("#UserPassword").val()){
			$("#UserRepwd").next(".validate").remove();
			$("#UserRepwd").after("<div class='validate'>两次输入密码不一致</div>");
			$("#UserRepwd").val('');
			return false;
		}
		$(this).parent().submit();
	});
	$(".login #UserPassword, .reg #UserPassword").blur(function(){
		if($("#UserPassword").val().length < 6){
			$("#UserPassword").after("<div class='validate'>密码长度不得低于6个字符！</div>");
		}		
	});
	$("#UserRepwd").blur(function(){
		if($("#UserRepwd").val() != '' && $("#UserRepwd").val() != $("#UserPassword").val()){
			$("#UserRepwd").after("<div class='validate'>两次输入密码不一致</div>");
			$("#UserRepwd").val('');
			return false;
		}		
	});
	//清除密码校验提示
	$("#UserPassword, #UserRepwd").focus(function(){
		$(this).next(".validate").remove();
	});	
	//动态校验
	$(".reg #UserEmail").blur(function(){
		var emailRegExp = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
		if(!emailRegExp.test($(this).val())){
			$(this).next(".validate").remove();
			$(this).after("<div class='validate'>E-Mail格式错误</div>");
			$(this).focus();
		}	
		else{
			$(this).next(".validate").remove();
		}
	});	
	//会员登陆
	$(".login .submit").click(function(){
		$(this).parent().submit();
	});
	
	//输入框回车提交表单
	$("input[type='password']").keypress(function (e){
		var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
		if(keyCode == 13){
			$(this).parent().parent().submit();
		}	
	})
	
	//提交评论
	$(".commentInput .submitButton").click(function (){
		var sType = $(this).attr('sType');
		
		if(sType == 'baike'){
			var mid = $(this).attr('mid');			
			var sid = $('#ArticleWeiboSid').val();
			var CommentText = $('#CommentText').val();
			var isRepost = $('#isRepost').attr('checked');
			var isFollow = $('#isFollow').attr('checked');
			var uid = $('#ArticleWeiboUid').val();
		}
		else if(sType == 'video'){
			var mid = $(this).attr('mid');			
			var sid = $('#VideoWeiboSid').val();
			var CommentText = $('#CommentText').val();
			var isRepost = $('#isRepost').attr('checked');
			var isFollow = $('#isFollow').attr('checked');
			var uid = $('#VideoWeiboUid').val();
		}
		else if(sType == 'goods'){
			var mid = $(this).attr('mid');			
			var sid = $('#MallGoodsWeiboSid').val();
			var CommentText = $('#CommentText').val();
			var isRepost = $('#isRepost').attr('checked');
			var isFollow = $('#isFollow').attr('checked');
			var uid = $('#MallGoodsWeiboUid').val();
		}
		else{
			alert('错误的对象类型:sType');
			return false;
		}

		//数据校验，评论内容不能为空
		if(CommentText.length == 0){
			alert('评论内容不能为空！');
			return false;
		}
		
		$('#isRepost').parent().append('<img class="waitting" src="/images/waitting.gif" width="16" height="16" />');
		
		var queryURL = SITE_URL + '/weibo/comment/';

		$.ajax({
			'url':queryURL,
			'data':{'mid':mid, 'sType':sType, 'sid':sid, 'text':CommentText, 'isRepost':isRepost, 'isFollow':isFollow, 'uid':uid},
			'cache':false,
			'success':function(data){
				response = eval('('+data+')');
				if(response.error == '1'){
					window.location.href = SITE_URL + response.url;
					return false;
				}
				else{
					$('#CommentText').val('');
					$(".replyList").prepend(response.result);					
				}				
				$('.options .waitting').remove();
			},
			'error':function(oXHR, status){
				$('.options .waitting').remove();
				alert(status);
			}
		});		
	});
	
	//收藏本站
	$(".bookmark_us").click(function (){
		window.external.addFavorite('http://www.doucl.com','豆壳网');
		/*
		if(document.all){
			window.external.addFavorite('http://www.doucl.com','豆壳网');
		}
		else if(window.sidebar){
			window.sidebar.addPanel('http://www.doucl.com','豆壳网');
		}
		*/
		return false;
	});
});

jQuery.extend({
		popShow:function(msg, autoClose, obj){
			alert(msg);
		/*
		var frame = '<div class="pop">' +
			'<div class="body">' +
				'<table width="100%" border="0" cellspacing="0" cellpadding="0">' +
				  '<tr>' +
					'<td class="topLeft opacity">&nbsp;</td>' +
					'<td class="topCenter opacity">&nbsp;</td>' +
					'<td class="topRight opacity">&nbsp;</td>' +
				  '</tr>' +
				  '<tr>' +
					'<td class="centerLeft opacity">&nbsp;</td>' +
					'<td>' +
						'<div class="main">' +
							'<div class="title"><span class="close" onclick="javascript:jQuery.popClose()">关闭</span><span class="red bold">操作提示</span></div>' +
							'<div class="content">'+msg+'</div>' +							
						'</div>' +
					'</td>' +
					'<td class="centerRight opacity">&nbsp;</td>' +
				  '</tr>' +
				  '<tr>' +
					'<td class="bottomLeft opacity">&nbsp;</td>' +
					'<td class="bottomCenter opacity">&nbsp;</td>' +
					'<td class="bottomRight opacity">&nbsp;</td>' +
				  '</tr>' +
				'</table>' +
			'</div>' +
		'</div>';
		$(".container").before(frame);
		
		//移动提示框位置到触发事件元素处		
		$('.pop').css('top', obj.offsetTop);
		$('.pop').fadeIn(500);	
		
		if(autoClose){
			setTimeout("$('.pop').fadeOut(500);", 2000);
			//移除对象，避免多个对象重叠显示，半透明效果失去
			setTimeout("$(\".pop\").remove()", 3000);
		}	
		*/
	},
	popClose:function(){
		$(".pop").fadeOut(500);
		//移除对象，避免多个对象重叠显示，半透明效果失去
		setTimeout("$(\".pop\").remove()", 1000);
	},
	setMyface:function(myface_url){		
		var queryURL = SITE_URL + '/Users/setMyface/';
		
		$.ajax({
			'url':queryURL,
			'data':{'myface':myface_url},
			'cache':false,
			'success':function(data){
//				alert(data);
				response = eval('('+data+')');
				
				$(".myface .img img").attr("src", myface_url);
				$(".myface .status").empty();
				
				jQuery.popShow(response.msg, true, document);
				//alert('ajax return :' + response.msg);
			},
			'error':function(oXHR, status){
				jQuery.popShow(status, true, document);
			}
		});
	},
	ajaxGetCartNum:function(){		
		var queryURL = SITE_URL + '/MallCart/ajaxGetCartNum/';
		$.ajax({
			'url':queryURL,
			'cache':false,
			'success':function(data){
				$(".header .num_in_cart").html(data);
			}
		});
	}
});