<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_easyshop = "localhost";
$database_easyshop = "cake_web_db";
$username_easyshop = "root";
$password_easyshop = "321";
$easyshop = mysql_pconnect($hostname_easyshop, $username_easyshop, $password_easyshop) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET UTF8");


?>