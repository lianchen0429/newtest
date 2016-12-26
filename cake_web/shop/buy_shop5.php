<?php
session_start();
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
	background-image: url(../image/04.gif);
}
.style1 {color: #999966}
.style2 {color: #999966; font-weight: bold; }
.style3 {color: #6A6A46; font-weight: bold; }
.style12 {color: #000066}
-->
</style></head>

<body>
   <?PHP
   


 
$_SESSION['s_product']=$_SESSION['s_product'].$_POST['s_product'].",";

$_SESSION['s_money']=$_SESSION['s_money'].$_POST['s_money'].",";
$_SESSION['s_number']=$_SESSION['s_number'].$_POST['s_number'].",";

 
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
 
  <form name="form1" method="post" action="buy_shop6.php">
  <br>
   
  <img src="../image/lkjgf;.jpg" width="438" height="121" />
  <table width="452" border="1">
	  <?php   $arr= split(",",$_SESSION['s_product']);
  $arr3= split(",",$_SESSION['s_money']);
  $arr2= split(",",$_SESSION['s_number']);
  for ($i=0;$i<=count($arr);$i++){
 
  $sum=$sum + ($arr3[$i] * $arr2[$i]);
  };?>
      <tr>
        <td width="550" bgcolor="#D6D5D1"><div align="center">
		  <p>
		    <?php
	$_SESSION['ss']=substr($_SESSION[$sale_id], 0, 9);
			
		mysql_connect("localhost","root",""); //連接資料庫
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET UTF8");
 mysql_select_db("cake_web_db"); //選擇資料庫
 mysql_query("insert into sale_product
(a_account,sale_sn,s_product,sale_num,s_money,sale_date,se_name,se_phone,se_address,se_stud,se_si,si_class,sendtype)
 
 values
 ('". $_SESSION['MM_Username'] ."','". $_SESSION['ss'] ."','". $_SESSION['s_product'] ."','". $_SESSION['s_number'] ."','". $_SESSION['s_money'] ."','". date("Y-m-d") ."','".$_POST['se_name']."','".$_POST['se_phone']."','".$_POST['se_address']."','".$_POST['se_stud']."','".$_POST['se_si']."','".$_POST['si_class']."','".$_POST['sendtype']."')
");
		$_SESSION[$sale_id]=md5(uniqid(rand()));
		
		echo "購物完畢"."<br>";
		echo "<font color=red >金額為:". $sum ."元</font><br>";
	
		
$_SESSION['s_product']="";
$_SESSION['s_money']="";
$_SESSION['s_number']="";
		

		?>
		    <br />
		    <span class="style12">購物完畢</span></p>
		  <hr />
		  <p><br />
		    <label>
		      請選蛋糕內餡<br />
		      <input name="sendtype" type="radio" value="布丁" />
		      布丁
		      <input name="sendtype" type="radio" value="乳酪" />
		      乳酪
		      <input name="sendtype" type="radio" value="水果" />
		      水果
		      <input name="sendtype" type="radio" value="芋泥" />
		      芋泥
		      <br />
		      <input name="sendtype" type="radio" value="巧克力" />
		      巧克力
		      <input name="sendtype" type="radio" value="核桃" />
		      核桃
   </label>
              <label>
              <input type="submit" name="Submit" value="送出" />
              </label>
		    </p>
		  <p>並匯款到:00000000<br />
		    <label></label>
		  </p>
        </div></td>
    
	  </tr>
    </table>
  </form>
  <a href="../index.php" target="_top">回首頁</a>



</div>
</body>
</html>
