<?php
	
	setlocale(LC_ALL,"es_ES");

	$hoy = date("d-m-Y");
	//$fecha1 =getdate();
	//$fecha = date("d-m-Y",strtotime($fecha1));
	
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=matriz_de_Riesgo_y_Oportunidad '.$hoy.' .xls');
	require 'conexion.php';

	$conn = new Conexion1();
	$link = $conn->conectarse();
	$query= 'SELECT * FROM matriz_r_o';
	$result = mysqli_query($link, $query);
?>



<table border="1">
	<tr>
		
			
	</tr>

	<tr>
		
		<th style="background-color: #FE8888;" >No. Caso</th>
		<th style="background-color:#FE8888;" >Proceso</th>
		<th style="background-color:#FE8888;" >Contexto</th>
		<th style="background-color:#FE8888;"  >Parte Interesada</th>
		<th  style="background-color:#FE8888;" >Descrip. del Suceso</th>
		<th  style="background-color:#FE8888;" >Riesgo/Oportunidad</th>
		<th  style="background-color:#FE8888;" >Cons. Previstas</th>
		<th  style="background-color:#FE8888;" >Probabilidad</th>
		<th  style="background-color:#FE8888;" >Severidad</th>
		<th  style="background-color:#FE8888;" >Magnitud</th>
		<th  style="background-color:#FE8888;" >clasificacion</th>
		<th  style="background-color:#FE8888;" >dec_acc</th>
		<th  style="background-color:#FE8888;" >Descipcion de Medida</th>
		<th  style="background-color:#FE8888;" >frecuencia</th>
		<th  style="background-color:#FE8888;" >plazo</th>
		<th  style="background-color:#FE8888;" >Eficacia de las Medidas</th>
		<th  style="background-color:#FE8888;" >Responsable</th>
		<th  style="background-color:#FE8888;" >Fecha</th>
		<th  style="background-color:#FE8888;" >Evi. Objetiva</th>
		<th  style="background-color:#FE8888;" >Estado</th>



	</tr>
	<?php
		while ($row = mysqli_fetch_assoc ($result) ) {
			?>
				<tr>
					
					<td><?php echo $row['caso']; ?></td>
					<td><?php 

							switch ($row['proceso']) {
					            case '1':
					            $des_pro = "Sistema De Gestion";
					            break;
					            
					            case '2':
					            $des_pro = "Prevencion de Riesgo";
					            break;
					            
					            case '3':
					            $des_pro = "Recursos Humanos";
					            break;

					            case '4':
					            $des_pro = "Contabilidad";
					            break;

					            case '5':
					            $des_pro = " Adquisiciones";
					            break;

					            case '6':
					            $des_pro = "Comunicaciones";
					            break;

					            case '7':
					            $des_pro = "Revisión Por La Direccion";
					            break;

					            case '8':
					            $des_pro = "Informacion Documentada";
					            break;

					            case '9':
					            $des_pro = "Auditoria";
					            break;

					            case '10':
					            $des_pro = "No Conformidad Y Acc. Correctiva";
					            break;

					            case '11':
					            $des_pro = "Ejecucion de Obra";
					            break;


					            case '12':
					            $des_pro = "Diseño y Desarrollo (Inmobiliaria)";
					            break;

					            default:
					            $des_pro = "Verificar";
					            break;
					            }

					echo $des_pro; ?></td>



					<td><?php 

					  if ($row['contexto'] == 1) {
			           $contexto = "Cuestion Interna";
			  		  }else{
			  		  $contexto = "Cuestion Externa";
			  		  }

					 echo $contexto; ?></td>
					<td><?php

							switch ($row['part_int']) {
				            case '1':
				            $des_part = "Cliente (Inmobiliaria)";
				            break;
				            
				            case '2':
				            $des_part = "Cliente Final";
				            break;
				            
				            case '3':
				            $des_part = "Proveedor De Productos";
				            break;

				            case '4':
				            $des_part = "Proveedor De Servidores";
				            break;

				            case '5':
				            $des_part = "Colaboradores";
				            break;

				            case '6':
				            $des_part = "Competidores";
				            break;

				            case '7':
				            $des_part = "Sociedad";
				            break;

				            default:
				            $des_part = "Error Llamar Encargado Pivot Data";
				            break;
				            }



					 echo $des_part; ?></td>
					<td><?php echo $row['descrip_1']; ?></td>
					<td><?php

					 if ($row['dec_o_r'] == 1) {
			           $ro = "Riesgo";
			  		  }else{
			  		  $ro = "Oportunidad";
			  		  }


					 echo $ro; ?></td>
					<td><?php echo $row['con_pre']; ?></td>
					<td><?php echo $row['probabilidad']; ?></td>
					<td><?php echo $row['severidad']; ?></td>
					<td><?php echo $row['magnitud']; ?></td>
					<td><?php

						switch ($row['clasificacion']) {
				            case '1':
				            $des_clas = "Riesgo Bajo";
				            break;
				            
				            case '2':
				            $des_clas = "Riesgo Medio";
				            break;
				            
				            case '3':
				            $des_clas = "Riesgo Alto";
				            break;

				            default:
				            $des_clas = "Error Llamar Encargado Pivot Data";
				            break;
				            }    


					 echo $des_clas; ?></td>
					<td><?php 

							switch ($row['dec_acc']) {
				            case '1':
				            $dacc = "Eliminar";
				            break;
				            
				            case '2':
				            $dacc = "Evitar";
				            break;
				            
				            case '3':
				            $dacc = "Cambiar Probabilidad/Consecuencia";
				            break;

				            case '4':
				            $dacc = "Compartir";
				            break;

				            case '5':
				            $dacc = "Mantener";
				            break;

				            case '6':
				            $dacc = "Asumir";
				            break;

				            default:
				            $dacc = "Error Llamar Encargado Pivot Data";
				            break;
				            }    

					echo $dacc; ?></td>
					<td><?php echo $row['desc_acc']; ?></td>
					<td><?php echo $row['frecuencia']; ?></td>
					<td><?php echo $row['plazo']; ?></td>
					<td><?php echo $row['eficacia']; ?></td>
					<td><?php 

								switch ($row['responsable']) {
					            case '1':
					            $respon = "Gerente General";
					            break;
					            
					            case '2':
					            $respon = "Subgerente";
					            break;
					            
					            case '3':
					            $respon = "Gerente Tecnico";
					            break;

					            case '4':
					            $respon = "Jefe de Calidad";
					            break;

					            case '5':
					            $respon = "Jefe de Seguridad";
					            break;

					            case '6':
					            $respon = "Encargado de Calidad";
					            break;

					            case '7':
					            $respon = "Coordinador de Calidad";
					            break;

					            case '8':
					            $respon = "Supervisor";
					            break;

					            case '9':
					            $respon = "Adm. de Obra";
					            break;

					            case '10':
					            $respon = "Jefe de Terreno";
					            break;

					            case '11':
					            $respon = "Oficina Técnica";
					            break;

					            default:
					            $respon = "Verificar";
					            break;
					            }
								echo $respon ?></td>


					<td><?php echo $row['fecha']; ?></td>
					<td><?php echo $row['objetivo']; ?></td>
					<td><?php 
							if ($row['estado'] == 1) {
			         			$estado = "Finalizado";
			  					}else {
			  					$estado = "Pendiente";
			  					}

					echo $estado; ?></td>

				</tr>	

			<?php
		}
	?>
</table>