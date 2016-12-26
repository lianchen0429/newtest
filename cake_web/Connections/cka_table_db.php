<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cka_table_db = "127.0.0.1";
$database_cka_table_db = "cake_web_db";
$username_cka_table_db = "root";
$password_cka_table_db = "";
$cka_table_db = mysql_pconnect($hostname_cka_table_db, $username_cka_table_db, $password_cka_table_db) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET UTF8");
?>