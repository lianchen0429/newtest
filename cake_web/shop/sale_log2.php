<?php require_once('../Connections/easyshop.php'); ?>
<?php
session_start();
$colname_rs = "1";
if (isset($_GET['id'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_rs = sprintf("SELECT * FROM sale_product WHERE s_id = %s", $colname_rs);
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>購買商品</title>
<style type="text/css">
<!--
body {
	background-color: #CCCCFF;
	background-image: url(../user/image/thumb_1184398664.gif);
}
.style3 {color: #6A6A46; font-weight: bold; }
.style10 {
	color: #666666;
	font-size: small;
}
.style24 {font-family: "標楷體"; color: #000000; }
.style25 {color: #000000; font-weight: bold; font-family: "標楷體"; }
.style26 {color: #FFFFFF}
-->
</style></head>

<body>
   



<?php require_once('buy_top.php'); ?>
<hr>
<div align="center"><br />
<br>
 
  <form name="form1" method="post" action="buy_shop2.php?buyok=true"><?php echo date("Y-m-d");?>    <br>
    <span class="style10">訂貨編號: <?php echo $row_rs['sale_sn']; ?></span>
    <br />
    <img src="../image/kujkhjk.jpg" width="483" height="109" />
    <table width="514" border="0">
      <tr bgcolor="#CCCCCC">
        <td colspan="3" bgcolor="#9B8A7A"><div align="center"><span class="style26">[購買清單] </span></div></td>
      </tr>
      <tr bgcolor="#CCCCCC">
        <td colspan="3" bgcolor="#FFFFFF"><div align="left" class="style24">(<?php echo $row_rs['se_si']; ?>) 內餡: <?php echo $row_rs['sendtype']; ?></div></td>
      </tr>
      <tr bgcolor="#E9FFA4">
        <td colspan="3" bgcolor="#FFFFFF"><div align="center" class="style24">
          <div align="left">購買者: <?php echo $row_rs['a_account']; ?> 購買時間:<?php echo $row_rs['sale_date']; ?></div>
        </div></td>
      </tr>
      <tr bgcolor="#CCFF33">
        <td width="267" bgcolor="#FFFFFF"><div align="center" class="style25">品名</div></td>
        <td width="108" bgcolor="#FFFFFF"><div align="center" class="style25">購買數量</div></td>
        <td width="117" bgcolor="#FFFFFF"><div align="center" class="style25">品名單價</div></td>
      </tr>
	  <?php   $arr= split(",",$row_rs['s_product']);
  $arr3= split(",",$row_rs['s_money']);
  $arr2= split(",",$row_rs['sale_num']);
  for ($i=0;$i<=count($arr);$i++){
  //echo $arr[$i] . " " . $arr2[$i] . " " . $arr3[$i] . " " . "<br>";
  echo "<tr bgcolor=#FFFFCC><td >". $arr[$i] ."</td><td >". $arr2[$i] ."</td><td >". ($arr3[$i] ) ."</td></tr>";
  
  $sum=$sum + ($arr3[$i] * $arr2[$i]);
  };?>
	  
	  
      
	  
	  
      <tr bgcolor="#E9FFA4">
        <td colspan="2" bgcolor="#FFFFFF"><div align="center" class="style25">總金額</div></td>
        <td bgcolor="#FFFFFF"><span class="style25"><?php echo $sum;?></span></td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#FFFFFF"><div align="center">
        <?php 		
		echo "購物完畢"."<br>";
		echo "<font color=red > 金額為:". $sum ."元</font><br>";
		?></div></td>
	  </tr>
    </table>
  </form>
  <a href="sale_log.php">回上頁 </a> | <a href="../index.php" target="_top"> 回首頁</a>
  <hr>
  <p><span class="style3">    <?php 
  //echo $_SESSION['s_product'];
	/*
  $arr= split(",",$_SESSION['s_product']);
  $arr2= split(",",$_SESSION['s_money']);
  $arr3= split(",",$_SESSION['s_number']);
  for ($i=0;$i<=count($arr);$i++){
  echo $arr[$i] . " " . $arr2[$i] . " " . $arr3[$i] . " " . "<br>";
  };
  */

  
  
  ?>
  </span> </p>
  <p>      <br>
  </p>
</div>
<div align="center">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p><span class="style3">
  </span></p>
 

</div>
</body>
</html>
<?php
mysql_free_result($rs);
?>
