<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/falla.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');

$id = $_GET['id_fal'];

$con = new fallas();

$sql = "SELECT falla.id_fal, falla.clase_falla_id_clase_falla, falla.tipo_falla_id_tipo_falla, falla.etiq_falla, clase_falla.etiqueta_clase, tipo_falla.etiqueta_tipo FROM falla 
    INNER JOIN clase_falla ON falla.clase_falla_id_clase_falla =  clase_falla.id_clase_falla 
    INNER JOIN tipo_falla ON falla.tipo_falla_id_tipo_falla = tipo_falla.id_tipo_falla
    WHERE  falla.id_fal ='$id';";
$consulta = $con->conn->query($sql);

if ($consulta) {
  
  if ($consulta->num_rows > 0) {

    while ($fila = mysqli_fetch_assoc($consulta)) {

     $etiqueta_falla = $fila['etiq_falla'];
     $idclase = $fila['clase_falla_id_clase_falla'];
     $idtipo = $fila ['tipo_falla_id_tipo_falla'];
     $etiquetaclase  = $fila['etiqueta_clase'];
     $etiquetatipo = $fila['etiqueta_tipo'];


      

    }

  }

}







?>

<!DOCTYPE html>
<html>
<head>
  <title>Terra - Editar Datos de Usuario</title>
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
              <i class="fa fa-user"></i> Falla
              <small>Pagina para editar información de una Falla. <i class="fa fa-info"></i></small>
            </h1>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Datos</a></li>
              <li class="active">Falla</li>
            </ol>
        </section>
      
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Editar Datos de Falla</b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                    <form method="post" id="editar_fal">
                       <div class='form-group col-md-4'>
                          <label for='email_usuario'><i class='fa fa-pencil'></i> Nombre de Falla</label>
                          <input type='text' class='form-control' id='etiqueta' name='etiqueta' placeholder='etiqueta' value='<?php echo $etiqueta_falla; ?>' maxlength="50" onkeypress="return validarLetras(event)" required>
                       </div>
                                
              
                       <div class="form-group col-md-4">
                       <label for="clase_falla"> <i class="fa fa-caret-square-o-down"></i> Clase de falla</label>
                       <select id="clase_falla" name="clase_falla" class="form-control" required>
                          <option selected="selected" value="0">Seleccione una opción</option>
                           <?php  

                        $con = new fallas();
                        $sql = "SELECT * FROM clase_falla;";
                        $consulta = $con->conn->query($sql);

                        if ($consulta) {
                          if ($consulta->num_rows > 0) {
                            while ($fila = mysqli_fetch_assoc($consulta)) {
                              $ID = $fila['id_clase_falla'];
                              $nombre = $fila['etiqueta_clase'];

                              echo "<option value='".$ID."'>".$nombre."</option>";
                            }
                          }else {
                            echo "<option selected='selected' value=''>NO HAY CLASES DE FALLA (LLAMAR A ENCARGADO)</option>";
                          }
                        }

                      ?>
                       </select>
                      </div>

                      <div class="form-group col-md-4">
                       <label for="tipo_Falla"> <i class="fa fa-caret-square-o-down"></i> Elementos de falla</label>
                       <select id="tipo_falla" name="tipo_falla" class="form-control" required>
                          <option selected="selected" value="0">Seleccione una opción</option>
                           <?php  

                        $con = new fallas();
                        $sql = "SELECT * FROM tipo_falla;";
                        $consulta = $con->conn->query($sql);

                        if ($consulta) {
                          if ($consulta->num_rows > 0) {
                            while ($fila = mysqli_fetch_assoc($consulta)) {
                              $ID = $fila['id_tipo_falla'];
                              $nombre = $fila['etiqueta_tipo'];

                              echo "<option value='".$ID."'>".$nombre."</option>";
                            }
                          }else {
                            echo "<option selected='selected' value=''>NO HAY ELELEMTOS DE FALLAS (LLAMAR A ENCARGADO)</option>";
                          }
                        }

                      ?>
                       </select>
                      </div>
      



              <div class="col-md-12 with-border">
                       <div class="col-md-12 with-border">
                        <p class='help-block' style='color:red;'><i class='fa fa-info'></i> Recuerde llenar todos los campos</p>
                        
                        <div class="col-md-6"> 

                          <div class="form-group col-md-6">
                        <label for='estado'> <i class='fa fa-eye'></i> Clase de Falla Actual</label>
                          <input type="text" class='form-control' value="<?php echo $etiquetaclase; ?>" disabled>
                          <input type="hidden" class='form-control' name="clasev" id="clasev" value='<?php echo $idclase; ?>'>
                        </div>
                         <div class="form-group col-md-6">
                          <label for='estado'> <i class='fa fa-eye'></i> Elemento de Falla Actual</label>
                          <input type="text" class='form-control' value="<?php echo $etiquetatipo; ?>" disabled>
                          <input type="hidden" class='form-control' name="tipov" id="tipov" value='<?php echo $idtipo; ?>'>
                        </div>
                        </div>
                       </div>
                       <div class='form-group col-md-8'>
                          <input type='hidden' name='falla' id='falla' value='<?php echo $id; ?>'>
                       </div>
                      <div class='col-md-12'>
                        <a type='button' class='btn btn-danger pull-left' href='lista_falla.php'>Cancelar Proceso</a>
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

  $('#cel_usuario').inputmask("(9999)-9999999");
  $('#tel_usuario').inputmask("(9999)-9999999");
</script>
</body>
</html>