<html>
<title>

<?php 

if(isset($_POST['reporte'])){
echo $_POST['reporte']; 
}else{
echo "Nivel de servicio";
}
?>
</title>
<link href="CSS/nivel_servicio.css" rel="stylesheet" type="text/css"/>
<body>

<div id = fondo>

</div>
	<div id = "encabezados">
		<?php
		include 'head_and_foot.php';
		echo $head;
		?>
	</div>

		<?php 
		
		if(isset($_POST['consulta'])){
		include 'funciones.php';
		
		if($_POST['reporte']=="SLA General"){

			$tabla = reporte_resueltos($dns = "SI");
		
		}elseif($_POST['reporte']=="Inmuebles fuera de SLA"){
		
			$tabla = reporte_resueltos($dns = "NO");
			
		}elseif($_POST['reporte']=="Inmuebles dentro de SLA"){
		
			$tabla = reporte_resueltos($dns = "SI");
			
		}
		
		echo "<div id = \"tabla\">
				
				<div id = \"datos\">
					<label>Reporte: <label id = \"titulos\">".$_POST['reporte']."</label></label>
					<label>Mes : ".$_POST['mes']."</label>
					<label>Grupo : ".$_POST['gpo']."</label>
					<label><a href = \"\" >Cambiar de reporte</a></label>
				</div>
				<div class = \"centertabla\">
					<table>
					<tr>
					<td colspan = 5 align = \"center\">Datos del inmueble</td>
					<td colspan = 5 align = \"center\">Atencion de incidentes</td>
					</tr>
					<tr>
					<td class = \"titulo\" id = \"id\"> ID Inmueble</td>
					<td class = \"titulo_site\" id = \"sit\">Site</td>
					<td class = \"titulo\" id = \"horario\">Horario de Servicio</td>
					<td class = \"titulo\" id = \"ps\">Total PS</td>
					<td class = \"titulo\" id = \"nr\">Nr</td>
					<td class = \"titulo\" id = \"nc_np\">Nc + Np</td>	
					<td class = \"titulo\" id = \"nsr\">NS Real %</td>
					<td class = \"titulo\" id = \"nsm\">NS M&iacute;nimo %</td>
					<td class = \"titulo\" id = \"cns\">Cumplimiento NS</td>
					<td class = \"titulo\" id = \"ins\">Incumplimiento respecto al NS m&iacute;nimo %</td>
					<td class = \"titulo\" id = \"fac\">Facturacion</td>
					<td class = \"titulo\" id = \"ded\">Deductiva</td>
					</tr>
					</table>
				</div>

			</div>
				<div id = \"resultados\">
					<div class = \"centertabla\">".$tabla."<br>
					</div>
				<div>";

		}else{
		
		
		echo "<div id = \"consulta\">
			
			<label>Selecciona los parametros del reporte</label>	
			<form action = \"\" method = \"POST\">
			<label>Reporte:</label>
			<select name = \"reporte\">
			<option>SLA General</option>
			<option>Inmuebles fuera de SLA</option>
			<option>Inmuebles dentro de SLA</option>
			</select>
			
			<label>Mes:</label>
			<select name = \"mes\">
			<option>Enero</option>
			<option>Febrero</option>
			<option>Marzo</option>
			<option>Abril</option>
			<option>Mayo</option>
			<option>Junio</option>
			<option>Julio</option>
			<option>Agosto</option>
			<option>Septiembre</option>
			<option>Octubre</option>
			<option>Noviembre</option>
			<option>Diciembre</option>
			</select>
			
			<label>Grupo Resolutor:</label>
			<select name = \"gpo\">
			<option>Soporte</option>
			<option>Asociados</option>
			</select>
			<label>
			<input type = \"submit\" value =\"Ejecutar consulta\" name=\"consulta\"></input>
			</label>
		    </form>
				
				
			
			  </div>";
		
		}
		
		?>
	
	

	
	
	

</body>
</html>













