<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/obs_m2.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');

$id = $_GET['idRev'];

$con = new obs_pro();

$sql = "SELECT revision_proyecto.idRev, revision_proyecto.tipo_r, revision_proyecto.fecha_re, datos_proyecto.cant_m2, revision_proyecto.cant_obs, revision_proyecto.ob_mt, revision_proyecto.inspector, revision_proyecto.Datos_Proyecto_id_Proyecto, edificio.nom_ed, edificio.id_ed FROM datos_proyecto
INNER JOIN edificio ON edificio.id_ed = datos_proyecto.edificio_id_ed
INNER JOIN revision_proyecto ON datos_proyecto.id_Proyecto = revision_proyecto.Datos_Proyecto_id_Proyecto
WHERE revision_proyecto.idRev = '$id';";
$consulta = $con->conn->query($sql);

  
  if ($consulta->num_rows >= 0) {

    while ($fila = mysqli_fetch_assoc($consulta)) {
      $fecha = $fila['fecha_re'];
      $m2 = $fila['cant_m2'];
      $cant_obs = $fila['cant_obs'];
      //$tipo = $fila['tipo_depto'];
      $inspector = $fila['inspector'];
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
              <i class="fa fa-user"></i> Datos de Revision
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
                    <form method="post" id="editar_revision_proyecto">
                      <!--id="editar_revision_proyecto"-->
                      <!--action="modulos/edit_obser_m2.php"-->
                                

                  
            <div class="form-group col-md-4">
            <label for=""><i class="fa fa-calendar"></i> Fecha de Revision.</label>
            <input type="date" class="form-control" id="fecha_revision" name="fecha_revision" required maxlength="4" value='<?php echo $fecha;?>'>
            </div>

            <div class="form-group col-md-2 ">
            <label for="nombre"><i class="fa fa-hastang"></i> Total de M2:</label>
            <input type="text" class="form-control" id="cant_m2" name="cant_m2" maxlength="5" value='<?php echo $m2;?>' disabled  required>
            </div>

            <div class="form-group col-md-2">
            <label for="nombre"><i class="fa fa-hastang"></i>Cant. de Obs:</label>
            <input type="text" class="form-control" id="cant_obs" name="cant_obs" onkeypress="return validarMtrs(event)" onkeyup ="return Calculo(event)" maxlength="5" required value="<?php echo $cant_obs;?>">
            </div>

            <div class="form-group col-md-2">
            <label for="nombre"><i class="fa fa-hastang"></i>Obs. Por M2:</label>
            <input type="text" class="form-control" id="obs_m2" name="obs_m2"  maxlength="5"  required>
            </div>

            <div class="form-group col-md-4">
              <label for  ="tel_rec"><i class="fa fa-th"></i> Inspector:</label>
              <input type ="text" class="form-control" id="inspector" name="inspector" onkeypress="return validarMayus(event)" required  maxlength="50" 
                value='<?php echo $inspector?>' >
                  </div>

             

                     <div class="col-md-12 with-border">
                       <div class="col-md-12 with-border">
                        <p class='help-block' style='color:red;'><i class='fa fa-info'></i> Recuerde llenar todos los campos</p>
                        
                        <div class="col-md-6"> 

                        <div class="form-group col-md-6">
                          <label for='estado'> <i class='fa fa-eye'> </i> <i class="fa fa-building"></i> Proyecto Actual</label>
                          <input type="text" class='form-control' value="<?php echo $nombre_ed; ?>" disabled>
                          <input type="hidden" class='form-control' name='id_proyecto' id='id_proyecto' value="<?php echo $id_ed; ?>">
                        </div>
                        </div>
                       </div>
                       <div class='form-group col-md-8'>
                          <input type='hidden' name='id_rev' id='id_rev' value='<?php echo $id; ?>'>
                       </div>
                      <div class='col-md-12'>
                        <a type='button' class='btn btn-danger pull-left' href='lista_m2.php'>Cancelar Proceso</a>
                        <button type='submit' name='submit' class='btn btn-success pull-right' onclick="return activar(event)">Editar Datos</button>
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


   $(document).ready(function () {


    
      var valor1 = document.getElementById('cant_m2').value;
      
      var valor2 = document.getElementById('cant_obs').value;
      var x = (parseFloat(valor2))/parseFloat(valor1);
      x = x.toFixed(2);
      document.getElementById('obs_m2').disabled = false;
      document.getElementById('obs_m2').value = x;
      document.getElementById('obs_m2').disabled = true;
      
      


     });

   function activar(e){

    document.getElementById('obs_m2').disabled = false;
    

  }


function Calculo(e){

var valor1 = document.getElementById('cant_m2').value;
var valor2 = document.getElementById('cant_obs').value;
var x = (parseFloat(valor2))/parseFloat(valor1);
x = x.toFixed(2);
document.getElementById('obs_m2').disabled = false;
document.getElementById('obs_m2').value = x;
document.getElementById('obs_m2').disabled = true;

}

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


function validarMayus(e) 
  {
    tecla = (document.form) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[A-Z ]{1,45}$/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Debes ingresar solo letras Mayusculas.");
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

    patron =/[A-Z0-9]/;
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