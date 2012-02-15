$(document).ready(function(){
	//分类二级菜单展开特效
	$(".sortList .item").hover(function(){
		$(this).addClass("current");
		$(this).children(".wholeList").show();
		$(this).children(".mask").show();
	}, function(){
		$(this).removeClass("current");
		$(this).children(".wholeList").hide();
		$(this).children(".mask").hide();		
	});	
	
	//侧边栏畅销榜
	$(".topList .item").hover(function(){
		$(".topList .item:first").children(".goods").addClass('goodsCur').removeClass('goods');
		$(this).children(".goods").addClass('goodsCur');
		$(this).children(".goods").removeClass('goods');

		$(this).prevAll().children(".goodsCur").addClass('goods');
		$(this).nextAll().children(".goodsCur").addClass('goods');		
		$(this).prevAll().children(".goodsCur").removeClass('goodsCur');
		$(this).nextAll().children(".goodsCur").removeClass('goodsCur');
	},function(){
		//鼠标跳出选定区域
	});
	
	//商城首页焦点图
	$(".mallMain .focus .title .item").hover(function(){
		$(this).addClass("onFocus");
		$(this).removeClass("outFocus");
		
		//去除其他项焦点
		$(this).prevAll().removeClass("onFocus");
		$(this).prevAll().addClass("outFocus");
		
		$(this).nextAll().removeClass("onFocus");
		$(this).nextAll().addClass("outFocus");
		
		//更换焦点
		$(this).parent().parent().children(".img").children("a").children("img").attr("src", $(this).attr("focusPic"));
		$(this).parent().parent().children(".img").children("a").attr("href", $(this).attr("focusUrl"));
	},function(){
		
	});
	
	//购物车相关	
	$(".buyButton").click(function(){
//		alert("商城内测中，暂不能购物，敬请期待！");
//		return false;
		var goods_id = $("#MallGoodsId").val();
		var goods_number = $("#goodsCount").val();
		
		if(GOODS_STOCK <= 0){
			$("#goodsCount").val(0);
			jQuery.popShow('库存紧缺补货中，请耐心等待！', true, this);			
		}
		else{
			var queryURL = SITE_URL + '/MallCart/add/' + goods_id + '/' + goods_number + '/';
			location.href = queryURL;			
		}
	});
	
	//购买数量检验限制处理
	$("#goodsCount").keyup(function(){
		var goods_number = new Number($("#goodsCount").val());
		
		if(GOODS_STOCK > 0){	//有库存
			//输入数量错误
			if(goods_number <= 0 || goods_number.toString() == 'NaN'){
				$("#goodsCount").val(1);
			}
			
			if(goods_number > GOODS_STOCK && GOODS_USER_MAX == 0){
				$("#goodsCount").val(GOODS_STOCK);
				jQuery.popShow('最多购买 ' + GOODS_STOCK + ' 个', true, this);
			}
			else if(goods_number > GOODS_USER_MAX && GOODS_USER_MAX != 0){
				$("#goodsCount").val(GOODS_USER_MAX);
				jQuery.popShow('最多购买 ' + GOODS_USER_MAX + ' 个', true, this);
			}			
		}
		else{	//无库存断货
			$("#goodsCount").val(0);
			jQuery.popShow('库存紧缺补货中，请耐心等待！', true, this);						
		}
	});
	
	//修改购买数量
	$(".cart .goodsCount").keyup(function(){
		var cart_id = $(this).parent().parent().children("input[name='cart_id']").val();
		var goods_price = new Number($(this).parent().parent().parent().children(".price").children("span").html());
		var goods_num = new Number($(this).val());		
		var user_max = new Number($(this).parent().parent().children("input[name='user_max']").val());
		var goods_stock = new Number($(this).parent().parent().children("input[name='goods_stock']").val());		
		
		if(goods_stock > 0){
			//数字格式错误		
			if(goods_num <= 0 || goods_num.toString() == 'NaN'){
				goods_num = 1;
				$(this).val(1);
				jQuery.popShow('请输入数字', true, this);
			}
			//购买数量限制
			if(user_max == 0){		//无购买限制时，最大购买量为库存数量
				if(goods_num > goods_stock){
					goods_num = goods_stock;
					$(this).val(goods_num);
					jQuery.popShow('最多购买 ' + goods_stock + ' 个', true, this);
				}
			}
			else{		//购买限制时最大购买数量为限制数
				if(goods_num > user_max){
					if(user_max > goods_stock){
						goods_num = goods_stock;
						$(this).val(goods_num);
						jQuery.popShow('库存紧缺补货中,最多可购买 ' + user_max + ' 个', true, this);						
					}
					else{
						goods_num = user_max;
						$(this).val(goods_num);
						jQuery.popShow('最多购买 ' + user_max + ' 个', true, this);						
					}					
				}
			}			
		}
		else{
			$(this).val(0);
			jQuery.popShow('库存紧缺补货中，请耐心等待！', true, this);
		}
		
		//更新数据库			
		var queryURL = SITE_URL + '/MallCart/updateGoodsCount/' + cart_id + '/' + goods_num;
		$.ajax({
			'url':queryURL,
			'success':function(data){
				response = eval('('+data+')');
				if(typeof(response.error) == 'undefined'){
					isSuccess = true; 
				}
				else{
					alert(response.error + response.error_code);
					isSuccess = false;
				}
			}
		});		
		
		var sub_whole = goods_price * goods_num;
		
		//更新单品总价
		$(this).parent().parent().parent().children(".subWhole").children("span").html(sub_whole.toFixed(2));
		jQuery.cartPriceCount();
	});
	
	//按钮动作
	$(".cart input[name='toShopping']").click(function(){
		location.href = SITE_URL + '/Mall/';
	});
	
	//订单确认
	//选择配送地址
	$(".cart .address input[name='data[consignee_id]']").click(function(){		
		if($(this).val() == 0){	//添加新地址			
			$(this).parent().next().children(".addressInput").show();
		}
		else{
			$(".cart .address .addressInput").hide();
		}
	});
	
	//配送信息校验
	$(".check_order .options input[type='submit']").click(function(){
		if($(".cart .address input[name='data[consignee_id]']").val() == 0){
			if($("#MallOrderConsignee").val() == ''){
				jQuery.popShow('收货人姓名不能为空！', true, $('.addressInput'));				
				return false;
			}
			
			if($(".cart #MallOrderProvince").val() == undefined | $(".cart #MallOrderProvince").val() == ''){
				jQuery.popShow('请选择收货地址所属省份！', true, $('.addressInput'));
				return false;
			}
			
			if($(".cart #MallOrderCity").val() == undefined | $(".cart #MallOrderCity").val() == ''){
				jQuery.popShow('请选择收货地址所属城市！', true, $('.addressInput'));
				return false;
			}
			
			if($(".cart #MallOrderDistrict").val() == undefined | $(".cart #MallOrderDistrict").val() == ''){
				jQuery.popShow('请选择收货地址所属区！', true, $('.addressInput'));
				return false;
			}
			
			if($(".cart #MallOrderAddress").val() == ''){
				jQuery.popShow('请正确填写详细地址！', true, $('.addressInput'));
				return false;
			}
			
			if($(".cart #MallOrderMobile").val() == '' & $(".cart #MallOrderTell").val() == ''){
				jQuery.popShow('为便于物流配送，手机号或电话请至少填写一个！', true, $('.addressInput'));
				return false;
			}
		}		
		
		return true;
	});
	
	//配送费用计算
	$(".check_order input[name='data[MallOrder][express_id]']").click(function(){
		var express_id = $(this).val();
		var cart_goods_num = $(".check_order input[name='cart_goods_num']").val();
		var goods_amount = $(".check_order input[name='goods_amount']").val();
		
//		alert(express_id + '-' + cart_goods_num + '-' + goods_amount);
		
		var queryURL = SITE_URL + '/MallCart/getExpressFee/' + express_id + '/' + goods_amount + '/' + cart_goods_num;
		$.ajax({
			url:queryURL,
			success:function(data){
				$(".check_order .express_fee").html(data);
			}
		});
	});
});

//拓展函数
jQuery.extend({
	/**
	 * 统计购物车中商品总价
	 */
	cartPriceCount:function(){
		var totalGoodsPrice = new Number();
		$(".cart .orderGoodsList .item").each(function(){
			totalGoodsPrice = totalGoodsPrice + Number($(this).children(".subWhole").children("span").html());
		});		
		totalGoodsPrice = totalGoodsPrice.toFixed(2);
		$(".cart .totalGoodsPrice").html(totalGoodsPrice);
	},
	/**
	 * 更新购物车中所有商品的订购数量
	 */
	cartSaveGoodsNum:function(){
		var cart_id;
		var goods_num;
		var isSuccess;	//记录更新是否成功
		
		$(".cart .orderGoodsList .item").each(function(){
			cart_id = $(this).children(".count").children("input[name='cart_id']").val();
			goods_num = $(this).children(".count").children().children().val();
			
			//更新数据库			
			var queryURL = SITE_URL + '/MallCart/updateGoodsCount/' + cart_id + '/' + goods_num;
			$.ajax({
				'url':queryURL,
				'success':function(data){
					response = eval('('+data+')');
					if(typeof(response.error) == 'undefined'){
						isSuccess = true; 
					}
					else{
						alert(response.error + response.error_code);
						isSuccess = false;
					}
				}
			});			
		});		
	},
	/**
	 * 获取区域下一级地区列表
	 */
	getRegions:function(obj){
		if($(obj).val() != ''){
			var region_type = $(obj).attr('region_type');
			var queryURL = SITE_URL + '/MallCart/getRegions/' + region_type + '/' + $(obj).val();
			$.ajax({
				'url':queryURL,
				'success':function(data){
					$(obj).parent().nextAll().remove();
					$(obj).parent().after("\n" + data);
				}
			});			
		}
	}
});