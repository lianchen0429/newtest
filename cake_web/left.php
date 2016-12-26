<?php require_once('Connections/easyshop.php'); ?>
<?php
mysql_select_db($database_easyshop, $easyshop);
$query_rs = "SELECT * FROM s_product_ps ORDER BY s_product_ps ASC";
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">
<!--
body {
	background-color: #000000;
	background-image: url(image/kjhfkjhkl.jpg);
}
.style2 {color: #FFFFFF}
.style3 {font-size: small}
.style4 {color: #990000}
.style5 {color: #996600}
.style12 {font-size: 14px}
.style13 {color: #FFFFFF; font-size: 14px; }
-->
</style>
</head>

<body>
<div align="center">
  <p>&nbsp;</p>
  <table width="90%" border="0" bordercolor="#DFE4E0">
    <tr>
      <td width="95" bgcolor="#744F34"><img src="image/logo2.jpg" width="143" height="98" /></td>
    </tr>
    <tr>
      <td bgcolor="#744F34"><div align="center" class="style12"><span class="style5"><a href="user/add_user.php" target="mainFrame" class="style2">會員註冊</a></span>
          <hr />
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#744F34"><div align="center" class="style12"><span class="style5"><a href="index2.php" target="mainFrame" class="style2">會員登入</a></span>
          <hr />
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#744F34"><div align="center" class="style12"><a href="right.php" target="mainFrame" class="style2">線上購物</a>
        <hr />
      </div></td>
    </tr>
	
	<tr>
      <td bgcolor="#744F34"><div align="center" class="style12"><a href="talkall_add.php" target="mainFrame" class="style2">發表討論</a>
        <hr />
      </div></td>
    </tr>
	
	
	<tr>
      <td bgcolor="#744F34"><div align="center" class="style12"><a href="talkall.php" target="mainFrame" class="style2">線上討論</a>
        <hr />
      </div></td>
    </tr>
	
	
    <tr>
      <td bgcolor="#744F34"><div align="center" class="style12"><span class="style4"><a href="system/sys_login.php" target="mainFrame" class="style2">系統管理</a></span></div></td>
    </tr>
    <tr>
      <td bgcolor="#744F34"><div align="center">
        <?php do { ?>
                </span><a href="right.php?i_sort=<?php echo urlencode($row_rs['s_product_ps']); ?>" target="mainFrame" class="style2"><span class="style13"><?php echo $row_rs['s_product_ps']; ?></span></a><span class="style2"><br />
      <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?></div></td>
    </tr>
  </table>
  <br />
  <p class="style3">&nbsp;</p>
</div>
</body>
</html>
<?php
mysql_free_result($rs);
?>
