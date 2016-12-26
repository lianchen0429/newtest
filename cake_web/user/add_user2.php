<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>加入會員</title>
<style type="text/css">
<!--
body {
	background-image: url(../image/back060080.jpg);
}
-->
</style></head>

<body>

<p>&nbsp;</p>
<p align="center"><img src="../image/jhgjhgkm.jpg" width="416" height="219"></p>
<p align="center"><?
//switch ($_GET['id']) {}
switch ($_GET['id']){
case "1":
 	echo "加入會員完畢" ;
	break;
	case "2":
 	echo "帳號重複哦請回上頁重選" ;
	break;
	case "3":
 	echo "登入失敗請重新回上頁登入" ;
	break;
	case "4":
 	echo "若要購物需先加入會員(或查看商品需先登入會員),請到首頁加入會員" ;
	break;
	case "5":
 	echo "查看我的商品需先回首頁登入會員" ;
	break;
}
 ?></p>
<p align="center">
<a href="../index.php" target="_top">回首頁</a><a href="Javascript:OnClick=history.back()">回上頁</a></p>

<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
