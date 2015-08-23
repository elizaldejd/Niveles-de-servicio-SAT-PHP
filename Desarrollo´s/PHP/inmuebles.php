
<div class = "cabezera">

<?php

//echo $head;

?>
</div>


<html>
<title>Volumetrias proyecto X</title>
<link href="estilos_consultas.css" rel="stylesheet" type="text/css"/>
</html>

<div id = "resultados">
<?php

if (isset($_POST['id_inmueble'])){
include 'conexion.php';
$id = $_POST['id_inmueble'];

$query = "SELECT * FROM bd_volumetria WHERE id_loc = '$id'";

$datos = mysql_query($query);

$rec = mysql_fetch_array($datos);

if ((mysql_num_rows ($datos))<1){

echo "El id ". $id ." no tiene resultados, Favor de validar.";

}

echo "

	<div id = \"consulta\">

		<form action =\"\" method = \"POST\" >

			<div id =\"caja\">
				<div>
					<label>Ingresa el id del inmueble</label>
				</div>
				<div>
					<input type = \"text\" name = \"id_inmueble\">
				</div>
				<div>
					<input type =\"submit\" value = \"Consultar\" id = \"boton\">	
				</div>
			</div>
		</form>

	</div>
	
<div id =\"\">

	<table id= \"titulo\">
			<tr>
			<td id = \"titulos\">Datos del inmueble ". $id ."</td>
			</tr>
	</table>
	<table id = \"datos_inmueble\">
		<tr>
			<td>Zona</td> <td id = \"domicilio\">".$rec['zona']."</td>
		</tr>
		<tr>
			<td>Estado</td> <td id = \"domicilio\">".$rec['estado']."</td>
		</tr>
		<tr>
			<td>Domicilio</td> <td id = \"domicilio\">".$rec['domicilio']."</td>
		</tr>

	</table>

</div>";

echo "<div = \"resultado\"><table border = 1 > <tr>
						  <td id = \"headtablecero\"></td>
						  <td id = \"headtable\">Eficiencia Energetica</td>
						  <td id = \"headtable\">Escritorio Base</td>
						  <td id = \"headtable\">Escritorio Especial</td>
						  <td id = \"headtable\">Movil Base Con Back Pack</td>
						  <td id = \"headtable\">Movil Base Con Maletin</td>
						  <td id = \"headtable\">Movil Especial Con Back Pack</td>
						  <td id = \"headtable\">Movil Especial Con Maletin</td>
						  <td id = \"headtable\">Volumetria</td>
						  </tr>
						  <tr>
						  <td id = \"headtable\">Volumetria por Perfil</td>
						  <td>".$rec['ps1'] . "</td>
						  <td>".$rec['ps2'] . "</td>
						  <td>".$rec['ps3'] . "</td>
						  <td>".$rec['ps4'] . "</td>
						  <td>".$rec['ps5'] . "</td>
						  <td>".$rec['ps6'] . "</td>
						  <td>".$rec['ps7'] . "</td>
						  <td>".($rec['ps1'] + $rec['ps2'] +$rec['ps3'] +$rec['ps4']+
						  $rec['ps5']+$rec['ps6']+$rec['ps7'])."</td>
						  </tr>
						  <tr>
						  <td id = \"headtable\">Costo Por Perfil</td>
						  <td>".(($rec['ps1']) * (467.63) ). "</td>
						  <td>".(($rec['ps2']) * (467.63) ). "</td>
						  <td>".(($rec['ps3']) * (574) ). "</td>
						  <td>".(($rec['ps4']) * (1) ). "</td>
						  <td>".(($rec['ps5']) * (1) ). "</td>
						  <td>".(($rec['ps6']) * (1) ). "</td>
						  <td>".(($rec['ps7']) * (1) ). "</td>
						  
						  </tr>
						  
						  
						  
						  
						  
						  

						  </table></div>";
}else{

echo "	<div id = \"consulta_falsa\">

		<form action =\"\" method = \"POST\" >

				<div id =\"\">
					<label>Ingresa el id del inmueble</label>
				</div>
				<div id =\"\">
					<input type = \"text\" name = \"id_inmueble\">
				</div>
				<div id =\"\">
					<input type =\"submit\" value = \"Consultar\" id = \"boton\">	
				</div>
		</form>

	</div>";

}
?>

</div>

<div class = "foot">
<?php


//echo $foot;

?>
</div>

