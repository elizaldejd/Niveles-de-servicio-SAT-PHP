<?php

define('DB_SERVER','localhost');
define('DB_NAME','proyecto_x');
define('DB_USER','root');
define('DB_PASS','elizalde#110290');

$con = @mysql_connect(DB_SERVER,DB_USER,DB_PASS);
$selectdb = @mysql_select_db(DB_NAME,$con); 

if(!$con) {

echo "No se pudo conectar a la base error: ".mysql_errno();

}elseif(!$selectdb){

echo "No se pudo seleccionar la base error: ".mysql_errno();

}
?>