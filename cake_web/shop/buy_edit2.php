<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
body {
	background-image: url(../user/image/thumb_1185020784.jpg);
}
.style2 {color: #738120}
-->
</style>
</head>

<body>

<div align="center">
  <?PHP 
session_start();
// echo $_GET['s_number'];?>
  <?php // echo $_GET['r_id'];?>
  
  
  <?php 
/*
echo $_SESSION['s_product'];
echo "<p>";
echo $_SESSION['s_number'];
echo "<p>";
echo $_SESSION['s_money'];
*/


 $arr= split(",",$_SESSION['s_product']);
  
  $arr2= split(",",$_SESSION['s_number']);
  $arr3= split(",",$_SESSION['s_money']);
  
  $_SESSION['s_product']="";//先清空session
  $_SESSION['s_number']="";//先清空session
  $_SESSION['s_money']="";//先清空session
  
  /*
  echo "<p>";
  echo $_GET['r_id']; 
  echo "要刪除的上頁索引值";
  echo "<p>";
  */
  
  for ($i=0;$i<=count($arr);$i++){
  
  if($i == ($_GET['r_id']+1)){
  $_SESSION['s_product']=$_SESSION['s_product'] . "," . $arr[$i];
  $_SESSION['s_number']=$_SESSION['s_number'] . "," . $_GET['s_number'];
  $_SESSION['s_money']=$_SESSION['s_money'] . "," . $arr3[$i];
  }else{
  
  $_SESSION['s_product']=$_SESSION['s_product'] . "," . $arr[$i];
  $_SESSION['s_number']=$_SESSION['s_number'] . "," . $arr2[$i];
  $_SESSION['s_money']=$_SESSION['s_money'] . "," . $arr3[$i];
  
  }
  
  }

echo "<p>";
//echo $_SESSION['s_product'];




?>
  
</div>
<p align="center"><img src="../image/13.jpg" width="506" height="337" /></p>
<p align="center" class="style2">修改完畢</p>
<p align="center" class="style1"><a href="buy_shop2.php">回上頁</a></p>
</body>
</html>
