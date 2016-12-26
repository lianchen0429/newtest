<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
body {
	background-image: url(../image/ytk.jpg);
}
.style5 {font-size: 12px}
-->
</style></head>
<?php
//initialize the session


// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  session_unregister('MM_Username');
  session_unregister('MM_UserGroup');
	
  $logoutGoTo = "../index.php";

}
?>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: large;
}
.style2 {color: #666666}
.style4 {color: #FFFFFF}
.style6 {color: #211F20; }
.style7 {color: #201E1F; }
.style8 {font-size: 14px}
-->
</style>

<table width="671" border="0" align="center">
  <tr bgcolor="#CC0033">
    <td colspan="4" bgcolor="#C4BBB2"><div align="center" class="style1 style5">會員專區</div></td>
  </tr>
  <tr bgcolor="#FFE6EC">
    <td width="216" bgcolor="#FFFFFF"><span class="style8"><span class="style2">
      <?php  echo $_SESSION['MM_Username'];?>
歡迎光臨 |</span> <a href="../right.php" class="style4">回首頁</a> </span></td>
    <td width="121" bgcolor="#FFFFFF"><div align="center" class="style8"><a href="edit_account.php" class="style6">修改會員</a></div></td>
    <td width="160" bgcolor="#FFFFFF"><div align="center" class="style8"><a href="sale_log.php" class="style7">購物記錄</a></div></td>
    <td width="146" bgcolor="#FFFFFF"><div align="center" class="style8"><a href="buy_shop2.php" class="style7">購物車</a></div>
      <div align="center" class="style8"></div>      <div align="left" class="style8">
        <div align="center"> </div>
    </div></td>
  </tr>
</table>
