<?php
//initialize the session
session_start();


// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<? include "s_include.php" ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>無標題文件</title>
<style type="text/css">
<!--
body {
	background-color: #FFFEE8;
	background-image: url(../image/13.jpg);
}
.style9 {font-size: 14px; color: #FFFFFF; }
-->
</style></head>

<body>

<p><br>
  <br>
  <br>
  <br>
</p>
<table width="100%" height="206" border="1" cellpadding="0" cellspacing="0">
  
  <tr>
    <td bgcolor="#6F7F1D"><a href="s_account2.php" target="mainFrame" class="style9">會員管理</a></td>
  </tr>
  <tr>
    <td bgcolor="#6F7F1D"><a href="s_system.php" target="mainFrame" class="style9">銷售管理</a></td>
  </tr>
  <tr>
    <td bgcolor="#6F7F1D"><a href="s_upstore.php" target="mainFrame" class="style9">蛋糕上架</a></td>
  </tr>
  <tr>
    <td bgcolor="#6F7F1D"><a href="s_upstore_del.php" target="mainFrame" class="style9">蛋糕管理</a></td>
  </tr>
  
   <tr>
    <td bgcolor="#6F7F1D"><a href="../talkall.php" target="mainFrame" class="style9">討論區管理</a></td>
  </tr>
  <tr>
    <td bgcolor="#6F7F1D"><a href="ch_syspass.php" target="mainFrame" class="style9">密碼修改</a></td>
  </tr>
  <tr>
    <td bgcolor="#6F7F1D"><a href="<?php echo $logoutAction ?>" target="_top" class="style9">系統登出</a></td>
  </tr>
</table>
</body>
</html>
