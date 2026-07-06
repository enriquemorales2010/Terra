<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/falla.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');

$ID_fallas = $_GET['id_pos_has_fal'];


$con = new fallas();

      $sql = "SELECT falla.id_fal, falla.etiq_falla, falla.clase_falla_id_clase_falla, falla.tipo_falla_id_tipo_falla, clase_falla.id_clase_falla, clase_falla.etiqueta_clase, tipo_falla.id_tipo_falla, tipo_falla.etiqueta_tipo, postventas_has_falla.id_pos_has_fal,postventas_has_falla.postventas_num_caso, postventas_has_falla.falla_id_fal FROM falla INNER JOIN clase_falla ON falla.clase_falla_id_clase_falla = clase_falla.id_clase_falla INNER JOIN tipo_falla ON falla.tipo_falla_id_tipo_falla = tipo_falla.id_tipo_falla INNER JOIN postventas_has_falla ON falla.id_fal = postventas_has_falla.falla_id_fal WHERE postventas_has_falla.id_pos_has_fal ='$ID_fallas';";
$consulta = $con->conn->query($sql);

if ($consulta) {
  
  if ($consulta->num_rows > 0) {

    while ($fila = mysqli_fetch_assoc($consulta)) {
      $etiqueta = $fila['etiq_falla'];
      $caso = $fila['postventas_num_caso'];
      $falla_id = $fila['id_fal'];
      $idclase = $fila['id_clase_falla'];
      $etiquetaclase = $fila['etiqueta_clase'];
      $idtipo = $fila['id_tipo_falla'];
      $etiquetatipo = $fila['etiqueta_tipo'];



      

  /*   if ($fila['dec_gar'] == 0) {
        $estado = "En espera";
         $clase = "btn btn-xs btn-success";
        }elseif ($fila['dec_gar'] == 1) {
          $estado = "Aplica";
          $clase = "btn btn-xs  btn-warning";
        }elseif ($fila['dec_gar'] == 2) {
          $estado = "No Aplica";
          $clase = "btn btn-xs btn-danger";
        }else {
         $estado = "LLamar al encargado";
         $clase = "btn btn-xs btn-danger";
              }
*/
  
      


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
              <i class="fa fa-user"></i> Falla <strong>#<?php echo "$ID_fallas";?></strong> del Caso <strong>#<?php  echo"$caso" ?></strong>
              <small>Pagina para Editar una Falla en un caso. <i class="fa fa-info"></i></small>
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
              <h3 class="box-title"><b>Etiqueta de Falla</b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form method="post" id="editar_fal_caso">

                    <!--id="editar_fal_caso"-->

                    <div class="form-group col-md-4">
                    <label for="prov_serv"> <i class="fa fa-exclamation-triangle"></i>Clase de Fallas</label>
                    <select id="clase_falla" name="clase_falla" class="form-control" onchange="return cambiarElemento(event)" required>
                      <option selected="selected" value="">Seleccione una opción</option>
                      <?php  

                        $con5 = new fallas();
                        $sql5 = " SELECT * FROM clase_falla";
                        $consulta5 = $con->conn->query($sql5);
                        if ($consulta5) {
                          if ($consulta5->num_rows > 0) {
                            while ($fila = mysqli_fetch_assoc($consulta5)) {
                              $id_clase = $fila['id_clase_falla'];
                              $nombre = $fila['etiqueta_clase'];



                              echo "<option value='".$id_clase."'>".$nombre."</option>";
                            }
                          }else {
                            echo "<option selected='selected' value=''>NO HAY FALLAS (LLAMAR AL ENCARGADO)</option>";
                          }
                        }

                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                  <label for="prov_serv"> <i class="fa fa-exclamation-triangle"></i> Elemento de Falla</label>
                  <select  class="form-control" id="elemento" onchange="return cambiarfalla(event)" required>
                      <option value="">Debes Seleccionar Primero Clases</option>
                  </select>
                  </div>
                  <div class="form-group col-md-4">
                  <label for="prov_serv"> <i class="fa fa-exclamation-triangle"></i> Fallas</label>
                  <select class="form-control" name="id_fallas" id="id_fallas" required>
                      <option value="">Debes Selecciona Primero Elemento</option>
                  </select>
                  </div>
                    
                
                      
                      

                       <div class='form-group col-md-12'>
                          <p class='help-block' style='color:red;'><i class='fa fa-info'></i> Recuerde llenar todos los campos</p>
                       </div>
                       
                        <div class="form-group col-md-4">
                        <label for='estado'> <i class='fa fa-eye'></i> Clase Actual</label>
                          <input type="text" class='form-control' value="<?php echo $etiquetaclase; ?>" disabled>
                          <input type="hidden" class='form-control'  value="<?php echo $idclase; ?>">
                        </div>
                                         
                       
                         <div class="form-group col-md-4">
                        <label for='estado'> <i class='fa fa-eye'></i> Elemento Actual</label>
                          <input type="text" class='form-control' value="<?php echo $etiquetatipo; ?>" disabled>
                          <input type="hidden" class='form-control' value="<?php echo $idtipo; ?>">
                        </div>
                       
                        
                          <div class="form-group col-md-4">
                        <label for='estado'> <i class='fa fa-eye'></i> Falla Actual</label>
                          <input type="text" class='form-control' value="<?php echo $etiqueta; ?>" disabled>
                          <input type="hidden" class='form-control' name="fallav" id="fallav" value="<?php echo $falla_id; ?>">
                        </div>

                       <div class='form-group col-md-8'>
                          <input type='hidden' name='caso_falla' id='caso_falla' value='<?php echo $ID_fallas; ?>'>
                          <input type="hidden" name='caso1' id='caso1' value='<?php echo $caso; ?>'>
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


function cambiarElemento(){
 $('#id_fallas').find('option').remove().end().append('<option value="">Seleccionar</option>').val('');
 $("#clase_falla option:selected").each(function () {
            
            clase_falla = $(this).val();
            
            $.post("modulos/gettipofallas.php", { clase_falla: clase_falla }, function(data){
              $("#elemento").html(data);
              
            });       
});

}

function cambiarfalla(){

 $("#elemento option:selected").each(function () {
            
            elemento = $(this).val();
            
            $.post("modulos/getffallas.php", { elemento: elemento }, function(data){
              
              $("#id_fallas").html(data);
              
            });       
});

}
  $('#cel_usuario').inputmask("(9999)-9999999");
  $('#tel_usuario').inputmask("(9999)-9999999");
</script>
</body>
</html>