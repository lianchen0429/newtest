<?php require_once('../Connections/easyshop.php'); ?>

<? include "s_include.php" ?>
<?php
session_start();
if($_SESSION['MM_Username']<>"admin"){
exit;
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

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM a_account WHERE a_id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_easyshop, $easyshop);
  $Result1 = mysql_query($deleteSQL, $easyshop) or die(mysql_error());

  $deleteGoTo = "s_account2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  //header(sprintf("Location: %s", $deleteGoTo));
}

$colname_rs = "1";
if (isset($_GET['is'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_GET['is'] : addslashes($_GET['is']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_rs = sprintf("SELECT * FROM a_account WHERE a_id = %s", $colname_rs);
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>R|</title>
</head>

<body>
<div align="center">
 <?php require_once('system_top.php'); ?>
  <form name="form1" method="post" action="">
    <input name="id" type="hidden" id="id" value="<?php echo $row_rs['a_id']; ?>">
    <input type="submit" name="Submit" value="刪除完畢">    
    <hr>
    <a href="s_account2.php">come back    </a>
  </form>
  <p>&nbsp;</p>
</div>
</body>
</html>
<?php
mysql_free_result($rs);
?>
