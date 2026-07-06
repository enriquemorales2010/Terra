<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/estadistica.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');

$id = $_GET['idestadisticas'];

$con = new estadisticas();

$sql = "SELECT estadisticas.idestadisticas, estadisticas.mes, estadisticas.year, estadisticas.fecha, estadisticas.perdidos, estadisticas.arrastrados, estadisticas.accidentados, estadisticas.profesionales, estadisticas.edificio_id_ed, edificio.nom_ed FROM estadisticas 
                  INNER JOIN edificio ON estadisticas.edificio_id_ed = edificio.id_ed
    WHERE estadisticas.idestadisticas ='$id';";
$consulta = $con->conn->query($sql);

if ($consulta) {
  
  if ($consulta->num_rows > 0) {

    while ($fila = mysqli_fetch_assoc($consulta)) {

     $fecha = $fila['fecha'];
     $fecha = date("Y-m",strtotime($fecha));
     $perdidos = $fila['perdidos'];
     $arrastrados = $fila ['arrastrados'];
     $accidentados  = $fila['accidentados'];
     $profesionales = $fila['profesionales'];
     $edificio_id_ed = $fila['edificio_id_ed'];
     $proyecto = $fila['nom_ed'];

  

    }

  }

}







?>

<!DOCTYPE html>
<html>
<head>
  <title>Terra - Editar Datos de Estadisticas de Prevención</title>
  <?php echo head(); ?>
</head>
<body class="hold-transition skin-red sidebar-mini">
  <div class="wrapper">
    
    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
        <!-- Logo -->
      <a href="index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><i class="fa fa-info"></i> </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"> <i class="fa fa-info"></i> <b>Inicio</b></span>
      </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <?php include_once('modulos/barratop.php'); ?>
        </nav>
      </header>

    <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <?php include_once('modulos/menu.php');
                if ($_SESSION['perfil'] == "Super Administrador") {
                  echo menuSuperAdministrador();
                }elseif ($_SESSION['perfil'] == "Encargado de Calidad") {
                  echo menuencCalid();
                 }elseif ($_SESSION['perfil'] == "Administrador") {
                  echo menuAdministrador();
                }elseif ($_SESSION['perfil'] == "Ejecutivo Post-Ventas") {
                  echo menuEjecutivo();
                }elseif ($_SESSION['perfil'] == "Coordinador de Calidad") {
                  echo menuCoorCalid();
                }elseif ($_SESSION['perfil'] == "Prevencion de Riesgo") {
                  echo menuPrevRies();
                }elseif ($_SESSION['perfil'] == "Oficina Tecnica") {
                  echo menuOfTec();
                }elseif ($_SESSION['perfil'] == "Usuario Basico") {
                  echo menuUsuarioB();
                }else {
                  echo menuLlamarEncargado();
                }
                ?>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              <i class="fa fa-user"></i> Estadisticas de Prev. de Riesgo.
              <small>Pagina para editar información de Estadisticas Mesuales. <i class="fa fa-info"></i></small>
            </h1>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> </a></li>
              <li class="active">Estadisticas de Prevención</li>
            </ol>
        </section>
      
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Editar Datos de La Estadistica de Fecha: <?php echo "$fecha"; ?></b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                    <form method="post" id="editar_estad" >
                      <!--id="editar_estad"-->
                      <!--action="modulos/edit_estadistica.php"-->
                       <div class='form-group col-md-4'>
                          <label for='email_usuario'><i class='fa fa-pencil'></i> Mes/Año: </label>
                          <input type='month' class='form-control' id='fecha' name='fecha'  value='<?php echo"$fecha";?>' maxlength="50" required>
                       </div>
                                
              
                       <div class="form-group col-md-4">
                       <label for="clase_falla"> <i class="fa fa-caret-square-o-down"></i> Obra</label>
                       <select id="proyecto" name="proyecto" class="form-control" required>
                          <option selected="selected" value="0">Seleccione una opción</option>
                           <?php  

                        $con = new estadisticas();
                        $sql = "SELECT * FROM edificio;";
                        $consulta = $con->conn->query($sql);

                        if ($consulta) {
                          if ($consulta->num_rows > 0) {
                            while ($fila = mysqli_fetch_assoc($consulta)) {
                              $ID = $fila['id_ed'];
                              $nombre = $fila['nom_ed'];

                              echo "<option value='".$ID."'>".$nombre."</option>";
                            }
                          }else {
                            echo "<option selected='selected' value=''>NO HAY OBRAS (LLAMAR A ENCARGADO)</option>";
                          }
                        }

                      ?>
                       </select>
                      </div>


                  <div class="form-group col-md-12 well well-sm text-center"><strong>Datos.</strong></div>

                  <div class="form-group col-md-3 alerta">
                    <label for="email_usuario"><i class="fa fa-envelope"></i> Accidentes </label>
                    <input type="text" class="form-control" id="accidentados" name="accidentados" placeholder="Solo Numeros" maxlength="3" onkeypress="return validarNum(event)"  value='<?php echo"$accidentados";?>' >
                  </div>

                   <div class="form-group col-md-3 alerta">
                    <label for="email_usuario"><i class="fa fa-envelope"></i> Dias Perdidos </label>
                    <input type="text" class="form-control" id="perdidos" name="perdidos" placeholder="Solo Numeros" maxlength="3" onkeypress="return validarNum(event)" title="Maximo 3 Digitos" 
                    value='<?php echo"$perdidos";?>'>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="pass_usuario"><i class="fa fa-unlock"></i> Dias Arrastrados</label>
                    <input type="text" class="form-control" id="arrastrados" name="arrastrados" placeholder="Solo Numeros" title="Maximo 3 Digitos" maxlength="3" onkeypress="return validarNum(event)"
                     value='<?php echo"$arrastrados";  ?>' >
                  </div>

                   
                  <div class="form-group col-md-3">
                    <label for="pass_usuario"><i class="fa fa-unlock"></i> Enfermedades Prof.</label>
                    <input type="text" class="form-control" id="profesionales" name="profesionales" placeholder="Solo Numeros" title="Maximo 3 Digitos" maxlength="3" onkeypress="return validarNum(event)" value='<?php echo"$profesionales";?>'>
                  </div>

                     <div class="col-md-12 with-border">
                       <div class="col-md-12 with-border">
                        <p class='help-block' style='color:red;'><i class='fa fa-info'></i> Recuerde llenar todos los campos</p>
                        
                        <div class="col-md-6"> 

                          <div class="form-group col-md-6">
                        <label for='estado'> <i class='fa fa-eye'></i> Fecha Actual</label>
                          <input type="month" class='form-control' value="<?php echo $fecha; ?>" disabled>
                        </div>
                         <div class="form-group col-md-6">
                          <label for='estado'> <i class='fa fa-eye'></i> Obra Actual</label>
                          <input type="text" class='form-control' value="<?php echo $proyecto; ?>" disabled>
                          <input type="hidden" class='form-control' name='proyectov' id='proyectov' value="<?php echo $edificio_id_ed; ?>">
                        </div>
                        </div>
                       </div>
                       <div class='form-group col-md-8'>
                          <input type='hidden' name='id_estadistica' id='id_estadistica' value='<?php echo $id; ?>'>
                       </div>
                      <div class='col-md-12'>
                        <a type='button' class='btn btn-danger pull-left' href='lista_estadisticas.php'>Cancelar Proceso</a>
                        <button type='submit' name='submit' class='btn btn-success pull-right'>Editar Datos</button>
                      </div>
            </div>
      



              
          </form>
          </div><!-- /.box-body -->

        </div>
          
        </section><!-- cierre content -->




      </div><!-- /.content-wrapper - Contenedor Principal de la Página -->

      <?php echo insertar_footer(); ?>



  </div><!-- ./wrapper -->

  <?php echo insertarScripts(); ?>

<script type="text/javascript">

function validarLetras(e) 
  {
    tecla = (document.form) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[A-Za-z\sáéíóúñÁÉÍÓÚÑ']{1,45}$/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Debes ingresar solo letras.");
    };
    return patron.test(te);
  }

function validarCorreo(e) 
  { 

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[A-Za-z0-9_.\-@]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Debes ingresar solo letras, números y caracteres como: _.\-");
    };
    return patron.test(te); 

  }

function validarPass(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/^[A-Za-z0-9]{1,16}$/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Para la contraseña debe ingresar solo letras y números y debe tener mínimo 8 dígitos.");
    };
    return patron.test(te); 

  }

function validarDir(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[A-Za-z0-9\sáéíóúñÁÉÍÓÚÑ'_.\-#,/()]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Para la dirección son validos: letras, números y los caracteres especiales: ,.-/@*#!");
    };
    return patron.test(te); 

  }

    function validarNum(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[0-9]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal({
    title: "Error",
    text: "Solo Puede Ingresar Numeros.",
    type: 'error'
    });
    };
    return patron.test(te); 

  }

  $('#cel_usuario').inputmask("(9999)-9999999");
  $('#tel_usuario').inputmask("(9999)-9999999");
</script>
</body>
</html>