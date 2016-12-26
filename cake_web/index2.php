<?php require_once('Connections/easyshop.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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
$maxRows_rs1 = 15;
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
$query_rs1 = "SELECT * FROM s_product ";  //原首頁版
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
$query_rsps = "SELECT * FROM s_product_ps ";
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
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['a'])) {
  $loginUsername=$_POST['a'];
  $password=$_POST['b'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "right.php";
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
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

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
.style4 {color: #FFFFFF}
.style5 {font-size: small}
.style25 {color: #FFFFFF; font-weight: bold; font-size: large; }
.style27 {color: #000000}
body {
	background-image: url(image/dghkdk.jpg);
}
.style28 {
	color: #FFFFFF;
	font-size: x-large;
}
-->
</style>
</head>

<body>
<div align="center">
  <table width="24%" border="0">
    <tr>
      <td bgcolor="#E3C9AE"><div align="center" class="style28">登入會員</div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="493" height="91" border="1">
    <tr>
      <td width="691" height="85" bgcolor="#F2DDC8">
	    <span class="style27">
	    <? if ($_SESSION['MM_Username'] ==""){  ?>	  
	    </span>
	    <form action="<?php echo $loginFormAction; ?>" method="POST" name="form3" class="style27">
	      <span class="style5">會員登入 帳號</span>
	      <input name="a" type="text" id="a" size="10">
	      <span class="style5">密碼</span>
	      <input name="b" type="password" id="b" size="10">
	      <input type="submit" name="Submit2" value="登入">
	    </form>	    
	    <span class="style27">
        <? }else{
echo $_SESSION['MM_Username'] . "歡迎登入!";  }; 
?>
        <a href="user/add_user.php" class="style25">加入會員 </a>
          <span class="style5"><a href="shop/sale_log.php" class="style25">
		  
		  <?php
	  if ($_SESSION['MM_Username']<>""){
	  echo "我的個人資料";
	  }
	  ?>
		  
		  
		  
		  </a></span> <a href="<?php echo $logoutAction ?>"> </a></span>	    
      <div align="center" class="style5"></div></td>
    </tr>
    <?php do { ?>
    <?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); ?>
  </table>
</div>
<p align="center"><span class="style4"></span></p>
<div align="center"><br>
</div>
</body>
</html>
<?php

mysql_free_result($rsps);


?>
