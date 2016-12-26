<?php require_once('../Connections/easyshop.php'); ?>
<?php
session_start();
$colname_rs = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_rs = sprintf("SELECT * FROM a_account WHERE a_account = '%s'", $colname_rs);
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
	background-image: url(../user/image/thumb_1185020784.jpg);
}
.style1 {color: #999966}
.style2 {color: #999966; font-weight: bold; }
.style3 {color: #6A6A46; font-weight: bold; }
.style8 {
	color: #425700;
	font-weight: bold;
	font-size: small;
}
.style9 {
	color: #FF0000;
	font-weight: bold;
	font-size: small;
}
.style11 {color: #CCCCFF}
.style13 {font-size: small}
.style16 {color: #FF0000; font-size: small; }
.style24 {
	color: #99CC00;
	font-weight: bold;
}
.style25 {color: #FFFFFF; font-weight: bold; font-size: small; }
.style26 {color: #000000}
.style27 {color: #000000; font-weight: bold; font-size: small; }
.style28 {font-size: small; color: #000000; }
-->
</style></head>

<body>
   <?PHP 


 
$_SESSION['s_product']=$_SESSION['s_product'].$_POST['s_product'].",";

$_SESSION['s_money']=$_SESSION['s_money'].$_POST['s_money'].",";
$_SESSION['s_number']=$_SESSION['s_number'].$_POST['s_number'].",";

//echo $_SESSION['s_product'];
// echo "<p>";
//echo $_SESSION['s_money'];
// echo "<p>";
//echo $_SESSION['s_number'];
?>


<?php 
if ($_GET['shop']=="false"){

$_SESSION['s_product']="";
$_SESSION['s_money']="";
$_SESSION['s_number']="";


};?>
<?php require_once('buy_top.php'); ?>
<hr>
<div align="center"><br>
 
<form name="form1" method="post" action="buy_shop5.php" onsubmit="return postit3();">
    <div align="center"><?php echo date("Y-m-d");?>    <br>
      <table width="600" border="1">
        <tr>
          <td colspan="4" background="../image/back060046.gif" bgcolor="#FFFFFF"><div align="center"><img src="../image/hgfk.jpg" width="598" height="160" /></div></td>
        </tr>
        <tr>
          <td colspan="4" bgcolor="#FFFFFF"><div align="center" class="style16 style26">收件人
            <input name="sendtype" type="hidden" id="sendtype" value="<?php echo $_POST['sendtype'];?>" />
          </div></td>
        </tr>
        <tr>
          <td width="83" bgcolor="#FFFFFF"><span class="style27">姓名</span></td>
          <td width="192" bgcolor="#FFFFFF"><div align="left" class="style28">
            <div align="left">
              <input name="se_name" type="text" id="se_name" />
              </div>
          </div></td>
          <td width="98" bgcolor="#FFFFFF"><span class="style27">電話</span></td>
          <td width="199" bgcolor="#FFFFFF"><input name="se_phone" type="text" id="se_phone" /></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF"><span class="style27">地址</span></td>
          <td colspan="3" bgcolor="#FFFFFF"><div align="left" class="style28">
            <div align="left">
              <input name="se_address" type="text" id="se_address" size="60" />
              </div>
          </div></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF"><span class="style27">付款方式</span></td>
          <td colspan="3" bgcolor="#FFFFFF"><div align="left" class="style28">
            <div align="left">
              <input name="se_si" type="radio" value="ATM轉帳" />
              ATM轉帳
              <input name="se_si" type="radio" value="自取" />
              自取 </div>
          </div></td>
        </tr>
        <tr>
          <td colspan="4" bgcolor="#FFFFFF"><div align="left" class="style13">
              <div align="center">
                <input type="submit" name="Submit" value="我 要 結 帳" />
                <br />
                <a href="../right.php">[繼續購買]</a> <span class="style11">_____ </span><a href="buy_shop2.php?shop=false">[清空購物車]</a></div>
          </div></td>
        </tr>
        </table>
      <table width="748" border="0">
        <tr bgcolor="#CCCCCC">
          <td colspan="3" bgcolor="#FFFFFF"><div align="left" class="style13 style26"><span class="style24"><span class="style26">交易編號</span>:<?  echo substr($_SESSION[$sale_id], 0, 9);?>
          </span></div></td>
        </tr>
        <tr bgcolor="#E9FFA4">
          <td colspan="3" bgcolor="#FFFFFF"><div align="center" class="style8 style26">購買會員:
          <?php  echo $_SESSION['MM_Username'];?></div></td>
        </tr>
        <tr bgcolor="#CCFF33">
          <td width="108" bgcolor="#FFFFFF"><div align="center" class="style25 style26">品名</div></td>
          <td width="180" bgcolor="#FFFFFF"><div align="center" class="style25 style26">數量</div></td>
          <td width="232" bgcolor="#FFFFFF"><div align="center" class="style25 style26">單價</div></td>
        </tr>
        <?php   $arr= split(",",$_SESSION['s_product']);
  $arr3= split(",",$_SESSION['s_money']);
  $arr2= split(",",$_SESSION['s_number']);
  for ($i=0;$i<=count($arr);$i++){
  //echo $arr[$i] . " " . $arr2[$i] . " " . $arr3[$i] . " " . "<br>";
  echo "<tr bgcolor=#FFFFCC><td >". $arr[$i] ."</td><td >". $arr2[$i] ."</td><td >". ($arr3[$i] ) ."</td></tr>";
  
  $sum=$sum + ($arr3[$i] * $arr2[$i]);
  };?>
        
        
        
        
        
        <tr bgcolor="#E9FFA4">
          <td colspan="2" bgcolor="#FFFFFF"><div align="center" class="style13 style26"><strong>總金額</strong></div></td>
          <td bgcolor="#FFFFFF"><span class="style9 style26"><?php echo $sum;?></span></td>
        </tr>
        <tr>
          <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        </table>
      <br>
      </div>
  </form>
  <div align="center"><a href="../index.php" target="_top">回首頁</a>
    
    
  </div>
</body>
</html>
<?php
mysql_free_result($rs);
?>

<script language="javascript">
function postit3(){


if(document.form1.se_name.value==""){
alert ("姓名要填唷!")
return false;
}else if (document.form1.se_address.value==""){
alert ("地址要填唷!");
return false;
}

//alert ("新增完畢");




}
</script>