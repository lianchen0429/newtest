<?php require_once('../Connections/easyshop.php'); ?>
<?php
// *** Validate request to login to this site.
session_start();
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($accesscheck)) {
  $GLOBALS['PrevUrl'] = $accesscheck;
  session_register('PrevUrl');
}

if (isset($_POST['account'])) {
  $loginUsername=$_POST['account'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "system.php";
  $MM_redirectLoginFailed = "sys_login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_easyshop, $easyshop);
  
  $LoginRS__query=sprintf("SELECT sys_account, sys_pass FROM system_account WHERE sys_account='%s' AND sys_pass='%s'",
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
	$_SESSION['MM_Username']="admin";
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
<title>系統管理登入</title>
<style type="text/css">
<!--
body {
	background-image: url(../image/aaaf.jpg);
}
.style1 {color: #FFFFFF}
-->
</style></head>

<body>
<div align="center"></div>
<form action="<?php echo $loginFormAction; ?>" method="POST" name="form1" target="_top">
  <div align="center">
    <p>&nbsp;</p>
    <table width="31%" border="0">
      <tr>
        <td bgcolor="#2D1D1E"><div align="center"><span class="style1">系統管理登入 </span></div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <table width="625" border="1">
      <tr>
        <td width="615" height="120" bgcolor="#FDFDFF">
        <table width="571" border="1">
          <tr>
            <td width="48" bgcolor="#291517"><span class="style1">帳號</span></td>
            <td width="175" bgcolor="#FAFAFA"><span class="style1">
              <input name="account" type="text" id="account">
            </span></td>
            <td width="50" bgcolor="#271416"><div align="left" class="style1">密碼</div></td>
            <td width="201" bgcolor="#FFFFFF"><span class="style1">
              <input name="pass" type="password" id="pass">
            </span></td>
            <td width="63" bgcolor="#FFFFFF"><div align="left" class="style1">
                <input type="submit" name="Submit" value="送出">
            </div></td>
          </tr>
        </table>
      </td>
      </tr>
    </table>
  </div>
</form>
<div align="center"><a href="../index.php" target="_top" class="style1">回首頁</a><br>
</div>
<p>&nbsp;</p>
</body>
</html>
