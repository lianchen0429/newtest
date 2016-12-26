<?php require_once('../Connections/easyshop.php'); ?>
<?php
mysql_select_db($database_easyshop, $easyshop);
$query_rs = "update sale_product set sendtype='".$_POST['sendtype']."' where sale_sn='".$_SESSION['ss']."'";
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center">選取完畢</p>
<p align="center"><a href="../index.php" target="_top">回首頁</a></p>
</body>
</html>
 