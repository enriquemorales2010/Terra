/*Ajax para registrar edificio */

$(document).ready(function(){

  $("#agregar_edificio").submit(function(e){

    if ( $( "#nombre_edificio" ).val() != "" && $( "#dir_edificio" ).val() != "") {


    //variables

    var nomb_edificio = $("#nombre_edificio").val(),
        direccion = $("#dir_edificio").val(),
        frec = $("#fecha_rec").val();
        
        

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
                url: "modulos/reg_edificio.php",
                type: "POST",
                data: {
                  "nombre_edificio": nomb_edificio,
                  "dir_edificio": direccion,
                  "fecha_rec": frec

                },
               success: function(resp){

                if (resp != 0) {
                  sweetAlert("Exito!","Edificio registrado correctamente.","success");
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



/*---   AJAX para registro de Usuarios    ---*/
$(document).ready(function(){

  $("#agregar_usr").submit(function(e){

    if ( $( "#rut_usuario" ).val() != "" && $( "#nombre_usuario" ).val() != "" && $("#apellido_usuario").val() != "" && $( "#dir_usuario" ).val() != "" && $( "#email_usuario" ).val() != "" && $( "#pass_usuario" ).val() != "" && $( "#perfil_usuario" ).val() != "") {


    //variables

    var rut = $("#rut_usuario").val(),
        nomb_usuario = $("#nombre_usuario").val(),
        apel_usuario = $("#apellido_usuario").val(),
        direccion = $("#dir_usuario").val(),
        correo = $("#email_usuario").val(),
        clave = $("#pass_usuario").val(),
        perfil= $("#perfil_usuario").val();
        

        swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, registrar usuario",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {
              
              //ajax
              $.ajax({
                url: "modulos/reg_usuario.php",
                type: "POST",
                data: {
                  "rut_usuario": rut,
                  "nombre_usuario": nomb_usuario,
                  "apellido_usuario": apel_usuario,
                  "dir_usuario": direccion,
                  "email_usuario": correo,
                  "pass_usuario": clave,
                  "perfil_usuario": perfil

                },
               success: function(resp){

                if (resp != 0) {
                  sweetAlert("Exito!","Usuario registrado correctamente.","success");
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

/*---   AJAX para registro de Transportistas   ---*/
$(document).ready(function(){

  $("#agregar_transp").submit(function(e){

    if ( $("#ci_transp").val() != "" && $("#nombre_transp").val() != "" && $("#apellido_transp").val() != "" && $("#fechaNac_transp").val() != "" && $("#dir_transp").val() != "" && $("#email_transp").val() != "" && $("#lic_transp").val() != "" &&  $("#tel_transp").val() != "" && $("#cel_transp").val() != "" && $("#nacionalidad").val() != "" && $("#venc_licencia").val() != "" ) {

    //variables

    var cedula = $("#ci_transp").val(),
        nomb_transp = $("#nombre_transp").val(),
        apel_transp = $("#apellido_transp").val(),
        nac_transp = $("#fechaNac_transp").val(),
        direccion = $("#dir_transp").val(),
        correo = $("#email_transp").val(),
        licencia = $("#lic_transp").val(),
        telef_transp = $("#tel_transp").val(),
        cel_transp = $("#cel_transp").val(),
        nacionalidad = $("#nacionalidad").val(),
        venc_licencia = $("#venc_licencia").val();

        swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, registrar transportista",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {



    //ajax
    $.ajax({
      url: "modulos/reg_transp.php",
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
        "nacionalidad": nacionalidad,
        "venc_licencia": venc_licencia
      },
      success: function(resp){

                if (resp != 0) {
                  sweetAlert("Exito!","Transportista registrado correctamente.","success");
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

/*---   AJAX para registro de Vehiculos     ---*/
$(document).ready(function(){

  $("#agregar_vhclo").submit(function(e){

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
        transp_asig = $("#transp_asig").val();

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, registrar vehículo",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/reg_vehiculo.php",
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
        "transp_asig": transp_asig
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Vehículo registrado correctamente.","success");
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

/*---   AJAX para registro de Proveedores   ---*/
$(document).ready(function(){

  $("#agregar_prov").submit(function(e){

    if ( $("#rut").val() != "" && $("#nombre_prov").val() != "" && $("#dir").val() != "" && $("#email").val() != "" && $("#tel_prov").val() != "" && $("#cel_prov").val() != "" ) {

    //variables
    var rut = $("#rut").val(),
        nomb_proveedor = $("#nombre_prov").val(),
        direccion = $("#dir").val(),
        correo = $("#email").val(),
        telef_proveedor = $("#tel_prov").val(),
        cel_proveedor = $("#cel_prov").val();
        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, registrar proveedor",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/reg_proveedores.php",
      type: "POST",
      data: {
        "rut": rut,
        "nombre_prov": nomb_proveedor,
        "dir": direccion,
        "email": correo,
        "tel_prov": telef_proveedor,
        "cel_prov": cel_proveedor
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Proveedor de Material registrado correctamente.","success");
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



/*---   AJAX para registro de Empleado   ---*/
$(document).ready(function(){

  $("#agregar_emp").submit(function(e){

    if( $("#rut").val() != "" && $("#nombre_emp").val() != "" && $("#apellido_emp").val() != "" && $("#fechaNac_emp").val() != "" && $("#dir_emp").val() != "" && $("#cargo_emp").val() != "" ) {
      var  rut = $("#rut").val(),
        nombre = $("#nombre_emp").val(),
        apellido = $("#apellido_emp").val(),
        fecha = $("#fechaNac_emp").val(),
        direccion = $("#dir_emp").val(),
        cargo = $("#cargo_emp").val();
        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, registrar Empleado",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {
        

    //ajax
    $.ajax({
      url: "modulos/reg_empleado.php",
      type: "POST",
      data: {
        "rut": rut,
        "nombre_emp": nombre,
        "apellido_emp": apellido,
        "fechaNac_emp": fecha,
        "dir_emp": direccion,
        "cargo_emp":cargo
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Empleado registrado correctamente.","success");
                  setTimeout(function() {
                    location.reload(true);
                  }, 2000);   
                }else {
                  sweetAlert("Ya existen registros asociados", "La cédula ya se encuentra registrada a otra persona.", "error");
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






/*Ajax para registrar falla*/
$(document).ready(function(){

  $("#reg_fallas").submit(function(e){

    if ( $("#nombre_falla").val() != "" && $("#tipo_fal").val() != "" && $("#cla_fal").val() != "" ) {

    //variables
    var nombre_falla = $("#nombre_falla").val(),
        cla_fal = $("#cla_fal").val(),
        tipo_fal = $("#tipo_fal").val();
        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, registrar Falla",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/reg_falla.php",
      type: "POST",
      data: {
        "nombre_falla": nombre_falla,
        "cla_fal": cla_fal,
        "tipo_fal": tipo_fal
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Falla registrada correctamente.","success");
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


/*Ajax Para Registrar Postventas*/
$(document).ready(function(){

  $("#agregar_postv").submit(function(e){
   
    if ( $("#nom_rec").val() != "" && $("#rut_usu").val() != "" && $("#contrato").val() != "" && $("#fechar").val() != "" && $("#id_ed").val() != "" && $("#num_dep").val() != "" && $("#correo").val() != "" && $("#tel_rec").val() != "" && $("#cel_rec").val() != "" && $("#desc_caso").val() != "" ) {

    //variables
    var nom_rec = $("#nom_rec").val(),
        contrato = $("#contrato").val(),
        fechar = $("#fechar").val(),
        desc_caso = $("#desc_caso").val(),
        id_ed = $("#id_ed").val(),
        num_dep = $("#num_dep").val(),
        correo = $("#correo").val(),
        tel_rec = $("#tel_rec").val(),
        rut_usu = $("#rut_usu").val(),
        cel_rec = $("#cel_rec").val();
        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, registrar",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/reg_postv.php",
      type: "POST",
      data: {
        "nom_rec": nom_rec,
        "contrato": contrato,
        "fechar": fechar,
        "desc_caso": desc_caso,
        "id_ed": id_ed,
        "num_dep": num_dep,
        "correo": correo,
        "tel_rec": tel_rec,
        "cel_rec": cel_rec,
        "rut_usu": rut_usu
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Caso registrado correctamente.","success");
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


/*Ajax para Agregar Seguimiento*/
$(document).ready(function(){

  $("#agr_seguimiento").submit(function(e){

    if ( $("#fecha").val() != "" && $("#caso").val() != "" && $("#desc_seg").val() != "" )  {

    //variables
    var fecha = $("#fecha").val(),
        caso = $("#caso").val(),
        desc_seg = $("#desc_seg").val();

        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, registrar Seguimiento",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/reg_seg.php",
      type: "POST",
      data: {
        "fecha": fecha,
        "caso": caso,
        "desc_seg": desc_seg
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Seguimiento registrado correctamente.","success");
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


/*Ajax para Agregar Seguimiento*/
$(document).ready(function(){

  $("#agre_fall").submit(function(e){

    if ( $("#id_falla").val() != "" && $("#caso").val() != "" )  {

    //variables
    var id_falla = $("#id_falla").val(),
        caso = $("#caso").val();
        

        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, registrar Falla",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/agregar_falla.php",
      type: "POST",
      data: {
        "id_falla": id_falla,
        "caso": caso
        
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Falla registrada correctamente.","success");
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




/*Ajax para registrar clase falla*/
$(document).ready(function(){

  $("#agre_clase_fall").submit(function(e){

    if ( $("#nombre_clase_falla").val() != "" )  {

    //variables
    var nombre_clase_falla = $("#nombre_clase_falla").val();
        

        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, registrar Clase de Falla",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/reg_clase_falla.php",
      type: "POST",
      data: {
        
        "nombre_clase_falla": nombre_clase_falla
        
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Clase de Falla registrada correctamente.","success");
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


/*Ajax para registrar elemento falla*/
$(document).ready(function(){

  $("#agre_tipo_fall").submit(function(e){

    if ( $("#nombre_tipo_falla").val() != "" )  {

    //variables
    var nombre_elem_falla = $("#nombre_elem_falla").val();
        

        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, registrar Elemento de Falla",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/reg_elem_falla.php",
      type: "POST",
      data: {
        
        "nombre_elem_falla": nombre_elem_falla
        
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Elemento Falla registrada correctamente.","success");
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




/*Ajax para Finalizar*/
$(document).ready(function(){

  $("#final_caso").submit(function(e){

    if ( $("#conformidad").val() != "" && $("#fecha_fi").val() != "" && $("#caso").val() != "" )  {

    //variables
    var conformidad = $("#conformidad").val(),
        fecha_fi = $("#fecha_fi").val(),
        caso = $("#caso").val();

        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Finalizar Caso",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/final_caso.php",
      type: "POST",
      data: {
        

        "fecha_fi": fecha_fi,
        "conformidad": conformidad,
        "caso": caso
        
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Se ha Finalizado el Caso.","success");
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


/*Ajax para Registrar Salidas No Conforme*/
$(document).ready(function(){

  $("#reg_salida_nc").submit(function(e){

    if (    $("#id_s").val() != ""
         && $("#area").val() != ""  
         && $("#accion_a").val() != ""  
         && $("#etapa").val() != ""  
         && $("#proyecto").val() != "" 
         && $("#ubicacion").val() != "" 
         && $("#estado").val() != ""
          )  {

    var id_s = $("#id_s").val(),
        area = $("#area").val(),
        accion_a = $("#accion_a").val(),
        etapa = $("#etapa").val(),
        ubicacion = $("#ubicacion").val(),
        proyecto = $("#proyecto").val(),
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
          confirmButtonText: "Si, Ingresar Salida",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/reg_salida_nc.php",
      type: "POST",
      data: {
        

        "id_s" : id_s,
        "area" : area,
        "accion_a" : accion_a,
        "etapa" : etapa,
        "ubicacion" : ubicacion,
        "proyecto" : proyecto,
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
        "funcion_4" : funcion_4,
        "fecha_ac_co_4" : fecha_ac_co_4,
        "aceptacion_5" : aceptacion_5,  
        "obs_acep_5" : obs_acep_5,
        "nom_enc_5" : nom_enc_5,
        "fecha_acep_5" : fecha_acep_5,
        "nom_enc_6" : nom_enc_6,
        "funcion_6": funcion_6,
        "fecha_cie_6" : fecha_cie_6,
        "estado" : estado,
        "agregar_m" : agregar_m
        
        
        
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Se Registro la Salida.","success");
                  setTimeout(function() {
                    window.location.assign("lista_salidanc.php");
                  }, 2000);   
                 }else {
                  sweetAlert("Ya existen registros asociados", "Con ese Numero se encuentro registrada una Salida.", "error");
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


/*Ajax para Registrar Matriz de Riesgo y Oportunidad*/
$(document).ready(function(){

  $("#registrar_matriz_ro").submit(function(e){

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
         $("#evidencia1").val() != "" )   {

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
         evidencia1 = $("#evidencia1").val();

        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Registra Matriz",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/reg_matriz_ro.php",
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
        "eficacia" :eficacia,
        "evidencia1" : evidencia1 
        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Se ha Registrado Matriz.","success");
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

  $("#registro_matriz_doc").submit(function(e){

    if ( $("#id_calculado").val() != ""
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
    var id_calculado = $("#id_calculado").val(),
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
          confirmButtonText: "Si, Registrar",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/reg_mat_doc.php",
      type: "POST",
      data: {

        "id_calculado" : id_calculado,
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
                  sweetAlert("Exito!","Se ha Registrado El Documento.","success");
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


/*Ajax para registrar de estadistica*/
$(document).ready(function(){

  $("#reg_estad").submit(function(e){

    if ( $("#proyecto").val() != "" && $("#fecha").val() != ""  )  {

    //variables
    var proyecto = $("#proyecto").val(),
        fecha = $("#fecha").val(),
        perdidos = $("#perdidos").val(),
        arrastrados = $("#arrastrados").val(),
        accidentados = $("#accidentados").val(),
        profesionales = $("#profesionales").val();

        

         swal({
          title: "Estimado Usuario...",
          text: "Desea realizar la siguiente acción?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ecc71",
          confirmButtonText: "Si, Registrar Estadistica",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function(isConfirm){
            if (isConfirm) {

    //ajax
    $.ajax({
      url: "modulos/reg_estadistica.php",
      type: "POST",
      data: {
        

        "proyecto" : proyecto,
        "fecha" : fecha,
        "perdidos" : perdidos,
        "arrastrados" : arrastrados,
        "accidentados" : accidentados,
        "profesionales" : profesionales

        
      },
      success: function(resp){

               if (resp != 0) {
                  sweetAlert("Exito!","Se ha Registrado.","success");
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