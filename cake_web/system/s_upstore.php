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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
//---------------------------------------

$uploaddir = '';
$uploadfile = $uploaddir.basename($_FILES['myfile']['name']);
(move_uploaded_file($_FILES['myfile']['tmp_name'], "store_photo/".$uploadfile));
//---------------------------------------

  $insertSQL = sprintf("INSERT INTO s_product (s_file,s_product, s_ps, s_money_old, s_money, s_text) VALUES (%s, %s, %s, %s, %s, %s)",
  GetSQLValueString($_FILES['myfile']['name'], "text"),
                       GetSQLValueString($_POST['s_product'], "text"),
                       GetSQLValueString($_POST['s_ps'], "text"),
                       GetSQLValueString($_POST['s_money_old'], "text"),
                       GetSQLValueString($_POST['s_money'], "text"),
                       GetSQLValueString(nl2br($_POST['s_text']), "text"));

  mysql_select_db($database_easyshop, $easyshop);
  $Result1 = mysql_query($insertSQL, $easyshop) or die(mysql_error());

  $insertGoTo = "s_upstore3.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO s_product_ps (s_product_ps) VALUES (%s)",
                       GetSQLValueString($_POST['ps'], "text"));

  mysql_select_db($database_easyshop, $easyshop);

  $Result1 = mysql_query($insertSQL, $easyshop) or die(mysql_error());

  $insertGoTo = "s_upstore.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_easyshop, $easyshop);
$query_rsps = "SELECT * FROM s_product_ps ORDER BY s_product_ps ASC";

$rsps = mysql_query($query_rsps, $easyshop) or die(mysql_error());



$row_rsps = mysql_fetch_assoc($rsps);
$totalRows_rsps = mysql_num_rows($rsps);
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>蛋糕上架</title>
<style type="text/css">
<!--
body {
	background-image: url(../image/fkjhll.jpg);
}
.style4 {color: #FFFFFF}
.style6 {font-size: small; font-family: "標楷體"; color: #000033; }
.style7 {font-size: small; font-family: "標楷體"; color: #FFFFFF; }
.style8 {color: #000000}
-->
</style></head>

<body>
<div align="center" class="style4"><span class="style8">[蛋糕上架 ]</span></div>
<?php require_once('system_top.php'); ?>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <div align="center">
    <input name="ps" type="text" id="ps">
    <input type="submit" name="Submit" value="新增蛋糕類別">
    <a href="s_upstore_ps.php">蛋糕類別管理</a></div>
  <p>
    <input type="hidden" name="MM_insert" value="form1">
</p>
  <p>&nbsp;</p>
  <p>&nbsp;  </p>
</form>
<br>
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form2" onSubmit="return aaa();">
  <table width="676" border="1" align="center">
    <tr>
      <td width="125" bgcolor="#B2A592"><span class="style7">蛋糕名稱</span></td>
      <td width="535" bgcolor="#FFFFFF"><input name="s_product" type="text" id="s_product"></td>
    </tr>
    <tr>
      <td bgcolor="#B2A592"><span class="style7">蛋糕類別</span></td>
      <td bgcolor="#FFFFFF"><span class="style6">
        <select name="s_ps" id="s_ps">
          
          <?php
do {  
?>
          <option value="<?php echo $row_rsps['s_product_ps']?>"<?php if (!(strcmp($row_rsps['s_product_ps'], $row_rsps['s_product_ps']))) {echo "SELECTED";} ?>><?php echo $row_rsps['s_product_ps']?></option>
          <?php
} while ($row_rsps = mysql_fetch_assoc($rsps));
  $rows = mysql_num_rows($rsps);
  if($rows > 0) {
      mysql_data_seek($rsps, 0);
	  $row_rsps = mysql_fetch_assoc($rsps);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#B2A592"><span class="style7">蛋糕金額原價</span></td>
      <td bgcolor="#FFFFFF"><input name="s_money_old" type="text" id="s_money_old" onKeyPress="if   (event.keyCode   <   46||event.keyCode   >   57)   event.returnValue   =   false;"></td>
    </tr>
    <tr>
      <td bgcolor="#B2A592"><span class="style7">蛋糕金額特價</span></td>
      <td bgcolor="#FFFFFF"><input name="s_money" type="text" id="s_money" onKeyPress="if   (event.keyCode   <   46||event.keyCode   >   57)   event.returnValue   =   false;"></td>
    </tr>
    <tr>
      <td bgcolor="#B2A592"><span class="style7">蛋糕解說</span></td>
      <td bgcolor="#FFFFFF"><span class="style6">
        <textarea name="s_text" cols="60" rows="5" wrap="VIRTUAL" id="s_text"></textarea>
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#B2A592"><span class="style7">插入蛋糕圖檔</span></td>
      <td bgcolor="#FFFFFF"><input name="myfile" type="file" id="myfile"></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#CDD4C2"><div align="center" class="style6">
        <input type="submit" name="Submit" value="送出">
      </div></td>
    </tr>
  </table>
  <div align="center"></div>
  <input type="hidden" name="MM_insert" value="form2">
</form>
</body>
</html>
<?php
mysql_free_result($rsps);
?>

<script language="javascript">
function aaa(){
if(document.form2.s_product.value==""){
alert ("商品名稱要填唷!")
return false
}else if (document.form2.s_money.value==""){
alert ("商品特價要填唷!")
return false
}else if (document.form2.s_text.value==""){
alert ("內容要填唷!")
return false
}
}
</script>