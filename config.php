<?php

define('DB_SERVER', 'server');  // Mysql hostname, usually localhost
define('DB_USERNAME','username');  // Mysql username
define('DB_PASSWORD', 'password');  // Mysql password
define('DB_DATABASE', 'database');// Mysql database name


$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>