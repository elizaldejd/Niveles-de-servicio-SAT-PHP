<html>
<title>SLA Tickets activos</title>
<link href="CSS/sla_activos.css" rel="stylesheet" type="text/css"/>
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

<div id = "fondo">

</div>
	<div id = "encabezados">
		<?php
		include 'head_and_foot.php';
		echo $head;
		?>
	</div>
<div class = "recuadro">
	<div class = "titulos">	
		<table>
			<tr>
				<td>Folio mainbit</td>
				<td>Folio Remedy</td>
				<td>Estatus</td>
				<td>Tipo de inmueble</td>
				<td>TTR horas</td>
				<td>SLA objetivo</td>
				<td>horas estantes</td>
				<td>Coordinador</td>
			</tr>
		</table>	
	</div>

	<div class = "resultados">	
		<table>
			<?php 
				include 'funciones.php';
				
				//$q = "SELECT * FROM bd_tickets WHERE tipo_ticket = 'Incidente'";
				
				$q = "SELECT * FROM bd_tickets WHERE 
				tipo_ticket = \"Incidente\" AND status_actual = \"Pendiente\" OR 
				tipo_ticket = \"Incidente\" AND status_actual = \"Asignado\" OR 
				tipo_ticket = \"Incidente\" AND status_actual = \"Asignado 2\" OR 
				tipo_ticket = \"Incidente\" AND status_actual = \"En curso\" OR 
				tipo_ticket = \"Incidente\" AND status_actual = \"En proceso\" 			
				";


				$rec = mysql_query($q);
				
				while($datos = mysql_fetch_array($rec)){
				
					$ttr = $datos['registrado'] + $datos['asignado'] + $datos['asignado2'] +
						   $datos['en_curso'] + $datos['en_proceo'];
						   
					$hora = formato_hora($ttr = $ttr);
					$sla = sla_obj($ttr = $ttr,$t_inm = $datos['tipo_inmueble']);
					$bandera = $sla[2];
						
						$q2 = "SELECT * FROM bd_coordinaciones WHERE idconcatenado = \"".$datos['organizacion_usuario']."\"";
						$rec2 = mysql_query($q2);
						if((mysql_num_rows($rec2))>=1){
							$rec2 = mysql_query($q2);
							$datos2 = mysql_fetch_array($rec2);
							$coordinador = $datos2['coordinador'];
						}else{
							$coordinador = $datos['organizacion_usuario'];
						}
						
						//$coordinador = $datos['organizacion_usuario'];
					echo "<tr class = \" ".$bandera." \">
					
					<td>
					<a href=\"\" onclick=\"MM_openBrWindow('ticket.php?ticket=".$datos['folio_mainbit']."','' ,'scrollbars=1, width=1040,height=500')\">".$datos['folio_mainbit']."</a>
					</td>
					<td>".$datos['folio_sat']."</td>
					<td>".$datos['status_actual']."</td>
					<td>".$datos['tipo_inmueble']."</td>
					<td>".$hora."</td>
					<td>".$sla[0]."</td>
					<td>".$sla[1]."</td>
					
					<td>".$coordinador."</td>
					</tr>";
				}
			?>
			
		</table>
	
	</div>
</div>	
	
	
	
	
	
	
	
	
</div>