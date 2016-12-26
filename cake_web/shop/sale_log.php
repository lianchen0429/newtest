<?php require_once('../Connections/easyshop.php'); ?>
<?php
session_start();
$colname_rs = "1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_rs = sprintf("SELECT * FROM sale_product WHERE a_account = '%s' ORDER BY s_id DESC", $colname_rs);
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>購買完畢</title>
<style type="text/css">
<!--
.style3 {color: #CC3300; font-weight: bold; }
.style4 {
	font-size: small;
	color: #990000;
}
.style6 {font-size: small; color: #FFFFFF; font-weight: bold; }
body {
	background-image: url(../image/464.gif);
}
.style13 {
	color: #FFFFFF;
	font-size: 14px;
}
.style23 {
	color: #000000;
	font-size: 13px;
}
.style26 {font-size: 13px; color: #990000; }
.style27 {color: #242328; font-size: 13px; }
.style28 {font-size: 14px; color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>

<body>
<div align="center"><span class="style3">[購買記錄]</span>
  <?php require_once('buy_top.php'); ?><hr>
<table width="614" border="1">
  <tr>
    <td colspan="4" bgcolor="#FEF9F6"><img src="../image/kjhfkjh.jpg" width="611" height="138" /></td>
    </tr>
  <tr>
    <td width="103" bgcolor="#9E664B">&nbsp;</td>
    <td width="123" bgcolor="#9E664B"><div align="center" class="style6 style13">交易日期</div></td>
    <td width="245" bgcolor="#9E664B"><div align="center" class="style28">交易編號</div></td>
    <td width="115" bgcolor="#9E664B"><div align="center" class="style28">狀態</div></td>
    </tr>
  <?php do { ?>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style26"><a href="sale_log2.php?id=<?php echo $row_rs['s_id']; ?>">詳細資料</a></span></td>
      <td bgcolor="#FFFFFF"><div align="center" class="style23"  ><?php echo $row_rs['sale_date']; ?></div></td>
      <td bgcolor="#FFFFFF"><div align="center" class="style27"><?php echo $row_rs['sale_sn']; ?></div></td>
      <td bgcolor="#FFFFFF"><div align="center" class="style27"><?php 
	  
	 // echo $row_rs['sale_ps']; 
	  
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
    </tr>
  <?php } while ($row_rs = mysql_fetch_assoc($rs));  ?>
</table>
</div>
</body>
</html>
<?php
mysql_free_result($rs);
?>
