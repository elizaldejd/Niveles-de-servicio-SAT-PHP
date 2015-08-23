<html>
<title>

Tickets sin id asignado

</title>
<link href="CSS/tickets_sin_id.css" rel="stylesheet" type="text/css"/>

<body>
</body>

</html>

<?php
include 'funciones.php';


$tabla = id_vacios();


echo $tabla;

		
			if(isset($_GET['ticket'])){
			
			$ticket = $_GET['ticket'];
			$q_datos = "SELECT * FROM bd_tickets WHERE folio_mainbit = ".$ticket."";
			$rec = mysql_query($q_datos); 
			
			$regreso = mysql_fetch_array($rec);
			
				$folio = $regreso['folio_mainbit'];
				$folio_remedy = $regreso['folio_sat'];
				$fecha_a = $regreso['fecha_apertura'];
				$sla = $regreso['status_sla'];
				$titulo = "Actualizacion del id de inmueble del ticket ".$ticket;
			
			}else{
				
				$titulo = "Selecciona el ticket a modificar";
				$fecha_a = "____________________";
				$folio_remedy = "____________________";
				$folio = "____________________";
				$sla = "____________________";
				
				
			}
			echo "<form action = \"\" onSubmit = \"ejemplo(); \"><fieldset><legend>".$titulo."</legend>";
			
			echo "<div><label>Folio mainbit: </label>  <p>".$folio.		   "</p></div>";
			echo "<div><label>Folio Remedy:  </label>  <p>".$folio_remedy. "</p></div>";
			echo "<div><label>Estatus SLA: 	 </label>  <p>".$sla.          "</p></div>";
			echo "<div><label>Fecha Registro:</label>  <p>".$fecha_a.      "</p></div>";
			echo "<div><label>Ingresa el Id: </label>  <p><input type =\"text\"\"></p></div>";
			
			
			
			echo "<input type = \"submit\" value = \"Actualizar\" name = \"boton\">";
			
				if(isset($_REQUEST['boton'])){
						
						$retorno = "Actualizado";

				}else{
				
					$retorno = "";
				}
			
			echo "<div>".$retorno."</div>";
			
			echo "</form></fieldset>";



?>