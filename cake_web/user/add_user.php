<?php require_once('../Connections/easyshop.php'); ?>
<? //include "u_include.php" ?>
<?php
session_start();
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="add_user2.php?id=2";
  $loginUsername = $_POST['a1'];
  $LoginRS__query = "SELECT a_account FROM a_account WHERE a_account='" . $loginUsername . "'";
  mysql_select_db($database_easyshop, $easyshop);
  $LoginRS=mysql_query($LoginRS__query, $easyshop) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO a_account (a_account, a_pass, a_name, a_address, a_phone, a_sogi, atm) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['a1'], "text"),
                       GetSQLValueString($_POST['a2'], "text"),
                       GetSQLValueString($_POST['a3'], "text"),
                       GetSQLValueString($_POST['a4'], "text"),
                       GetSQLValueString($_POST['a5'], "text"),
                       GetSQLValueString($_POST['a6'], "text"),
                       GetSQLValueString($_POST['atm'], "text"));

  mysql_select_db($database_easyshop, $easyshop);
  $Result1 = mysql_query($insertSQL, $easyshop) or die(mysql_error());

  $insertGoTo = "add_user2.php?id=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>加入會員</title>
<script type="text/JavaScript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>
<style type="text/css">
<!--
body {
	background-image: url(../image/jgfjnfgj.jpg);
}
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {font-family: "標楷體"}
.style12 {font-family: "標楷體"; color: #FFFFFF; font-size: 14px; }
.style14 {font-family: "標楷體"; font-size: 14px; }
.style17 {font-size: 14px}
.style19 {color: #FDFDFD}
.style20 {color: #FFFFFF}
-->
</style></head>

<body>
<div align="center">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td bgcolor="#FFFFFF"><div align="center" class="style1"></div></td>
    </tr>
  </table>
</div>
<div align="center"><br>
</div>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" onSubmit="return aaa( );">
  <div align="center"></div>
  <table width="562" border="0" align="center">
    <tr>
      <td colspan="4" bgcolor="#893C22"><div align="center" class="style17"><span class="style1"><span class="style19">加入會員</span></span></div></td>
    </tr>
    <tr>
      <td width="51" bgcolor="#A16543"><span class="style2 style17 style20">帳號</span></td>
      <td width="212" bgcolor="#FEFEFE"><input name="a1" type="text" id="a1"></td>
      <td width="63" bgcolor="#A16543"><div align="center" class="style2 style20 style17"><span class="style2">密碼</span></div></td>
      <td width="208" bgcolor="#FFFFFF"><input name="a2" type="password" id="a2"></td>
    </tr>
    <tr>
      <td bgcolor="#A16543"><span class="style12">姓名</span></td>
      <td bgcolor="#FEFEFE"><input name="a3" type="text" id="a3"></td>
      <td bgcolor="#A16543"><div align="center" class="style12">電話</div></td>
      <td bgcolor="#FFFFFF"><input name="a5" type="text" id="a5" onKeyPress="if   (event.keyCode   <   46||event.keyCode   >   57)   event.returnValue   =   false;"></td>
    </tr>
    <tr>
      <td bgcolor="#A16543"><span class="style12">郵件</span></td>
      <td bgcolor="#FEFEFE"><input name="a6" type="text" id="a6"></td>
      <td bgcolor="#A16543"><div align="center" class="style12">
        <div align="center"><span class="style2">atm</span></div>
      </div></td>
      <td bgcolor="#FFFFFF"><input name="atm" type="text" id="atm" onKeyPress="if   (event.keyCode   <   46||event.keyCode   >   57)   event.returnValue   =   false;" maxlength="36"  ></td>
    </tr>
    <tr>
      <td bgcolor="#A16543"><span class="style12">住址</span></td>
      <td colspan="3" bgcolor="#FEFEFE"><span class="style17">
        <input name="a4" type="text" id="a4" size="50">        
      </span>        <div align="center" class="style12"></div></td>
    </tr>
    <tr>
      <td colspan="4" bgcolor="#FEFEFE"><div align="center" class="style14">
        <input type="submit" name="Submit" value="送出">
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<div align="center"></div>
<p align="center"><a href="../index.php" target="_top">回首頁</a></p>
</body>
</html>
<script language="javascript">
function aaa(){
if(document.form1.a1.value==""){
alert ("帳號要填唷!")
return false
}else if (document.form1.a2.value==""){
alert ("密碼要填唷!")
return false
}else if (document.form1.a3.value==""){
alert ("姓名要填唷!")
return false
}else if (document.form1.a4.value==""){
alert ("住址要填唷!")
return false
}else if (document.form1.a5.value==""){
alert ("電話要填唷!")
return false
}else if (document.form1.a6.value==""){
alert ("EMAIL要填唷!")
return false
}else if (document.form1.atm.value ==""){
alert ("ATM要填唷")
return false

}
}
</script>