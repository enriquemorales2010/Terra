<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/postventas.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');

$ID_fallas = $_GET['id_pos_has_fal'];


$con = new postventas();

$sql = "SELECT postventas_has_falla.id_pos_has_fal, postventas_has_falla.postventas_num_caso, postventas_has_falla.costo, postventas_has_falla.falla_id_fal, postventas_has_falla.dec_gar, postventas_has_falla.descripcion, postventas_has_falla.costo ,falla.etiq_falla FROM postventas_has_falla INNER JOIN falla ON postventas_has_falla.falla_id_fal = falla.id_fal WHERE postventas_has_falla.id_pos_has_fal ='$ID_fallas';";
$consulta = $con->conn->query($sql);

if ($consulta) {
  
  if ($consulta->num_rows > 0) {

    while ($fila = mysqli_fetch_assoc($consulta)) {

      $descripciion = $fila['descripcion'];
      $caso = $fila['postventas_num_caso'];
      $etiqueta = $fila['etiq_falla'];

        if($fila['costo'] == 0 && $fila['dec_gar'] == 0 ){
                                  $costoc = "Sin Costo Aun";
                                  $costod = $fila['costo'];
                                 }elseif($fila['costo'] == 0 && $fila['dec_gar'] == 2 ){
                                  $costoc = "Sin Costo";
                                  $costod = $fila['costo'];
                                 }else{
                                  $costod = $fila['costo'];
                                  $costod = number_format($costod, 0, ",", ".");
                                  $costoc = "CLP$ ".$costod."";
                                 }

                      
      

     if ($fila['dec_gar'] == 0) {
        $estado = "En espera";
         $clase = "btn btn-xs btn-warning";
        }elseif ($fila['dec_gar'] == 1) {
          $estado = "Aplica";
          $clase = "btn btn-xs  btn-success";
        }elseif ($fila['dec_gar'] == 2) {
          $estado = "No Aplica";
          $clase = "btn btn-xs btn-danger";
        }else {
         $estado = "LLamar al encargado";
         $clase = "btn btn-xs btn-danger";
              }
  
      


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
              <small>Pagina para Agregar información de una Falla en el caso. <i class="fa fa-info"></i></small>
            </h1>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Datos</a></li>
              <li class="active">Falla-Caso</li>
            </ol>
        </section>
      
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Descripcion de Garantia en la Falla de <?php echo $etiqueta; echo " #$ID_fallas"; ?></b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form method="post" id="editar_gar_caso" >

                       <!-- id="editar_gar_caso"-->
                       <div class='form-group col-md-12'>
                          <label for='dir_usuario'><i class='fa fa-pencil-square-o'></i> Descripcion de Garantia</label>
                          <textarea class='form-control' id='descripcion' name='descripcion' placeholder='Paz Gonzalez' onkeypress="return validarDir(event)" required maxlength="1250"><?php echo $descripciion; ?></textarea>
                       </div>

                       <div class='form-group col-md-2'>
                          <label for='costo'><i class='fa fa-pencil-square-o'></i> Costo de Garantia</label>
                          <input type="text" class="form-control" id="costo" name="costo" placeholder="Solo Ingresar Numeros" maxlength="8" onkeypress="return validarCedula(event)" value="<?php echo"$costod";?>" required>
                       </div>
                      
                      
                       <div class='form-group col-md-2'>
                          <label for='estado'> <i class='fa fa-eye'></i> Estado de Garantia</label>
                          <select name='estado' id='estado' class='form-control' required>
                            <?php if($estado == "En espera") { ?>
                             <option selected='selected' value='0'><?php echo $estado; ?></option>
                             <option value='1'>Aplica</option>
                             <option value='2'>No Aplica</option>
                             <?php }elseif($estado == "Aplica") { ?>
                             <option selected='selected' value='1'><?php echo $estado; ?></option>
                             <option value='2'>No Aplica</option>
                              <option value='0'>En Espera</option>
                             <?php }elseif($estado == "No Aplica") { ?>
                             <option selected='selected' value='2'><?php echo $estado; ?></option>
                             <option value='1'>Aplica</option>
                              <option value='0'>En Espera</option>
                             <?php }else { ?>
                             <option selected='selected' value='0'>LLamar a encargado...</option>
                             
                             <?php }; ?>
                          </select>
                       </div>

                       <div class='form-group col-md-12'>
                          <p class='help-block' style='color:red;'><i class='fa fa-info'></i> Recuerde llenar todos los campos</p>
                       </div>
                       <div class="col-md-12">
                        <hr>
                        
                        <div class="col-md-4">
                          <div class="form-group col-md-6">
                        <label for='estado'> <i class='fa fa-eye'></i> Estado Actual</label>
                          <input type="text" class='form-control' value="<?php echo $estado; ?>" disabled>
                        </div>
                        </div>
                        
                        <div class="col-md-4">
                          <div class="form-group col-md-8">
                        <label for='estado'> <i class='fa fa-eye'></i> Costo Actual de Falla</label>
                          <input type="text" class='form-control' value="<?php echo $costoc; ?>" disabled>
                        </div>
                        </div>

                       </div>


                       <div class='form-group col-md-8'>
                          <input type='hidden' name='caso_garantia' id='caso_garantia' value='<?php echo $ID_fallas; ?>'>
                          <input type='hidden' name='caso_post' id='caso_post' value='<?php echo $caso; ?>'>
                          <input type='hidden' name='costoo' id='costoo' value='<?php echo $costod; ?>'>
                       </div>
                      <div class='col-md-12'>
                        <a type='button' class='btn btn-danger pull-left' href='postventa_detalles.php?num_caso=<?php echo $caso?>'>Cancelar Proceso</a>
                        <button type='submit' name='submit' class='btn btn-success pull-right'>Editar Datos</button>
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

  function validarCedula(e) 
  { 
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron = /\d/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Debes ingresar solo números.");
    };
    return patron.test(te); 
  }

  $('#cel_usuario').inputmask("(9999)-9999999");
  $('#tel_usuario').inputmask("(9999)-9999999");
</script>
</body>
</html>