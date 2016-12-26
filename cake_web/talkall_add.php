<?php require_once('Connections/cka_table_db.php'); ?>
<?php
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
  $insertSQL = sprintf("INSERT INTO talkall (t_sort,t_acc, t_title, t_text, t_date) VALUES (%s,%s, %s, %s, %s)",
    GetSQLValueString($_POST['t_sort'], "int"),
                       GetSQLValueString($_POST['acc'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString(nl2br($_POST['text']), "text"),
                       GetSQLValueString($_POST['dd'], "text"));

  mysql_select_db($database_cka_table_db, $cka_table_db);
  $Result1 = mysql_query($insertSQL, $cka_table_db) or die(mysql_error());

  $insertGoTo = "talkall.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_cka_table_db, $cka_table_db);
$query_r1 = "SELECT * FROM talkall ORDER BY t_sort DESC";
$r1 = mysql_query($query_r1, $cka_table_db) or die(mysql_error());
$row_r1 = mysql_fetch_assoc($r1);
$totalRows_r1 = mysql_num_rows($r1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">
<!--
body {
	background-image: url(image/drnhfgj.jpg);
}
.style2 {
	color: #6DA6EB;
	font-size: 12px;
	font-weight: bold;
}
.style5 {
	color: #807063;
	font-size: 18px;
}
.style6 {font-size: 12px; color: #988C7E; }
.style7 {font-size: small; color: #988C7E; }
-->
</style>
</head>

<body>
<div align="center">
  <p class="style2">&nbsp;</p>
  <table width="200" border="1" bordercolor="#8E8073">
    <tr>
      <td bgcolor="#FFFFFF"><div align="center"><span class="style2"><span class="style5">發表新主題</span></span></div></td>
    </tr>
  </table>
  <p class="style2">&nbsp;</p>
  <hr />
  <div align="left">
    <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>" onsubmit="return accessSina()">
      <table width="62%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
        <tr>
          <td width="16%" bgcolor="#FFFFFF"><div align="left" class="style6">發言人</div></td>
          <td width="84%" bgcolor="#FFFFFF"><div align="left" class="style7">
            <input name="acc" type="text" id="acc" />
            <input name="dd" type="hidden" id="dd" value="<?php echo date("Y-m-d H:i:s",strtotime("+8 hour")) ?>" />
          </div></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF"><div align="left" class="style6">主題名稱</div></td>
          <td bgcolor="#FFFFFF"><div align="left" class="style7">
            <input name="title" type="text" id="title" size="46" />
          </div></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF"><div align="left" class="style6">內容</div></td>
          <td bgcolor="#FFFFFF"><div align="left" class="style7">
            <textarea name="text" cols="50" rows="4" id="text"></textarea>
          </div></td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF"><div align="center">
            <input type="submit" name="Submit" value="送出" />
          </div></td>
        </tr>
      </table>
      <div align="center"><br />
        <a href="Javascript:OnClick=history.back()">回上頁</a>
        <input name="t_sort" type="hidden" id="t_sort" value="<?php echo $row_r1['t_sort']+1; ?>" />
      </div>
        <input type="hidden" name="MM_insert" value="form1">
    </form>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($r1);
?>
<script language="javascript">
function accessSina()
{
if(document.form1.acc.value==""){
alert ("發表人要填唷!")
return false;
}else if (document.form1.title.value==""){
alert ("主題名稱要填唷!");
return false;
}

alert ("新增完畢");
}
</script>