<?php require_once('Connections/easyshop.php'); ?>
<?php
//initialize the session
session_start();
// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  session_unregister('MM_Username');
  session_unregister('MM_UserGroup');
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
$maxRows_rs1 = 60;
$pageNum_rs1 = 0;
if (isset($_GET['pageNum_rs1'])) {
  $pageNum_rs1 = $_GET['pageNum_rs1'];
}
$startRow_rs1 = $pageNum_rs1 * $maxRows_rs1;

mysql_select_db($database_easyshop, $easyshop);

if ($_GET[so]<>""){
$query_rs1 = "SELECT * FROM s_product where s_product like '%". $_GET[so] ."%' or s_text like '%". $_GET[so] ."%'";  
}else{

if ($_GET[i_sort]==""){
$query_rs1 = "SELECT * FROM s_product ORDER BY RAND()";  //原首頁版
} else{
$query_rs1 = "SELECT * FROM s_product where s_ps='". $_GET[i_sort] ."'";  
};

};
 


$query_limit_rs1 = sprintf("%s LIMIT %d, %d", $query_rs1, $startRow_rs1, $maxRows_rs1);
$rs1 = mysql_query($query_limit_rs1, $easyshop) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);

if (isset($_GET['totalRows_rs1'])) {
  $totalRows_rs1 = $_GET['totalRows_rs1'];
} else {
  $all_rs1 = mysql_query($query_rs1);
  $totalRows_rs1 = mysql_num_rows($all_rs1);
}
$totalPages_rs1 = ceil($totalRows_rs1/$maxRows_rs1)-1;

mysql_select_db($database_easyshop, $easyshop);
$query_rsps = "SELECT * FROM s_product_ps ORDER BY RAND()";
$rsps = mysql_query($query_rsps, $easyshop) or die(mysql_error());
$row_rsps = mysql_fetch_assoc($rsps);
$totalRows_rsps = mysql_num_rows($rsps);

$queryString_rs1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs1") == false && 
        stristr($param, "totalRows_rs1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs1 = sprintf("&totalRows_rs1=%d%s", $totalRows_rs1, $queryString_rs1);

$currentPage = $_SERVER["PHP_SELF"];

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
<?php
// *** Validate request to login to this site.
session_start();

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($accesscheck)) {
  $GLOBALS['PrevUrl'] = $accesscheck;
  session_register('PrevUrl');
}

if (isset($_POST['a'])) {
  $loginUsername=$_POST['a'];
  $password=$_POST['b'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "user/add_user2.php?id=3";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_easyshop, $easyshop);
  
  $LoginRS__query=sprintf("SELECT a_account, a_pass FROM a_account WHERE a_account='%s' AND a_pass='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $easyshop) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $GLOBALS['MM_Username'] = $loginUsername;
    $GLOBALS['MM_UserGroup'] = $loginStrGroup;	      

    //register the session variables
    session_register("MM_Username");
    session_register("MM_UserGroup");

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>購物首頁</title>
<style type="text/css">
<!--
body {
	background-color: #000000;
	background-image: url(image/55.gif);
}
.style4 {color: #FFFFFF}
.style5 {font-size: small}
.style30 {font-size: small; color: #FFFFFF; }
.style32 {font-size: small; color: #759D20; }
.style35 {
	color: #E6756F;
	font-weight: bold;
	font-family: "標楷體";
}
.style39 {
	color: #666666;
	font-size: 12px;
}
.style40 {color: #759D20}
-->
</style>
</head>

<body>
 <center>
<div align="center">
  <div align="left"></div>
  <table width="816" height="216" border="0" align="left">
        <tr>
          <td height="85" colspan="3" bgcolor="#FFFFFF"> <img src="image/logo3.jpg" width="800" height="185"></td>
        </tr>
    <tr>
      <td width="372" height="85" background="image/1.jpg" bgcolor="#FFFFFF"><form action="<?php echo $loginFormAction; ?>" method="POST" name="form3" target="_top" class="style4">
        <div align="left"><span class="style32">
          <? if ($_SESSION['MM_Username'] ==""){  ?>
          會員登入 <br>
          帳號</span>
          <span class="style40">
            <input name="a" type="text" id="a" size="10">
            <br>
            <span class="style5">密碼</span></span>
          <span class="style40">
            <input name="b" type="password" id="b" size="10">
            <input type="submit" name="Submit2" value="登入">
            <span class="style5"> <a href="user/add_user.php"><br>
            加入會員 </a></span></span>
          
          <span class="style40">
            <? }else{
echo $_SESSION['MM_Username'] . "歡迎登入!";  }; 
//$nowtime=date(U);      //date(U)為取得秒數 
//setcookie("cook",$_SESSION['MM_Username'],$nowtime+1200); //COOKIE存活 時間為2分鐘$username為上頁表單文字

//setcookie("success_num",session_id(),$nowtime+1200);
//  $token = md5(uniqid(rand()));
//echo $token;
if ($_SESSION['MM_Username']=="" ){ 
$_SESSION[$sale_id]=md5(uniqid(rand()));
};

?>
            </span>
          <span class="style32">(登入會員才能購物)        </span> </div>
      </form></td>
      <td width="307" background="image/1.jpg" bgcolor="#FFFFFF"><form action="right.php" enctype="application/x-www-form-urlencoded" name="form1" class="style5">
          <div align="center"><span class="style35">蛋糕檢索</span>
            <input name="so" type="text" id="so">
            <input type="submit" name="Submit" value="送出">
          </div>
      </form></td>
      <td width="115"><span class="style30"><a href="shop/sale_log.php">
        <?php if($_SESSION['MM_Username']<>""){?>
        會員管理
<?php }?>
      </a><br>
      <a href="<?php echo $logoutAction ?>" target="_top">登出</a></span></td>
    </tr>
   
    <tr bgcolor="#FFFFFF">
      <td height="17" colspan="3" background="user/image/54_jpg.gif">
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  <table width=95% border=1 align="center" bordercolor="#BBD858">
                
                  <?php
				$x=1;
				 do { 

		if ($x==1 or (($x-1)%3==0)){
		 echo "<tr align=center>";
         };?>
				 
                      <td align="center" background="image/trhyfgj.jpg">
					  
					 
					 
					 
					 
					 <div align="center"><img src="system/store_photo/<?php echo $row_rs1['s_file']; ?>" width="157" height="134"><span class="style39"><br>
            分類:<strong><?php echo $row_rs1['s_ps']; ?></strong><br>
            名稱:<?php echo $row_rs1['s_product']; ?><br>
            特價:<strong><?php echo $row_rs1['s_money']; ?></strong><br>
  <a href="shop/buy_shop.php?id=<?php echo $row_rs1['pro_id']; ?>" class="style5">
  <?php if($_SESSION['MM_Username']<>""){?>
    我要購買
  <?php }?>
  </a></span><br>
          </div>					   </td>
                      <?php 
			
				   if($x<>1 and $x %3==0) echo "</tr>";
				
				  $x=$x+1;
				
				  } while ($row_rs1 = mysql_fetch_assoc($rs1)); ?>
	    </table>	  </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="17" colspan="3" background="user/image/54_jpg.gif"><span class="style4"></span><span class="style4"></span>        <div align="center"><span class="style4">記錄<?php echo ($startRow_rs1 + 1) ?> 到 <?php echo min($startRow_rs1 + $maxRows_rs1, $totalRows_rs1) ?> 共 <?php echo $totalRows_rs1 ?> 筆<br>
            </span>
          <table border="0" width="50%" align="center">
            <tr>
              <td width="23%" align="center">
                <span class="style4">
                <?php if ($pageNum_rs1 > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, 0, $queryString_rs1); ?>">第一頁</a>
                  <?php } // Show if not first page ?>                
                </span></td>
              <td width="31%" align="center">
                <span class="style4">
                <?php if ($pageNum_rs1 > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, max(0, $pageNum_rs1 - 1), $queryString_rs1); ?>">上一頁</a>
                  <?php } // Show if not first page ?>                
                </span></td>
              <td width="23%" align="center">
                <span class="style4">
                <?php if ($pageNum_rs1 < $totalPages_rs1) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, min($totalPages_rs1, $pageNum_rs1 + 1), $queryString_rs1); ?>">下一頁</a>
                  <?php } // Show if not last page ?>                
                </span></td>
              <td width="23%" align="center">
                <span class="style4">
                <?php if ($pageNum_rs1 < $totalPages_rs1) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, $totalPages_rs1, $queryString_rs1); ?>">最後一頁</a>
                  <?php } // Show if not last page ?>                
                </span></td>
            </tr>
          </table>
          <span class="style4"><br>
          </span></div>
        <div align="center">        </div></td>
    </tr>
  </table>
</div>
<div align="center">
  
  <br>
<a href="system/sys_login.php" target="_blank"></a></div>
<p align="center"><span class="style4"></span></p>
</center>
</body>
</html>
<?php
mysql_free_result($rs1);

mysql_free_result($rsps);


?>
