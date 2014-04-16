<?php

define('DB_SERVER', 'db475637345.db.1and1.com'); // Mysql hostname, usually localhost
define('DB_USERNAME','dbo475637345'); // Mysql username
define('DB_PASSWORD', 'KalNik@28'); // Mysql password
define('DB_DATABASE', 'db475637345'); // Mysql database name


$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>