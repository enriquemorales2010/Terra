
/*Ajax para EDITAR dATOS DE Proyecto de m2*/
$(document).ready(function(){

  $("#edit_datos_proyecto").submit(function(e){

    if (    $("#id_Proyecto").val() != ""
         && $("#proyecto").val() != ""  
         && $("#proyectov").val() != ""
         && $("#piso").val() != ""  
         && $("#num_dep").val() != "" 
         && $("#cant_mtrs").val() != ""
         && $("#tipo_depto").val() != ""

  ){

    var id_Proyecto = $("#id_Proyecto").val(),
        proyecto = $("#proyecto").val(),
        proyectov = $("#proyectov").val(),
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
          confirmButtonText: "Si, Editar Proyecto",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_datos_pro.php",
      type: "POST",
      data: {
        
                "id_Proyecto" : id_Proyecto,
                "proyecto" : proyecto,
                "proyectov" : proyectov,
                "piso" : piso,
                "num_dep" : num_dep,
                "cant_mtrs" : cant_mtrs,
                "tipo_depto" : tipo_depto
                
        
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Se Edito Proyecto.","success");
                  setTimeout(function() {
                    window.location.assign("lista_m2.php");
                  }, 2000);   
                 }else {
                  sweetAlert("No se Ha Editado", "Revisa Los Datos Ingresados", "error");
                 // document.getElementById('').disabled = true;
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



/*Ajax para Editar revision por m2*/
$(document).ready(function(){

  $("#editar_revision_proyecto").submit(function(e){

    if (    $("#id_rev").val() != ""
         && $("#id_proyecto").val() != ""  
         && $("#fecha_revision").val() != "" 
         && $("#cant_obs").val() != "" 
         && $("#obs_m2").val() != ""
         && $("#inspector").val() != ""
  ){

    var id_rev = $("#id_rev").val(),
        id_proyecto = $("#id_proyecto").val(),
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
      url: "modulos/edit_obser_m2.php",
      type: "POST",
      data: {
        
                "id_rev" : id_rev,
                "id_proyecto" : id_proyecto,
                "fecha_revision" : fecha_revision,
                "cant_obs" : cant_obs,
                "obs_m2" : obs_m2,
                "inspector" : inspector
                
        
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Se Edito Revisión.","success");
                  setTimeout(function() {
                    window.location.assign("lista_m2.php");
                  }, 2000);   
                 }else {
                  sweetAlert("Ya existen registros asociados", "Revisar Datos.", "error");
                  document.getElementById('obs_m2').disabled = false;

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
