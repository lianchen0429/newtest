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
  $updateSQL = sprintf("UPDATE a_account SET a_pass=%s, a_name=%s, a_address=%s, a_phone=%s, a_sogi=%s, atm=%s WHERE a_id=%s",
                       GetSQLValueString($_POST['a2'], "text"),
                       GetSQLValueString($_POST['a3'], "text"),
                       GetSQLValueString($_POST['a4'], "text"),
                       GetSQLValueString($_POST['a5'], "text"),
                       GetSQLValueString($_POST['a6'], "text"),
                       GetSQLValueString($_POST['atm'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_easyshop, $easyshop);
  $Result1 = mysql_query($updateSQL, $easyshop) or die(mysql_error());

  $updateGoTo = "edit_account.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rs = "1";
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
<title>修改帳戶資料</title>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
body {
	background-image: url(../image/hgfdhg.jpg);
}
.style2 {color: #FFFFFF}
.style4 {color: #000066; font-size: small; }
.style5 {color: #000066}
.style6 {font-size: small}
-->
</style>
</head>

<body>
<div align="center"><span class="style1">修改帳戶資料</span><br>
  <?php require_once('buy_top.php'); ?>
</div>
<hr>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <div align="center"></div>
  <table width="602" border="1" align="center">
    <tr>
      <td width="217" rowspan="7" bgcolor="#695F0A"><img src="../image/dfk.jpg" width="217" height="219" /></td>
      <td width="88" bgcolor="#D13526"><div align="center" class="style4 style2">
        <div align="center"><span class="style2">帳號</span>
          <input name="id" type="hidden" id="id" value="<?php echo $row_rs['a_id']; ?>">
        </div>
      </div></td>
      <td width="275" bgcolor="#F3E9E8"><?php echo $row_rs['a_account']; ?></td>
    </tr>
    <tr>
      <td bgcolor="#D13526"><div align="center" class="style4 style2">
        <div align="left" class="style2">
          <div align="center">密碼</div>
        </div>
      </div></td>
      <td bgcolor="#F3E9E8"><input name="a2" type="text" id="a2" value="<?php echo $row_rs['a_pass']; ?>"></td>
    </tr>
    <tr>
      <td bgcolor="#D13526"><div align="center" class="style4 style2">
        <div align="left" class="style2">
          <div align="center">姓名</div>
        </div>
      </div></td>
      <td bgcolor="#F3E9E8"><input name="a3" type="text" id="a3" value="<?php echo $row_rs['a_name']; ?>"></td>
    </tr>
    <tr>
      <td bgcolor="#D13526"><div align="center" class="style4 style2">
        <div align="left" class="style2">
          <div align="center">住址</div>
        </div>
      </div></td>
      <td bgcolor="#F3E9E8"><input name="a4" type="text" id="a4" value="<?php echo $row_rs['a_address']; ?>"></td>
    </tr>
    <tr>
      <td bgcolor="#D13526"><div align="center" class="style4 style2">
        <div align="left" class="style2">
          <div align="center">電話</div>
        </div>
      </div></td>
      <td bgcolor="#F3E9E8"><input name="a5" type="text" id="a5" value="<?php echo $row_rs['a_phone']; ?>"></td>
    </tr>
    <tr>
      <td bgcolor="#D13526"><div align="center" class="style4 style2">
        <div align="left" class="style2">
          <div align="center">郵件</div>
        </div>
      </div></td>
      <td bgcolor="#F3E9E8"><input name="a6" type="text" id="a6" value="<?php echo $row_rs['a_sogi']; ?>"></td>
    </tr>
    <tr>
      <td bgcolor="#D13526"><div align="left" class="style2">
        <div align="center"><span class="style6">卡號</span></div>
      </div></td>
      <td bgcolor="#F3E9E8"><input name="atm" type="text" id="atm" value="<?php echo $row_rs['atm']; ?>"></td>
    </tr>
    <tr>
      <td colspan="3"><div align="center">
        <input type="submit" name="Submit" value="送出" />
      </div></td>
    </tr>
  </table>
    <input type="hidden" name="MM_update" value="form1">
</form>
</body>
</html>
<?php
mysql_free_result($rs);
?>
