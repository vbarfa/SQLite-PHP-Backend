<?php 

define('BASE_PATH', dirname(dirname(__FILE__)));
define('APP_FOLDER','simpleadmin');

$db = new SQLite3('./db/my_database') or die('Unable to open database'); 