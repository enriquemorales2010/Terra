<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
   
}
    
  
  

include_once('clases/obs_m2.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');



$con = new obs_pro();
$sql = "SELECT datos_proyecto.id_Proyecto, datos_proyecto.num_depto, datos_proyecto.cant_m2, datos_proyecto.tipo_depto, datos_proyecto.edificio_id_ed FROM datos_proyecto";
$consulta = $con->conn->query($sql);
									
  if ($consulta->num_rows > 0) {
	while ($fila = mysqli_fetch_assoc($consulta)) {
		$id_proyecto = $fila['id_Proyecto'];

		//$ID = $fila['id_proyecto'];
		//$nombre = $fila['num_depto'];

	}
}





?>

<!DOCTYPE html>
<html>
<head>
  <title>Constructora Terra - Gestión de Revisión</title>
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
              <i class="fa fa-exclamation-circle"></i> Revisión de Proyecto
              <small>Página para la gestión de Revisión Por M2. <i class="fa fa-info"></i></small>
            </h1>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Datos</a></li>
              <li class="active">Revisión</li>
            </ol>
        </section>
        
 <?php if ($_SESSION['perfil'] == "Super Administrador" || $_SESSION['perfil'] == "Ejecutivo Post-Ventas") { ?>     
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">


          <div class="row" id = 'tabla1'>
              <div class="col-md-12" id = "box_" >
                    <div class="box box-primary">
                     <div class="box-header with-border col-md-12">
                        <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#agregar_proy"><i class="fa fa-plus"></i> Agregar Nuevo Proyecto</button>
                        <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#agregar_rev"><i class="fa fa-plus"></i> Agregar Nueva Revisión</button>
                        <div class='form-group col-md-3  pull-right' >
                                    
                                    <select class='form-control' name="tabla" id="tabla" onchange="return Mostrar(event)">
                                     <option value="">Seleccion Datos</option>
                                     <option value="1">Proyectos</option>
                                     <option value="2">Observaciones</option>
                                    </select>
                        </div>
                        <!--<a href="editar_usuario.php"><button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar Usuario</button></a>-->
                     </div><!-- /.box-header -->
                      <div class="col-sm-12"></div>
                      <div class='box-body' >
                      <div class='col-sm-12' >
                        <div class="table-responsive" id = "tabla1" >
                        <?php 
                          $con = new obs_pro();
                          $con->listaproyecto();
                        ?>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
          </div>

          <div class="row" id = 'tabla2' hidden>
                

                 <div class="col-md-12"  >
                    <div class="box box-primary">
                     <div class="box-header with-border col-md-12">
                        <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#agregar_proy"><i class="fa fa-plus"></i> Agregar Nuevo Proyecto</button>
                        <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#agregar_rev"><i class="fa fa-plus"></i> Agregar Nueva Revisión</button>
                        <div class='form-group col-md-3  pull-right' >
                                    
                                    <select class='form-control' name="tabla" id="tabla3" onchange="return Mostrar2(event)">
                                     <option value="">Seleccion Datos</option>
                                     <option value="1">Proyectos</option>
                                     <option value="2">Observaciones</option>
                                    </select>
                        </div>
                        <!--<a href="editar_usuario.php"><button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar Usuario</button></a>-->
                     </div><!-- /.box-header -->
                      <div class="col-sm-12"></div>
                      <div class='box-body' >
                      <div class='col-sm-12' >
                        <div class="table-responsive" >
                        <?php 
                          $con = new obs_pro();
                          $con->listaobservacion();
                        ?>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
          </div>

          


      



        <div class="modal fade bs-modal-lg" id="agregar_proy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">  

                <div class="modal-header">
                  <h4 class="box-title"><b> Registro de Nuevo Proyecto</b></h4>
                </div>

                <form role="form" method="post" id="reg_datos_proyecto">
                	<!--id="agregar_postv"-->
                	<!-- action="modulos/"-->
                <div class="modal-body">
                  <div class="row">

									<div class="form-group col-md-4">
									<label for="prov_serv"> <i class="fa fa-building"></i> Edificio:</label>
									<select id="id_ed" name="id_ed" class="form-control" required>
									<option selected="selected" value="">Seleccione una opción</option>
									<?php  
									
									$con = new obs_pro();
									$sql = "SELECT edificio.id_ed, edificio.nom_ed FROM edificio ;";
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

            <div class="form-group col-md-2">
              <label for=""><i class="fa fa-hashtag"></i> Piso.</label>
              <input type="text" class="form-control" id="piso" name="piso" onkeypress="return validarNum(event)" required maxlength="2" >
            </div>
                  
						<div class="form-group col-md-2">
						  <label for=""><i class="fa fa-hashtag"></i> N. de Depto.</label>
						  <input type="text" class="form-control" id="num_dep" name="num_dep" onkeypress="return validarNum(event)" required maxlength="4">
						</div>

						<div class="form-group col-md-2">
						<label for="nombre"><i class="fa fa-hastang"></i> Total de M2:</label>
						<input type="text" class="form-control" id="cant_mtrs" name="cant_mtrs" onkeypress="return validarMtrs(event)"  maxlength="6" required>
						</div>
            
			            <div class="form-group col-md-2">
			              <label for="tel_rec"><i class="fa fa-th"></i> Tipo de Depto.</label>
			              <input type="text" class="form-control" id="tipo_depto" name="tipo_depto" onkeypress="return validartipoDept(event)"  required  maxlength="2" >
			            </div>
             
           

                 
            

                  <!-- /.form group -->
                  <div class="form-group col-md-12">
                    <p class="help-block" style="color:red;"><i class="fa fa-info"></i> Recuerde llenar todos los campos</p>
                  </div>
                </div>
                </div>
                <div class="modal-footer">
                  <div class="col-md-12">
                    <input type="submit" name="submit" class="btn btn-success pull-right" value="Agregar Nuevo Proyecto">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              
              </form>
           
           </div>
          </div>
        </div><!-- Final Modal de Proyecto-->


		
		    <div class="modal fade bs-modal-lg" id="agregar_rev" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">  

                <div class="modal-header">
                  <h4 class="box-title"><b> Registra Nueva Revisión</b></h4>
                </div>

                <form role="form" method="post" id="reg_revision_proyecto" >
                	<!--id="reg_revision_proyecto"-->
                	<!-- action="modulos/reg_obser_m2.php"-->
                <div class="modal-body">
                  <div class="row">

									<div class="form-group col-md-3 col-md-offset-1">
									<label for="prov_serv"> <i class="fa fa-building"></i> Proyecto:</label>
									<select id="id_proyecto" name="id_proyecto" class="form-control" onchange ="return cambiarElemento(event)" required>
									<option selected="selected" value="">Seleccione una opción</option>
									<?php  
                  
                  $con = new obs_pro();
                  $sql = "SELECT DISTINCT edificio.id_ed, edificio.nom_ed, datos_proyecto.edificio_id_ed FROM  datos_proyecto
                  INNER JOIN edificio ON datos_proyecto.edificio_id_ed = edificio.id_ed 
                  WHERE datos_proyecto.cant_rev < 3;";
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

                  <div class="form-group col-md-3 ">
                  <label for="prov_serv"> <i class="fa fa-building"></i> Piso:</label>
                  <select id="piso1" name="piso1" class="form-control"  required onchange ="return cambiarApto(event)" disabled>
                  <option selected="selected" value="">Seleccione una opción</option>
                  
                  </select>
                  </div>

                  <div class="form-group col-md-3 ">
                  <label for="prov_serv"> <i class="fa fa-building"></i> Num de Depto:</label>
                  <select id="apto" name="apto" class="form-control"  required onchange ="return cambiarM2(event)" disabled>
                  <option selected="selected" value="">Seleccione una opción</option>
                  
                  </select>
                  </div>




                  
						<div class="form-group col-md-3 col-md-offset-1">
						<label for=""><i class="fa fa-calendar"></i> Fecha de Revision.</label>
						<input type="date" class="form-control" id="fecha_revision" name="fecha_revision" required maxlength="4">
						</div>

						<div class="form-group col-md-2">
						<label for="nombre"><i class="fa fa-hastang"></i> Total de M2:</label>
						<input type="text" class="form-control" id="cant_m2" name="cant_m2"  maxlength="5" required disabled>
						</div>

						<div class="form-group col-md-2">
						<label for="nombre"><i class="fa fa-hastang"></i>Cant. de Obs:</label>
						<input type="text" class="form-control" id="cant_obs" name="cant_obs" onkeypress="return validarMtrs(event)" onkeyup ="return Calculo(event)" maxlength="5" required>
						</div>

						<div class="form-group col-md-2">
						<label for="nombre"><i class="fa fa-hastang"></i>Obs. Por M2:</label>
						<input type="text" class="form-control" id="obs_m2" name="obs_m2"  maxlength="5" disabled required>
						</div>

						<div class="form-group col-md-4">
							<label for  ="tel_rec"><i class="fa fa-th"></i> Inspector:</label>
							<input type ="text" class="form-control" id="inspector" name="inspector" onkeypress="return validarMayus(event)" required  maxlength="50" >
			            </div>

						 
            
			            
             
           

                 
            

                  <!-- /.form group -->
                  <div class="form-group col-md-12">
                    <p class="help-block" style="color:red;"><i class="fa fa-info"></i> Recuerde llenar todos los campos</p>
                  </div>
                </div>
                </div>
               
                <div class="modal-footer">
                  <div class="col-md-12">
                    <input type="submit" name="submit" class="btn btn-success pull-right" onclick="return activar(event)" value="Agregar Nueva Revision">
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


  function activar(e){

  	document.getElementById('obs_m2').disabled = false;
  	

  }


 function cambiarElemento(e){

  	 document.getElementById('piso1').disabled = false;
 //$('#cant_m2').find('value').end().val('');
 $("#id_proyecto option:selected").each(function () {
            
            id_proyecto = $(this).val();
            
            $.post("modulos/getM2.php", { id_proyecto: id_proyecto }, function(data){
              $("#piso1").html(data);
              $("#apto").empty();
              $("#apto").append('<option value="" selected="selected">Escoja Una Opcion</option>');
              $("#cant_m2").val("");

              


                          
             
            }); 

              
});



}

function cambiarApto(e){

$("#piso1 option:selected").each(function () {

            var id_proyecto = document.getElementById('id_proyecto').value;
            piso = $(this).val();
             document.getElementById('apto').disabled = false;
            $.post("modulos/getApto.php", { id_proyecto: id_proyecto, piso:piso }, function(data){
              document.getElementById('cant_m2').disabled=false;
              $("#apto").html(data);
              document.getElementById('cant_m2').disabled=true; 


                if (document.getElementById('cant_obs').value != 0) {
                
                var valor1 = document.getElementById('cant_m2').value;
                var valor2 = document.getElementById('cant_obs').value;
                var x = (parseFloat(valor2))/parseFloat(valor1);
                x = x.toFixed(2);
                document.getElementById('obs_m2').disabled = false;
                document.getElementById('obs_m2').value = x;
                document.getElementById('obs_m2').disabled = true;
                };  
          
              
             
            }); 

              
});



}


function cambiarM2(e){

$("#apto option:selected").each(function () {

            
            apto = $(this).val();
            
            $.post("modulos/getMtrs.php", { apto: apto}, function(data){
               
               $( "#cant_m2" ).val(data);

              //var cant_m2 = document.getElementById('cant_m2');
              //cant_m2 = html(data);
          
              
             
            }); 

              
});



}



function Mostrar(e){

var tabla = document.getElementById('tabla').value;


if(tabla == 2){
  $('#tabla2').show();
  $('#tabla1').hide();
document.getElementById("tabla").selectedIndex = "0";
}


}

function Mostrar2(e){

var tabla4 = document.getElementById('tabla3').value;

if(tabla4 == 1){
$('#tabla2').hide();
$('#tabla1').show();
document.getElementById("tabla3").selectedIndex = "0";
}



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

  function validarNum(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[0-9]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("SOLO NUMEROS");
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


  
  //$('#rif').inputmask("A-99999999-9");
   
</script>  
</body>
</html>