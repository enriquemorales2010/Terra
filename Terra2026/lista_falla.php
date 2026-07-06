<?php





session_start();

if (!isset($_SESSION['usuario'])) {

  header('Location: error_login.php?error=true');

}



include_once('clases/falla.php');

include_once('modulos/maquetado.php');

include_once('modulos/footer.php');

include_once('modulos/scripts_js.php');





?>



<!DOCTYPE html>

<!--

This is a starter template page. Use this page to start your new project from

scratch. This page gets rid of all links and provides the needed markup only.

-->

<html>

<head>

  <?php echo head(); ?>

  <title>TERRA Constructora - Gestión de Fallas</title>

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

        <?php

        include_once('modulos/barratop.php');

        ?>

      </nav>

    </header>

    <!-- Left side column. contains the logo and sidebar -->

    <aside class="main-sidebar">



      <!-- sidebar: style can be found in sidebar.less -->

      <section class="sidebar">

        <?php include_once('modulos/menu.php');

                if ($_SESSION['perfil'] == "Super Administrador") {

                  echo menuSuperAdministrador();

                }elseif ($_SESSION['perfil'] == "Encargado") {

                  echo menuEncargado();

                }elseif ($_SESSION['perfil'] == "Ejecutivo Post-Ventas") {

                  echo menuEjecutivo();

                }else {

                  echo menuAdministrador();

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

          <i class="fa fa-user"></i> Fallas.

          <small>Página para la gestión de los Fallas. <i class="fa fa-info"></i></small>

        </h1>

        <ol class="breadcrumb">

          <li><a href="#"><i class="fa fa-info"></i></a></li>

          <li class="active">Edificio</li>

        </ol>

      </section>

<?php if ($_SESSION['perfil'] == "Super Administrador") { ?>

      <!-- Main content -->

      <section class="content">



        <div class="row">

          <div class="col-md-12">

            <div class="box box-primary">

               <div class="box-header with-border col-md-12">

                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#agregar_falla1"><i class="fa fa-plus"></i> Agregar Nueva Falla</button>

                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar_clase"><i class="fa fa-plus"></i> Agregar Nueva Clase de Falla</button>

                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar_tipo"><i class="fa fa-plus"></i> Agregar Nuevo Elemento de Falla</button>



                  <!--<a href="editar_usuario.php"><button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar Usuario</button></a>-->

               </div><!-- /.box-header -->

				

              <div class='box-body'>

                <div class='col-md-12'>

                	<br>

                  <div class="table-responsive">

                  <?php  



                  $con = new fallas();

                  $con->listafalla();



                  ?>

                  </div>

               </div>

            </div>



        <!-- MODAL #1 -->

        <div class="modal fade bs-modal-lg" id="agregar_falla1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">  

              

               <div class="modal-header">

                  <h4 class="box-title"><b>Registro de Nueva Falla</b></h4>

                </div>

            <div class="modal-body">

                <div class="row">

              <form role="form" method="post" id="reg_fallas">

                                  

                  

                  

                   <div class="form-group col-xs-5 col-md-offset-3">

                    <label for="nombre_edificio"><i class="fa fa-pencil"></i>Nombre de Falla.</label>

                    <input type="text" class="form-control" id="nombre_falla" name="nombre_falla" placeholder="Fuga de Corriente" maxlength="50" onkeypress="return validarLetras(event)"  required>

                  </div>

                  

                   

                    



                     <div class="form-group col-xs-6">

                    <label for="cla_fal"> <i class="fa fa-caret-square-o-down"></i> Clase de Falla</label>

                    <select id="cla_fal" name="cla_fal" class="form-control" required>

                      <option selected="selected" value="">Seleccione una opción</option>

                      <?php  



                        $con = new fallas();

                        $sql = "SELECT * FROM clase_falla";

                        $consulta = $con->conn->query($sql);



                        if ($consulta) {

                          if ($consulta->num_rows > 0) {

                            while ($fila = mysqli_fetch_assoc($consulta)) {

                              $ID = $fila['id_clase_falla'];

                              $etiqueta = $fila['etiqueta_clase'];



                              echo "<option value='".$ID."'>".$etiqueta."</option>";

                            }

                          }else {

                            echo "<option selected='selected' value=''>NO HAY FALLAS (LLAMAR A ENCARGADO)</option>";

                          }

                        }



                      ?>

                    </select>

                    </div> 

                    

                    <div class="form-group col-xs-6">

                    <label for="tip_fal"> <i class="fa fa-caret-square-o-down"></i> Elemento de Falla</label>

                    <select id="tipo_fal" name="tipo_fal" class="form-control" required>

                      <option selected="selected" value="">Seleccione una opción</option>

                      <?php

                       $con = new fallas();

                        $sql = "SELECT * FROM tipo_falla";

                        $consulta = $con->conn->query($sql);



                        if ($consulta) {

                          if ($consulta->num_rows > 0) {

                            while ($fila = mysqli_fetch_assoc($consulta)) {

                              $ID = $fila['id_tipo_falla'];

                              $etiqueta = $fila['etiqueta_tipo'];



                              echo "<option value='".$ID."'>".$etiqueta."</option>";

                            }

                          }else {

                            echo "<option selected='selected' value=''>NO HAY FALLAS (LLAMAR A ENCARGADO)</option>";

                          }

                        }

                        ?>

                    </select>

                    </div> 







        

                  <div class="form-group col-md-12">

                    <p class="help-block" style="color:red;"><i class="fa fa-info"></i> Recuerde llenar todos los campos</p>

                  </div>

                  </div>

                </div>

                <div class="modal-footer">

                  <div class="col-md-12">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

                    <input type="submit" name="submit" class="btn btn-success pull-right" value="Agregar Nueva Falla">

                  </div>

                </div>

              </form>

            

            </div>

          </div>

        </div>

        <!-- MODAL #1 -->





        <!-- MODAL #2 -->

        <div class="modal fade " id="agregar_clase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog " role="document">

            <div class="modal-content">  

              

               <div class="modal-header">

                  <h4 class="box-title"><b>Registro de Nueva Clase de Fala</b></h4>

                </div>

            <div class="modal-body">

                <div class="row">

              <form role="form" method="post" id="agre_clase_fall">

                

                  

                  

                  <div class="form-group col-xs-5 col-md-offset-3">

                    <label for="nombre_clase_falla"><i class="fa fa-pencil"></i>Nombre de Clase de Falla.</label>

                    <input type="text" class="form-control" id="nombre_clase_falla" name="nombre_clase_falla" placeholder="Fuga de Corriente" maxlength="30" onkeypress="return validarLetras(event)"  required>

                  </div>

                               





        

                  <div class="form-group col-md-12">

                    <p class="help-block" style="color:red;"><i class="fa fa-info"></i> Recuerde llenar todos los campos</p>

                  </div>

                  </div>

                </div>

                <div class="modal-footer">

                  <div class="col-md-12">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

                    <input type="submit" name="submit" class="btn btn-success pull-right" value="Agregar Nueva Clase de Falla">

                  </div>

                </div>

              </form>

            

            </div>

          </div>

        </div>

        <!-- MODAL #2 -->



        <!-- MODAL #3 -->

        <div class="modal fade" id="agregar_tipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog" role="document">

            <div class="modal-content">  

              

               <div class="modal-header">

                  <h4 class="box-title"><b>Registro de Nuevo Elemento de Falla</b></h4>

                </div>

            <div class="modal-body">

                <div class="row">

              <form role="form" method="post" id="agre_tipo_fall">

                

                  

                  

                  <div class="form-group col-xs-5 col-md-offset-3">

                    <label for="nombre_elem_falla"><i class="fa fa-pencil"></i>Nombre de Elemento de  Falla.</label>

                    <input type="text" class="form-control" id="nombre_elem_falla" name="nombre_elem_falla" placeholder="Fuga de Corriente" maxlength="30" onkeypress="return validarLetras(event)"  required>

                  </div>

                  



        

                  <div class="form-group col-md-12">

                    <p class="help-block" style="color:red;"><i class="fa fa-info"></i> Recuerde llenar todos los campos</p>

                  </div>

                  </div>

                </div>

                <div class="modal-footer">

                  <div class="col-md-12">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

                    <input type="submit" name="submit" class="btn btn-success pull-right" value="Agregar Nueva Falla">

                  </div>

                </div>

              </form>

            

            </div>

          </div>

        </div>

        <!-- MODAL #3 -->





            </div>

         </div>

      </div>

      

   </section>



<?php }else { echo "<div class='box-body'>

              <div class='alert alert-danger alert-dismissible'>

              <h4><i class='icon fa fa-ban'></i> Alerta!</h4>

              Disculpe estimado usuario, no tiene permisos para gestionar este módulo.

              </div></div>"; } ?>

    </div><!-- /.content-wrapper -->



   <?php echo insertar_footer(); ?>

  

</div><!-- ./wrapper -->



<?php echo insertarScripts(); ?>



<script type="text/javascript">



  function validarLetras(e) 

  {

    tecla = (document.form) ? e.keyCode : e.which;

    if (tecla==8) return true; 



    patron =/[A-Za-z\sáéíóúñÁÉÍÓÚÑ()']{1,45}$/;

    te = String.fromCharCode(tecla);

    if (patron.test(te)==false)

    {

      swal("Debes ingresar solo letras y Paréntesis ().");

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

      swal("Para la contraseña debe ingresar sólo letras y números y debe tener mínimo 8 dígitos.");

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

      swal("Para la dirección son validos: letras, números y los caracteres especiales: ,.-/#()");

    };

    return patron.test(te); 



  }



  function validarCedula(e) 

  { 

    

  }









  //$('#ci_usuario').inputmask("99999999");

  $('#cel_usuario').inputmask("(9999)-9999999");

  $('#tel_usuario').inputmask("(9999)-9999999");



   $('.date').inputmask("yyyy/mm/dd",{ "placeholder": "aaaa/mm/dd" }); 

   $(".date").inputmask({

   yearrange: { minyear: 1930 }

   });



    $('.date').inputmask("yyyy/mm/dd",{ "placeholder": "aaaa/mm/dd" }); 

    $(".date").inputmask({

    yearrange: { minyear: 1997 }

    });



     $('#venc_licencia').inputmask("yyyy/mm/dd",{ "placeholder": "aaaa/mm/dd" });

     $("#venc_licencia").inputmask({

      yearrange: { minyear: 2017, maxyear: 2199 }

     });





    

    

    

    

   

</script>



</body>

</html>