<?php

include 'conexion.php';

function lista(){

	$query = "SELECT DISTINCT estado FROM bd_volumetria";
	$rec = mysql_query($query);

		echo "<select size = >";
			while($datos = mysql_fetch_array($rec)){
			echo  "<option>".$datos['estado']."</option>";
			}
		echo "</select>";
}

function reporte_resueltos($dns){

set_time_limit(3600);

$ps = 0;
$fac = 0;
$deduc = 0;

$tabla .= "<table>";
$query = "SELECT DISTINCT id FROM bd_tickets WHERE 

tipo_ticket = 'Incidente' and status_actual = 'Resuelto' and id <> '' or
tipo_ticket = 'Incidente' and status_actual = 'En validacion SAT' and id <> '' or 
tipo_ticket = 'Incidente' and status_actual = 'Cerrado' and id <> '' ";


				$rec = mysql_query($query);
				$i = 1;
			while($datos = mysql_fetch_array($rec)){
				if (($i % 2)== 0){
				$fila = "id";
				}else{
				$fila = "id";
				}
			$resultadoNS = nivel_servicio($id = $datos['id']);
			
				if ($resultadoNS[8] == $dns){
				
						if($resultadosVOL = volumetrias($id = $datos['id'],$incum = $resultadoNS[7])){
							 $ps = $resultadosVOL[1];
							 $fac = $resultadosVOL[0];
							 $deduc = $resultadosVOL[2];
							 
								$fac = apesos($cantidad=$fac);
								$deduc = apesos($cantidad=$deduc);

							
						}else{
						
							$ps = 0;
							$fac =0;
							$deduc = 0;
						}
						
						$resultadosHOR = bdhorario($id = $datos['id']);
						
	$tabla .=   "<tr> 
				<td id = \"id_r\"><a target = \"_blank\" href = \"detalle_inmueble.php?codigo=".$datos['id']."\"> ".$datos['id']." </a></td> 
				<td id = \"site_r\">".$resultadosHOR[0]."</td>
				<td id = \"horario_r\">".$resultadosHOR[1]."</td>
				<td id = \"ps_r\">".$ps."</td>
				<td id = \"nr_r\">".$resultadoNS[4]."</td>
				<td id = \"nc_np_r\">".$resultadoNS[3]."</td>
				<td id = \"nsr_r\">".$resultadoNS[5]."</td> 
				<td id = \"nsm_r\">".$resultadoNS[6]."</td>
				<td id = \"cns_r\">".$resultadoNS[8]."</td>
				<td id = \"ins_r\">".$resultadoNS[7]."</td>
				<td id = \"fac_r\">".$fac."</td>
				<td id = \"ded_r\">".$deduc."</td>
					  </tr>";
					  

				 $i = $i+1;
				 }
			}

$tabla .=  "</table>";

return $tabla;
}

function bdhorario($id){

		$consulta = "SELECT * FROM horarios WHERE id = '".$id."'";
				
		$d_query = mysql_query($consulta);
		
			if($rec = mysql_fetch_array($d_query)){

				$site = $rec['site'];
				$horario = $rec['hrequerimientos'];
				$domicilio = $rec['addres'];
				$t_inmue = $rec['inmueble'];
				$criticidad = $rec['criticidad'];
				$estado = $rec['state'];
				$prioritario = $rec['prioritario'];

			}else{
				
				$site = "---";
				$horario = "---";
				$domicilio = "---";
				$t_inmue = "---";
				$criticidad = "---";
				$estado = "---";
				$prioritario="---";
			}	

		$retorno = array($site, $horario,$domicilio,$t_inmue,$criticidad,$estado,$prioritario);
			return $retorno;
	}

function volumetrias($id,$incm){
	
	$query_volumetrias = "SELECT * FROM bd_volumetria WHERE mes = 'Septiembre' AND id_loc = ".$id."";
	$rec_volumetrias = mysql_query($query_volumetrias);
	
		$rec_volumetrias = mysql_query($query_volumetrias);
		
		if($datos_volumetrias = mysql_fetch_array($rec_volumetrias)){
			$ps1 = $datos_volumetrias['ps1']; //Perfil 1 
			$ps2 = $datos_volumetrias['ps2'];
			$ps3 = $datos_volumetrias['ps3'];
			$ps4 = $datos_volumetrias['ps4'];
			$ps5 = $datos_volumetrias['ps5'];
			$ps6 = $datos_volumetrias['ps6'];
			$ps7 = $datos_volumetrias['ps7'];
			
			$facturacion = round((($ps1* 576.59) + ($ps2* 467.63) + ($ps3* 574) + ($ps4* 576.59) + ($ps5* 576.59) + ($ps6* 665.25) + ($ps7* 665.25)),2);
			$volumetria = $ps1+$ps2+$ps3+$ps4+$ps5+$ps6+$ps7;
			$deductiva = round(($incm * $facturacion*0.02),2);
		}else{		
			$facturacion =0;
			$volumetria = 0;
			$deductiva = 0;
		}			

			$retorno = array($facturacion,$volumetria,$deductiva);

			return $retorno; 
	
}

function head_incidentes(){

echo '<table>
	<tr>
		<td colspan = 5 align = "center">Datos del inmueble</td>
		<td colspan = 5 align = "center">Atencion de incidentes</td>
	</tr>
	  
	<tr>
		<td class = "title_tabla1" id = "noinmueble"> ID Inmueble</td>
		<td class = "title_tabla1" id = "site">Site</td>
		<td class = "title_tabla1" id = "horario">Horario de Servicio</td>
		<td class = "title_tabla1" id = "tpx">Horas Posibles (TPx)</td>
		<td class = "title_tabla1" id = "ps">Total PS</td>
		<td class = "title_tabla2" id = "Nr">Nr</td>
		<td class = "title_tabla2" id = "Nr">Nc + Np</td>	
		<td class = "title_tabla2" id = "Nr">NS Real %</td>
		<td class = "title_tabla2" id = "Nr">NS M&iacute;nimo %</td>
		<td class = "title_tabla2" id = "Nr">Cumplimiento NS</td>
		<td class = "title_tabla2" id = "Nr">Incumplimiento respecto al NS m&iacute;nimo %</td>
		<td class = "title_tabla2" id = "Facturacion">Facturacion</td>
		<td class = "title_tabla2" id = "Facturacion">Deductiva</td>
		
	</tr>

</table>';





}

function id($id_con){

	$num = strpos($id_con,"-");

	$id = substr($id_con,0,$num);
	
	return $id;

}

function id_unicos(){

$q_id = "SELECT DISTINCT id FROM horarios ORDER BY id ASC";

$rec = mysql_query($q_id);

while ($datos = mysql_fetch_array($rec)){


echo '<a href = "x_inmueble.php?valor='.$datos["id"].'">link</a><br>';

}

}

function sla_resueltos(){

set_time_limit(3600);

$q_resueltos = "SELECT status_actual, folio_mainbit, tipo_ticket, registrado, asignado, asignado2, en_curso, en_proceo, tipo_inmueble, id, organizacion_usuario FROM bd_tickets WHERE 
tipo_ticket = 'Incidente' AND status_actual = 'Resuelto' or 
tipo_ticket = 'Incidente' AND status_actual = 'Cerrado'  or
tipo_ticket = 'Incidente' AND status_actual = 'En validacion SAT'";


$rec = mysql_query($q_resueltos);

while($datos = mysql_fetch_array($rec)){
	
	$status = $datos['status_actual'];
	$folio_mainbit = $datos['folio_mainbit'];
	$ticket = $datos['tipo_ticket'];
	$registrado = $datos['registrado'];
	$asignado = $datos['asignado'];
	$asignado2 = $datos['asignado2'];
	$en_curso = $datos['en_curso'];
	$en_proceso = $datos['en_proceo'];
	$t_inmueble = $datos['tipo_inmueble'];
	$id_c = $datos['id'];
	$id_concatenado = $datos['organizacion_usuario'];

		if($id_c == Null){

			$id = id($id_con = $id_concatenado);
			
					$q_id = "UPDATE bd_tickets SET id ='".$id."' WHERE folio_mainbit =".$folio_mainbit."";
					mysql_query($q_id);
	
		}
	
				$ttr = $registrado + $asignado + $asignado2 + $en_curso + $en_proceso;
			
				$q_sla = "UPDATE bd_tickets SET TTR = ".$ttr." WHERE folio_mainbit = '".$folio_mainbit."'";
				
				mysql_query($q_sla);
				
								
								if($t_inmueble == 1){
								
										if($ttr<28800){
										
											$sla_status = "T1";
									
										}elseif($ttr>28801 and $ttr<43200){
										
											$sla_status ="T2";
											
										}else{
										
											$sla_status = "TF";
										
										}
								
										$q_status = "UPDATE bd_tickets SET status_sla = '".$sla_status."' WHERE folio_mainbit = ".$folio_mainbit;
									
											mysql_query($q_status);
								
								}elseif($t_inmueble==2){

										if($ttr<28800){
										
											$sla_status = "T1";
									
										}elseif($ttr>28801 and $ttr<86400){
										
											$sla_status ="T2";
											
										}else{
										
											$sla_status = "TF";
										
										}
								
										$q_status = "UPDATE bd_tickets SET status_sla = '".$sla_status."' WHERE folio_mainbit = ".$folio_mainbit;
									
										mysql_query($q_status);

								}elseif($t_inmueble==3){
										
										if($ttr<43200){
										
											$sla_status = "T1";
									
										}elseif($ttr<172800){
										
											$sla_status ="T2";
											
										}else{	
										
											$sla_status = "TF";
										
										}
								
										$q_status = "UPDATE bd_tickets SET status_sla = '".$sla_status."' WHERE folio_mainbit = ".$folio_mainbit;

										mysql_query($q_status);

								}else{
								
										if($ttr<28800){
										
											$sla_status = "T1";
									
										}elseif($ttr>28801 and $ttr<43200){
										
											$sla_status ="T2";
											
										}else{
										
											$sla_status = "TF";
										
										}
								
										$q_status = "UPDATE bd_tickets SET status_sla = '".$sla_status."' WHERE folio_mainbit = ".$folio_mainbit;
									
											mysql_query($q_status);
								
								}
							
							

}

echo "Finalizo";
}

function sla_t1($id){

$sql = "SELECT * FROM bd_tickets WHERE tipo_ticket = 'Incidente' and  id = '".$id."' and status_sla = 'T1'";


 $rec = mysql_query($sql);

 $t1 = mysql_num_rows($rec);

 return $t1;
 
}

function sla_t2($id){

$sql = "SELECT * FROM bd_tickets WHERE tipo_ticket = 'Incidente' and  id = '".$id."' and status_sla = 'T2'";


 $rec = mysql_query($sql);

 $t1 = mysql_num_rows($rec);

 return $t1;
 
}

function sla_tf($id){

$sql = "SELECT * FROM bd_tickets WHERE tipo_ticket = 'Incidente' and  id = '".$id."' and status_sla = 'TF'";


 $rec = mysql_query($sql);

 $t1 = mysql_num_rows($rec);

 return $t1;
 
}

function nivel_servicio($id){


$t1 = sla_t1($id = $id);
$t2 = sla_t2($id = $id);
$tf = sla_tf($id = $id);
$nr = 0;
$nsm = 97;
$ins = 0;

$tt = $t1 + $t2 + $tf;

if($t2>($tt/2)){

$nr = $t1 + $tt / 2;
$ns = round((100 * ($nr/$tt)),4);

}else{

$nr = $t1 + $t2;
$ns = round((100 * ($nr/$tt)),4);

}


if ($ns>= $nsm){

$ins = 0.0000;
$cns = "SI";
}else{

$ins = $nsm - $ns;
$cns = "NO";

}
//                0   1   2   3   4   5   6    7	8
$arreglo  =array($t1,$t2,$tf,$tt,$nr,$ns,$nsm,$ins,$cns);

return $arreglo;

}

function id_vacios(){

$q_vacios = "SELECT * FROM bd_tickets WHERE tipo_ticket = 'Incidente' and status_actual = 'Cerrado' and id = '' or tipo_ticket = 'Incidente' and status_actual = 'Resuelto' and id = ''";


	  
$rec = mysql_query($q_vacios);


echo '<table>
	  <tr><td class = "titulo">Folio Mainbit</td><td class = "titulo">Folio Remedy</td><td class = "titulo">Status SLA</td><td class = "titulo">Accion</td>
	  <tr>';
	  
if( mysql_num_rows($rec)>0){

			while ($datos = mysql_fetch_array($rec)){

					echo "<tr><td class = \"datos\">".$datos['folio_mainbit']."</td>
						  <td class = \"datos\">".$datos['folio_sat']."</td>
						  <td class = \"datos\">".$datos['status_sla']."</td>
						  <td class = \"datos\"><a name = \"link\"href = \"tickets_sin_id.php?ticket=".$datos['folio_mainbit']."\">Modificar</td>";

					echo "<tr>";

				}
				echo "</table>";
			
		}
}

function formato_tabla($query){


$rec = mysql_query($query);

	if($rec){
		
		echo "<table>";

		echo '<tr>
				<td colspan = 5 align = "center">Datos del inmueble</td>
			    <td colspan = 5 align = "center">Atencion de incidentes</td>
		      </tr>
	  
			  <tr>
				<td class = "title_tabla1" id = "noinmueble"> ID Inmueble</td>
				<td class = "title_tabla1" id = "site">Site</td>
				<td class = "title_tabla1" id = "horario">Horario de Servicio</td>
				<td class = "title_tabla1" id = "ps">Total PS</td>
				<td class = "title_tabla2" id = "Nr">Nr</td>
				<td class = "title_tabla2" id = "Nr">Nc + Np</td>	
				<td class = "title_tabla2" id = "Nr">NS Real %</td>
				<td class = "title_tabla2" id = "Nr">NS M&iacute;nimo %</td>
				<td class = "title_tabla2" id = "Nr">Cumplimiento NS</td>
				<td class = "title_tabla2" id = "Nr">Incumplimiento respecto al NS m&iacute;nimo %</td>
				<td class = "title_tabla2" id = "Facturacion">Facturacion</td>
				<td class = "title_tabla2" id = "Facturacion">Deductiva</td>
			  </tr>';

		while($datos = mysql_fetch_array($rec)){
			
				
			
		
		}

	}else{

		return "Se tuvo un el siguiente error con la consulta: ".mysql_error()." Por tal motivo no hay datos que mostrar.";

	}

}

function formato_hora($ttr){

$d = 86400;
$h = 3600;
$m = 60;

if($ttr<0){

return "Numero negativo";

}
if(($ttr / $d)>=1){

$dias = intval($ttr / $d);

if($dias>1){
$texto = " dias ";
}else{
$texto = " dia ";
}

		$horas = intval(($ttr - ($dias*$d)) / $h);
			if($horas<10){
			$horas = 0 .$horas;
			}
		$minutos = intval(($ttr - (($dias*$d)+($horas*$h)))/$m);
			if($minutos<10){
			$minutos = 0 .$minutos;
			}
		$segundos = intval(($ttr-(($dias*$d)+($horas*$h)+($minutos*$m))));
			if($segundos<10){
			$segundos = 0 .$segundos;
			}

	return $dias.$texto.$horas.":".$minutos.":".$segundos;

}else{

		$horas = intval(($ttr /3600));
			if($horas<10){
			$horas = 0 .$horas;
			}
		$minutos = intval(($ttr - ($horas*$h))/$m);
			if($minutos<10){
			$minutos = 0 .$minutos;
			}
		$segundos = intval(($ttr-(($horas*$h)+($minutos*$m))));
			if($segundos<10){
			$segundos = 0 .$segundos;
			}

	return $horas.":".$minutos.":".$segundos;

}

}

function apesos($cantidad){


if($cantidad >= 1){
$formateada ="---";
if(is_float($cantidad)){

$cantidad = round($cantidad,2);
$separador = explode(".",$cantidad);
$cientos = $separador[0];
$no = strlen($cientos);
$centavos = strlen($separador[1]);
}else{

$cientos = $cantidad;
$no = strlen($cientos);
$centavos = "0";
}

	if($no==9){

			$formateada = (substr($cientos,-9,3)).",".(substr($cientos,-6,3)).",".(substr($cientos,-3,3));

		}elseif($no>=7 and $no<=8){

				$no = ($no-6);
				$resto = substr($cientos,0,$no);
				$formateada = $resto.",".(substr($cientos,-6,3)).",".(substr($cientos,-3,3));

		}elseif($no==6){

			$formateada = (substr($cientos,-6,3)).",".(substr($cientos,-3,3));

		}elseif($no<=5 and $no>=4){

				$no = ($no-3);
				$resto = substr($cientos,0,$no);
				$formateada = $resto.",".(substr($cientos,-3,3));

		}elseif($no<=3){

				$formateada = $cientos;

		}elseif($no>9){

		return "000.000";

		}
	
	if($centavos <=9){
	$centavos = $centavos."0";
	}
	$pesos = "$  ".$formateada.".".$centavos;
 }else{
	$pesos = "$  0.00";
 }
	return $pesos;

}

function sla_obj($ttr,$t_inm){

$primer = 3600; //Una hora
$segundo = 7200; //Dos horas
$tercero = 10800; //Tres horas
$cuarto = 14400; //Cuatro horas
$bandera = "";

$restante = "";
	if($t_inm ==1){

		$t1 =28800;
		$t2 =43200;
		
		if($ttr<$t1){
			$objetivo = "T1";
			$ttr = $t1- $ttr;
			if($ttr < $primer){
				$bandera = "bandera1";
			}elseif($ttr >= $segundo and $ttr <= $tercero){
				$bandera = "bandera2";
			}elseif($ttr > $tercero and $ttr <= $cuarto){
				$bandera = "bandera3";
			}	
					$restante = formato_hora($ttr = $ttr);
		}elseif($ttr<$t2){
			$objetivo = "T2";
			$ttr = $t2- $ttr;
			if($ttr < $primer){
				$bandera = "bandera1";
			}elseif($ttr >= $segundo and $ttr <= $tercero){
				$bandera = "bandera2";
			}elseif($ttr > $tercero and $ttr <= $cuarto){
				$bandera = "bandera3";
			}

					$restante = formato_hora($ttr = $ttr);
		}else{
			$objetivo = "TF";
			$restante = "TF";
		}

	}elseif($t_inm ==2){

		$t1 =28800;
		$t2 =86400;
		
		if($ttr<$t1){
			$objetivo = "T1";
			$ttr = $t1- $ttr;
			if($ttr < $primer){
				$bandera = "bandera1";
			}elseif($ttr >= $segundo and $ttr <= $tercero){
				$bandera = "bandera2";
			}elseif($ttr > $tercero and $ttr <= $cuarto){
				$bandera = "bandera3";
			}
					$restante = formato_hora($ttr = $ttr);
		}elseif($ttr<$t2){
			$objetivo = "T2";
			$ttr = $t2- $ttr;
			if($ttr < $primer){
				$bandera = "bandera1";
			}elseif($ttr >= $segundo and $ttr <= $tercero){
				$bandera = "bandera2";
			}elseif($ttr > $tercero and $ttr <= $cuarto){
				$bandera = "bandera3";
			}
					$restante = formato_hora($ttr = $ttr);
		}else{
			$objetivo = "TF";
			$restante = "TF";
		}

	}elseif($t_inm ==3){

		$t1 =43200;
		$t2 =172800;
		
		if($ttr<$t1){
			$objetivo = "T1";
			$ttr = $t1- $ttr;
			if($ttr < $primer){
				$bandera = "bandera1";
			}elseif($ttr >= $segundo and $ttr <= $tercero){
				$bandera = "bandera2";
			}elseif($ttr > $tercero and $ttr <= $cuarto){
				$bandera = "bandera3";
			}

					$restante = formato_hora($ttr = $ttr);
		}elseif($ttr<$t2){
			$objetivo = "T2";
			$ttr = $t2- $ttr;
			if($ttr < $primer){
				$bandera = "bandera1";
			}elseif($ttr >= $segundo and $ttr <= $tercero){
				$bandera = "bandera2";
			}elseif($ttr > $tercero and $ttr <= $cuarto){
				$bandera = "bandera3";
			}

					$restante = formato_hora($ttr = $ttr);
		}else{
			$objetivo = "TF";
			$restante = "TF";
		}

	}else{

	$t_inm = 1;

		$t1 =28800;
		$t2 =43200;
		
		if($ttr<$t1){
			$objetivo = "T1";
			$ttr = $t1- $ttr;
			if($ttr < $primer){
				$bandera = "bandera1";
			}elseif($ttr >= $segundo and $ttr <= $tercero){
				$bandera = "bandera2";
			}elseif($ttr > $tercero and $ttr <= $cuarto){
				$bandera = "bandera3";
			}
					$restante = formato_hora($ttr = $ttr);
		}elseif($ttr<$t2){
			$objetivo = "T2";
			$ttr = $t2- $ttr;
			if($ttr < $primer){
				$bandera = "bandera1";
			}elseif($ttr >= $segundo and $ttr <= $tercero){
				$bandera = "bandera2";
			}elseif($ttr > $tercero and $ttr <= $cuarto){
				$bandera = "bandera3";
			}
					$restante = formato_hora($ttr = $ttr);
		}else{
			$objetivo = "TF";
			$restante = "TF";
		}

	}

return $retorno = array($objetivo,$restante,$bandera);

}

function estabilizacion_inmueble($id){

$valores = nivel_servicio($id=$id);
$volumetria = volumetrias($id = $id,$incm=0);
	$facturacion = $volumetria[0];
//    0   1   2   3   4   5   6    7	8
//  ($t1,$t2,$tf,$tt,$nr,$ns,$nsm,$ins,$cns);

$t1 = $valores[0];
$t2 = $valores[1];
$tf = $valores[2];
$tt = $valores[3];
$nr = $valores[4];
$ns = $valores[5];
$tabla = "";
$ins=0;
$fila = 1;
$ttReales1 = $t1;
$ttReales2 = $t2;
if($ns>97){
return false;
}else{

		$tabla .= "<table class = \"tabla_resultados\">";
		$ins = 97-$ns;			
		$ins = number_format($ins,4);			
		$deductiva = ($facturacion * 0.02)*$ins;
        $deductiva = apesos($cantidad = $deductiva);
					
	while($ns<97){
			
			if(($fila % 2)==0){
				$texto = "par";
			}else{
				$texto = "inpar";
			}
			
			$t1= $t1+1;
			$tt = $t1+$t2+$tf;

		if($t2>($tt*0.5)){
			$nr = $t1+($tt*0.5);
		}else{
			$nr = $t1+$t2;
		}
	//Se genera la tabla de deductivas		

		$ns = number_format((100*($nr/$tt)),4);
		
		if($ns<97){
			$ins = number_format((97-$ns),4);
			$deductiva = ($facturacion * 0.02)*$ins;
			$deductiva = apesos($cantidad = $deductiva);
		}else{
			$ins = 0.00;
			$deductiva = "$ 0.00";
		}
		$tt1 = round(($t1+$t2)/2);
		$tt2 = ($t1+$t2)-$tt1;
		
		$tabla .= "<tr>
				   <td class = \"resultados\" id =".$texto." >Caso ".$fila."     </td> 
				   <td class = \"resultados\" id =".$texto." >".$tt1."           </td> 
				   <td class = \"resultados\" id =".$texto." >".$tt2."           </td>
				   <td class = \"resultados\" id =".$texto." >".$tf."           </td>
				   <td class = \"resultados\" id =".$texto." >".$tt."           </td>
				   <td class = \"resultados\" id =".$texto." >".$nr."           </td> 
				   <td class = \"resultados\" id =".$texto." >".$ns."           </td>
				   <td class = \"resultados\" id =".$texto." >".$ins."           </td>
				   <td class = \"deductiva\" id =".$texto." >".$deductiva."    </td>
				   </tr>";			
		$fila ++;
	}
			$tabla .= "</table>";
			
	// Finaliza la tabla de deductivas

		$tt_t1 = $tt1 - $ttReales1;
		$tt_t2 = $tt2 - $ttReales2;
		$tts = $tt_t1+$tt_t2;


}

$datos = array($tabla,$tt_t1,$tt_t2,$ns,$tts);

return $datos;

}

function tt_pendientes($id){

$tabla = "";
$q = "SELECT * FROM bd_tickets WHERE 
id = ".$id." AND status_actual = 'Asignado' OR
id = ".$id." AND status_actual = 'Asignado 2'   OR
id = ".$id." AND status_actual = 'En curso'  OR 
id = ".$id." AND status_actual = 'En proceso' OR
id = ".$id." AND status_actual = 'Abierto' OR
id = ".$id." AND status_actual = 'Pendiente' ";

$rec = mysql_query($q);
		
if($datos = mysql_fetch_array($rec)){
		$tabla .= "<table id = \"prueba12\">";
		$rec = mysql_query($q);
			while($datos = mysql_fetch_array($rec)){
			$tabla .= "<tr>
			<td class = \"resultados_c\">
			<a target = \"_blank\"href=\"ticket.php?ticket=".$datos['folio_mainbit']."&remedy=".$datos['folio_sat']."\">".$datos['folio_mainbit']."</a></td>
		
			<td class = \"resultados_c\">".$datos['folio_sat']."</td>
			<td class = \"resultados_c\">".$datos['status_actual']."</td>
			<td class = \"resultados_c\">".$datos['folio_mainbit']."</td>
			<td class = \"resultados_c\">".$datos['folio_mainbit']."</td>
			<td class = \"resultados_c\">".$datos['folio_mainbit']."</td>
			<td class = \"resultados_c\">".$datos['folio_mainbit']."</td>
			</tr>";

	}
			$tabla .= "</table>";
}else{
$tabla = utf8_decode("No se tiene más tickets pendientes por resolver.");
}

return $tabla;
}














?>