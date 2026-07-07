<?php

session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
  exit;
}

include_once('clases/postventas.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');

$num_cas = isset($_GET['num_caso']) ? intval($_GET['num_caso']) : 0;

$nombre = '';
$dept = '';
$descripcion = '';
$correo = '';
$fono = '';
$celular = '';
$usuario = '';
$nombre_edificio = '';
$id_edificio = 0;
$contrato = '';

if ($num_cas <= 0) {
    die('Número de caso inválido.');
}

$con = new postventas();

$stmt = $con->conn->prepare(
    "SELECT p.num_caso, p.nom_rec, p.tip_con, p.num_dep, p.fec_ini_rec, p.resp_recl, p.desc_caso, p.correo_rec, p.fono_rec, p.cel_rec, p.rut_usu, p.id_ed, e.nom_ed " .
    "FROM postventas p INNER JOIN edificio e ON p.id_ed = e.id_ed WHERE p.num_caso = ?"
);

if (!$stmt) {
    die('Error al preparar consulta: ' . $con->conn->error);
}

$stmt->bind_param('i', $num_cas);
$stmt->execute();

$stmt->bind_result($num_cas, $nombre, $tip_con, $dept, $fec_ini_rec, $resp_recl, $descripcion, $correo, $fono, $celular, $usuario, $id_edificio, $nombre_edificio);

if ($stmt->fetch()) {
    if ($tip_con == 1) {
        $contrato = 'Propietario';
    } elseif ($tip_con == 2) {
        $contrato = 'Arrendatario';
    } else {
        $contrato = 'Desconocido';
    }
} else {
    die('No se encontró el caso de postventa solicitado.');
}

$stmt->close();

?><!DOCTYPE html>
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
              <i class="fa fa-user"></i> Post-Ventas
              <small>Pagina para editar información de un Caso de Post-Ventas. <i class="fa fa-info"></i></small>
            </h1>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Datos</a></li>
              <li class="active">Caso</li>
            </ol>
        </section>
      
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Editar Datos de Usuario</b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">


        <form role='form' method='post' id="editar_casos">

                       <div class='form-group col-md-3'>
                          <label for='email_usuario'><i class='fa fa-male'></i> Nombre de la Persona que Reclama</label>
                          <input type='text' class='form-control' id='reclamador' name='reclamador' placeholder='Jose Perez' value='<?php echo $nombre; ?>' maxlength="50" onkeypress="return validarLetras(event)" required>
                       </div>
                       
                        <div class='form-group col-md-2'>
                          <label for='estado'> <i class='fa fa-eye'></i>Arrendatario o Propietario</label>
                          <select name='contrato' id='contrato' class='form-control' required>
                            <?php if($contrato == "Propietario") { ?>
                             <option selected='selected' value='1'><?php echo $contrato; ?></option>
                             <option value='2'>Arrendatario</option>
                             <?php }else{ ?>
                             <option selected='selected' value='2'><?php echo $contrato; ?></option>
                             <option value='1'>Propietario</option>
                             <?php }?>
                           </select>
                       </div>

                       <div class='form-group col-md-3'>
                          <label for='nombre_usuario'><i class='fa fa-male'></i>Numero de Departamento</label>
                          <input type='text' class='form-control' id='dpto' name='dpto' placeholder='1234' value='<?php echo $dept; ?>' maxlength="6" onkeypress="return validarDir(event)" required>
                       </div>
                    <div class="form-group col-md-4">
                    <label for="edif"> <i class="fa fa-group"></i> Edificio</label>
                    <select id="edificio" name="edificio" class="form-control" required>
                      <option selected="selected" value="0">Seleccione una opción</option>
                      <?php  

                        $con = new postventas();
                        $sql = "SELECT edificio.id_ed, edificio.nom_ed FROM edificio;";
                        $consulta = $con->conn->query($sql);

                        if ($consulta) {
                          if ($consulta->num_rows > 0) {
                            while ($fila = mysqli_fetch_assoc($consulta)) {
                              $ID = $fila['id_ed'];
                              $nombre = $fila['nom_ed'];

                              echo "<option value='".$ID."'>".$nombre."</option>";
                            }
                          }else {
                            echo "<option selected='selected' value=''>NO HAY EDIFICIO (LLAMAR A ENCARGADO)</option>";
                          }
                        }

                      ?>
                    </select>
                    </div>
                       <div class='form-group col-md-12'>
                          <label for='dir_usuario'><i class='fa fa-map-marker'></i> Descripcion del Caso</label>
                          <textarea class='form-control' id='descripcion' name='descripcion' placeholder='Descripcion del Caso' onkeypress="return validarDir(event)" required maxlength="60"><?php echo $descripcion; ?></textarea>
                       </div>

                       <div class='form-group col-md-3'>
                          <label for='email_usuario'><i class='fa fa-male'></i> Correo de la Persona que Reclama</label>
                          <input type='email' class='form-control' id='email' name='email' placeholder='name@hosting.com' value='<?php echo $correo; ?>' maxlength="50" onkeypress="return validarCorreo(event)" required>
                       </div>

                       <div class='form-group col-md-3'>
                          <label for='telefono'><i class='fa fa-male'></i> Telefono de la Persona que Reclama</label>
                          <input type='text' class='form-control' id='fono' name='fono' placeholder='(22)-1231231' value='<?php echo $fono; ?>' maxlength="12" onkeypress="return validarCedula(event)" required>
                       </div>
                      
                       <div class='form-group col-md-3'>
                          <label for='telefono'><i class='fa fa-male'></i> Celular de la Persona que Reclama</label>
                          <input type='text' class='form-control' id='celular' name='celular' placeholder='(9)-12341234' value='<?php echo $celular; ?>' maxlength="12" onkeypress="return validarCedula(event)" required>
                       </div>

                      
                       
                       <div class='form-group col-md-8'>
                          <p class='help-block' style='color:red;'><i class='fa fa-info'></i> Recuerde llenar todos los campos</p>
                       </div>
                       <div class="col-md-12">
                        <hr>
                        
                        <div class="col-md-6">
                          <div class="form-group col-md-5">
                        <label for='estado'> <i class='fa fa-eye'></i> Edificio Actual</label>
                          <input type="text" name="nom_edificio" id="nom_edificio" class='form-control' value="<?php echo $nombre_edificio; ?>" disabled>
                        </div>
                        </div>
                       </div>
                       <div class='form-group col-md-8'>
                          <input type='hidden' name='rut_usuario' id='rut_usuario' value='<?php echo $usuario; ?>'>
                          <input type='hidden' name='ident_ed' id='ident_ed' value='<?php echo $id_edificio; ?>'>
                          <input type='hidden' name='num_caso' id='num_caso' value='<?php echo $num_cas; ?>'>
                       </div>
                      <div class='col-md-12'>
                        <a type='button' class='btn btn-danger pull-left' href='lista_postv.php'>Cancelar Proceso</a>
                        <button type='submit' name='submit' class='btn btn-success pull-right'>Editar Datos</button>
                      </div>
                </form>

            </div>
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

  function validarRut(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron = /[K0-9-k]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Debe ingresar letras, números y el caracter especial - con el siguiente patrón: 12345678-9 o K");
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
      swal("Para la contraseña debe ingresar sólo letras y números y debe tener mínimo 8 dígitos.");
    };
    return patron.test(te); 

  }

   function validarDir(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[A-Za-z0-9\sáéíóúñÁÉÍÓÚÑ'_.\-@!*#,/()]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Para la dirección son validos: letras, números y los caracteres especiales: ,.-/@*#!()");
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

  //$('#ci_usuario').inputmask("99999999");
  $('#cel_prov').inputmask("(9)-99999999");
  $('#tel_prov').inputmask("(22)-99999999");
   $('.date').inputmask("yyyy/mm/dd",{ "placeholder": "aaaa/mm/dd" }); 
   $(".date").inputmask({
   yearrange: { minyear: 2018 }
   });

    $('.date').inputmask("yyyy/mm/dd",{ "placeholder": "aaaa/mm/dd" }); 
    $(".date").inputmask({
    yearrange: { minyear: 2018 }
    });

     $('#venc_licencia').inputmask("yyyy/mm/dd",{ "placeholder": "aaaa/mm/dd" });
     $("#venc_licencia").inputmask({
      yearrange: { minyear: 2017, maxyear: 2199 }
     });


  $('#fono').inputmask("(99)-9999999");
  $('#celular').inputmask("(9)-99999999");
</script>
</body>
</html>
