
<?php require_once('../Connections/easyshop.php'); ?>
<?php
session_start();
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs = 100;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
  $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

mysql_select_db($database_easyshop, $easyshop);
$query_rs = "SELECT * FROM s_product ORDER BY s_ps ASC";
$query_limit_rs = sprintf("%s LIMIT %d, %d", $query_rs, $startRow_rs, $maxRows_rs);
$rs = mysql_query($query_limit_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);

if (isset($_GET['totalRows_rs'])) {
  $totalRows_rs = $_GET['totalRows_rs'];
} else {
  $all_rs = mysql_query($query_rs);
  $totalRows_rs = mysql_num_rows($all_rs);
}
$totalPages_rs = ceil($totalRows_rs/$maxRows_rs)-1;

mysql_select_db($database_easyshop, $easyshop);
$query_rs2 = "SELECT * FROM s_product_ps ORDER BY s_product_ps ASC";
$rs2 = mysql_query($query_rs2, $easyshop) or die(mysql_error());
$row_rs2 = mysql_fetch_assoc($rs2);
$totalRows_rs2 = mysql_num_rows($rs2);

$queryString_rs = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs") == false && 
        stristr($param, "totalRows_rs") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs = sprintf("&totalRows_rs=%d%s", $totalRows_rs, $queryString_rs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
<!--
.style1 {font-size: small}
.style5 {color: #FFFFFF; font-weight: bold; }
body {
	background-image: url(../image/jhgjhgj.jpg);
}
.style8 {color: #8A6606}
.style11 {color: #FFFFFF}
.style14 {font-size: small; color: #000000; }
.style15 {color: #A29686; font-weight: bold; }
.style16 {color: #B84F5D}
.style17 {color: #6C583F;
	font-size: large;
}
-->
</style>
</head>

<body>
<div align="center" class="style8"><span class="style17">-蛋糕瀏覽-</span><br />
</div>
<div align="center">
 
<?php do { ?>
  [<a href="s_upstore_deld.php?p=<?php echo urlencode($row_rs2['s_product_ps']); ?>"><?php echo ($row_rs2['s_product_ps']); ?></a>]
  <?php } while ($row_rs2 = mysql_fetch_assoc($rs2)); ?><br>
</div>
<table width="100%" border="1" align="center">
  <tr>
    <td width="139" bgcolor="#604F35"><div align="center"><span class="style5 style1 style11">蛋糕圖</span></div></td>
    <td width="177" bgcolor="#604F35"><div align="center" class="style5 style1 style11">蛋糕名稱</div></td>
    <td width="151" bgcolor="#604F35"><div align="center" class="style5 style1 style11">蛋糕類別</div></td>
    <td width="169" bgcolor="#604F35"><div align="center" class="style5 style1 style11">蛋糕售價</div></td>
    <td width="476" bgcolor="#604F35"><div align="center" class="style5 style1 style11">蛋糕說明</div></td>
    <td width="165" bgcolor="#604F35"><span class="style11"></span></td>
  </tr>
  <?php do { ?>
  <tr>
    <td bgcolor="#FFFFFF"><div align="center"><span class="style14"><a href="photo.php?p=<?php echo $row_rs['s_file']; ?>" target="_blank"><img src="store_photo/<?php echo $row_rs['s_file']; ?>" width="99" height="86" border="0" /></a></span></div></td>
    <td bgcolor="#FFFFFF"><span class="style14"><?php echo $row_rs['s_product']; ?></span></td>
    <td bgcolor="#FFFFFF"><span class="style14"><?php echo $row_rs['s_ps']; ?></span></td>
    <td bgcolor="#FFFFFF"><span class="style14"><?php echo $row_rs['s_money']; ?></span></td>
    <td bgcolor="#FFFFFF"><span class="style14"><?php echo $row_rs['s_text']; ?></span></td>
    <td bgcolor="#FFFFFF"><span class="style14"><a href="s_edit_upstore.php?id=<?php echo $row_rs['pro_id']; ?>">編輯</a> / <a href="s_upstore_del2.php?id=<?php echo $row_rs['pro_id']; ?>">刪除</a></span></td>
  </tr>
  <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
</table>
<div align="center"><br>
  <?php // echo ($startRow_rs + 1) ?>
  <?php  //echo min($startRow_rs + $maxRows_rs, $totalRows_rs) ?> 
HAVE <?php echo $totalRows_rs ?><br>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_rs > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, 0, $queryString_rs); ?>">first</a>
        <?php } // Show if not first page ?>
      </td>
      <td width="31%" align="center"><?php if ($pageNum_rs > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, max(0, $pageNum_rs - 1), $queryString_rs); ?>">up</a>
        <?php } // Show if not first page ?>
      </td>
      <td width="23%" align="center"><?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, min($totalPages_rs, $pageNum_rs + 1), $queryString_rs); ?>">down</a>
        <?php } // Show if not last page ?>
      </td>
      <td width="23%" align="center"><?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, $totalPages_rs, $queryString_rs); ?>">old page</a>
        <?php } // Show if not last page ?>
      </td>
    </tr>
  </table>
  <p><a href="s_upstore.php">回上頁</a></p>
</div>
</body>
</html>
<?php
mysql_free_result($rs);

mysql_free_result($rs2);
?>

