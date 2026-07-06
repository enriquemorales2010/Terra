<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/obs_m2.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');

$id_proyecto = $_GET['id_Proyecto'];

$con = new obs_pro();

$sql = "SELECT datos_proyecto.id_Proyecto, datos_proyecto.num_depto, datos_proyecto.piso, datos_proyecto.cant_m2, datos_proyecto.tipo_depto, datos_proyecto.edificio_id_ed, 
        edificio.nom_ed, edificio.id_ed FROM datos_proyecto
                  INNER JOIN edificio ON datos_proyecto.edificio_id_ed = edificio.id_ed 
              WHERE datos_proyecto.id_proyecto='$id_proyecto';";
$consulta = $con->conn->query($sql);

  
  if ($consulta->num_rows > 0) {

    while ($fila = mysqli_fetch_assoc($consulta)) {
      $depto = $fila['num_depto'];
      $piso = $fila['piso'];
      $m2 = $fila['cant_m2'];
      $tipo = $fila['tipo_depto'];
      $nombre_ed = $fila['nom_ed'];
      $id_ed = $fila['id_ed'];
  

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
              <i class="fa fa-user"></i> Datos de Proyecto Para Obs.
              <small>Pagina para editar información de Proyecto. <i class="fa fa-info"></i></small>
            </h1>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> </a></li>
              <li class="active">Datos de Proyecto</li>
            </ol>
        </section>
      
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Editar Datos de Proyecto de Revisión</b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                    <form method="post" id="edit_datos_proyecto" >
                      <!--id="edit_datos_proyecto" -->
                      <!--action="modulos/edit_datos_pro.php"-->
                                
              
                       <div class="form-group col-md-4">
                       <label for="proyecto"> <i class="fa fa-building"></i> Edificio</label>
                       <select id="proyecto" name="proyecto" class="form-control" required>
                          <option selected="selected" value="0">Seleccione una opción</option>
                           <?php  

                        $con = new obs_pro();
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
                            echo "<option selected='selected' value=''>NO HAY PROYECTO (LLAMAR A ENCARGADO)</option>";
                          }
                        }

                      ?>
                       </select>
                      </div>
                  
                   <div class="form-group col-md-3 alerta">
                    <label for="email_usuario"><i class="fa fa-caret-square-o-right"></i> Piso: </label>
                    <input type="text" class="form-control" id="piso" name="piso" placeholder="Solo Numeros" maxlength="3" onkeypress="return validarNum(event)"  value='<?php echo"$piso";?>' >
                  </div>

              
                  <div class="form-group col-md-3 alerta">
                    <label for="email_usuario"><i class="fa fa-caret-square-o-right"></i> Numero de Depto: </label>
                    <input type="text" class="form-control" id="num_dep" name="num_dep" placeholder="Solo Numeros" maxlength="3" onkeypress="return validarNum(event)"  value='<?php echo"$depto";?>' >
                  </div>

                  <div class="form-group col-md-2">
                    <label for="nombre"><i class="fa fa-caret-square-o-right"></i> Total de M2:</label>
                    <input type="text" class="form-control" id="cant_mtrs" name="cant_mtrs" onkeypress="return validarMtrs(event)"  maxlength="6" required value='<?php echo"$m2";?>'>
                  </div>
                  
                  <div class="form-group col-md-2">
                    <label for="tel_rec"><i class="fa fa-caret-square-o-right"></i> Tipo de Depto: </label>
                    <input type="text" class="form-control" id="tipo_depto" name="tipo_depto" onkeypress="return validartipoDept(event)"  required  maxlength="4"
                    value='<?php echo"$tipo";?>' >
                  </div>
             

                     <div class="col-md-12 with-border">
                       <div class="col-md-12 with-border">
                        <p class='help-block' style='color:red;'><i class='fa fa-info'></i> Recuerde llenar todos los campos</p>
                        
                        <div class="col-md-6"> 

                        <div class="form-group col-md-6">
                          <label for='estado'> <i class='fa fa-eye'> </i> <i class="fa fa-building"></i> Edificio Actual</label>
                          <input type="text" class='form-control' value="<?php echo $nombre_ed; ?>" disabled>
                          <input type="hidden" class='form-control' name='proyectov' id='proyectov' value="<?php echo $id_ed; ?>">
                        </div>
                        </div>
                       </div>
                       <div class='form-group col-md-8'>
                          <input type='hidden' name='id_Proyecto' id='id_Proyecto' value='<?php echo $id_proyecto; ?>'>
                       </div>
                      <div class='col-md-12'>
                        <a type='button' class='btn btn-danger pull-left' href='lista_m2.php'>Cancelar Proceso</a>
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

   function validartipoDept(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[A-Z0-9/-]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("SOLO LETRAS MAYUSCULAS Y NUMEROS");
    };
    return patron.test(te); 

  }

   function validarMtrs(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[0-9\.]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Solo puedes Ingresar Numeros y Como Separador de decimales el punto(.)");
    };
    return patron.test(te); 

  }

  $('#cel_usuario').inputmask("(9999)-9999999");
  $('#tel_usuario').inputmask("(9999)-9999999");
</script>
</body>
</html>