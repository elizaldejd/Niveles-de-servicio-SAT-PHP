<html>

<title><?php 

if(isset($_GET['id'])){
echo utf8_decode("Estabilización del inmueble ".$_GET['id']);
}

?> </title>
<link href="CSS/des_deductivas.css" rel="stylesheet" type="text/css"/>

<html>

<?php

include 'funciones.php';

if(isset($_GET['id'])){
$id = $_GET['id'];

$variables = estabilizacion_inmueble($id=$id);
$valores = nivel_servicio($id=$id);
$volumetria = volumetrias($id = $id,$incm=$valores[7]);
$deductiva = apesos($cantidad = $volumetria[2]);

		echo      utf8_decode("<div id = \"fija\">
					   <table>
						   <tr>
							<td class =\"titulos\" colspan = 9>Desglose de tickets, calculando deductiva para cada caso.</td>
						   </tr>
						   <tr>
							   <td class =\"titulos\">___________</td>
							   <td class =\"titulos\">Tickets T1        </td> 
							   <td class =\"titulos\">Tickets T2        </td>
							   <td class =\"titulos\">Tickets TF        </td>
							   <td class =\"titulos\">Total tickets     </td>
							   <td class =\"titulos\">Nr                </td> 
							   <td class =\"titulos\" id = \"porcentajes\">% Nivel de Servicio </td>
							   <td class =\"titulos\" id = \"porcentajes\">% Incumplimiento NS </td>
							   <td class =\"titulos\">Deductiva </td>
						   </tr>
						   
						   <tr>
							   <td class = \"resultados\" id = \"par\">Nivel de servicio Real</td> 
							   <td class = \"resultados\" id = \"par\">".$valores[0]."           </td> 
							   <td class = \"resultados\" id = \"par\">".$valores[1]."           </td>
							   <td class = \"resultados\" id = \"par\">".$valores[2]."           </td>
							   <td class = \"resultados\" id = \"par\">".$valores[3]."           </td>
							   <td class = \"resultados\" id = \"par\">".$valores[4]."           </td> 
							   <td class = \"resultados\" id = \"par\">".$valores[5]."           </td>
							   <td class = \"resultados\" id = \"par\">".$volumetria[1]."          </td>
							   <td class = \"deductiva\" id = \"par\">".$deductiva."    </td>
					      </tr>
					   </table>
				   </div>");
echo "<div id = \"resultados\">";				   
	echo $variables[0];	
echo "</div>";

}else{

header('location:menu.php');

}



?>