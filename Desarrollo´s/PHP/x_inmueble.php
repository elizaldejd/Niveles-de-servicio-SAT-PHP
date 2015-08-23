<?php

include 'funciones.php';



if (isset($_GET['valor'])){

$variable = $_GET['valor'];

echo $variable;

}else{


header("location:tabla.php");

}


?>