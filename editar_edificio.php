<?php  





session_start();

if (!isset($_SESSION['usuario'])) {

  header('Location: error_login.php?error=true');

}



include_once('clases/edificios.php');

include_once('modulos/maquetado.php');

include_once('modulos/footer.php');

include_once('modulos/scripts_js.php');



$id = $_GET['id_ed'];



$con = new edificios();

$sql = "SELECT * FROM edificio where id_ed = '$id';";

$consulta = $con->conn->query($sql);



if ($consulta) {



  if ($consulta->num_rows > 0) {

    

    while ($fila = mysqli_fetch_assoc($consulta)) {

      

      $ID = $fila['id_ed'];

      $nombre = $fila['nom_ed'];

      $direccion = $fila['dir_ed'];

      

      $fechar = $fila['fecha_rec'];

      $estado = $fila['estado'];

      



      if($estado){



        if ($estado == 1) {

          $estado = "Activo";

          

        }elseif ($estado == 0) {

          $estado = "Inactivo";

        

        }else{

         echo "algo paso"; 

        }



    }



  }



}

}



?>



<!DOCTYPE html>

<html>

<head>

	<title>Terra Constructora - Editar Datos de Edificios</title>

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

        			<i class="fa fa-building-o"></i> Edificios

        			<small>Página para editar datos de un Edificio.<i class="fa fa-info"></i></small>

        		</h1>



        		<ol class="breadcrumb">

          		<li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Datos</a></li>

          		<li class="active">Edificios</li>

        		</ol>

        </section>

      

        <!-- CONTENIDO PRINCIPAL -->

         <section class="content">



         <div class="box box-info">

          

          <div class="box-header with-border">

            <h3 class="box-title"><b>Editar Datos del Edificio</b></h3>

          </div><!-- /.box-header -->



          <div class="box-body">

              <div class="col-md-12">



            <form role="form" method="post" id="editar_edi">

           

            <div class="form-group col-md-4">

              <label for="nombre_prov"><i class="fa fa-building"></i> Nombre del Edificio</label>

              <input type="text" class="form-control" id="nombre_edificio" name="nombre_edificio" placeholder="Retrimoca" value='<?php echo $nombre; ?>' maxlength="50" onkeypress="return validarDir(event)" required>

            </div>

            

            <div class='form-group col-md-2'>

                          <label for='estado'> <i class='fa fa-eye'></i> Estado</label>

                          <select name='estado' id='estado' class='form-control' required>

                            <?php if($estado == "Activo") { ?>

                             <option selected='selected' value='1'><?php echo $estado; ?></option>

                             <option value='0'>Inactivo</option>

                             <?php }else{ ?>

                             <option selected='selected' value='0'><? echo $estado;?>Inactivo</option>

                             <option value='1'>Activo</option>

                             <?php }?>

                          </select>

                       </div>



            <div class="form-group col-md-12">

              <label for="dir"><i class="fa fa-map-marker"></i> Dirección</label>

              <textarea name="dir_edificio" id="dir_edificio" class="form-control" placeholder="Sector Nueva Rosa Carretera J" onkeypress="return validarDir(event)" maxlength="120" required><?php echo $direccion ?></textarea>

            </div>



          

            <div class="form-group col-md-3">

              <label for="fecha"><i class="fa fa-calendar"></i> Fecha de Recepcion Municipal: </label>

              <input type="date" class="form-control" placeholder="Año-mes-dia" name="fecha_rec" id="fecha_rec" onchange="return restarFechas2(event)" value="<?php echo $fechar ?>">

            </div>



        

            <div class="col-md-12"><hr></div>

            

         

             <div class="form-group col-md-3">

              <label for="cel_prov"><i class="fa fa-calendar"></i> Fecha de Recepción <br> Municipal:</label>

              <input type="text" class="form-control" id="" value='<?php echo $fechar ?>' required disabled>

            </div>

            

            

            <div class="form-group col-md-4">

              <input type="hidden" id="ID" name="ID" value='<?php echo $ID; ?>'>

            </div>

            <div class="form-group col-md-12">

              <p class="help-block" style="color:red;"><i class="fa fa-info-circle"></i> Recuerde llenar todos los campos.</p>

            </div>

            <div class="col-md-12">

             <hr>

             



            <div class='col-md-12'>

              <button type='submit' name='submit' class='btn btn-success pull-right'>Editar Datos</button>

              <a type='button' class='btn btn-danger pull-left' href='lista_edificios.php'>Cancelar Proceso</a>

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







    function restarFechas(fecha_ini, fecha_cul) {

     inicio=document.getElementById('fecha_ini').value;

        final=document.getElementById('fecha_cul').value;

        inicio=new Date(inicio);

        final=new Date(final);

        if(inicio >= final){

        swal("Fechas de Culminación Incorrecta");

        document.getElementById("fecha_cul").value = '';

        }

      }



      function restarFechas2(fecha_cul, fecha_rec) {

        inicio=document.getElementById('fecha_cul').value;

        final=document.getElementById('fecha_rec').value;

        inicio=new Date(inicio);

        final=new Date(final);

        if(inicio >= final){

        swal("Fechas de Recepción Incorrecta");

        document.getElementById("fecha_rec").value = '';        }

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



  function validarRif(e) {



    tecla = (document.all) ? e.keyCode : e.which;

    if (tecla==8) return true; 



    patron = /[VEJG0-9-]/;

    te = String.fromCharCode(tecla);

    if (patron.test(te)==false)

    {

      swal("Debe ingresar letras, números y el caracter especial - con el siguiente patrón: VEJG-12345678-9");

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



   $('.date').inputmask("yyyy/mm/dd",{ "placeholder": "aaaa/mm/dd" }); 

   $(".date").inputmask({

   yearrange: { minyear: 1930 }

   });



    $('.date').inputmask("yyyy/mm/dd",{ "placeholder": "aaaa/mm/dd" }); 

    $(".date").inputmask({

    yearrange: { minyear: 1999  }

    });



  //$('#ci_usuario').inputmask("99999999");

  $('#cel_prov').inputmask("(9999)-9999999");

  $('#tel_prov').inputmask("(9999)-9999999");

  $('#fax_prov').inputmask("(9999)-9999999");

  //$('#rif').inputmask("A-99999999-9");

   

</script> 

</body>

</html>