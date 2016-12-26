<?php require_once('../Connections/easyshop.php'); ?>
<?php
session_start();
$colname_rs = "1";
if (isset($_GET['id'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_rs = sprintf("SELECT * FROM s_product WHERE pro_id = %s", $colname_rs);
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
.style1 {
	color: #669966;
	font-weight: bold;
	font-size: large;
}
body {
	background-color: #FDFBDB;
	background-image: url(../user/image/thumb_1185020785.jpg);
}
.style5 {
	color: #422C15;
	font-weight: bold;
}
.style6 {
	color: #000000;
	font-weight: bold;
}
.style25 {color: #000000}
.style32 {color: #000000; font-size: 14px;}
.style35 {font-family: "標楷體"; color: #000000; font-size: 14px;}
.style36 {font-family: "標楷體"; color: #000000; font-size: small;}
-->
</style>
</head>

<body>
<div align="center" class="style1">
</div>
<?php require_once('buy_top.php'); ?>
<hr>
<form name="form1" method="post" action="buy_shop2.php">
  <table width="622" height="320" border="1" align="center">
    <tr bgcolor="#CC9966">
      <td colspan="3" bgcolor="#FFFFFF"><div align="center" class="style5 style25"><img src="../image/jyghkjghk.jpg" width="626" height="211" /></div>        
      <div align="center" class="style6"></div></td>
    </tr>
    
    <tr bgcolor="#FAD3E3">
      <td width="19" rowspan="4" background="../image/back060080.jpg" bgcolor="#FFFF99"><span class="style25"><span class="style5 style25"><strong><img src="../system/store_photo/<?php echo $row_rs['s_file']; ?>" width="247" height="200" /></strong></span></span></td>
      <td colspan="2" bgcolor="#F3F8FC" class="style35"><span class="style32">
        類別:<?php echo $row_rs['s_ps']; ?> 品名:
         <?php
	   	   echo $row_rs['s_product']; 
	  
	   ?>
      
      <input name="s_product" type="hidden" id="s_product" value="<?php echo $row_rs['s_product']; ?>" />
      </span></td>
    </tr>
    <tr bgcolor="#FAD3E3">
      <td width="185" bgcolor="#F3F8FC" class="style35"><div align="center" class="style25">說明</div></td>
      <td width="396" bgcolor="#F3F8FC" class="style35"><div align="left" class="style32"><?php echo $row_rs['s_text']; ?></div></td>
    </tr>
    <tr bgcolor="#FAD3E3">
      <td height="23" bgcolor="#F3F8FC" class="style35"><div align="center" class="style35">售價</div></td>
      <td bgcolor="#F3F8FC" class="style35"><div align="left" class="style35"><?php echo $row_rs['s_money']; ?>
          <input name="s_money" type="hidden" id="s_money" value="<?php echo $row_rs['s_money']; ?>">
      </div></td>
    </tr>
    <tr bgcolor="#FAD3E3">
      <td bgcolor="#F3F8FC"><div align="center" class="style35">購買數量</div></td>
      <td bgcolor="#F3F8FC"><div align="left" class="style36">
        <select name="s_number" id="s_number">
           <?php 
	 for ($i=1;$i<=20;$i++){
	if ($i==1){
	 echo  "<option value=" . $i ." selected>" . $i . "</option>" ;
	 }else{
	  echo  "<option value=" . $i .">" . $i . "</option>" ;
	};
	 };
	  
	   ?>
        </select>
</div></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#FDFBDB"><div align="center" class="style25">
        <input type="submit" name="Submit" value="送出">
      </div></td>
    </tr>
  </table>
</form>
<br>
<hr>
<p align="center"><a href="../index.php" target="_top">回首頁</a></p>
</body>
</html>
<?php
mysql_free_result($rs);
?>
