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
//----------------------------------------------------------
mysql_select_db($database_cka_table_db, $cka_table_db);
$tm=$_POST['dd'] ." by " . $_POST['racc'];
$query_up_rs = "update  talkall set ed_time='". $tm ."' , t_sort='".$_POST['t_sort']."' where t_id=".$_POST['talkid'];
$up_rs = mysql_query($query_up_rs, $cka_table_db) or die(mysql_error());
$row_up_rs = mysql_fetch_assoc($up_rs);
$totalRows_up_rs = mysql_num_rows($up_rs);
//-----------------------------------------------------------
  $insertSQL = sprintf("INSERT INTO retalkall (talk_id, re_acc, re_text, re_dd) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['talkid'], "int"),
                       GetSQLValueString($_POST['racc'], "text"),
                       GetSQLValueString(nl2br($_POST['rtext']), "text"),
                       GetSQLValueString($_POST['dd'], "text"));

  mysql_select_db($database_cka_table_db, $cka_table_db);
  $Result1 = mysql_query($insertSQL, $cka_table_db) or die(mysql_error());

  $insertGoTo = "re_talkall.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_rs = "-1";
if (isset($_GET['id'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_cka_table_db, $cka_table_db);
$query_rs = sprintf("SELECT * FROM talkall WHERE t_id = %s", $colname_rs);
$rs = mysql_query($query_rs, $cka_table_db) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);

$maxRows_rers = 200;
$pageNum_rers = 0;
if (isset($_GET['pageNum_rers'])) {
  $pageNum_rers = $_GET['pageNum_rers'];
}
$startRow_rers = $pageNum_rers * $maxRows_rers;

$colname_rers = "-1";
if (isset($_GET['id'])) {
  $colname_rers = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_cka_table_db, $cka_table_db);
$query_rers = sprintf("SELECT * FROM retalkall WHERE talk_id = %s ORDER BY reta_id DESC", $colname_rers);
$query_limit_rers = sprintf("%s LIMIT %d, %d", $query_rers, $startRow_rers, $maxRows_rers);
$rers = mysql_query($query_limit_rers, $cka_table_db) or die(mysql_error());
$row_rers = mysql_fetch_assoc($rers);

if (isset($_GET['totalRows_rers'])) {
  $totalRows_rers = $_GET['totalRows_rers'];
} else {
  $all_rers = mysql_query($query_rers);
  $totalRows_rers = mysql_num_rows($all_rers);
}
$totalPages_rers = ceil($totalRows_rers/$maxRows_rers)-1;

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
.style1 {font-size: small}
body {
	background-image: url();
	background-color: #F8F8F8;
}
.style2 {
	font-size: 12px;
	color: #5B687B;
}
.style5 {
	font-size: 12px;
	color: #330000;
}
.style7 {font-size: 12px; color: #000000; font-weight: bold; }
.style8 {color: #CC0000}
.style10 {font-size: small; color: #330000; }
.style11 {color: #666666; }
.style13 {color: #FFFFFF}
.style14 {font-size: small; color: #FFFFFF; }
.style15 {font-size: 14px}
.style16 {font-size: 14px; color: #666666; }
.style18 {color: #F8F8F8}
.style19 {font-size: 13px}
.style20 {font-size: 13px; color: #666666; }
.style21 {font-size: 13px; color: #FFFFFF; }
-->
</style>
</head>

<body>
<?php
$aa=$_GET['cl']+1;
mysql_select_db($database_cka_table_db, $cka_table_db);
$query_up_rs = "update  talkall set click_num='".$aa."' where t_id=".$_GET['id'];
$up_rs = mysql_query($query_up_rs, $cka_table_db) or die(mysql_error());
//$row_up_rs = mysql_fetch_assoc($up_rs);
//$totalRows_up_rs = mysql_num_rows($up_rs);
?>
<div align="center"><img src="image/lkjgf;.jpg" width="660" height="142" /><br />
  <span class="style2">[討論區 -回應]  </span>
  <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
    <table width="68%" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td width="14%" bgcolor="#68655E"><div align="left" class="style16 style13 style19">
          <div align="left" class="style18">發表人</div>
        </div></td>
        <td width="36%"><div align="left" class="style20">
          <div align="left"><?php echo $row_rs['t_acc']; ?></div>
        </div></td>
        <td width="13%" bgcolor="#68655E"><div align="left" class="style20">
          <div align="left" class="style13">日期</div>
        </div></td>
        <td width="37%"><div align="left" class="style20">
          <div align="left"><?php echo $row_rs['t_date']; ?></div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#68655E"><div align="left" class="style21">
          <div align="left">主題</div>
        </div></td>
        <td colspan="3"><div align="left" class="style20">
          <div align="left"><?php echo $row_rs['t_title']; ?></div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#68655E"><div align="left" class="style21">內容</div></td>
        <td colspan="3"><div align="left" class="style20"><?php echo $row_rs['t_text']; ?></div></td>
      </tr>
      <tr>
        <td colspan="4"><div align="left"><span class="style8"><span class="style11"><span class="style15"><span class="style15"><span class="style19"></span></span></span></span></span></div></td>
      </tr>
      <tr>
        <td bgcolor="#68655E"><div align="left" class="style21">回應者</div></td>
        <td colspan="3"><div align="left" class="style20">
          <input name="racc" type="text" id="racc" />
          <input name="talkid" type="hidden" id="talkid" value="<?php echo $row_rs['t_id']; ?>" />
          <input name="dd" type="hidden" id="dd" value="<?php echo date("Y-m-d H:i:s",strtotime("+8 hour")) ?>" />
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#68655E"><div align="left" class="style21">內容</div></td>
        <td colspan="3"><div align="left" class="style20">
          <textarea name="rtext" cols="60" rows="3" wrap="virtual" id="rtext"></textarea>
        </div></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#F8F8F8">
          <div align="center" class="style16">
            
            <div align="center">
              <input type="submit" name="Submit" value="我要回應" />
            </div>
          </div>
        <div align="left" class="style16"></div></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1">
    <a href="talkall.php" class="style1">[回上頁]    </a>
    <input name="t_sort" type="hidden" id="t_sort" value="<?php echo $row_r1['t_sort']+1; ?>" />
    <input name="click_num" type="hidden" id="click_num" value="<?php echo $row_rs['click_num']+1; ?>" />
  </form>
  <hr />
  <span class="style7">[回應內容]</span>
  <table width="73%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
    <?php do { 
	if($row_rers['re_acc']=="")exit;
	?> 
      <tr>
        <td colspan="4" bgcolor="#F8F8F8"><div align="center" class="style5">--</div></td>
      </tr>
      <tr>
      <td width="16%" bgcolor="#68655E"><div align="left" class="style14">[回應者]</div></td>
      <td width="35%" bgcolor="#F8F8F8"><div align="left" class="style10"><?php echo $row_rers['re_acc']; ?></div></td>
      <td width="17%" bgcolor="#68655E"><div align="left" class="style14">回應時間</div></td>
      <td width="32%" bgcolor="#F8F8F8"><div align="left" class="style10"><?php echo $row_rers['re_dd']; ?></div></td>
    </tr>
    <tr>
     
        <td bgcolor="#68655E"><div align="left" class="style14">**回應內容</div></td>
        <td colspan="3" bgcolor="#F8F8F8"><div align="left" class="style10"><?php echo $row_rers['re_text']; ?> 
		
		 <a href="retalk_del.php?re_id=<?php echo $row_rers['reta_id']; ?>" onClick="return accessSina()">
		  <?php if($_SESSION['MM_Username']=="admin")echo "[刪除]";?>
		   </a>
		
	    </div></td>
      </tr> <?php } while ($row_rers = mysql_fetch_assoc($rers)); ?>
  </table>
</div>
</body>
</html>
<?php
mysql_free_result($rs);

mysql_free_result($rers);



?>
