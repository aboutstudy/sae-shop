<div id="container">
  <table width="100%" height="760" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="80"><table width="100%" height="80" border="0" cellpadding="0" cellspacing="0" background="../images/admin/topbg.gif" style="background-repeat:repeat-x">
          <tr>
            <td width="66"><table width="100%" height="60" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="top-nav-td"><a href="#" target="left-iframe"><img src="../images/admin/config.gif" alt="系统设置" width="32" height="32" border="0" /></a></td>
                </tr>
                <tr>
                  <td class="top-nav-td">系统设置</td>
                </tr>
            </table></td>
            <td width="66"><table width="100%" height="60" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="top-nav-td"><a href="#" target="right-iframe"><img src="../images/admin/info.gif" alt="信息管理" width="32" height="32" border="0" /></a></td>
                </tr>
                <tr>
                  <td class="top-nav-td">系统设置</td>
                </tr>
            </table></td>
            <td width="66"><table width="100%" height="60" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="top-nav-td"><a href="#" target="right-iframe"><img src="../images/admin/class.gif" alt="栏目管理" width="32" height="32" border="0" /></a></td>
                </tr>
                <tr>
                  <td class="top-nav-td">系统设置</td>
                </tr>
            </table></td>
            <td width="66"><table width="100%" height="60" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="top-nav-td"><a href="#" target="right-iframe"><img src="../images/admin/manage-info.gif" alt="模板管理" width="32" height="32" border="0" /></a></td>
                </tr>
                <tr>
                  <td class="top-nav-td">系统设置</td>
                </tr>
            </table></td>
            <td width="66"><table width="100%" height="60" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="top-nav-td"><a href="#" target="right-iframe"><img src="../images/admin/user.gif" alt="帐号管理" width="32" height="28" border="0" /></a></td>
                </tr>
                <tr>
                  <td class="top-nav-td">帐号权限</td>
                </tr>
            </table></td>
            <td width="66"><table width="100%" height="60" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="top-nav-td"><a href="#" target="right-iframe"><img src="../images/admin/other.gif" alt="其他" width="32" height="32" border="0" /></a></td>
                </tr>
                <tr>
                  <td class="top-nav-td">其他</td>
                </tr>
              </table></td>
			  <td width="66"><table width="100%" height="60" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="top-nav-td">&nbsp;</td>
                </tr>
                <tr>
                  <td class="top-nav-td">&nbsp;</td>
                </tr>
            </table></td>
            <td width="60"><table width="85%" height="60" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="60" class="top-nav-td"><a href="iframe/left-iframe-sysconfig.php" target="left-iframe"></a></td>
                </tr>
                <tr>
                  <td class="top-nav-td">&nbsp;</td>
                </tr>
            </table></td>
            <td width="15">&nbsp;</td>
            <td width="200" height="55"><span style="color:#FFFFFF; font-size:12px;"><b>用户名: </b><?=@$username?>&nbsp;&nbsp;<br /><b>用户组: </b><?=@$group_name?></span></td>
            <td width="64" height="55" style="color:#FFFFFF; font-weight: bolder; font-size:12px;">&nbsp;</td>
            <td width="152" style="color:#FFFFFF; font-weight: bolder; font-size:12px;">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" colspan="12">
			   <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td bgcolor="#9DC5FF" class="top-nav-2-td"><a href="/" target="_blank">网站首页</a></td>
                  <td height="25" bgcolor="#9DC5FF" class="top-nav-2-td">
                  	<?php echo $this->Html->link('后台首页', '/iframes/rightIframe/', array('target' => 'right-iframe'));?>
                  </td>
                  <td bgcolor="#9DC5FF" class="top-nav-2-td">
                  	<?php echo $this->Html->link('退出系统', '/users/logout/', null, '请确认是否要退出系统.');?>
                  </td>
                  <td bgcolor="#9DC5FF" class="top-nav-2-td">&nbsp;</td>
                  <td bgcolor="#9DC5FF">&nbsp;</td>
                </tr>
              </table></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td><table width="100%" height="680" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td id="left-menu" style="width:200px;"><iframe src="<?php echo $this->Html->url('/iframes/leftMenu');?>" name="left-iframe" id="left-iframe" scrolling="auto" marginheight="0px" marginwidth="0px" frameborder="0" style="width:200px; height:680px"></iframe></td>
            <td bgcolor="#9DC5FF"  onclick="switchBar('left-menu','switchPoint2')" style="height:100%; width:10px; cursor:pointer;"><span id="switchPoint2" style="color:#9DC5FF" >1</span><img id="hiden-bar" src="../images/admin/go.gif" alt="打开/关闭左边导航栏" width="9" height="9" /></td>
            <td style="width:100%"><iframe src="<?php echo $this->Html->url('/iframes/rightIframe');?>" name="right-iframe" id="right-iframe" scrolling="auto" marginheight="0px" marginwidth="0px" frameborder="0" width="100%" height="680px"></iframe></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
