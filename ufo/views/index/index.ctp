<?php
	$this->Html->css('admin/login', NULL, array('inline' => FALSE));
?>
<script>
	if(top.window.location.href != window.location.href){
		top.window.location.href = window.location.href;
	}
	$(document).ready(function(){
		$("#UserUsername").focus();			
	});
</script>
<table width="98" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td height="60">&nbsp;</td>
  </tr>
</table>
<table width="524" border="0" cellspacing="0" cellpadding="0" align="center" height="320">
  <?=$this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'login')))?>
    <tr> 
      <td width="61" rowspan="3" valign="top"> <TABLE WIDTH=61 height="100%" BORDER=0 CELLPADDING=0 CELLSPACING=0>
          <TR> 
            <TD height="63"> 
            	<?php echo $this->Html->image('/images/admin/login_r1_c1_01.jpg', array('width' => 61, 'height' => 63));?>
            </TD>
          </TR>
          <TR> 
            <TD height="163" background="<?php echo $this->Html->url('/images/admin/login_r1_c1_02.jpg');?>">&nbsp;</TD>
          </TR>
          <TR> 
            <TD height="100%" background="<?php echo $this->Html->url('/images/admin/login_r1_c1_003.jpg');?>">&nbsp;</TD>
          </TR>
          <TR> 
            <TD height="23"> 
            	<?php echo $this->Html->image('/images/admin/login_r1_c1_03.jpg', array('width' => 61, 'height' => 23));?>
            </TD>
          </TR>
        </TABLE></td>
      <td colspan="3">
      	<?php echo $this->Html->image('/images/admin/login_r1_c2.gif', array('width' => 463, 'height' => 65));?>
      </td>
    </tr>
    <tr> 
      <td width="241" valign="top" bgcolor="#FFFFFF">
      	<?php echo $this->Html->image('/images/admin/login_r2_c2.gif', array('width' => 241, 'height'=> 104));?>
      </td>
      <td width="157" rowspan="2" valign="top" bgcolor="#FFFFFF"> 
        <table width="157" height="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td> <br>
              <?php echo $this->Html->image('/images/admin/login_r2_c3.gif', array('width' => 157, 'height' => 184));?>
            </td>
          </tr>
          <tr>
            <td height="100%" valign="bottom"> <div align="right"><a href="../../" target="_blank"></a>&nbsp;<a href="http://bbs.phome.net" target="_blank"></a></div></td>
          </tr>
        </table> </td>
      <td width="65" rowspan="2" valign="top"> 
        <table width="65" height="100%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td height="184" background="<?php echo $this->Html->url('/images/admin/login_r2_c4.gif');?>">&nbsp;</td>
          </tr>
          <tr> 
            <td height="100%" background="<?php echo $this->Html->url('/images/admin/login_r2_c4_002.jpg');?>">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td height="80"> <table width="230" height="100%" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="47" height="27"><b>账号:</b></td>
            <td colspan="2"> 
            	<!--<input name="username" type="text" class="b-form2" size="22"> -->
            	<?=$form->input('User.username', array('label'=> ''))?>            
            </td>
          </tr>
          <tr> 
            <td height="27"><b>密码:</b>&nbsp;</td>
            <td colspan="2"> 
            	<!--<input name="password" type="password" class="b-form2" size="22">-->
            	<?=$form->input('User.password', array('label'=>''))?>         
            </td>
          </tr>
          <tr> 
            <td height="27">&nbsp;</td>
            <td width="86"><input name="imageField" type="image" src="<?php echo $this->Html->url('/images/admin/login2.gif');?>" width="69" height="21" border="0"></td>
            <td width="97">&nbsp;</td>
          </tr>
          <tr> 
            <td height="27">&nbsp;</td>
            <td colspan="2" valign="bottom"><div style="font-family:'微软雅黑', '黑体'"><a href="http://www.doucl.com" target="_blank"><strong></strong></a></div></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0" background="<?php echo $this->Html->url('/images/admin/login_r4_c1.gif');?>">
          <tr> 
            <td width="111" height="32">&nbsp;</td>
            <td width="111" valign="top">&nbsp;</td>
            <td width="302">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="39" colspan="4" valign="top" bgcolor="ECECEC">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="19%"><div align="center"></div></td>
            <td width="73%" height="30" style=" font-family:'微软雅黑','华文细黑',Times New Roman";><strong><font color="#FF9900"> </font></strong>© 2010-2011 (DOUCL.COM), All rights reserved.</td>
            <td width="8%">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
  <?=$form->end()?>
</table>