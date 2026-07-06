<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/enc_per.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');


?>

<!DOCTYPE html>
<html>
<head>
  <title>Terra - Control de Documentación</title>
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
            <h1>Registro de Encuesta de Perc.
              <small>Pagina para Ingreso de una Encuesta. <i class="fa fa-info"></i></small>
            </h1>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Sis. de Gestión de Datos</a></li>
              <li class="active">Control de Encuesta</li>
            </ol>
        </section>
      
      <?php if ($_SESSION['perfil'] == "Super Administrador" or $_SESSION['perfil'] == "Coordinador de Calidad") { ?>
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Registro de Encuesta</b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">


        <form role='form' method='POST' id='reg_encuesta_per'>
                    <!--id='reg_encuesta_per'-->
                   <!--action="modulos/reg_perc.php"-->

          <div class="form-group col-md-12 well well-sm text-center"><strong> ANTECEDENTES GENERALES.</strong></div>

            <div class="form-group col-md-3 col-md-offset-1 alerta">
             <label for="email_usuario"><i class="fa fa-calendar"></i> Mes/Año: </label>
             <input type="month" class="form-control" id="fecha_proyecto" name="fecha_proyecto" placeholder="Solo Numeros" required onkeypress="return validarNum(event)"  maxlength="3" >
            </div>


             <div class='form-group col-md-3'>
              <label for='area'><i class='fa fa-building'></i> Proyecto : </label>
               <select name='proyecto' id='proyecto' class='form-control' required>
                <option value='' selected>Selec. Una Opción</option>
                              <?php
                              
                    $con = new enc_perc();
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
                     echo "<option selected='selected' value=''>NO HAY EDIfICIO (LLAMAR A ENCARGADO)</option>";
                     }
                     }
                              
                              
                     ?>
                 </select>
               </div>


               <div class='form-group col-md-3'>
              <label for='area'><i class='fa fa-question'></i> Item : </label>
               <select name='SelectorItem' id='SelectorItem' class='form-control' onchange='return SeleccionItem(event)'  required>
                    <option value='' selected>Selec. Una Opción</option>
                    <option value='1'>General</option>
                    <option value='2'>Obra Gruesa</option>
                    <option value='3'>Terminación</option>
                 </select>
               </div>




            <div class='form-group col-md-12' id="pregunta1" hidden >
            <div class="form-group col-md-12 well well-sm text-center"><strong>PREGUNTAS.</strong></div> 

            
                 <div class='form-group col-md-10 '>
                 <label for='dir_usuario'><i class='fa fa-question-circle'></i> - Cumplimiento de los Plazos, Hitos y Compromisos. </label>
                 <textarea class='form-control' id='ditem1' name='ditem1' placeholder='Observación' onkeypress="return validarDir(event)"  maxlength="2500"></textarea>
                 </div> 
                

                 <div class='form-group col-md-2'>
                 <label for='area'><i class='fa fa-list'></i> Calificación :</label>
                 <input type='text' class='form-control' name="item1" id="item1" placeholder='7.0' maxlength="3" onfocusout ="return Calcular(event)" onkeypress="return validarNota(event)" >
                 </div>
            </div>

             <div class='form-group col-md-12' id="pregunta2" hidden >              
             <div class='form-group col-md-10'>
                    <label for='dir_usuario'><i class='fa fa-question-circle'></i> - Calidad de los trabajos de Obra Gruesa. </label>
                    <textarea class='form-control' id='ditem2' name='ditem2' placeholder='Observación' onkeypress="return validarDir(event)"  maxlength="2500"></textarea>
             </div> 
            

           <div class='form-group col-md-2'>
             <label for='area'><i class='fa fa-list'></i> Calificación :</label>
              <input type='text' class='form-control' name="item2" id="item2"  placeholder='7.0' maxlength="3" onfocusout ="return Calcular(event)" onkeypress="return validarNota(event)" >
            </div>
             </div>

             <div class='form-group col-md-12' id="pregunta3" hidden >
             <div class='form-group col-md-10'>
                    <label for='dir_usuario'><i class='fa fa-question-circle'></i> - Calidad de los trabajos en Terminaciones. </label>
                    <textarea class='form-control' id='ditem3' name='ditem3' placeholder='Observación' onkeypress="return validarDir(event)"  maxlength="2500"></textarea>
             </div> 
            

           <div class='form-group col-md-2'>
             <label for='area'><i class='fa fa-list'></i> Calificación :</label>
              <input type='text' class='form-control' name="item3" id="item3"  placeholder='7.0' maxlength="3"  onfocusout ="return Calcular(event)" onkeypress="return validarNota(event)" max="7.0" >
            </div> 
            </div>


            <div class='form-group col-md-12' id="pregunta4" hidden >
            <div class='form-group col-md-10'>
                    <label for='dir_usuario'><i class='fa fa-question-circle'></i> - Prevención de Riesgos en Obra Gruesa. </label>
                    <textarea class='form-control' id='ditem4' name='ditem4' placeholder='Observación' onkeypress="return validarDir(event)"  maxlength="2500"></textarea>
             </div> 
            

           <div class='form-group col-md-2'>
             <label for='area'><i class='fa fa-list'></i> Calificación :</label>
              <input type='text' class='form-control' name="item4" id="item4"  placeholder='7.0' maxlength="3"   onfocusout ="return Calcular(event)" onkeypress="return validarNota(event)" max="7.0" >
            </div> 
            </div>



            <div class='form-group col-md-12' id="pregunta5" hidden >
            <div class='form-group col-md-10'>
                    <label for='dir_usuario'><i class='fa fa-question-circle'></i> - Prevención de Riesgos en Terminaciones. </label>
                    <textarea class='form-control' id='ditem5' name='ditem5' placeholder='Observación' onkeypress="return validarDir(event)"  maxlength="2500"></textarea>
             </div> 
            

           <div class='form-group col-md-2'>
             <label for='area'><i class='fa fa-list'></i> Calificación :</label>
              <input type='text' class='form-control' name="item5" id="item5"  placeholder='7.0' maxlength="3" onfocusout ="return Calcular(event)" onkeypress="return validarNota(event)" max="7.0" >
            </div> 
            </div>



            <div class='form-group col-md-12' id="pregunta6" hidden >
            <div class='form-group col-md-10'>
                    <label for='dir_usuario'><i class='fa fa-question-circle'></i> - Capacidad de respuesta ante los Requerimientos. </label>
                    <textarea class='form-control' id='ditem6' name='ditem6' placeholder='Observación' onkeypress="return validarDir(event)"  maxlength="2500"></textarea>
             </div> 
            

           <div class='form-group col-md-2'>
             <label for='area'><i class='fa fa-list'></i> Calificación :</label>
              <input type='text' class='form-control' name="item6" id="item6"  placeholder='7.0' maxlength="3" onfocusout ="return Calcular(event)" onkeypress="return validarNota(event)" max="7.0" >
            </div> 
            </div>


            <div class='form-group col-md-12' id="pregunta7" hidden >
             <div class='form-group col-md-10'>
             <label for='dir_usuario'><i class='fa fa-question-circle'></i> - Infraestructura y Aseo de Obra. </label>
             <textarea class='form-control' id='ditem7' name='ditem7' placeholder='Observación' onkeypress="return validarDir(event)"  maxlength="2500"></textarea>
            </div> 
            

             <div class='form-group col-md-2'>
             <label for='area'><i class='fa fa-list'></i> Calificación :</label>
             <input type='text' class='form-control' name="item7" id="item7"  placeholder='7.0' maxlength="3"   onfocusout ="return Calcular(event)" onkeypress="return validarNota(event)" max="7.0">
             </div> 
            </div>



             <div class='form-group col-md-12' id="pregunta8" hidden >
                <div class="form-group col-md-12 well well-sm text-center"><strong> OBSERVACIONES ADICIONALES</strong></div>

                <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-circle-o-notch'></i> Observaciones Adicionales. </label>
                    <textarea class='form-control' id='obs_adi' name='obs_adi' placeholder='Observación' onkeypress="return validarDir(event)"  maxlength="2500"></textarea>
                </div> 
             </div> 
              
              <div class="form-group col-md-12 well well-sm text-center"><strong> DATOS DE ENCUESTAS</strong></div>

                <div class='form-group col-md-3 col-md-offset-2'>
                 <label for='area'><i class='fa fa-user'></i> Nombre del Encuestado: </label>
                 <input type='text' class='form-control' name="nom_enc" id="nom_enc"  maxlength="250" onkeypress="return validarMayusculas(event)" required placeholder='JUAN PEREZ' >
                </div> 
                
                <div class="form-group col-md-3 alerta">
                     <label for="email_usuario"><i class="fa fa-calendar"></i> Fecha de la Encuesta: </label>
                     <input type="date" class="form-control" id="fecha_enc" name="fecha_enc" placeholder="Solo Numeros" required="" onkeypress="return validarNum(event)"  maxlength="3" >
                </div>

                <div class='form-group col-md-2'>
                    <label for='area'><i class='fa fa-list'></i> Promedio :</label>
                    <input type='text' class='form-control' name="promedio" id="promedio"  placeholder='7.0' maxlength="3" disabled required>
                </div> 


                  <div class="form-group col-md-12">
                    <input type="submit" name="submit" class="btn btn-success pull-right" value="Agregar Encuesta" onclick="return desbloquear(event)" >
                     <a type='button' class='btn btn-danger pull-left' href='lista_enc_per.php'>Cancelar Proceso</a>
                  </div>




                     </form>

            </div>
          </div><!-- /.box-body -->

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

function SeleccionItem(e) {

var ItemSeleccionado = document.getElementById("SelectorItem").value;

if(ItemSeleccionado == 0){ 
        //document.getElementById("pregunta1").value = x;
        //document.getElementById("pregunta2").value = "-";
        //document.getElementById("pregunta3").value = "-";
        document.getElementById("pregunta1").hidden = true;
        document.getElementById("pregunta2").hidden = true;
        document.getElementById("pregunta3").hidden = true;
        document.getElementById("pregunta4").hidden = true;
        document.getElementById("pregunta5").hidden = true;
        document.getElementById("pregunta6").hidden = true;
        document.getElementById("pregunta7").hidden = true;
        document.getElementById("pregunta8").hidden = true;
        document.getElementById('item1').value = '';
        document.getElementById('item2').value = '';
        document.getElementById('item3').value = '';
        document.getElementById('item4').value = '';
        document.getElementById('item5').value = '';
        document.getElementById('item6').value = '';
        document.getElementById('item7').value = '';
        document.getElementById('ditem1').value = '';
        document.getElementById('ditem2').value = '';
        document.getElementById('ditem3').value = '';
        document.getElementById('ditem4').value = '';
        document.getElementById("ditem5").value = '';
        document.getElementById("ditem6").value = '';
        document.getElementById("ditem7").value = '';
        Calcular(event);

}

//Muestra Todas las Preguntas

if(ItemSeleccionado == 1){ 
        //document.getElementById("pregunta1").value = x;
        //document.getElementById("pregunta2").value = "-";
        //document.getElementById("pregunta3").value = "-";
        document.getElementById("pregunta1").hidden = false;
        document.getElementById("pregunta2").hidden = false;
        document.getElementById("pregunta3").hidden = false;
        document.getElementById("pregunta4").hidden = false;
        document.getElementById("pregunta5").hidden = false;
        document.getElementById("pregunta6").hidden = false;
        document.getElementById("pregunta7").hidden = false;
        document.getElementById("pregunta8").hidden = false;
        document.getElementById('item1').value = '';
        document.getElementById('item2').value = '';
        document.getElementById('item3').value = '';
        document.getElementById('item4').value = '';
        document.getElementById('item5').value = '';
        document.getElementById('item6').value = '';
        document.getElementById('item7').value = '';
        document.getElementById('ditem1').value = '';
        document.getElementById('ditem2').value = '';
        document.getElementById('ditem3').value = '';
        document.getElementById('ditem4').value = '';
        document.getElementById("ditem5").value = '';
        document.getElementById("ditem6").value = '';
        document.getElementById("ditem7").value = '';
        Calcular(event);
}

//Muestra Preguntas de Obra Gruesa

if(ItemSeleccionado == 2){ 
        //document.getElementById("pregunta1").value = x;
        //document.getElementById("pregunta2").value = "-";
        //document.getElementById("pregunta3").value = "-";
        document.getElementById("pregunta1").hidden = false;
        document.getElementById("pregunta2").hidden = false;
        document.getElementById("pregunta3").hidden = true;
        document.getElementById("pregunta4").hidden = false;
        document.getElementById("pregunta5").hidden = true;
        document.getElementById("pregunta6").hidden = false;
        document.getElementById("pregunta7").hidden = false;
        document.getElementById("pregunta8").hidden = false;
        document.getElementById('item3').value = '';
        document.getElementById('item5').value = '';
        document.getElementById('ditem3').value = '';
        document.getElementById('ditem5').value = '';
        Calcular(event);
}


if(ItemSeleccionado == 3){ 
        //document.getElementById("pregunta1").value = x;
        //document.getElementById("pregunta2").value = "-";
        //document.getElementById("pregunta3").value = "-";
        document.getElementById("pregunta1").hidden = false;
        document.getElementById("pregunta2").hidden = true;
        document.getElementById("pregunta3").hidden = false;
        document.getElementById("pregunta4").hidden = true;
        document.getElementById("pregunta5").hidden = false;
        document.getElementById("pregunta6").hidden = false;
        document.getElementById("pregunta7").hidden = false;
        document.getElementById("pregunta8").hidden = false;
        document.getElementById('item2').value = '';
        document.getElementById('item4').value = '';
        document.getElementById('ditem2').value = '';
        document.getElementById('ditem4').value = '';
        Calcular(event);

}


}


function Calcular(e) {

 var contador = 0;
 var vr1 = document.getElementById('item1').value;

  if (vr1 > 7) {
 swal('Nota Maxima Por Item 7');
  document.getElementById('item1').value = '';
  return
 }

 if (document.getElementById('item2').value > 7) {
 swal('Nota Maxima Por Item 7');
  document.getElementById('item2').value = '';
  return;
 }

 if (document.getElementById('item3').value > 7) {
 swal('Nota Maxima Por Item 7');
  document.getElementById('item3').value = '';
  return;
 }

 if (document.getElementById('item4').value > 7) {
 swal('Nota Maxima Por Item 7');
  document.getElementById('item4').value = '';
  return;
 }

 if (document.getElementById('item5').value > 7) {
 swal('Nota Maxima Por Item 7');
  document.getElementById('item5').value = '';
  return;
 }

 if (document.getElementById('item6').value > 7) {
 swal('Nota Maxima Por Item 7');
  document.getElementById('item6').value = '';
  return;
 }

 if (document.getElementById('item7').value > 7) {
 swal('Nota Maxima Por Item 7');
  document.getElementById('item7').value = '';
  return;
 }


 if (vr1 == "" || vr1 == 0) {
  
  vr1 = 0;
 }

  
 if(vr1 != "" || vr1 != 0){
  vr1 = vr1;
   contador = contador + 1;
 }

var vr2 = document.getElementById('item2').value;



 if (vr2 == "" || vr2 == 0) {
  
  vr2 = 0;
 };

 if(vr2 != "" || vr2 != 0 ){
  document.getElementById('item2').value = vr2;
  contador = contador + 1;
 };



 var vr3 = document.getElementById('item3').value;


 if (vr3 == "" || vr3 == 0) {
  
  vr3 = 0;
 };

 if(vr3 != "" || vr3 != 0 ){
  document.getElementById('item3').value = vr3;
  contador = contador + 1;
 };


 var vr4 = document.getElementById('item4').value;

  
  if (vr4 == "" || vr4 == 0) {
  
  vr4 = 0;
 };

 if(vr4 != "" || vr4 != 0){
  document.getElementById('item4').value = vr4;
  contador = contador + 1;
 };

 var vr5 = document.getElementById('item5').value;


  if (vr5 == "" || vr5 == 0) {
  
  vr5 = 0;
 };

 if(vr5 != "" || vr5 != 0){
  document.getElementById('item5').value = vr5;
  contador = contador + 1;
 };


 var vr6 = document.getElementById('item6').value;


  if (vr6 == "" || vr6 == 0) {
  
  vr6 = 0;
 };

 if(vr6 != "" || vr6 != 0){
  document.getElementById('item6').value = vr6;
  contador = contador + 1;
 };


 var vr7 = document.getElementById('item7').value;

  

  if (vr7 == "" || vr7 == 0) {
  
  vr7 = 0;
 };

 if(vr7 != "" || vr7 != 0){
  document.getElementById('item7').value = vr7;
  contador = contador + 1;
 };





 var suma = 0;
 suma = parseFloat(vr1) + parseFloat(vr2) + parseFloat(vr3) + parseFloat(vr4) + parseFloat(vr5) + parseFloat(vr6) + parseFloat(vr7) ;
 var p = (parseFloat(suma))/parseFloat(contador);


// alert("Contador: "+contador);
// alert("Su Suma es: "+p);
//alert("Su promedio es: "+p);
 p = p.toFixed(1);
 document.getElementById('promedio').disabled = false;
 document.getElementById('promedio').value = p;
 document.getElementById('promedio').disabled = true;

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

function desbloquear(e) {
  document.getElementById('promedio').disabled = false;
}


  function validarMayusculas(e) 
  {
    tecla = (document.form) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[A-Z SÁÉÍÓÚÑ']{1,45}$/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Debes ingresar solo letras Mayusculas.");
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

  function validarNumero(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[0-9]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Solo Puede Ingresar Numeros");
    };
    return patron.test(te); 



  }




   function validarNota(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[0-9\.]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Solo Puede Ingresar Numeros y como Caracter Especial: .");
    };
    return patron.test(te); 
  }

</script>
</body>
</html>