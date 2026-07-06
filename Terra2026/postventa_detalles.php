<?php  
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION['usuario'])) {
    header('Location: error_login.php?error=true');
    exit();
}

include_once('clases/postventas.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');

$num_cas = $_REQUEST['num_caso'];
$sesion = $_SESSION['perfil'];

$con = new postventas();

// Consulta principal
$sql2 = "SELECT perfil.eti_per, postventas.num_caso, postventas.nom_rec, 
                postventas.tip_con, postventas.num_dep, postventas.desc_caso, 
                postventas.fec_ini_rec, postventas.fec_cul_recl, postventas.estado, 
                postventas.id_ed, usuario.rut_usu, postventas.conformidad, 
                usuario.nom_usu, usuario.ape_usu, usuario.cor_usu 
         FROM perfil 
         INNER JOIN usuario ON usuario.id_per = perfil.id_per 
         INNER JOIN postventas ON usuario.rut_usu = postventas.rut_usu 
         WHERE postventas.num_caso = '$num_cas'";

$consulta2 = $con->conn->query($sql2);

$nom_recl = "";
$dept = "";
$freclamo = "";
$describir = "";
$contrato = "";
$usuarioc = "";
$rut = "";
$correou = "";
$conform = "";
$fecha_culminacion = "";
$estado_caso = "";

if ($consulta2 && $consulta2->num_rows > 0) {
    while ($fila = mysqli_fetch_assoc($consulta2)) {
        $nom_recl = $fila['nom_rec'];
        $dept = $fila['num_dep'];
        $freclamo = $fila['fec_ini_rec'];
        $freclamo = date("d-m-Y", strtotime($freclamo));
        $describir = $fila['desc_caso'];
        $contrato = $fila['tip_con'];
        $nomu = $fila['nom_usu'];
        $apeu = $fila['ape_usu'];
        $usuarioc = $nomu . " " . $apeu;
        $rut = $fila['rut_usu'];
        $correou = $fila['cor_usu'];
        $fecha_culminacion = $fila['fec_cul_recl'];
        $estado_caso = $fila['estado'];

        if ($contrato) {
            $contrato = ($contrato == '1') ? "Propietario" : "Arrendatario";
        }

        if ($fila['conformidad'] == 0) {
            $conform = "En Espera";
        } elseif ($fila['conformidad'] == 1) {
            $conform = "Conforme";
        } elseif ($fila['conformidad'] == 2) {
            $conform = "No Conforme";
        } else {
            $conform = "Llamar a Encargado PivotData.cl";
        }
    }
}

// Consulta edificio
$sql3 = "SELECT edificio.nom_ed, edificio.fecha_rec 
         FROM edificio 
         INNER JOIN postventas ON postventas.id_ed = edificio.id_ed 
         WHERE postventas.num_caso = '$num_cas'";
$consulta3 = $con->conn->query($sql3);

$nom_edif = "";
$recepcion = "";

if ($consulta3 && $consulta3->num_rows > 0) {
    while ($fila = mysqli_fetch_assoc($consulta3)) {
        $nom_edif = $fila['nom_ed'];
        $recepcion = date("d-m-Y", strtotime($fila['fecha_rec']));
    }
}

// Consulta suma costos
$sql4 = "SELECT SUM(costo) as total FROM postventas_has_falla WHERE postventas_num_caso = '$num_cas'";
$consulta4 = $con->conn->query($sql4);

$sumatotal = "CLP$0";

if ($consulta4 && $consulta4->num_rows > 0) {
    while ($fila = mysqli_fetch_array($consulta4)) {
        if ($fila['total'] > 0) {
            $sumatotal_val = number_format($fila['total'], 0, ",", ".");
            $sumatotal = "CLP$" . $sumatotal_val;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Terra Constructora - Sistema de Gestión de Datos</title>
    <?php echo head(); ?>
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">
        <a href="index.php" class="logo">
            <span class="logo-mini"><i class="fa fa-info"></i> </span>
            <span class="logo-lg"> <i class="fa fa-info"></i> <b>Inicio</b></span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">
            <?php include_once('modulos/barratop.php'); ?>
        </nav>
    </header>

    <!-- Sidebar -->
    <aside class="main-sidebar">
        <section class="sidebar">
            <?php 
            include_once('modulos/menu.php');
            if ($_SESSION['perfil'] == "Super Administrador") {
                echo menuSuperAdministrador();
            } elseif ($_SESSION['perfil'] == "Encargado de Calidad") {
                echo menuencCalid();
            } elseif ($_SESSION['perfil'] == "Administrador") {
                echo menuAdministrador();
            } elseif ($_SESSION['perfil'] == "Ejecutivo Post-Ventas") {
                echo menuEjecutivo();
            } elseif ($_SESSION['perfil'] == "Coordinador de Calidad") {
                echo menuCoorCalid();
            } elseif ($_SESSION['perfil'] == "Prevencion de Riesgo") {
                echo menuPrevRies();
            } elseif ($_SESSION['perfil'] == "Oficina Tecnica") {
                echo menuOfTec();
            } elseif ($_SESSION['perfil'] == "Usuario Basico") {
                echo menuUsuarioB();
            } else {
                echo menuLlamarEncargado();
            }
            ?>
        </section>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <i class="fa fa-exclamation-circle"></i> Detalles de Caso #<?php echo $num_cas; ?>
                <small>Página para el detalle de Caso de PostVentas</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Datos</a></li>
                <li class="active">Detalles de Caso</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">

                <!-- Información caso -->
                <div class="col-md-8">
                    <div class="small-box bg-blue">
                        <div class="box-body">
                            <h4>Numero de Caso:  <strong>#<?php echo $num_cas; ?></strong></h4>
                            <p class="col-xs-5"><b>Nombre del Reclamador:</b> <?php echo $nom_recl; ?></p>
                            <p class="col-xs-5"><b>Tipo de Contrato:</b> <?php echo $contrato; ?></p>
                            <p class="col-xs-5"><b>Edificio:</b> <?php echo $nom_edif; ?></p>
                            <p class="col-xs-5"><b>N. de Departamente: </b> <?php echo $dept; ?></p>
                            <p class="col-xs-5"><b>Fecha del Reclamo: </b> <?php echo $freclamo; ?></p>
                            <p class="col-xs-5"><b>Fecha Recep. Mun. :</b> <?php echo $recepcion; ?></p>
                            <p class="col-xs-5"><b>Conformidad del Caso:</b> <?php echo $conform; ?></p>
                            <p class="col-xs-5"><b>Costo Total:</b> <?php echo $sumatotal; ?></p>
                            <p class="col-xs-12"><b>Descripción del Caso: </b> <?php echo $describir; ?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-info-circle"></i>
                        </div>
                        <a href="#" class="small-box-footer"><h4>Información del Caso</h4></a>
                    </div>
                </div>

                <!-- Información encargado -->
                <div class="col-md-4">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h4><b>Nombre:</b> <?php echo $usuarioc; ?></h4>
                            <p><b>Correo:</b> <?php echo $correou; ?> </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="#" class="small-box-footer"><h4>Información del Empleado Encargado</h4></a>
                    </div>
                </div>

                <!-- Fallas -->
                <div class="col-md-12">
                    <div class="box box-default box-solid">
                        <div class="box-header with-border">
                            <!-- BOTÓN CON DATA-TOGGLE (IGUAL QUE EN LA PÁGINA QUE FUNCIONA) -->
                            <button type="button" class="btn btn-xs btn-info pull-right"
                                    style="margin-right: 5%;"
                                    data-toggle="modal" 
                                    data-target="#agregar_falla_modal">
                                <i class="fa fa-plus"></i> Agregar Falla
                            </button>
                            <h3 class="box-title">Fallas</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <?php  
                                $sql4 = "SELECT postventas.num_caso,
                                                postventas_has_falla.id_pos_has_fal,
                                                postventas_has_falla.falla_id_fal,
                                                postventas_has_falla.dec_gar,
                                                postventas_has_falla.descripcion,
                                                postventas_has_falla.costo,
                                                clase_falla.etiqueta_clase,
                                                tipo_falla.etiqueta_tipo,
                                                postventas.fec_cul_recl,
                                                postventas.estado,
                                                falla.etiq_falla
                                         FROM falla
                                         INNER JOIN clase_falla ON falla.clase_falla_id_clase_falla = clase_falla.id_clase_falla
                                         INNER JOIN tipo_falla ON falla.tipo_falla_id_tipo_falla = tipo_falla.id_tipo_falla
                                         INNER JOIN postventas_has_falla ON falla.id_fal = postventas_has_falla.falla_id_fal
                                         INNER JOIN postventas ON postventas.num_caso = postventas_has_falla.postventas_num_caso
                                         WHERE postventas.num_caso = '$num_cas'";

                                $consulta4 = $con->conn->query($sql4);

                                if ($consulta4 && $consulta4->num_rows > 0) {
                                    echo "<table class='table table-hover'>
                                            <thead>
                                                <tr>
                                                    <th>Fallas</th>
                                                    <th>Elemento</th>
                                                    <th>Aplica</th>
                                                    <th>Descripción</th>
                                                    <th>Costo</th>
                                                    <th>Editar Falla</th>
                                                    <th>Garantia</th>
                                                </tr>
                                            </thead><tbody>";

                                    while ($fila = mysqli_fetch_assoc($consulta4)) {
                                        $ID_fallas = $fila['id_pos_has_fal'];

                                        if ($fila['dec_gar'] == 0) {
                                            $estado = "En espera";
                                            $clase = "btn btn-xs btn-warning";
                                        } elseif ($fila['dec_gar'] == 1) {
                                            $estado = "Aplica";
                                            $clase = "btn btn-xs btn-success";
                                        } elseif ($fila['dec_gar'] == 2) {
                                            $estado = "No Aplica";
                                            $clase = "btn btn-xs btn-danger";
                                        } else {
                                            $estado = "LLamar al encargado";
                                            $clase = "btn btn-xs btn-danger";
                                        }

                                        // Lógica para habilitar/deshabilitar links de edición
                                        if (!empty($fila['fec_cul_recl']) && $fila['estado'] == 1 && $sesion != "Super Administrador" && $sesion != "Administrador") {
                                            $linkf = "#";
                                            $linkg = "#";
                                            $disabledLink = "disabled='disabled'";
                                        } else {
                                            $linkf = "editar_falla_caso.php?id_pos_has_fal=" . $fila["id_pos_has_fal"];
                                            $linkg = "editar_garantia_caso.php?id_pos_has_fal=" . $fila["id_pos_has_fal"];
                                            $disabledLink = "";
                                        }

                                        if ($fila['costo'] == 0 && $fila['dec_gar'] == 0) {
                                            $costoc = "Sin Costo Aun";
                                        } elseif ($fila['costo'] == 0 && $fila['dec_gar'] == 2) {
                                            $costoc = "Sin Costo";
                                        } else {
                                            $costod = number_format($fila['costo'], 0, ",", ".");
                                            $costoc = "CLP$ " . $costod;
                                        }

                                        echo "<tr>
                                                <td>".$fila['etiq_falla']."</td>
                                                <td>".$fila['etiqueta_tipo']."</td>
                                                <td><span class='".$clase."'>".$estado."</span></td>
                                                <td>".$fila['descripcion']."</td>
                                                <td>".$costoc."</td>
                                                <td><a class='btn btn-xs btn-info' ".$disabledLink." href='".$linkf."'>Editar Falla</a></td>
                                                <td><a class='btn btn-xs btn-info' ".$disabledLink." href='".$linkg."'>Editar Garantia</a></td>
                                            </tr>";
                                    }
                                    echo "</tbody></table>";
                                } else {
                                    echo "<div style='text-align:center; color:red; padding:20px;'><h3>NO HAY FALLAS REGISTRADAS AUN</h3></div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL AGREGAR FALLA - IGUAL QUE EN LA PÁGINA QUE FUNCIONA -->
                <div class="modal fade" id="agregar_falla_modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">  
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">
                                    <b>Registrar Falla de Caso #<?php echo $num_cas; ?></b>
                                </h4>
                            </div>
                            <form role="form" method="post" action="modulos/agregar_falla.php" id="formAgregarFalla">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <input type="hidden" id="caso" name="caso" required value="<?php echo $num_cas; ?>">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="clase_falla">Clase de Falla</label>
                                            <select id="clase_falla" name="clase_falla" class="form-control" required>
                                                <option value="">Seleccione una opción</option>
                                                <?php  
                                                $sql5 = "SELECT * FROM clase_falla ORDER BY etiqueta_clase";
                                                $consulta5 = $con->conn->query($sql5);
                                                if ($consulta5 && $consulta5->num_rows > 0) {
                                                    while ($fila = mysqli_fetch_assoc($consulta5)) {
                                                        echo "<option value='".$fila['id_clase_falla']."'>".$fila['etiqueta_clase']."</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="elemento">Elemento</label>
                                            <select class="form-control" id="elemento" name="elemento" required>
                                                <option value="">Primero selecciona una clase</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="id_falla">Falla específica</label>
                                            <select class="form-control" id="id_falla" name="id_falla" required>
                                                <option value="">Primero selecciona un elemento</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="descripcion">Descripción de la falla</label>
                                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required placeholder="Ingrese una descripción detallada de la falla..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="submit" class="btn btn-success">
                                        <i class="fa fa-save"></i> Agregar Falla
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Botón Finalizar Caso -->
                <div class="col-md-12 text-right" style="margin-top: 20px;">
                    <button type="button" class="btn btn-success">
                        <i class="fa fa-check"></i> Finalizar Caso
                    </button>
                </div>

            </div>
        </section>
    </div>

    <?php echo insertar_footer(); ?>
</div>

<!-- Scripts generales -->
<?php echo insertarScripts(); ?>

<!-- Script para los selectores dinámicos (igual que en tu página que funciona) -->
<script>
$(document).ready(function() {
    console.log('Documento listo');
    
    // Cargar elementos cuando cambia la clase de falla
    $('#clase_falla').on('change', function() {
        var clase_falla = $(this).val();
        
        if (clase_falla) {
            $('#elemento').html('<option value="">Cargando...</option>');
            $('#id_falla').html('<option value="">Primero selecciona un elemento</option>');
            
            $.ajax({
                url: 'modulos/gettipofallas.php',
                type: 'POST',
                data: { clase_falla: clase_falla },
                success: function(data) {
                    $('#elemento').html(data);
                },
                error: function() {
                    $('#elemento').html('<option value="">Error al cargar</option>');
                    alert('Error al cargar los elementos');
                }
            });
        } else {
            $('#elemento').html('<option value="">Primero selecciona una clase</option>');
            $('#id_falla').html('<option value="">Primero selecciona un elemento</option>');
        }
    });

    // Cargar fallas cuando cambia el elemento
    $('#elemento').on('change', function() {
        var elemento = $(this).val();
        
        if (elemento) {
            $('#id_falla').html('<option value="">Cargando...</option>');
            
            $.ajax({
                url: 'modulos/getffallas.php',
                type: 'POST',
                data: { elemento: elemento },
                success: function(data) {
                    $('#id_falla').html(data);
                },
                error: function() {
                    $('#id_falla').html('<option value="">Error al cargar</option>');
                    alert('Error al cargar las fallas');
                }
            });
        } else {
            $('#id_falla').html('<option value="">Primero selecciona un elemento</option>');
        }
    });

    // Validar formulario antes de enviar
    $('#formAgregarFalla').on('submit', function(e) {
        if (!$('#clase_falla').val()) {
            e.preventDefault();
            alert('Debes seleccionar una clase de falla');
            return false;
        }
        if (!$('#elemento').val()) {
            e.preventDefault();
            alert('Debes seleccionar un elemento');
            return false;
        }
        if (!$('#id_falla').val()) {
            e.preventDefault();
            alert('Debes seleccionar una falla específica');
            return false;
        }
        if (!$('#descripcion').val().trim()) {
            e.preventDefault();
            alert('Debes ingresar una descripción');
            return false;
        }
    });

    // Limpiar formulario cuando se cierra el modal
    $('#agregar_falla_modal').on('hidden.bs.modal', function () {
        $('#formAgregarFalla')[0].reset();
        $('#elemento').html('<option value="">Primero selecciona una clase</option>');
        $('#id_falla').html('<option value="">Primero selecciona un elemento</option>');
    });
});
</script>
<!-- MODAL DE PRUEBA -->
<div class="modal fade" id="modalPrueba" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>MODAL DE PRUEBA</h4>
            </div>
            <div class="modal-body">
                <p>Si ves esto, Bootstrap funciona</p>
            </div>
        </div>
    </div>
</div>

<!-- BOTÓN DE PRUEBA -->
<button type="button" class="btn btn-danger" onclick="abrirPrueba()">
    PROBAR MODAL
</button>

<script>
function abrirPrueba() {
    // Intentar de todas las formas posibles
    try {
        // Forma 1
        jQuery('#modalPrueba').modal('show');
        console.log('Intento 1: usando jQuery');
    } catch(e) {
        console.log('Error 1:', e);
    }
    
    try {
        // Forma 2
        $('#modalPrueba').modal('show');
        console.log('Intento 2: usando $');
    } catch(e) {
        console.log('Error 2:', e);
    }
    
    try {
        // Forma 3 - JavaScript puro
        document.getElementById('modalPrueba').style.display = 'block';
        document.getElementById('modalPrueba').className += ' in';
        console.log('Intento 3: JS puro');
    } catch(e) {
        console.log('Error 3:', e);
    }
}

// Verificar qué está disponible
console.log('=== DIAGNÓSTICO ===');
console.log('jQuery disponible:', typeof jQuery !== 'undefined');
console.log('$ disponible:', typeof $ !== 'undefined');
console.log('Bootstrap modal disponible:', typeof $.fn.modal !== 'undefined');
console.log('Elemento modal existe:', document.getElementById('modalPrueba') !== null);
</script>
</body>

</html>