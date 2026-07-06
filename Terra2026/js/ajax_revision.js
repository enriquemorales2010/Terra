

/*Ajax para Registrar dATOS DE Proyecto de m2*/
$(document).ready(function(){

  $("#reg_datos_proyecto").submit(function(e){

    if (    $("#id_ed").val() != ""
         && $("#piso").val() != ""
         && $("#num_dep").val() != ""  
         && $("#cant_mtrs").val() != "" 
         && $("#tipo_depto").val() != "" 
         
  ){

    var id_ed = $("#id_ed").val(),
        piso = $("#piso").val(),
        num_dep = $("#num_dep").val(),
        cant_mtrs = $("#cant_mtrs").val(),
        tipo_depto = $("#tipo_depto").val();
       

        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Registrar Proyecto",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/reg_datos_pro.php",
      type: "POST",
      data: {
        
                "id_ed" : id_ed,
                "piso" : piso,
                "num_dep" : num_dep,
                "cant_mtrs" : cant_mtrs,
                "tipo_depto" : tipo_depto
                
        
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Se Registro Proyecto.","success");
                  setTimeout(function() {
                    window.location.assign("lista_m2.php");
                  }, 2000);   
                 }else {
                  sweetAlert("Ya existen registros asociados", "Con ese Edificio y Depto se encuentro un registro.", "error");
                  //document.getElementById('promedio').disabled = true;
                }

    

      },
      error: function(error){

        alert(error);

      }
    });

  } else {
     swal("Cancelado!", "Acción no realizada.", "error");
     //document.getElementById('promedio').disabled = true;
  }

  });

        }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
        //9document.getElementById('promedio').disabled = true;
      }
  e.preventDefault();

    });

  });




/*Ajax para Registrar revision por m2*/
$(document).ready(function(){

  $("#reg_revision_proyecto").submit(function(e){

    if (    $("#apto").val() != ""
         && $("#fecha_revision").val() != ""  
         && $("#cant_obs").val() != "" 
         && $("#obs_m2").val() != "" 
         && $("#inspector").val() != ""
  ){

    var apto = $("#apto").val(),
        fecha_revision = $("#fecha_revision").val(),
        cant_obs = $("#cant_obs").val(),
        obs_m2 = $("#obs_m2").val(),
        inspector = $("#inspector").val();
       

        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Registrar Revisión",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/reg_obser_m2.php",
      type: "POST",
      data: {
        
                "apto" : apto,
                "fecha_revision" : fecha_revision,
                "cant_obs" : cant_obs,
                "obs_m2" : obs_m2,
                "inspector" : inspector
                
        
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Se Registro Revisión.","success");
                  setTimeout(function() {
                    window.location.assign("lista_m2.php");
                  }, 2000);   
                 }else {
                  sweetAlert("Ya existen registros asociados", "Excedio Cantidad de Revisión.", "error");
                  //document.getElementById('promedio').disabled = true;
                }

    

      },
      error: function(error){

        alert(error);

      }
    });

  } else {
     swal("Cancelado!", "Acción no realizada.", "error");
     //document.getElementById('promedio').disabled = true;
  }

  });

        }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
        //9document.getElementById('promedio').disabled = true;
      }
  e.preventDefault();

    });

  });
