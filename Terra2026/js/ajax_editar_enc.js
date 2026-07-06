

/*Ajax para Registrar Encuesta de Perc*/
$(document).ready(function(){

  $("#edit_encuesta_per").submit(function(e){

    if (    $("#id_per").val() != ""
         && $("#proyectov").val() != ""
         && $("#fecha_proyecto").val() != ""
         && $("#SelectorItem").val() != ""  
         && $("#nom_enc").val() != "" 
         && $("#fecha_enc").val() != "" 
         && $("#promedio").val() != "" 
  ){

    var id_per = $("#id_per").val(),
        proyecto = $("#proyecto").val(),
        proyectov = $("#proyectv").val(),
        fecha_proyecto = $("#fecha_proyecto").val(),
        SelectorItem = $("#SelectorItem").val(),
        ditem1 = $("#ditem1").val(),
        item1 = $("#item1").val(),
        ditem2 = $("#ditem2").val(),
        item2 = $("#item2").val(),
        ditem3 = $("#ditem3").val(),
        item3 = $("#item3").val(),
        ditem4 = $("#ditem4").val(),
        item4 = $("#item4").val(),
        ditem5 = $("#ditem5").val(),
        item5 = $("#item5").val(),
        ditem6 = $("#ditem6").val(),
        item6 = $("#item6").val(),
        ditem7 = $("#ditem7").val(),
        item7 = $("#item7").val(),
        obs_adi = $("#obs_adi").val(),
        nom_enc = $("#nom_enc").val(),
        fecha_enc = $("#fecha_enc").val(),
        promedio = $("#promedio").val();

        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Editar Encuesta",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_perc.php",
      type: "POST",
      data: {
                "id_per" : id_per,
                "proyecto" : proyecto,
                "proyectov" : proyectov,
                "fecha_proyecto" : fecha_proyecto,
                "SelectorItem": SelectorItem,
                "ditem1" : ditem1,
                "item1" : item1,
                "ditem2" : ditem2,
                "item2" : item2,
                "ditem3" : ditem3,
                "item3" : item3,
                "ditem4" : ditem4,
                "item4" : item4,
                "ditem5" : ditem5,
                "item5" : item5,
                "ditem6" : ditem6,
                "item6" : item6,
                "ditem7" : ditem7,
                "item7" : item7,
                "obs_adi" : obs_adi,
                "nom_enc" : nom_enc,
                "fecha_enc" : fecha_enc,
                "promedio" : promedio
        
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Se ha Editado la Encuenta.","success");
                  setTimeout(function() {
                    window.location.assign("lista_enc_per.php");
                  }, 2000);   
                 }else {
                  sweetAlert("Ya existen registros asociados", "Con esa fecha y Proyecto se encuentro registrada una Encuesta.", "error");
                  document.getElementById('promedio').disabled = true;
                }

    

      },
      error: function(error){

        alert(error);

      }
    });

  } else {
     swal("Cancelado!", "Acción no realizada.", "error");
     document.getElementById('promedio').disabled = true;
  }

  });

        }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
        document.getElementById('promedio').disabled = true;
      }
  e.preventDefault();

    });

  });
