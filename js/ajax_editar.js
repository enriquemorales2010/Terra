/*---   AJAX para editar datos de Usuarios   ---*/
$(document).ready(function(){

  $("#editar_usr").submit(function(e){

     if ( $( "#rut_usuario" ).val() != "" && $( "#nombre_usuario" ).val() != "" && $("#apellido_usuario").val() != "" && $( "#dir_usuario" ).val() != "" && $( "#email_usuario" ).val() != "" && $( "#pass_usuario" ).val() != "" && $( "#perfil_usuario" ).val() != "" && $( "#tel_usuario" ).val() != "" && $( "#cel_usuario" ).val() != "") {


    //variables

    var rut = $("#rut_usuario").val(),
        nomb_usuario = $("#nombre_usuario").val(),
        apel_usuario = $("#apellido_usuario").val(),
        direccion = $("#dir_usuario").val(),
        correo = $("#email_usuario").val(),
        clave = $("#pass_usuario").val(),
        perfil= $("#perfil_usuario").val(),
        estado= $("#estado").val(),
        telef_usuario = $("#tel_usuario").val(),
        cel_usuario = $("#cel_usuario").val();

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, actualizar datos",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

                  //ajax
    $.ajax({
      url: "modulos/edit_usuarios.php",
      type: "POST",
      data: {
         "rut_usuario": rut,
         "nombre_usuario": nomb_usuario,
         "apellido_usuario": apel_usuario,
         "dir_usuario": direccion,
         "email_usuario": correo,
         "pass_usuario": clave,
         "tel_usuario": telef_usuario,
         "cel_usuario": cel_usuario,
         "perfil_usuario": perfil,
         "estado": estado,
      },
      success: function(resp){

                if (resp != 0) {
                  sweetAlert("Exito!","Datos actualizados correctamente.","success");
                  setTimeout(function() {
                    window.location.assign("lista_usuarios.php");
                  }, 2000);   
                }else {
                  sweetAlert("Ya existen registros asociados.", "Ese email ya existe.", "error");
                }

      },
      error: function(error){

        swal(error);

      }

    });

      }else {
    swal("Cancelado!", "Acción no realizada.", "error");
  }

    });

  }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }


    e.preventDefault();


  });

});

/*---   AJAX para editar datos de Transportistas   ---*/
$(document).ready(function(){

  $("#editar_transp").submit(function(e){

    if ( $("#ci_transp").val() != "" && $("#nombre_transp").val() != "" && $("#apellido_transp").val() != "" && $("#fechaNac_transp").val() != "" && $("#dir_transp").val() != "" && $("#email_transp").val() != "" && $("#lic_transp").val() != "" &&  $("#tel_transp").val() != "" && $("#cel_transp").val() != "" && $("#venc_licencia").val() != "" ) {


    //variables

    var cedula = $("#ci_transp").val(),
        nomb_transp = $("#nombre_transp").val(),
        apel_transp = $("#apellido_transp").val(),
        nac_transp = $("#fechaNac_transp").val(),
        direccion = $("#dir_transp").val(),
        correo = $("#email_transp").val(),
        licencia = $("#lic_transp").val(),
        estado = $("#estado").val(),
        telef_transp = $("#tel_transp").val(),
        cel_transp = $("#cel_transp").val(),
        venc_licencia = $("#venc_licencia").val();

           swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, actualizar datos",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {



    //ajax
    $.ajax({
      url: "modulos/edit_transp.php",
      type: "POST",
      data: {
        "ci_transp": cedula,
        "nombre_transp": nomb_transp,
        "apellido_transp": apel_transp,
        "fechaNac_transp": nac_transp,
        "dir_transp": direccion,
        "email_transp": correo,
        "lic_transp": licencia,
        "tel_transp": telef_transp,
        "cel_transp": cel_transp,
        "estado": estado,
        "venc_licencia": venc_licencia
      },
      success: function(resp){

                if (resp != 0) {
                  sweetAlert("Exito!","Datos actualizados correctamente.","success");
                  setTimeout(function() {
                    location.reload(true);
                  }, 2000);   
                }else {
                  sweetAlert("Ya existen registros asociados.", "", "error");
                }

      },
      error: function(error){

        alert(error);

      }
    });

    }else {
    swal("Cancelado!", "Acción no realizada.", "error");
  }

   });
              }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }

  e.preventDefault();

  });

});

/*---   AJAX para editar datos de Vehiculos   ---*/
$(document).ready(function(){

  $("#editar_vehiculo").submit(function(e){

     if ( $("#matricula").val() != "" && $("#srial_carroc").val() != "" && $("#srial_motor").val() != "" && $("#marca").val() != "" && $("#modelo").val() != "" && $("#anno").val() != "" && $("#color").val() != "" && $("#num_puertas").val() != "" && $("#annos_servc").val() != "" ) {

    //variables

    var matricula = $("#matricula").val(),
        serial_carroc = $("#srial_carroc").val(),
        serial_motor = $("#srial_motor").val(),
        marca = $("#marca").val(),
        modelo = $("#modelo").val(),
        anno = $("#anno").val(),
        color = $("#color").val(),
        num_puertas = $("#num_puertas").val(),
        annos_servicio = $("#annos_servc").val(),
        tipo_motor = $("#tipo_motor").val(),
        tipo_comb = $("#tipo_comb").val(),
        tanque_gas = $("#tanque_gas").val(),
        ejes = $("#ejes").val(),
        peso = $("#peso").val(),
        num_cilindros = $("#num_cdros").val(),
        transp_asig = $("#transp_asig").val(),
        estado = $("#estado").val();

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, actualizar datos",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_vehiculo.php",
      type: "POST",
      data: {
        "matricula": matricula,
        "srial_carroc": serial_carroc,
        "srial_motor": serial_motor,
        "marca": marca,
        "modelo": modelo,
        "anno":anno,
        "color": color,
        "num_puertas": num_puertas,
        "annos_servc": annos_servicio,
        "tipo_motor": tipo_motor,
        "tipo_comb": tipo_comb,
        "tanque_gas": tanque_gas,
        "ejes": ejes,
        "peso": peso,
        "num_cdros": num_cilindros,
        "transp_asig": transp_asig,
        "estado": estado
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Datos actualizados correctamente.","success");
                  setTimeout(function() {
                    location.reload(true);
                  }, 2000);   
                }else {
                  sweetAlert("Ya existen registros asociados.", "", "error");
                }

      },
      error: function(error){

        alert(error);

      }

    });

} else {
swal("Cancelado!", "Acción no realizada.", "error");
}
                      

  });

      }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
e.preventDefault();

      });

});

/*---   AJAX para editar datos de Proveedores   ---*/
$(document).ready(function(){

  $("#editar_prov").submit(function(e){

    if ( $("#rut").val() != "" && $("#nombre_prov").val() != "" && $("#dir").val() != "" && $("#email").val() != "" && $("#tel_prov").val() != "" && $("#cel_prov").val() != "" ) {

    //variables
    var rut = $("#rut").val(),
        nomb_proveedor = $("#nombre_prov").val(),
        direccion = $("#dir").val(),
        correo = $("#email").val(),
        telef_proveedor = $("#tel_prov").val(),
        cel_proveedor = $("#cel_prov").val(),
        ID = $("#ID").val();

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, actualizar datos",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_prov.php",
      type: "POST",
      data: {
        "rut": rut,
        "nombre_prov": nomb_proveedor,
        "dir": direccion,
        "email": correo,
        "tel_prov": telef_proveedor,
        "cel_prov": cel_proveedor,
        "ID": ID,
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Datos actualizados correctamente.","success");
                  setTimeout(function() {
                    window.location.assign("lista_prov.php");
                  }, 2000);   
                }else {
                  sweetAlert("Ya existen registros asociados", "", "error");
                }

    

      },
      error: function(error){

        alert(error);

      }
    });

     } else {
      swal("Cancelado!", "Acción no realizada.", "error");
    }

  });


      }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
e.preventDefault();

  });

});

/*---   AJAX para editar datos de Mecanicos   ---*/
$(document).ready(function(){

  $("#editar_mec").submit(function(e){

   if( $("#ci_mec").val() != "" && $("#nombre_mec").val() != "" && $("#apellido_mec").val() != "" && $("#fechaNac_mec").val() != "" && $("#dir_mec").val() != "" && $("#prov_serv").val() != "" ) {


    //variables
    var nombre = $("#nombre_mec").val(),
        apellido = $("#apellido_mec").val(),
        fecha_nac = $("#fechaNac_mec").val(),
        direccion = $("#dir_mec").val(),
        ID_proveedor = $("#prov_serv").val(),
        estado = $("#estado").val(),
        CI = $("#ci_mec").val();

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, actualizar datos",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {
        

    //ajax
    $.ajax({
      url: "modulos/edit_mecanico.php",
      type: "POST",
      data: {
        "ci_mec": CI,
        "nombre_mec": nombre,
        "apellido_mec": apellido,
        "fechaNac_mec": fecha_nac,
        "dir_mec": direccion,
        "prov_serv": ID_proveedor,
        "estado": estado
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Datos actualizados correctamente.","success");
                  setTimeout(function() {
                    location.reload(true);
                  }, 2000);   
                }else {
                  sweetAlert("Ya existen registros asociados", "", "error");
                }

    

      },
      error: function(error){

        alert(error);

      }
    });

  } else {
     swal("Cancelado!", "Acción no realizada.", "error");
  }

  });

        }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
  e.preventDefault();

    });

});

/*---   AJAX para editar el estado de una solicitud  ---*/
$(document).ready(function(){

  $("#editar_solicitud").submit(function(e){

    if ( $("#estado_solicitud").val() != "" && $("#ID_solicitud").val() != "" ) {


    //variables
    var estado = $("#estado_solicitud").val(),
        ID = $("#ID_solicitud").val();

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, editar estado",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_solicitud.php",
      type: "POST",
      data: {
        "estado_solicitud": estado,
        "ID_solicitud": ID
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Estado de solicitud cambiado correctamente.","success");
                  setTimeout(function() {
                    location.reload(true);
                  }, 2000);   
                }else {
                  sweetAlert("Ya existen registros asociados", "", "error");
                }

      },
      error: function(error){

        swal(error);

      }
    });

    } else {
      swal("Cancelado!", "Acción no realizada.", "error");
    }

  });

      }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
e.preventDefault();

      });

});

/*---   AJAX para editar el estado de una incidencia   ---*/
$(document).ready(function(){

  $("#editar_incidencia").submit(function(e){

    if ( $("#estado_incidencia").val() != "") {

    //variables
    var estado = $("#estado_incidencia").val(),
        ID = $("#ID_incidencia").val(),
        matricula = $("#matricula").val();

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, editar estado",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_incidencia.php",
      type: "POST",
      data: {
        "estado_incidencia": estado,
        "ID_incidencia": ID,
        "matricula":  matricula
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Estado de incidencia cambiado correctamente.","success");
                  setTimeout(function() {
                    location.reload(true);
                  }, 2000);   
                }else {
                  sweetAlert("Ya existen registros asociados", "", "error");
                }

      },
      error: function(error){

        swal(error);

      }
    });

   } else {
     swal("Cancelado!", "Acción no realizada.", "error");
   }

  });

      }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
e.preventDefault();

  });

});

/*EDITAR EDIFICIO*/

$(document).ready(function(){

  $("#editar_edi").submit(function(e){

    if ($( "#nombre_edificio" ).val() != "" && $( "#dir_edificio" ).val() != "") {


    //variables

    var 
        nomb_edificio = $("#nombre_edificio").val(),
        est = $("#estado").val(),
        direccion = $("#dir_edificio").val(),
        fini = $("#fecha_ini").val(),
        fcul = $("#fecha_cul").val(),
        frec = $("#fecha_rec").val(),
        id_ed = $("#ID").val();
        

        
        

        swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, registrar Edificio",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {
              
              //ajax
              $.ajax({
                url: "modulos/edit_edificio.php",
                type: "POST",
                data: {
                  
                  "nombre_edificio": nomb_edificio,
                  "estado": est,
                  "dir_edificio": direccion,
                  "fecha_ini": fini,
                  "fecha_cul": fcul,
                  "fecha_rec": frec,
                  "ID": id_ed

                },
               success: function(resp){

                if (resp != 0) {
                  sweetAlert("Exito!","Edificio Editado correctamente.","success");
                  setTimeout(function() {
                    window.location.assign("lista_edificios.php");
                  }, 2000);   
                }else {
                  sweetAlert("Ya existen registros asociados", "", "error");
                }

              },
              error: function(error){
                swal(error);
              }

    });

  }else {
    swal("Cancelado!", "Acción no realizada.", "error");
  }

  });

        }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }

  e.preventDefault();

  });



});


/*Editar Seguimiento en los Caso*/
$(document).ready(function(){

  $("#editar_seg").submit(function(e){

    if ( $("#desc").val() != "" && $("#seg").val() != "" ) {


    //variables
    var desc= $("#desc").val(),
        seg = $("#seg").val(),
        caso = $("#caso").val();

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, editar Seguimiento",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_seg.php",
      type: "POST",
      data: {
        "desc": desc,
        "seg": seg
      },
      success: function(resp){
        
               if (resp != 0) {
                  sweetAlert("Exito!","Seguimiento cambiado correctamente.","success");
                  setTimeout(function() {
                    window.location = ("postventa_detalles.php?num_caso=" + caso);
                  }, 2000);   
                }else {
                  sweetAlert("Ya existen registros asociados", "", "error");
                }

      },
      error: function(error){

        swal(error);

      }
    });

    } else {
      swal("Cancelado!", "Acción no realizada.", "error");
    }

  });

      }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
e.preventDefault();

      });

});


/*Editar Falla*/

$(document).ready(function(){

  $("#editar_fal").submit(function(e){

    if ( $("#falla").val() != "" && $("#etiqueta").val() != "" && $("#clase_falla").val() != "" && $("#tipo_falla").val() != "" && $("#clasev").val() != "" && $("#tipov").val() != "") {


    //variables
    var falla = $("#falla").val(),
        etiqueta = $("#etiqueta").val(),
        clase_falla = $("#clase_falla").val(),
        tipo_falla = $("#tipo_falla").val(),
        clasev = $("#clasev").val(),
        tipov = $("#tipov").val();
     

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Editar Fallar",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_falla.php",
      type: "POST",
      data: {
        "falla": falla,
        "etiqueta": etiqueta,
        "clase_falla": clase_falla,
        "tipo_falla": tipo_falla,
        "clasev": clasev,
        "tipov": tipov
      },
      success: function(resp){
              
               if (resp != 0) {
                  sweetAlert("Exito!","Falla Editada correctamente.","success");
                  setTimeout(function() {
                    window.location.assign("lista_falla.php");
                  }, 2000);   
                }else {
                  sweetAlert("Ya existen registros asociados", "", "error");
                }

      },
      error: function(error){

        swal(error);

      }
    });

    } else {
      swal("Cancelado!", "Acción no realizada.", "error");
    }

  });

      }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
e.preventDefault();

      });

});





/*Editar Postventa*/

$(document).ready(function(){

  $("#editar_casos").submit(function(e){

    if ( $("#reclamador").val() != "" && $("#contrato").val() != "" && $("#dpto").val() != "" && $("#descripcion").val() != "" && $("#email").val() != "" && $("#fono").val() != "" && $("#celular").val() != "" && $("#ident_ed").val() != "" ) {


    //variables
    var reclamador = $("#reclamador").val(),
        contrato = $("#contrato").val(),
        dpto = $("#dpto").val(),
        descripcion = $("#descripcion").val(),
        email = $("#email").val(),
        fono = $("#fono").val(),
        celular = $("#celular").val(),
        edificio = $("#edificio").val(),
        ident_ed = $("#ident_ed").val(),
        num_caso = $("#num_caso").val();

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Editar Los Datos de Caso",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_postv.php",
      type: "POST",
      data: {
        "reclamador": reclamador,
        "contrato": contrato,
        "dpto": dpto,
        "descripcion": descripcion,
        "email": email,
        "fono": fono,
        "celular": celular,
        "edificio": edificio,
        "ident_ed": ident_ed,
        "num_caso": num_caso
      },
      success: function(resp){
        
               if (resp != 0) {
                  sweetAlert("Exito!","Caso cambiado correctamente.","success");
                  setTimeout(function() {
                    window.location.assign("lista_postv.php");
                  }, 2000);   
                }else {
                  sweetAlert("Ya existen registros asociados", "", "error");
                }

      },
      error: function(error){

        swal(error);

      }
    });

    } else {
      swal("Cancelado!", "Acción no realizada.", "error");
    }

  });

      }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
e.preventDefault();

      });

});

/*Editar Falla de Caso*/

$(document).ready(function(){

  $("#editar_fal_caso").submit(function(e){

    if ( $("#falla").val() != "" && $("#caso_falla").val() != "" && $("#fallaa").val() != "" && $("#caso1").val() != "") {


    //variables
    var falla = $("#falla").val(),
        caso_falla= $("#caso_falla").val(),
        fallaa = $("#falla").val(),
        caso1 = $("#caso1").val();
        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Editar Fallar de Este Caso",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_falla_caso.php",
      type: "POST",
      data: {
        "falla": falla,
        "caso_falla": caso_falla,
        "caso1": caso1,
        "fallaa": fallaa
      },
      success: function(resp){
        
                if (resp != 0) {
                  sweetAlert("Exito!","Falla cambiada correctamente.","success");
                  setTimeout(function() {
                    window.location.assign("postventa_detalles.php?num_caso="+caso1)
                  }, 2000);  
                }else {
                  sweetAlert("Ya existen registros asociados", "", "error");
                }

      },
      error: function(error){

        swal(error);

      }
    });

    } else {
      swal("Cancelado!", "Acción no realizada.", "error");
    }

  });

      }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
e.preventDefault();

      });

});


$(document).ready(function(){

  $("#editar_gar_caso").submit(function(e){

    if ( $("#descripcion").val() != "" && $("#costo").val() != "" && $("#estado").val() != "" && $("#costoo").val() != "" && $("#caso_garantia").val() != "" && $("#caso_post").val() != "") {


    //variables
    var descripcion = $("#descripcion").val(),
        costo = $("#costo").val(),
        estado= $("#estado").val(),
        costoo= $("#costoo").val(),
        caso_garantia = $("#caso_garantia").val(),
        caso_post = $("#caso_post").val();

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Editar Garantia de Esta Falla",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_garantia_caso.php",
      type: "POST",
      data: {
        "descripcion": descripcion,
        "costo": costo,
        "estado": estado,
        "costoo": costoo,
        "caso_garantia": caso_garantia,
        "caso_post": caso_post
      },
      success: function(resp){
        
                if (resp != 0) {
                  sweetAlert("Exito!","Garantia cambiada correctamente.","success");
                  setTimeout(function() {
                    window.location.assign("postventa_detalles.php?num_caso="+caso_post)
                  }, 2000);  
                }else {
                  sweetAlert("Ya existen registros asociados", "", "error");
                }

      },
      error: function(error){

        swal(error);

      }
    });

    } else {
      swal("Cancelado!", "Acción no realizada.", "error");
    }

  });

      }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
e.preventDefault();

      });

});


/*Ajax para Registrar Salidas No Conforme*/
$(document).ready(function(){

  $("#editar_salida_nc").submit(function(e){

    if (    $("#id_s").val() != ""   
         &&  $("#serie").val() != "" 
         &&  $("#area").val() != "" 
         && $("#proyecto_v").val() != ""
         && $("#accion_a").val() != ""  
         && $("#etapa").val() != ""  
         && $("#ubicacion").val() != "" 
         && $("#estado").val() != ""

     )  {



    var id_s = $("#id_s").val(),
        area = $("#area").val(),
        serie = $("#serie").val(),
        accion_a = $("#accion_a").val(),
        etapa = $("#etapa").val(),
        ubicacion = $("#ubicacion").val(),
        proyecto = $("#proyecto").val(),
        proyecto_v = $("#proyecto_v").val(),
        desc_sal_1 = $("#desc_sal_1").val(),
        nom_enc_1 = $("#nom_enc_1").val(),
        funcion_1 = $("#funcion_1").val(),
        origen_1 = $("#origen_1").val(),
        fecha_sa_1 = $("#fecha_sa_1").val(),
        evidencia_1 = $("#evidencia_1").val(),
        desc_ac_in_2 = $("#desc_ac_in_2").val(),
        nom_enc_2 = $("#nom_enc_2").val(),
        funcion_2 = $("#funcion_2").val(),
        fecha_ac_in_2 = $("#fecha_ac_in_2").val(),
        desc_ana_eva_3 = $("#desc_ana_eva_3").val(),
        desc_int_3 = $("#desc_int_3").val(),
        desc_imple_4 = $("#desc_imple_4").val(),
        nom_enc_4 = $("#nom_enc_4").val(),
        funcion_4 = $("#funcion_4").val(),
        fecha_ac_co_4 = $("#fecha_ac_co_4").val(),
        aceptacion_5 = $("#aceptacion_5").val(),  
        obs_acep_5 = $("#obs_acep_5").val(),
        nom_enc_5 = $("#nom_enc_5").val(),
        fecha_acep_5 = $("#fecha_acep_5").val(),
        nom_enc_6 = $("#nom_enc_6").val(),
        funcion_6= $("#funcion_6").val(),
        fecha_cie_6 = $("#fecha_cie_6").val(),
        estado = $("#estado").val(),
        agregar_m = $("#agregar_m").val();

        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Editar Registro",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_salida_nc.php",
      type: "POST",
      data: {
        

        "id_s" : id_s,
        "serie" : serie,
        "area" : area,
        "proyecto" : proyecto,
        "proyecto_v" : proyecto_v,
        "accion_a" : accion_a,
        "etapa" : etapa,
        "ubicacion" : ubicacion,
        "desc_sal_1" : desc_sal_1,
        "nom_enc_1" : nom_enc_1,
        "funcion_1" : funcion_1,
        "origen_1" : origen_1,
        "fecha_sa_1" : fecha_sa_1,
        "evidencia_1" : evidencia_1,
        "desc_ac_in_2" : desc_ac_in_2,
        "nom_enc_2" : nom_enc_2,
        "funcion_2" : funcion_2,
        "fecha_ac_in_2" : fecha_ac_in_2,
        "desc_ana_eva_3" : desc_ana_eva_3,
        "desc_int_3" : desc_int_3,
        "desc_imple_4" : desc_imple_4,
        "nom_enc_4" : nom_enc_4,
        "funcion_4": funcion_4,
        "fecha_ac_co_4" : fecha_ac_co_4,
        "aceptacion_5" : aceptacion_5,  
        "obs_acep_5" : obs_acep_5,
        "nom_enc_5" : nom_enc_5,
        "fecha_acep_5" : fecha_acep_5,
        "nom_enc_6" : nom_enc_6,
        "funcion_6": funcion_6,
        "fecha_cie_6" : fecha_cie_6,
        "agregar_m" : agregar_m,
        "estado" : estado
        
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Se Edito El Registro.","success");
                  setTimeout(function() {
                     window.location.assign("lista_salidanc.php");
                  }, 2000);   
                }else {
                  sweetAlert("Error LLamar Encargado", "", "error");
                }

      },
      error: function(error){

        alert(error);

      }
    });

      } else {
          swal("Cancelado!", "Acción no realizada.", "error");
      }

  });

      }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
e.preventDefault();

      });

});



/*Editar Falla en Caso*/

$(document).ready(function(){

  $("#editar_fal_caso").submit(function(e){

    if ( $("#caso1").val() != "" && $("#fallav").val() != "" && $("#caso_falla").val() != "" && $("#id_fallas").val() != "" ) {


    //variables
    var caso1 = $("#caso1").val(),
        fallav = $("#fallav").val(),
        caso_falla = $("#caso_falla").val(),
        id_fallas = $("#id_fallas").val();
     

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Editar Falla en el Caso",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_caso_falla.php",
      type: "POST",
      data: {
        "caso1": caso1,
        "fallav": fallav,
        "caso_falla": caso_falla,
        "id_fallas": id_fallas
      },
      success: function(resp){
              
               if (resp != 0) {
                  sweetAlert("Exito!","Falla de este Caso fue Editada correctamente.","success");
                  setTimeout(function() {
                    window.location.assign("postventa_detalles.php?num_caso="+caso1);
                  }, 2000);   
                }else {
                  sweetAlert("Ya existen registros asociados", "", "error");
                }

      },
      error: function(error){

        swal(error);

      }
    });

    } else {
      swal("Cancelado!", "Acción no realizada.", "error");
    }

  });

      }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
e.preventDefault();

      });

});


/*Ajax para Registrar Matriz de Riesgo y Oportunidad*/
$(document).ready(function(){

  $("#editar_matriz_ro").submit(function(e){

         if ( $("#proceso").val()  != "" &&
         $("#contexto").val() != "" &&
         $("#part_int").val() != "" &&
         $("#rie_opo").val() != "" &&
         $("#suceso").val() != "" &&
         $("#consecuencia").val() != "" &&
         $("#probabilidad").val() != "" &&
         $("#severidad").val() != "" &&
         $("#optradio").val() != "" &&
         $("#descripcion_2").val() != "" &&
         $("#frecuencia").val() != "" &&
         $("#funcion_1").val() != "" &&
         $("#plazo").val() != "" &&
         $("#eficacia").val() != "" &&
         $("#evidencia1").val() != "" &&
         $("#fecha").val() != "" &&
         $("#caso").val() != "" &&
         $("#estado").val() != ""  )   {

    //variables
    var  proceso = $("#proceso").val(),
         contexto = $("#contexto").val(),
         part_int = $("#part_int").val(),
         rie_opo = $("#rie_opo").val(),
         suceso = $("#suceso").val(),
         consecuencia = $("#consecuencia").val(),
         probabilidad = $("#probabilidad").val(),
         severidad = $("#severidad").val(),
         optradio = $("#optradio").val(),
         descripcion_2 = $("#descripcion_2").val(),
         frecuencia = $("#frecuencia").val(),
         funcion_1 = $("#funcion_1").val(), 
         plazo = $("#plazo").val(),
         eficacia = $("#eficacia").val(),
         evidencia1 = $("#evidencia1").val(),
         fecha = $("#fecha").val(),
         caso = $("#caso").val(),
         estado = $("#estado").val();

        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Editar Matriz",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_matriz_ro.php",
      type: "POST",
      data: {
        
        "proceso"  : proceso ,
        "contexto" : contexto ,
        "part_int" : part_int ,
        "rie_opo" : rie_opo ,
        "suceso" : suceso ,
        "consecuencia" : consecuencia ,
        "probabilidad" : probabilidad ,
        "severidad" : severidad ,
        "optradio" : optradio ,
        "descripcion_2" : descripcion_2 ,
        "frecuencia" : frecuencia ,
        "funcion_1" : funcion_1 ,
        "plazo" :plazo  ,
        "eficacia" :eficacia ,
        "evidencia1" : evidencia1,
        "fecha" : fecha,
        "caso" : caso,
        "estado" : estado
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Se ha Editado Matriz.","success");
                  setTimeout(function() {
                    window.location.assign("lista_matriz_ro.php");
                  }, 2000);   
                }else {
                  sweetAlert("Error LLamar Encargado", "", "error");
                }

      },
      error: function(error){

        alert(error);

      }
    });

      } else {
          swal("Cancelado!", "Acción no realizada.", "error");
      }

  });

      }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
e.preventDefault();

      });

});


/*Ajax para Registrar Matriz de Documentos*/
$(document).ready(function(){

  $("#editar_matriz_doc").submit(function(e){

    if ( $("#id_doc").val() != ""
     
      && $("#origen").val() != ""
      && $("#tip_doc").val() != ""
      && $("#mproceso").val() != ""
      && $("#numerodoc").val() != ""
      && $("#nombre").val() != ""
      && $("#n_version").val() != ""
      && $("#estado_ver").val() != ""
      && $("#fecha_elab").val() != ""
      && $("#ubicacion").val() != ""
      && $("#observacion").val() != ""
     


       )  {




    //variables
    var id_doc = $("#id_doc").val(),
        codigo_serie = $("#codigo_serie").val(),
        origen = $("#origen").val(),
        tip_doc = $("#tip_doc").val(),
        mproceso = $("#mproceso").val(),
        numerodoc = $("#numerodoc").val(),
        nombre = $("#nombre").val(),
        n_version = $("#n_version").val(),
        estado_ver = $("#estado_ver").val(),
        fecha_elab = $("#fecha_elab").val(),
        ubicacion = $("#ubicacion").val(),
        observacion = $("#observacion").val(),
        responsable = $("#responsable").val(),
        responsable1 = $("#responsable1").val(),
        responsable2 = $("#responsable2").val(),
        responsable3 = $("#responsable3").val(),
        responsable4 = $("#responsable4").val(),
        almacenamiento = $("#almacenamiento").val(), 
        proteccion = $("#proteccion").val(),
        recuperacion = $("#recuperacion").val(),
        retencion = $("#retencion").val(),
        disposicion = $("#disposicion").val();

        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Editar",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_mat_doc.php",
      type: "POST",
      data: {

        "id_doc" : id_doc,
        "codigo_serie" : codigo_serie, 
        "origen" : origen,
        "tip_doc" : tip_doc,
        "mproceso" : mproceso,
        "numerodoc" : numerodoc,
        "nombre" : nombre,
        "n_version" : n_version,
        "estado_ver" : estado_ver,
        "fecha_elab" : fecha_elab,
        "ubicacion" : ubicacion,
        "observacion" : observacion,
        "responsable" : responsable,
        "responsable1" : responsable1,
        "responsable2" : responsable2,
        "responsable3" : responsable3,
        "responsable4" : responsable4,
        "almacenamiento" : almacenamiento,
        "proteccion" : proteccion,
        "recuperacion" : recuperacion,
        "retencion" : retencion,
        "disposicion" : disposicion
        
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Se ha Editado El Documento.","success");
                  setTimeout(function() {
                    window.location.assign("lista_matriz_doc.php");
                  }, 2000);   
                }else {
                  sweetAlert("Error LLamar Encargado", "", "error");
                }

      },
      error: function(error){

        alert(error);

      }
    });

      } else {
          swal("Cancelado!", "Acción no realizada.", "error");
      }

  });

      }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
e.preventDefault();

      });

});



/*Ajax para Editar de estadistica*/
$(document).ready(function(){

  $("#editar_estad").submit(function(e){

    if (  $("#id_estadistica").val() != "" && $("#proyectov").val() != "" && $("#fecha").val() != ""  )  {

    //variables
    var proyecto = $("#proyecto").val(),
        fecha = $("#fecha").val(),
        perdidos = $("#perdidos").val(),
        arrastrados = $("#arrastrados").val(),
        accidentados = $("#accidentados").val(),
        profesionales = $("#profesionales").val(),
        proyectov = $("#proyectov").val(),
        id_estadistica = $("#id_estadistica").val();
        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Editar Estadistica",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/edit_estadistica.php",
      type: "POST",
      data: {
        
        "id_estadistica" : id_estadistica,
        "proyecto" : proyecto,
        "proyectov" : proyectov,
        "fecha" : fecha,
        "perdidos" : perdidos,
        "arrastrados" : arrastrados,
        "accidentados" : accidentados,
        "profesionales" : profesionales

        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Se ha Editado.","success");
                  setTimeout(function() {
                    location.reload(true);
                  }, 2000);   
                }else {
                  sweetAlert("Error LLamar Encargado", "", "error");
                }

      },
      error: function(error){

        alert(error);

      }
    });

      } else {
          swal("Cancelado!", "Acción no realizada.", "error");
      }

  });

      }else {
        //$( "span" ).text( "Not valid!" ).show().fadeOut( 5000 );
        swal("Rellene los campos indicados por favor!");
      }
e.preventDefault();

      });

});