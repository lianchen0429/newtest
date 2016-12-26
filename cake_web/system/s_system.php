<?php require_once('../Connections/easyshop.php'); ?>
<?php
session_start();
if($_SESSION['MM_Username']<>"admin"){
exit;
}
mysql_select_db($database_easyshop, $easyshop);
$query_rs = "SELECT * FROM sale_product ORDER BY s_id DESC";
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>購買完畢</title>
<style type="text/css">
<!--
.style3 {color: #CC3300; font-weight: bold; }
.style4 {font-size: small}
body {
	background-image: url(../image/sfgjhj.jpg);
}
.style10 {font-size: small; color: #FFFFFF; font-weight: bold; }
.style12 {font-size: small; color: #000000; }
.style14 {color: #D39741}
-->
</style>
</head>

<body>
<div align="center"><span class="style3"><br>
    <img src="../image/1a.jpg" width="650" height="177"><br>
    <span class="style14">[查看購買記錄]</span><br>
</span>
  <?php require_once('system_top.php'); ?>
<table width="629" border="1">
  <tr>
    <td width="122" bgcolor="#775A4A"><div align="center" class="style10">購買日期</div></td>
    <td width="201" bgcolor="#775A4A"><div align="center" class="style10">交易編號</div></td>
    <td width="177" bgcolor="#775A4A"><div align="center" class="style10">處理情況</div></td>
    <td width="101" bgcolor="#775A4A"><div align="center"><span class="style4"></span></div></td>
  </tr>
  <?php do { ?>
  <tr>
      <td height="37" bgcolor="#FFFFFF"><div align="center" class="style12"><?php echo $row_rs['sale_date']; ?></div></td>
      <td bgcolor="#FFFFFF"><div align="center" class="style12"><?php echo $row_rs['sale_sn']; ?></div></td>
      <td bgcolor="#FFFFFF"><div align="center" class="style12"><?php 
	  switch($row_rs['sale_ps']){
	  case "1":
	  echo "處理中";  
	  break;
	   case "2":
	  echo "運送中";
	  break;
	   case "3":
	  echo "結案";
	  break;
	   case "4":
	  echo "缺貨";
	  break;
	   case "5":
	  echo "退單";
	  break;
	         
	  }
	 
	  
	  ?></div></td>
      <td bgcolor="#FFFFFF"><div align="center" class="style12"><a href="sys_sale_log2.php?id=<?php echo $row_rs['s_id']; ?>">詳細購買資料</a></div></td>
  </tr>
  <?php } while ($row_rs = mysql_fetch_assoc($rs));  ?>
</table>
</div>
</body>
</html>
<?php
mysql_free_result($rs);
?>
