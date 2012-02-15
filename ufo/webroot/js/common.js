$(document).ready(function(){
	$("#infolist td").mouseover(function(){
		$(this).parent().children().addClass("light");
	});
	$("#infolist td").mouseout(function(){
		$(this).parent().children().removeClass("light");
	});	
	//侧边栏菜单
	$(".list-content:first").show();
	$(".class-title").click(function (){
		$(this).parent().find(".list-content").toggle();
	});
	
	//复制内容到粘贴板
	$(".copyPad").mousedown(function (e){
		if(e.which == 3){
			var content = $(this).siblings().attr('title');
			
			//去除字符串
			content = content.replace(/[-；]/gi,"");			
			content = content.replace(/[!！]{2,}/gi, "!");
			content = content.replace(/[.。]{2,}/gi, ".");
			
			var str = '【' + $(this).siblings().html() + '】' + content;
			if(copyToClipboard(str)){
				$(this).css({'color':'green'});
			}
			return false;
		}
	});
	
	//自动提取微博信息输入框聚焦
	$("#WeiboUrl").click(function (){
		$(this).select();		
	});
	
	try {
		$("#WeiboUrl").select();	
	}
	catch (e){
		
	}
	//$("#WeiboUrl").select();
	
	//内容编辑时控制HABTM内容变更
	$(".noChange input").attr("disabled", true);
	
	$(".noChange .input").click(function(){
		$(this).children("input").removeAttr('disabled')
		$(this).children("div").children("input").removeAttr('disabled')
	});
	
	//修改内容排序
	$(".sortOrder").click(function(){
		if($(this).children().is("div")){
			var modelName = $(this).children(".setSortOrder").attr('model');
			var id = $(this).children(".setSortOrder").attr('id');
			var originalValue = $(this).children().html();
			$(this).html("<input name=\"sortOrderValue\" value=\""+ originalValue +"\" type=\"text\" model=\"" + modelName + "\" id=\""+ id +"\" onblur=\"jQuery.setSortOrder(this);\" />");
			$(this).children("input").focus();
		}
	});		
});

jQuery.extend({
	"setSortOrder":function(obj){
		var sortOrderValue = $(obj).val();
		var id = $(obj).attr('id');
		var modelName = $(obj).attr('modelName');
		
		var queryURL = '/ufo/MallGoods/setSortOrder/' + id + '/' + sortOrderValue;
		$.ajax({
			'url':queryURL,
			'success':function(data){
				response = eval('('+data+')');
				if(typeof(response.error) == 'undefined'){					
					$(obj).parent().html("<div class=\"setSortOrder\" id=\""+ id +"\" model=\""+ modelName +"\">"+ sortOrderValue +"</div>");
				}
				else{
					$(obj).css("border", "solid 1px red");
				}
			}
		});
	}
});

function copyToClipboard(txt){
	if(window.clipboardData){
		window.clipboardData.clearData();
		window.clipboardData.setData("Text", txt);
	} 
	else if(navigator.userAgent.indexOf("Opera") != -1){
		window.location = txt;
	} 
	else if (window.netscape){
		try {
			netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
		} 
		catch (e) {
			alert("被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将'signed.applets.codebase_principal_support'设置为'true'");
		}
		var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
		if (!clip)
			return;
		var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
		if (!trans)
			return;
		trans.addDataFlavor('text/unicode');
		var str = new Object();
		var len = new Object();
		var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
		var copytext = txt;
		str.data = copytext;
		trans.setTransferData("text/unicode",str,copytext.length*2);
		var clipid = Components.interfaces.nsIClipboard;
		if (!clip)
			return false;
		clip.setData(trans,null,clipid.kGlobalClipboard);
		return true;
		//alert("复制成功！")
	}
}