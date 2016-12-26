<?php require_once('../Connections/easyshop.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO s_product_ps (s_product_ps) VALUES (%s)",
                       GetSQLValueString($_POST['ps'], "text"));

  mysql_select_db($database_easyshop, $easyshop);
  $Result1 = mysql_query($insertSQL, $easyshop) or die(mysql_error());

  $insertGoTo = "s_upstore_ps.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_easyshop, $easyshop);
$query_rs = "SELECT * FROM s_product_ps ORDER BY s_product_ps ASC";
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>類別管理</title>
<style type="text/css">
<!--
.style1 {font-size: small}
body {
	background-image: url(../image/6hg.jpg);
	background-color: #B6A89D;
}
.style2 {
	color: #DDC9AE;
	font-weight: bold;
}
.style3 {font-size: small; color: #1B1613; }
.style4 {color: #FFFFFF}
.style5 {color: #1B1613}
-->
</style>
</head>

<body>
<div align="center">
  <p><br>
    <span class="style2">蛋糕類別管理</span></p>
  <?php require_once('system_top.php'); ?>
  <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
    <input name="ps" type="text" id="ps">
    <input type="submit" name="Submit" value="送出">
    <input type="hidden" name="MM_insert" value="form1">
  </form>
 
</div>
<table width="277" border="1" align="center">
  <tr>
    <td width="197" bgcolor="#DCC8AD"><div align="center" class="style3">類別名稱</div></td>
    <td width="64" bgcolor="#DCC8AD"><div align="center"><span class="style1"><span class="style4"><span class="style5"></span></span></span></div></td>
  </tr>
  <?php do { ?>
  <tr>
    <td bgcolor="#FFFFFF"><div align="center" class="style1"><?php echo $row_rs['s_product_ps']; ?></div></td>
    <td bgcolor="#FFFFFF"><div align="center" class="style1"><a href="s_upstore_ps_del.php?id=<?php echo $row_rs['s_product_ps_id']; ?>">刪除</a></div></td>
  </tr>
  <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
</table>
<div align="center"></div>
<hr>
<p align="center"><a href="s_upstore.php">回上頁</a></p>
</body>
</html>
<?php
mysql_free_result($rs);
?>
