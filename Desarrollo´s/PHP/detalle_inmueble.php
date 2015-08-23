
<html>

<title><?php 

if(isset($_GET['codigo'])){
echo "Detalle de inmueble ".$_GET['codigo'];
}else{
echo "Detalle tickets inmueble";
}


?></title>
<link href="CSS/detalle_inmueble.css" rel="stylesheet" type="text/css"/>
<body>
</body>
</html>


<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { 

//v2.0
window.open(theURL,winName,features);
}
//-->
</script>

<?php

if(isset($_GET['codigo'])){

include 'funciones.php';
include 'head_and_foot.php';

echo "<div id = \"fondo\">".$head."</div>";
	  

$id = $_GET['codigo'];

$inmueble = bdhorario($id = $id);
$nivel = nivel_servicio($id = $id);
$volumetria = volumetrias($id= $id,$incm = $nivel[7]);

$deductiva= 0;
$$facturacion = 0;
if($nivel[5]<97){
$deductiva = apesos($cantidad = $volumetria[2]);
$facturacion = apesos($cantidad = $volumetria[0]);

}else{
$deductiva = "$ 0.00";
$facturacion = apesos($cantidad = $volumetria[0]);
}
if($volumetria[1]<=0){
$link = "  No se tiene Volumetria";
}else{
$link = "<a href = \"#\" target = \"_blank\">Clic para ir a detalle.</a></td>";
}

echo utf8_decode("

		<div class = \"datos_inmueble\">
			
			<table id = \"inmueble\">
			<tr>
			<td class = \"encabezados\"colspan = 4>Datos del inmueble ".$id."</td>
			</tr>
			<tr>
			<td class = \"titulo\"> Estado: </td><td class = \"resultados\">".$inmueble[5]."</td>
			<td class = \"titulo\"> Site: </td><td class = \"resultados\">".$inmueble[0]."</td>
			</tr>
			<tr>
			<td class = \"titulo\"> horario: </td><td class = \"resultados\">".$inmueble[1]."</td>
			<td class = \"titulo\"> Tipo de inmueble: </td><td class = \"resultados\">".$inmueble[3]."</td>
			</tr>
			<tr>
			<td class = \"titulo\">Prioritario: </td><td class = \"resultados\">".$inmueble[6]."</td>
			<td class = \"titulo\">Criticidad: </td><td class = \"resultados\">".$inmueble[4]."</td>
			</tr>
			<tr>
			<td class = \"titulo\">Dirección: </td><td colspan = 3 class = \"resultados\">".$inmueble[2]."</td>
			</tr>
			<tr>
			<td class = \"titulo\">Volumetría: </td><td class = \"resultados\">".$volumetria[1].$link."
			
			<td class = \"titulo\">Facturación: </td><td class = \"resultados_fac\">".$facturacion."</td>
			</tr>

			</table>
			
		</div> 
		
		<div id = \"nivel_servicio\">
			<table>
			<tr><td class = \"encabezados\"colspan = \"8\">Nivel de servicio Actual</td>
			</tr>
			<tr>
			<td class = \"titulo_h\">T1</td>
			<td class = \"titulo_h\">T2</td>
			<td class = \"titulo_h\">TF</td>
			<td class = \"titulo_h\">Nr</td>
			<td class = \"titulo_h\">Nivel de servicio real</td>
			<td class = \"titulo_h\">Nivel de servicio mínimo</td>
			<td class = \"titulo_h\">Incumplimiento de nivel de servicio</td>
			<td class = \"titulo_h\">Deductiva</td>
			</tr>
			<tr id = \"\">
			<td class = \"resultados_h\">".$nivel[0]."</td>
			<td class = \"resultados_h\">".$nivel[1]."</</td>
			<td class = \"resultados_h\">".$nivel[2]."</</td>
			<td class = \"resultados_h\">".$nivel[4]."</</td>
			<td class = \"resultados_h\">".$nivel[5]."</</td>
			<td class = \"resultados_h\">".$nivel[6]."</</td>
			<td class = \"resultados_h\">".$nivel[7]."</</td>
			<td class = \"resultados_h\">".$deductiva."</td>
			</tr>
			</table>
		</div>");
		
echo    "<div class = \"contenedor_h\">"; //Div contenedor_h
		
			if($nivel[5]<97){
				
				$estabilizacion = estabilizacion_inmueble($id = $id);
				
				echo "<div id = \"tabla_estabilizacion\">
			
						<table>
							<tr>
							<td class =\"encabezados\"colspan = 4>Estabilizacion del inmueble</td>
							
							</tr>
							<tr>
							<td class = \"titulo_h\">T1</td>
							<td class = \"titulo_h\">T2</td>
							<td class = \"titulo_h\">Total de Tickets</td>
							</tr>
							
							<tr>
							<td class = \"resultados_h\">".$estabilizacion[1]."</td>
							<td class = \"resultados_h\">".$estabilizacion[2]."</td>
							<td class = \"resultados_h\">".$estabilizacion[4]."</td>
							</tr>
							
							<tr>
							<td colspan = 3 class = \"detalle\">
							<a href=\"\" onclick=\"MM_openBrWindow('des_deductivas.php?id=".$id."','' ,'scrollbars=1, width=1040,height=500')\">Ir a detalle de tickets</a>
							</tr>
						</table>
			
					</div>"; // Fin de div tabla_estabilizacion
			
			
				$tabla = tt_pendientes($id = $id);
					echo "<div id = \"tt_pendientes\">

						<div id = \"titulo\">
						
						<table>
						<tr>
						<td class = \"titulo_h\">Folio Mainbit</td>
						<td class = \"titulo_h\">Folio Remedy</td>
						<td class = \"titulo_h\">Estatus</td>
						<td class = \"titulo_h\">TTR horas</td>
						<td class = \"titulo_h\">SLA Objetivo</td>
						<td class = \"titulo_h\">Horas Restantes</td>
						<td class = \"titulo_h\">Grupo Resolutorio</td>
						</tr>
						</table>
						</div>
						
						<div = id = \"resultados_p\">
							
							".$tabla."
						</div>
				  </div>";
			}else{
			
						$tabla = tt_pendientes($id = $id);
			echo "<div id = \"tt_pendientes\">

					
						<div = id = \"resultados_p\">
							
							".$tabla."
						</div>
				  </div>";
			}
			
			
echo "</div>"; //Fin de div contenedor_h
			


}else{

header("location:tabla.php");

}



?>