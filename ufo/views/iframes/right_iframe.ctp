<div style="margin:-13px 5px 5px 5px;">
<!--<div style="text-align:center; font-size:16px; line-height:1.7em; margin-bottom:30px; font-weight:bold">欢迎登陆人寿任我行后台管理系统</div> -->
<div class="title">登陆状态:</div>
<div class="content">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="150" height="20" scope="row">登陆帐号: <?=@$username?></td>
      <td width="300"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="20" scope="row"> 用户组别: <?=@$group_name?></td>
      <td></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div class="title">快捷菜单:</div>
<div class="content">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="20" scope="row"></th>
      <td width="100"><a href="/users/logout" onclick="javascript:return(confirm('请确认是否要退出系统.'));">退出系统</a></td>
      <td width="100"><a href="/users/changePwd">修改密码</a></td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>		
  </table>
</div>
</div>