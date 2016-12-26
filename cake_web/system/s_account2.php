<?php require_once('../Connections/easyshop.php'); ?>
<?php
session_start();
// *** Redirect if username exists
if($_SESSION['MM_Username']<>"admin"){
exit;
};
$maxRows_rs = 50;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
  $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

mysql_select_db($database_easyshop, $easyshop);
$query_rs = "SELECT * FROM a_account ORDER BY a_account ASC";
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
$query_rs = "SELECT * FROM a_account ORDER BY a_account ASC";
mysql_query("SET NAMES 'utf-8'");
mysql_query("SET CHARACTER SET 'UTF-8'");
mysql_query("SET CHARACTER_SET_RESULTS='UTF-8'");
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>會員管理</title>
<style type="text/css">
<!--
.style1 {font-size: small}
.style9 {color: #FFFFFF}
.style13 {font-size: 12px}
body {
	background-image: url(../image/ytk.jpg);
}
.style14 {color: #00001F}
.style16 {color: #719DAA}
.style17 {color: #05021D; font-size: 12px; }
.style18 {color: #05021D}
-->
</style>
</head>

<body>

<div align="center" class="style1">
  <table width="656" border="0" align="center">
    <tr bgcolor="#CCCCFF">
      <td height="20" colspan="5" bgcolor="#FDFBFC"><img src="../image/kjhfkjh.jpg" width="644" height="189"></td>
    </tr>
    <tr bgcolor="#CCCCFF">
      <td height="20" colspan="5" bgcolor="#FDFBFC"><div align="center"><span class="style14">會員管理 </span></div></td>
    </tr>
    <tr bgcolor="#CCCCFF">
    <td width="106" height="20" bgcolor="#FEFAF9"><div align="left" class="style17"><span class="style7">帳號</span></div></td>
      <td width="143" bgcolor="#FEFAF9"><div align="left" class="style17"><span class="style7">密碼</span></div></td>
      <td width="148" bgcolor="#FEFAF9"><div align="left" class="style17">姓名</div></td>
      <td width="150" bgcolor="#FEFAF9"><div align="left" class="style17">電話</div></td>
      <td width="87" bgcolor="#FEFAF9"><div align="left"><span class="style9"><span class="style13"><span class="style16"><span class="style18"></span></span></span></span></div></td>
    </tr>
    <?php do { ?>
      <tr>
        <td bgcolor="#FFFFFF"><div align="left" class="style13"><?php echo $row_rs['a_account']; ?></div></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style13"><?php echo $row_rs['a_pass']; ?></div></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style13"><?php echo $row_rs['a_name']; ?></div></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style13"><?php echo $row_rs['a_phone']; ?></div></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style13"><a href="s_edit_account.php?id=<?php echo $row_rs['a_id']; ?>">修改</a> / <a href="s_account_del.php?id=<?php echo $row_rs['a_id']; ?>" onClick="return accessSina()">刪除</a> </div></td>
      </tr>
      <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
  </table>
</div>
<p align="center" class="style1">
</body>
</html>
<?php
mysql_free_result($rs);
?>
<script language="javascript">
function accessSina()
{
 if (confirm('確定要刪除?')) {
  return true;
 } else {
  return false;

  }
}
</script>
