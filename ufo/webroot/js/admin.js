//关闭左边导航条
//switchPoint 的innerHTML值记录Bar展开状态
//bar指定要关闭的方框
function switchBar(bar,switchPoint){
	var switchPoint = document.getElementById(switchPoint);
	if (switchPoint.innerHTML==1){
		switchPoint.innerHTML=0;
		document.getElementById(bar).style.display="none";
		if(switchPoint = "switchPoint2"){
			document.getElementById("hiden-bar").src="../images/admin/go-right.gif";					
		}
	}
	else{
		switchPoint.innerHTML=1;
		document.getElementById(bar).style.display="block";		
		if(switchPoint = "switchPoint2"){
			document.getElementById("hiden-bar").src="../images/admin/go.gif";				
		}		
	}
} //End of switchBar

//展开栏目列表
//class-state-num 的innerHTML值记录子栏目展开状态0/1
function displayList(classId){	//classId = OK-33-12

	var classId = new String(classId);	//classId = class-1
	var e = classId.indexOf("-");
	var num = classId.substring(e + 1,classId.length);

	if (document.getElementById("class-state-" + num).innerHTML == 0){
		document.getElementById("items-" + num).style.display = "block";
		document.getElementById("class-state-" + num).innerHTML = 1;		
	}	//End of if
	else
	{
		document.getElementById("items-" + num).style.display = "none";
		document.getElementById("class-state-" + num).innerHTML = 0;		
	}	//End of else
}	//End of displayList()

//选定所有得选框函数
function checkAll(form){
	for(var pos = 0;pos < form.elements.length;pos++){
		if(form.elements[pos].name != 'selectAll'){
			form.elements[pos].checked = form.selectAll.checked;
		}
	}
}
