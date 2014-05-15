<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_db_link = "localhost";
$database_db_link = "booking_db";
$username_db_link = "root";
$password_db_link = "";
$db_link = mysql_pconnect($hostname_db_link, $username_db_link, $password_db_link) or trigger_error(mysql_error(),E_USER_ERROR); 
?>