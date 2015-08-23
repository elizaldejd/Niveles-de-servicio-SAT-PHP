<html>

<title>Detalle de Tickets Por inmueble</title>
<link href="CSS/pruebascss.css" rel="stylesheet" type="text/css"/>
<body>
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { 

//v2.0
window.open(theURL,winName,features);
}
//-->
</script>
</body>
</html>


<?php

//if(isset($_GET['codigo'])){

include 'funciones.php';
include 'head_and_foot.php';

$id = 390;//$_GET['codigo'];

$inmueble = bdhorario($id = $id);
$nivel = nivel_servicio($id = $id);
$volumetria = volumetrias($id= $id,$incm = $nivel[7]);

if($nivel[5]<97){
$deductiva = apesos($cantidad = $volumetria[2]);
$facturacion = apesos($cantidad = $volumetria[0]);

}else{
$deductiva = "$ 0.00";
$facturacion = apesos($cantidad = $volumetria[0]);
}

echo "<div id = \"fondo\">".$head."</div>";


echo utf8_decode("<div id = \"contenedor1\">

						<div id = \"datos_inmueble\">
							<table class = \"inmueble\">
							<tr><td class = \"encabezados\"colspan = 4>Datos del inmueble ".$id."</td></tr>
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
							<td class = \"titulo\">Volumetría: </td><td class = \"resultados\">".$volumetria[1]."
							<a href = \"#\" target = \"_blank\">Click para ir a detalle.</a>
							</td>
							<td class = \"titulo\">Facturación: </td><td class = \"resultados\">".$facturacion."</td>
							</tr>
							</table>
						</div>
						
						<div id = \"nivel_servicio\">
							<table>
								<tr><td class = \"encabezados\"colspan = \"8\">Nivel de servicio Actual</td></tr>
								<tr>
								<td class = \"titulo_h\">T1</td>
								<td class = \"titulo_h\">T2</td>
								<td class = \"titulo_h\">TF</td>
								<td class = \"titulo_h\">Nr</td>
								<td class = \"titulo_h\">Nivel de servicio real</td>
								<td class = \"titulo_h\">Nivel de servicio minimo</td>
								<td class = \"titulo_h\">Incumplimiento de nivel de servicio</td>
								<td class = \"titulo_h\">Deductiva</td>
								</tr>
								<tr>
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
						</div>
                 </div>"); //Fin de div contenedor1
				 
										
echo utf8_decode("<div id = \"contenedor2\">");

echo utf8_decode("<div id = \"estabilizacion\">");

if(($nivel[5])<97){
$estabilizacion = estabilizacion_inmueble($id = $id);
							
	echo utf8_decode("<table>
							<tr><td class =\"encabezados\"colspan = 4>Estabilizacion del inmueble</td></tr>
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
							<a href=\"\" onclick=\"MM_openBrWindow('des_deductivas.php?id=".$id."','' ,'width=1042,height=500')\">Ir a detalle de tickets</a>
							</tr>
						</table>");
}else{
echo "<label>El inmueble esta dentro de SLA</label>";
}						
echo utf8_decode("</div>"); //Fin de DIV estabilizacion
			$tabla = tt_pendientes($id = $id);		
echo utf8_decode("<div id = \"pendientes\">");
echo utf8_decode("<div id = \"titulo_tt\">
						<table>
							<tr>
							<td class = \"titulo_h\">Folio Mainbit</td>
							<td class = \"titulo_h\">Folio Remedy</td>
							<td class = \"titulo_h\">Estatus</td>
							<td class = \"titulo_h\">TTR horas</td>
							<td class = \"titulo_h\">SLA Objetivo</td>
							<td class = \"titulo_h\">Horas Restantes</td>
							<td class = \"titulo_h\">Grupo Resolutor</td>
							</tr>
						</table>
					</div>
					
					<div id= \"tt_resultados\">
						".$tabla."


					</div>");
					
echo utf8_decode("</div>");
echo utf8_decode("</div>");
//}else{

//header("location:tabla.php");

//}

?>