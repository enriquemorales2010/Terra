<?php
if (function_exists('opcache_reset')) {
    @opcache_reset();
}

ob_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header('Location: error_login.php?error=true');
    exit;
}

include_once('clases/salida_nc.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');
?>
<!DOCTYPE html>
<html>
<head>
  <?php echo head(); ?>
  <title>TERRA Constructora - Gestión de Salida No Conforme</title>
</head>

<body class="hold-transition skin-red sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <a href="index.php" class="logo">
        <span class="logo-mini"><i class="fa fa-info"></i></span>
        <span class="logo-lg"><i class="fa fa-info"></i> <b>Inicio</b></span>
      </a>

      <nav class="navbar navbar-static-top" role="navigation">
        <?php include_once('modulos/barratop.php'); ?>
      </nav>
    </header>

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

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <i class="fa fa-user"></i> Salida No Conforme.
          <small>Página para la gestión de Salidas No Conforme. <i class="fa fa-info"></i></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-info"></i></a></li>
          <li class="active">Salida No Conforme.</li>
        </ol>
      </section>

      <?php if ($_SESSION['perfil'] == "Super Administrador" || $_SESSION['perfil'] == "Coordinador de Calidad") { ?>
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">

              <div class="box-header with-border">
                <a href="reg_salida_noc.php" class="btn btn-primary pull-left" role="button">
                  <i class="fa fa-plus"></i> Agregar Salida No Conforme
                </a>
              </div>

              <div class="box-body">
                <div class="col-md-12">
                  <br>
                  <div class="table-responsive">
                    <?php
                    $con = new salida_nc();
                    $con->listaSalida();
                    ?>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>
      <?php } else { ?>
        <div class="box-body">
          <div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
            Disculpe estimado usuario, no tiene permisos para gestionar este módulo.
          </div>
        </div>
      <?php } ?>
    </div>

    <?php echo insertar_footer(); ?>
  </div>

  <?php echo insertarScripts(); ?>

  <script type="text/javascript">
    function validarLetras(e) {
      var tecla = (document.all) ? e.keyCode : e.which;
      if (tecla == 8) return true;

      var patron = /[A-Za-z\sáéíóúñÁÉÍÓÚÑ']{1,45}$/;
      var te = String.fromCharCode(tecla);

      if (patron.test(te) == false) {
        swal("Debes ingresar solo letras.");
      }
      return patron.test(te);
    }

    function validarCorreo(e) {
      var tecla = (document.all) ? e.keyCode : e.which;
      if (tecla == 8) return true;

      var patron = /[A-Za-z0-9_.\-@]/;
      var te = String.fromCharCode(tecla);

      if (patron.test(te) == false) {
        swal("Debes ingresar solo letras, números y caracteres como: _.\\-");
      }
      return patron.test(te);
    }

    function validarPass(e) {
      var tecla = (document.all) ? e.keyCode : e.which;
      if (tecla == 8) return true;

      var patron = /^[A-Za-z0-9]{1,16}$/;
      var te = String.fromCharCode(tecla);

      if (patron.test(te) == false) {
        swal("Para la contraseña debe ingresar sólo letras y números y debe tener mínimo 8 dígitos.");
      }
      return patron.test(te);
    }

    function restarFechas(fecha_ini, fecha_cul) {
      var inicio = document.getElementById('fecha_ini').value;
      var final = document.getElementById('fecha_cul').value;

      inicio = new Date(inicio);
      final = new Date(final);

      if (inicio >= final) {
        swal("Fechas de Culminación Incorrecta");
        document.getElementById("fecha_cul").value = '';
      }
    }

    function restarFechas2(fecha_cul, fecha_rec) {
      var inicio = document.getElementById('fecha_cul').value;
      var final = document.getElementById('fecha_rec').value;

      inicio = new Date(inicio);
      final = new Date(final);

      if (inicio >= final) {
        swal("Fechas de Recepción Incorrecta");
        document.getElementById("fecha_rec").value = '';
      }
    }

    function validarDir(e) {
      var tecla = (document.all) ? e.keyCode : e.which;
      if (tecla == 8) return true;

      var patron = /[A-Za-z0-9\sáéíóúñÁÉÍÓÚÑ'_.\-#,/()]/;
      var te = String.fromCharCode(tecla);

      if (patron.test(te) == false) {
        swal("Para la dirección son validos: letras, números y los caracteres especiales: ,.-/#()");
      }
      return patron.test(te);
    }

    function validarCedula(e) {
      return true;
    }

    $(document).ready(function () {
      if ($('#cel_usuario').length) {
        $('#cel_usuario').inputmask("(9999)-9999999");
      }

      if ($('#tel_usuario').length) {
        $('#tel_usuario').inputmask("(9999)-9999999");
      }

      if ($('.date').length) {
        $('.date').inputmask("yyyy/mm/dd", { "placeholder": "aaaa/mm/dd" });
      }

      if ($('#venc_licencia').length) {
        $('#venc_licencia').inputmask("yyyy/mm/dd", { "placeholder": "aaaa/mm/dd" });
      }
    });
  </script>

</body>
</html>
<?php
ob_end_flush();
?>