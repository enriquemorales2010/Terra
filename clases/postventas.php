<?php
require_once __DIR__ . '/conexion.php';

class postventas extends Conexion {

    public function __construct() {
        parent::__construct();
    }

    public function registrarPostventa($nombre, $arriendo, $dpto, $fechair, $descripcion, $email, $telefono, $celular, $conformidad, $estado, $usuario, $edificio) {
        echo 1;

        $sql = "INSERT INTO postventas (num_caso, nom_rec, tip_con, num_dep, fec_ini_rec, desc_caso, correo_rec, fono_rec, cel_rec, conformidad, estado, rut_usu, id_ed) 
                VALUES (NULL, '$nombre', '$arriendo', '$dpto', '$fechair', '$descripcion', '$email', '$telefono', '$celular', '$conformidad', '$estado', '$usuario', '$edificio')"; 
        $consulta = $this->conn->query($sql);

        if ($consulta) {
            return TRUE;
        } else {
            die($this->conn->error);
        }
    }

    public function listaPostventas() {
        $sql = "SELECT postventas.num_caso, postventas.nom_rec, postventas.tip_con, postventas.num_dep, postventas.fec_ini_rec, postventas.fec_cul_recl, 
                       postventas.estado, postventas.resp_recl, postventas.desc_caso, postventas.estado, postventas.id_ed, edificio.nom_ed, edificio.fecha_rec 
                FROM postventas 
                INNER JOIN edificio ON postventas.id_ed = edificio.id_ed";
        $consulta = $this->conn->query($sql);
        $sesion = $_SESSION['perfil'];

        if ($consulta) {
            if ($consulta->num_rows > 0) {
                echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_usuarios' cellspacing='0' width='100%'>
                        <thead>
                            <tr>
                                <th>Numero de Caso</th>
                                <th>Nombre del Reclamador</th>
                                <th>Propietario o Arrendatario</th>
                                <th>Edificio</th>
                                <th>N. de DPTO</th>
                                <th>Fecha del Reclamo</th>
                                <th>Fecha de Recep. M.</th> 
                                <th>Fecha de Culminacion</th>
                                <th>Estado</th>                  
                                <th>Acciones</th>
                                <th>Datos</th>
                            </tr>
                        </thead>
                        <tbody>";
                
                while ($fila = mysqli_fetch_assoc($consulta)) {
                    $contrato = ($fila['tip_con'] == 1) ? "Propietario" : "Arrendatario";
                    $culminar = ($fila['fec_cul_recl'] == "") ? "Aun en espera" : date("d-m-Y", strtotime($fila['fec_cul_recl']));
                    $inicio = date("d-m-Y", strtotime($fila['fec_ini_rec']));
                    $recepcion = date("d-m-Y", strtotime($fila['fecha_rec']));

                    if ($fila['estado'] == 0) {
                        $estado = "En espera";
                        $clase = "btn btn-xs btn-warning";
                    } elseif ($fila['estado'] == 1) {
                        $estado = "Finalizado";
                        $clase = "btn btn-xs btn-success";
                    } else {
                        $estado = "LLamar al encargado";
                        $clase = "btn btn-xs btn-danger";
                    }

                    if($fila['fec_cul_recl'] != "" && $fila['estado'] == 1 && $sesion != "Super Administrador") {
                        $btndesf = "disabled";
                        $link = "#";
                    } else {
                        $btndesf = "";
                        $link = "editar_postventa.php?num_caso=".$fila["num_caso"];          
                    }
                    
                    echo "<tr>
                            <td>".$fila['num_caso']."</td>
                            <td>".$fila['nom_rec']."</td>
                            <td>".$contrato."</td>
                            <td>".$fila['nom_ed']."</td>
                            <td>".$fila['num_dep']."</td>
                            <td>".$inicio."</td>
                            <td>".$recepcion."</td>
                            <td>".$culminar."</td>
                            <td style='text-align: center;'>
                                <a type='button' class='".$clase."'>".$estado."</a>
                            </td>
                            <td style='text-align: center;'>
                                <a type='button' class='btn btn-xs btn-info' ".$btndesf." href='".$link."'>Editar</a>
                            </td>
                            <td style='text-align: center;'>
                                <a type='button' class='btn btn-xs btn-info' href='postventa_detalles.php?num_caso=".$fila["num_caso"]."'>Ver Detalle</a>
                            </td>
                        </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<table class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Numero de Caso</th>
                                <th>Nombre del Reclamador</th>
                                <th>Tipo de Contrato</th>
                                <th>Edificio</th>
                                <th>N. de DPTO</th>
                                <th>Fecha del Reclamo</th>
                                <th>Fecha del Culminacion</th> 
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                      <div style='text-align:center; color:red;'><h3>NO HAY REGISTROS EN LA BASE DE DATOS</h3></div>";
            }
        }
    }

    public function editarPostventa($num_caso, $nombre, $contrato, $dpto, $descripcion, $correo, $telef, $cel, $real) {
        echo 1;

        $sql = "UPDATE postventas SET nom_rec = '$nombre', tip_con = '$contrato', num_dep = '$dpto', desc_caso = '$descripcion', 
                correo_rec = '$correo', fono_rec = '$telef', cel_rec = '$cel', id_ed = '$real' 
                WHERE num_caso = '$num_caso'";
        $consulta = $this->conn->query($sql);

        if ($consulta) {
            return TRUE;
        } else {
            die($this->conn->error);
            ini_set("display_error", false);
        }
    }

    public function agregarseg($fecha, $descripcion, $caso) {
        $sql = "INSERT INTO seguimiento (id_seg, fecha_seg, desc_seg, num_caso) VALUES (NULL, '$fecha', '$descripcion', '$caso')";
        $consulta = $this->conn->query($sql);
        echo 1;

        if ($consulta) {
            return TRUE;
        } else {
            die($this->conn->error);
        }
    }

    // *** FUNCIÓN CORREGIDA - AGREGAR FALLA CON DESCRIPCIÓN ***
    public function agregarfal($falla, $caso, $decision, $costo, $descripcion = '') {
        // Escapar la descripción para evitar inyección SQL
        $descripcion = $this->conn->real_escape_string($descripcion);
        
        // Incluir la descripción en la consulta
        $sql = "INSERT INTO postventas_has_falla (id_pos_has_fal, postventas_num_caso, falla_id_fal, dec_gar, costo, descripcion) 
                VALUES (NULL, '$caso', '$falla', '$decision', '$costo', '$descripcion')";
        
        $consulta = $this->conn->query($sql);

        if ($consulta) {
            return TRUE;
        } else {
            die($this->conn->error);
        }
    }

    // *** FUNCIÓN ALTERNATIVA - Si prefieres mantener el nombre original ***
    public function agregarfal_con_descripcion($falla, $caso, $decision, $costo, $descripcion) {
        return $this->agregarfal($falla, $caso, $decision, $costo, $descripcion);
    }

    public function editarseguimiento($id, $descripcion) {
        $sql = "UPDATE seguimiento SET desc_seg = '$descripcion' WHERE id_seg = '$id'";
        $consulta = $this->conn->query($sql);
        echo 1;

        if ($consulta) {
            return TRUE;
        } else {
            die($this->conn->error);
        }
    }

    public function editarfallacaso($valor, $casofalla) {
        $sql = "UPDATE postventas_has_falla SET falla_id_fal = '$valor' WHERE id_pos_has_fal = '$casofalla'";
        $consulta = $this->conn->query($sql);
        echo 1;

        if ($consulta) {
            return TRUE;
        } else {
            die($this->conn->error);
        }
    }

    public function editargarantia($id, $decision, $descripcion, $costod) {
        $sql = "UPDATE postventas_has_falla SET dec_gar = '$decision', descripcion = '$descripcion', costo = '$costod' 
                WHERE id_pos_has_fal = '$id'";
        $consulta = $this->conn->query($sql);
        echo 1;

        if ($consulta) {
            return TRUE;
        } else {
            die($this->conn->error);
        }
    }

    public function finalizarcaso($conformidad, $fechafinal, $caso, $estado) {
        $sql = "UPDATE postventas SET conformidad = '$conformidad', fec_cul_recl = '$fechafinal', estado = '$estado' 
                WHERE num_caso = '$caso'";
        $consulta = $this->conn->query($sql);
        echo 1;

        if ($consulta) {
            return TRUE;
        } else {
            die($this->conn->error);
        }
    }
}
?>