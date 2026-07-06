<?php  


session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
   
}
    

       

  
  

include_once('clases/postventas.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');


?>

<!DOCTYPE html>
<html>
<head>
  <title>Constructora Terra - Gestión de Post-Ventas</title>
  <?php echo head(); ?>
</head>
<body class="hold-transition skin-red sidebar-mini">
  <div class="wrapper">
    
    <!-- Main Header -->
    <header class="main-header">

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
              <i class="fa fa-exclamation-circle"></i> Post-Ventas
              <small>Página para la gestión de los Post-Ventas. <i class="fa fa-info"></i></small>
            </h1>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Datos</a></li>
              <li class="active">Post-Ventas</li>
            </ol>
        </section>
        
 <?php if ($_SESSION['perfil'] == "Super Administrador" || $_SESSION['perfil'] == "Ejecutivo Post-Ventas") { ?>     
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">


          <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border col-md-12">
                  <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#agregar_post"><i class="fa fa-plus"></i> Agregar Nuevo Caso</button>
                  <!--<a href="editar_usuario.php"><button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar Usuario</button></a>-->
               </div><!-- /.box-header -->
                <div class="col-sm-12"></div>






              <div class='box-body'>
                <div class='col-sm-12'>
                  <div class="table-responsive">
                  <?php 
                    $con = new postventas();
                    $con->listaPostventas();
                  ?>
                  </div>
               </div>
            </div>



              </div>
            </div>
          </div>



        <div class="modal fade bs-modal-lg" id="agregar_post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">  

                <div class="modal-header">
                  <h4 class="box-title"><b> Registro de Nuevo Casos</b></h4>
                </div>

                <form role="form" method="post" id="agregar_postv">
                <div class="modal-body">
                  <div class="row">
                  
                  <div class="form-group col-md-4">
              <label for="nombre"><i class="fa fa-user"></i> Nombre y Apellido de quien Reclama</label>
              <input type="text" class="form-control" id="nom_rec" name="nom_rec" placeholder="Jose Gonzalez" maxlength="25" onkeypress="return validarLetras(event)" required>
            </div>
            <div class="form-group col-md-4">
                    <label for="Arrenda"> <i class="fa fa-group"></i> Arrendatario O Propietario</label>
                    <select name="contrato" id="contrato" class="form-control" required>
                       <option selected="selected" value="0"> Seleccione</option>
                      <option value="1"> Propietario</option>
                      <option value="2">Arrendatario</option>
                    </select>
            </div>
            <div class="form-group col-md-4">
            <label for="fecha"> <i class="fa fa-calendar-o"></i> Fecha de Reclamo: </label>
            <input type="date" class="form-control" name="fechar" id="fechar">
            </div>
               
              
            <div class="form-group col-md-4">
                    <label for="prov_serv"> <i class="fa fa-building"></i> Edificio</label>
                    <select id="id_ed" name="id_ed" class="form-control" required>
                      <option selected="selected" value="">Seleccione una opción</option>
                      <?php  

                        $con = new postventas();
                        $sql = "SELECT edificio.id_ed, edificio.nom_ed FROM edificio WHERE estado = 1;";
                        $consulta = $con->conn->query($sql);

                        if ($consulta) {
                          if ($consulta->num_rows > 0) {
                            while ($fila = mysqli_fetch_assoc($consulta)) {
                              $ID = $fila['id_ed'];
                              $nombre = $fila['nom_ed'];

                              echo "<option value='".$ID."'>".$nombre."</option>";
                            }
                          }else {
                            echo "<option selected='selected' value=''>NO HAY EDIICIO (LLAMAR A ENCARGADO)</option>";
                          }
                        }

                      ?>
                    </select>
                  </div>

            <div class="form-group col-md-2">
              <label for=""><i class="fa fa-hashtag"></i> N. de Depto.</label>
              <input type="text" class="form-control" id="num_dep" name="num_dep" required maxlength="6">
            </div>
           
            
            <div class="form-group col-md-4">
              <label for="email"><i class="fa fa-envelope"></i> Correo de Contacto</label>
              <input type="text" class="form-control" id="correo" name="correo" placeholder="retrimoca@ejemplo.com" maxlength="38" onkeypress="return validarCorreo(event)" required>
            </div>
            <div class="form-group col-md-4">
              <label for="tel_rec"><i class="fa fa-phone"></i> Teléfono de Quien Reclama</label>
              <input type="text" class="form-control" id="tel_rec" name="tel_rec" placeholder="(22)-12341235" required  maxlength="13" pattern=".{12,}">
            </div>
            <div class="form-group col-md-4">
              <label for="cel_rec"><i class="fa fa-phone"></i> Celular de Quien Reclama</label>
              <input type="text" class="form-control" id="cel_rec" name="cel_rec" placeholder="(9)-12341235" required  maxlength="12" pattern=".{11,}">


            </div>
             
              <div class="form-group col-md-8">
                <label for="descr"><i class="fa fa-exclamation-triangle"></i> Descripcion del Caso</label>
                <textarea class="form-control" name="desc_caso" id="desc_caso" required></textarea>
              </div>

                 
            <div class="form-group col-md-4">
              <?php 

                $usuario = $_SESSION["usuario"]; 
                
                 $con = new postventas();
                  $sql5 = "SELECT * FROM usuario WHERE usuario.cor_usu = '$usuario';";
                   $consulta = $con->conn->query($sql5);

                        if ($consulta) {
                          if ($consulta->num_rows > 0) {
                            while ($fila = mysqli_fetch_assoc($consulta)) {
                              $usuario2 = $fila['rut_usu'];
                              ;
                            }
                          }else {
                            echo "Algo Paso... Llamar al encargado";
                          }
                        }         
               ?>

               <input type="hidden" id="rut_usu" name="rut_usu" value='<?php echo $usuario2; ?>'>
            </div>

                  <!-- /.form group -->
                  <div class="form-group col-md-12">
                    <p class="help-block" style="color:red;"><i class="fa fa-info"></i> Recuerde llenar todos los campos</p>
                  </div>
                </div>
                </div>
               
                <div class="modal-footer">
                  <div class="col-md-12">
                    <input type="submit" name="submit" class="btn btn-success pull-right" value="Agregar Nuevo Caso">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              
              </form>
           
           </div>
          </div>
        </div>

          
        </section><!-- cierre content -->

    <?php }else { echo "<div class='box-body'>
              <div class='alert alert-danger alert-dismissible'>
              <h4><i class='icon fa fa-ban'></i> Alerta!</h4>
              Disculpe estimado usuario, no tiene permisos para gestionar este módulo.
              </div></div>"; } ?>


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

     $('#cel_rec').inputmask("(9)-99999999");
  $('#tel_rec').inputmask("(22)-9999999");
  
  //$('#rif').inputmask("A-99999999-9");
   
</script>  
</body>
</html>