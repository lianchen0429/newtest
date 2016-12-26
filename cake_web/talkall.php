<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageNum_Recordset1,$totalPages_Recordset1,$prev_Recordset1,$next_Recordset1,$separator=" | ",$max_links=10, $show_page=true)
{
                GLOBAL $maxRows_rs,$totalRows_rs;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageNum_Recordset1<=$totalPages_Recordset1 && $pageNum_Recordset1>=0)
	{
		if ($pageNum_Recordset1 > ceil($max_links/2))
		{
			$fgp = $pageNum_Recordset1 - ceil($max_links/2) > 0 ? $pageNum_Recordset1 - ceil($max_links/2) : 1;
			$egp = $pageNum_Recordset1 + ceil($max_links/2);
			if ($egp >= $totalPages_Recordset1)
			{
				$egp = $totalPages_Recordset1+1;
				$fgp = $totalPages_Recordset1 - ($max_links-1) > 0 ? $totalPages_Recordset1  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_Recordset1 >= $max_links ? $max_links : $totalPages_Recordset1+1;
		}
		if($totalPages_Recordset1 >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "pageNum_rs") {
						$_get_vars .= "&$_get_name=$_get_value";
					}
				}
			}
			$successivo = $pageNum_Recordset1+1;
			$precedente = $pageNum_Recordset1-1;
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs=$precedente$_get_vars\">$prev_Recordset1</a>" :  "$prev_Recordset1";
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_rs) + 1;
					$max_l = ($a*$maxRows_rs >= $totalRows_rs) ? $totalRows_rs : ($a*$maxRows_rs);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "$textLink"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs=$successivo$_get_vars\">$next_Recordset1</a>" : "$next_Recordset1";
		}
	}
	return array($firstArray,$pagesArray,$lastArray);
}
?><?php require_once('Connections/cka_table_db.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs = 10;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
  $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

mysql_select_db($database_cka_table_db, $cka_table_db);
$query_rs = "SELECT * FROM talkall ORDER BY t_sort  DESC";
$query_limit_rs = sprintf("%s LIMIT %d, %d", $query_rs, $startRow_rs, $maxRows_rs);
$rs = mysql_query($query_limit_rs, $cka_table_db) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);

if (isset($_GET['totalRows_rs'])) {
  $totalRows_rs = $_GET['totalRows_rs'];
} else {
  $all_rs = mysql_query($query_rs);
  $totalRows_rs = mysql_num_rows($all_rs);
}
$totalPages_rs = ceil($totalRows_rs/$maxRows_rs)-1;



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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">
<!--
.style1 {font-size: 14px}
.style2 {font-size: 12px}
body {
	background-image: url(image/ytk.jpg);
}
.style6 {color: #245619}
.style13 {color: #FFFFFF; font-size: 16px; font-weight: bold; }
.style14 {font-size: 12px; color: #245619; }
.style15 {font-size: 14px; color: #FFFFFF; }
.style16 {color: #FFFFFF}
-->
</style>
</head>

<body>
<div align="center">
 
  <div align="left">
    <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="5" background="image/13.jpg" bgcolor="#B5B5B5"><div align="center"><span class="style13"> <br />
          [購物討論區
          
        ] </span><br />
        <br />
        <br />
        </div></td>
      </tr>
      <tr>
        <td width="9%" bgcolor="#7F8C22"><div align="center"><a href="talkall_add.php" class="style1 style16"> </a></div></td>
        <td width="36%" bgcolor="#7F8C22"><span class="style15">標題</span></td>
        <td bgcolor="#7F8C22"><div align="center" class="style15">發表人</div></td>
        <td bgcolor="#7F8C22"><div align="center" class="style15">回覆</div></td>
        <td bgcolor="#7F8C22"><div align="center" class="style15">人氣</div></td>
      </tr>
         <?php
		 $nn=1;
		  do { ?><tr>
     
          <td bgcolor="#FFFFFF"><div align="center" class="style6"><?php echo $nn;
		  $nn+=1;
		  ?></div></td>
          <td bgcolor="#FFFFFF"><div align="left" class="style14"><a href="re_talkall.php?cl=<?php echo $row_rs['click_num']; ?>&amp;id=<?php echo $row_rs['t_id']; ?>"><?php echo $row_rs['t_title']; ?></a> <a href="talk_del.php?t_id=<?php echo $row_rs['t_id']; ?>" onClick="return accessSina()">
		  <?php if($_SESSION['MM_Username']=="admin")echo "[刪除]";?>
		   </a><span class="style2"><a href="re_talkall.php?cl=<?php echo $row_rs['click_num']; ?>&amp;id=<?php echo $row_rs['t_id']; ?>">我要回應</a></span></div></td>
          <td width="9%" bgcolor="#FFFFFF"><div align="center" class="style14"><?php echo $row_rs['t_acc']; ?></div></td>
          <td width="8%" bgcolor="#FFFFFF"><div align="center" class="style14"><?php 
		  
		  $colname_rs_sum = "-1";
if (isset($row_rs['t_id'])) {
  $colname_rs_sum = (get_magic_quotes_gpc()) ? $row_rs['t_id'] : addslashes($row_rs['t_id']);
}
mysql_select_db($database_cka_table_db, $cka_table_db);
$query_rs_sum = sprintf("SELECT count(*)as re FROM retalkall WHERE talk_id = %s", $colname_rs_sum);
$rs_sum = mysql_query($query_rs_sum, $cka_table_db) or die(mysql_error());
$row_rs_sum = mysql_fetch_assoc($rs_sum);
$totalRows_rs_sum = mysql_num_rows($rs_sum);
		  echo $row_rs_sum['re'];
		  
//-------------------------
		  
		  
		   ?></div></td>
          <td width="10%" bgcolor="#FFFFFF"><div align="center" class="style14"><?php echo $row_rs['click_num']; ?></div></td>
          </tr> <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
    </table>
  
    <div align="center">
      <?php 
# variable declaration
$prev_rs = "« previous";
$next_rs = "next »";
$separator = " | ";
$max_links = 10;
$pages_navigation_rs = buildNavigation($pageNum_rs,$totalPages_rs,$prev_rs,$next_rs,$separator,$max_links,true); 

print $pages_navigation_rs[0]; 
?>
      <?php print $pages_navigation_rs[1]; ?> <?php print $pages_navigation_rs[2]; ?><br />
      <br />
    </div>
  </div>
</div>
<div align="center"><a href="sys/sys_login.php"><br />
</a></div>
</body>
</html>
<?php
mysql_free_result($rs);

mysql_free_result($rs_sum);
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