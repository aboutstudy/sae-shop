$(document).ready(function(){
	//修改会员注册资料提交					   
	$(".setting .submit").click(function(){
		if($("#UserPassword").val().length < 6 && $("#UserPassword").val().length > 0){
			alert("密码长度不得低于6个字符！");
			return false;
		}
		else if($("#UserRepwd").val() != $("#UserPassword").val()){
			alert("两次输入密码不一致");
			$("#UserRepwd").val('').focus();
			return false;
		}
		$(this).parent().submit();
	});
});