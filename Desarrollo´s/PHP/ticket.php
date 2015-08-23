<html>

<title>
<?php 
if(isset($_GET['ticket'])){
$titulo = $_GET['ticket'];
}else{
$titulo = "Redireccion";
}
echo "Resumen del ticket ".$titulo;
?>
</title>
<link href="CSS/ticket.css" rel="stylesheet" type="text/css"/>
<body>
</body>
</html>


<?php



include 'funciones.php';


if(isset($_GET['ticket'])){


$ticket = $_GET['ticket'];
echo utf8_decode("
<div class = \"contenedor\">
<div class = \"logos\"> 
<table>
<IMG class= \"logo_sat\"SRC=\"CSS/imagenes/sat.png\">
<td>Servicio de administracion tributaria".$ticket."</td>
<IMG class= \"logo_mainbit\"SRC=\"CSS/imagenes/main.png\">
</table>
</div>

<div class = \"datos\">

<table>
<tr><td>Datos del usuario</td></tr>
<tr><td>Usuario final Afectado:</td><td>Nombre</td>
<td>Usuario que reporta:</td><td>Nombre</td></tr>
<tr>
<td>Telefono:</td><td>Telefono</td>
<td>Extension:</td><td>extensións</td>
<td>Correo:</td><td>correo</td>
</tr>
<tr>
<td>Id concatenado:</td>
<td colspan = 3>Id concatenado</td>
<td>Horario del inmueble:</td>
<td>Horario</td>
</tr>
<tr>
<td>Tipo de inmueble:</td>
<td>Tipo de inmueble:</td>

</tr>
<tr>
<td>Dirección:</td>
<td colspan = 5>Direccion</td>
</tr>
<tr>
<td>Categoria:</td>
<td colspan = 5>categoria:</td>
</tr>
<tr>
<td>Descripcion:</td>
<td colspan = 5>Descripcion:</td>
</tr>
</table>

</div>


</div>


");



}else{
header('location:menu.php');
}

?>
