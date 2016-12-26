<?php // require_once('../../Connections/easyshop.php'); ?>
<?php require_once('../Connections/easyshop.php'); ?>
<?php
session_start();
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE sale_product SET sale_ps=%s WHERE s_id=%s",
                       GetSQLValueString($_POST['sale_ps'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_easyshop, $easyshop);
  $Result1 = mysql_query($updateSQL, $easyshop) or die(mysql_error());

  $updateGoTo = "s_system.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rs = "1";
if (isset($_GET['id'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_rs = sprintf("SELECT * FROM sale_product WHERE s_id = %s", $colname_rs);
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);

$colname_rs2 = "-1";
if (isset($_GET['id'])) {
  $colname_rs2 = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_rs2 = sprintf("SELECT * FROM sale_product WHERE s_id = %s", $colname_rs2);
$rs2 = mysql_query($query_rs2, $easyshop) or die(mysql_error());
$row_rs2 = mysql_fetch_assoc($rs2);
$totalRows_rs2 = mysql_num_rows($rs2);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
mysql_select_db($database_easyshop, $easyshop);
$query_RSP = "SELECT * FROM a_account WHERE a_account ='". $row_rs['a_account'] ."'"; 
$RSP = mysql_query($query_RSP, $easyshop) or die(mysql_error());
$row_RSP = mysql_fetch_assoc($RSP);
$totalRows_RSP = mysql_num_rows($RSP);
?>
<title>購買商品</title>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
	background-image: url(../images/sedhgbdf.jpg);
}
.style1 {font-size: small}
.style19 {color: #FFFFFF}
.style24 {color: #333333}
.style25 {
	font-size: small;
	color: #333333;
	font-weight: bold;
}
.style26 {color: #000000; font-size: small;}
.style27 {color: #000000}
.style28 {font-family: "標楷體"; color: #000000; }
-->
</style></head>

<body>
<div align="center"><br>
  <table width="40%" border="1" align="center">
    <tr>
      <td bgcolor="#635A55"> <div align="center" class="style19">[購買記錄] </div></td>
    </tr>
</table>
  <br>
 
  <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">    
    <div align="center"><br>
      <img src="../image/1b.jpg" width="530" height="178">
      <table width="517" border="1" align="center">
        <tr bgcolor="#CCCCFF">
          <td height="20" bgcolor="#E2E5DE"><div align="left" class="style19"><span class="style1 style19 style19"><span class="style26">帳號</span></span></div></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style27"><span class="style1"><?php echo $row_RSP['a_account']; ?></span></div></td>
        <td bgcolor="#E2E4DF"><div align="left"><span class="style1 style19 style19"><span class="style26">電話</span></span></div></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style27"><span class="style1"><?php echo $row_RSP['a_phone']; ?></span></div></td>
        </tr>
        <tr bgcolor="#CCCCFF">
          <td height="20" bgcolor="#E2E5DE"><div align="left" class="style19"><span class="style1 style19 style19"><span class="style26">密碼</span></span></div></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style27"><span class="style1"><?php echo $row_RSP['a_pass']; ?></span></div></td>
        <td bgcolor="#E2E4DF"><div align="left"><span class="style1 style19 style19"><span class="style26">E-MAIL</span></span></div></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style27"><span class="style1"><?php echo $row_RSP['a_sogi']; ?></span></div></td>
        </tr>
        <tr bgcolor="#CCCCFF">
          <td width="95" height="20" bgcolor="#E2E5DE"><div align="center" class="style1 style19 style19 style19">
            <div align="left"><span class="style26">姓名</span></div>
        </div></td>
        <td width="89" bgcolor="#FFFFFF"><div align="center" class="style1 style27">
          <div align="left"><span class="style1"><?php echo $row_RSP['a_name']; ?></span></div>
        </div></td>
        <td width="113" bgcolor="#E2E4DF"><div align="center" class="style1 style19 style19">
          <div align="center" class="style1 style19 style19">
            <div align="left"><span class="style26">ATM</span></div>
          </div>
        </div></td>
        <td width="192" bgcolor="#FFFFFF"><div align="center" class="style1 style27">
          <div align="left"><span class="style1"><?php echo $row_RSP['atm']; ?></span></div>
        </div></td>
        </tr>
        <tr>
          <td bgcolor="#E2E5DE"><div align="center" class="style1 style19">
            <div align="left"><span class="style1 style19 style19"><span class="style26">住址</span></span></div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div align="center" class="style1">
          <div align="left"><?php echo $row_RSP['a_address']; ?></div>
        </div>        <div align="center" class="style1"></div>        <div align="center" class="style1"></div></td>
        </tr>
      </table>
      <table width="576" border="1">
        <tr>
          <td width="129" bgcolor="#E1E4D9"><div align="center"><span class="style27">寄送位置</span></div></td>
        <td width="327" bgcolor="#E1E4D9"><div align="left"><?php echo $row_rs2['se_stud']; ?><?php echo $row_rs2['se_si']; ?><?php echo $row_rs2['si_class']; ?><br>
          ( <?php echo $row_rs2['area']; ?><?php echo $row_rs2['se_address']; ?> <?php echo $row_rs2['se_name']; ?> <?php echo $row_rs2['se_phone']; ?>)</div></td>
      </tr>
      </table>
      <table width="484" border="0">
        <tr bgcolor="#CCCCCC">
          <td colspan="3" bgcolor="#F0FFF5"><div align="left" class="style24"><span class="style1">編號:
            <?php echo $row_rs['sale_sn']; ?>
            <input name="id" type="hidden" id="id" value="<?php echo $row_rs['s_id']; ?>">
          </span>(<?php echo $row_rs['se_si']; ?>)<span class="style28">內餡: <?php echo $row_rs['sendtype']; ?></span></div></td>
        </tr>
        <tr bgcolor="#E9FFA4">
          <td colspan="3" bgcolor="#F0FFF5"><div align="center" class="style25">購買者: <?php echo $row_rs['a_account']; ?></div></td>
        </tr>
        <tr bgcolor="#E9FFA4">
          <td colspan="3" bgcolor="#F0FFF5"><div align="center" class="style25"> 購買時間:<?php echo $row_rs['sale_date']; ?></div></td>
        </tr>
        <tr bgcolor="#CCFF33">
          <td width="221" bgcolor="#F0FFF5"><div align="center" class="style25">產品名稱</div></td>
          <td width="70" bgcolor="#F0FFF5"><div align="center" class="style25">產品數量</div></td>
          <td width="90" bgcolor="#F0FFF5"><div align="center" class="style25">產品 單價</div></td>
        </tr>
        <?php   $arr= split(",",$row_rs['s_product']);
  $arr3= split(",",$row_rs['s_money']);
  $arr2= split(",",$row_rs['sale_num']);
  for ($i=0;$i<=count($arr);$i++){
  //echo $arr[$i] . " " . $arr2[$i] . " " . $arr3[$i] . " " . "<br>";
  echo "<tr><td >". $arr[$i] ."</td><td >". $arr2[$i] ."</td><td >". ($arr3[$i] ) ."</td></tr>";
  
  $sum=$sum + ($arr3[$i] * $arr2[$i]);
  };?>
        
        
        
        
        
        <tr bgcolor="#E9FFA4">
          <td colspan="2" bgcolor="#F0FFF5"><div align="center" class="style25">總金額</div></td>
          <td bgcolor="#F0FFF5"><span class="style25"><?php echo $sum;?></span></td>
        </tr>
        <tr bgcolor="#CCCC66">
          <td colspan="3" bgcolor="#F0FFF5"><div align="center" class="style25">處理情況</div></td>
        </tr>
        <tr bgcolor="#E4E4AF">
          <td colspan="3" bgcolor="#F0FFF5"><div align="center" class="style25">            
            <div align="center">
              <input name="sale_ps" type="radio" value="1">
              
              處理中
              
              <input name="sale_ps" type="radio" value="3">
              結案
              
              <input name="sale_ps" type="radio" value="5">
              退單
              <input type="submit" name="Submit" value="送出">
            </div>
          </div></td>
	    </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1">
    </div>
  </form>
  <div align="center"><a href="s_system.php">回上頁 </a> | <a href="../index.php"> 回首頁</a>


  </div>
</body>
</html>

