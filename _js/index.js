jQuery(document).ready(function(){

  // swal("Good job!", "You clicked the button!", "success");

  $("#txtCodigoQR").focus();

  //Aqui para realizar una busqueda Manual ingresando el codigo QR
  $("#txtCodigoQR").keyup(function(e){
      if(e.keyCode == 13){
         $("#btnBuscar").trigger("click");
      }
  });

  $("#btnBuscar").click(function(){
      var CodigoQR =  $("#txtCodigoQR").val();
      // $(".ultima-lectura").append('<li>'+CodigoQR+'</li>');

      $("#txtCodigoQR").val("");
      $("#txtCodigoQR").focus();
  });


  let scanner = new Instascan.Scanner({ 
  		  video: document.getElementById('preview'),
  		  mirror: true,
        captureImage: false,
        backgroundScan: true,
        refractoryPeriod: 2000,
  });
  
  Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length == 1) {
        scanner.start(cameras[0]);
        console.log(cameras[0].name);
      } else if(cameras.length >= 2){
        scanner.start(cameras[1]);
        console.log(cameras[1].name);
      }else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error(e);
  });

  scanner.addListener('scan', function (content) {
    //Reproduce sonido de lectura
    var sonido = $("#lectura")[0];
    sonido.play();
    //Aqui instrucciones a realizar con el codigo QR leido
    // $(".ultima-lectura").append('<li>'+content+'</li>');

    $("#txtCodigoQR").val(content);

    var code_ticket =  $("#txtCodigoQR").val();
    var id_asistencia = $("#id_asistencia").val();
    
    $.ajax({
      url: "getUsers.php",
      type: "POST",
      data: {code_ticket,id_asistencia},
      dataType: 'json',
      beforeSend: function() {
          console.log("Procesando....");

      },
      success: function(respuesta) {
        console.log(respuesta);

        if(respuesta.status == 'success'){

          swal({
            title: "Exito!",
            text: respuesta.msg,
            icon: respuesta.status,
            timer: 1000
            });

            

          // swal("Exito!", respuesta.msg, respuesta.status);
        }else{
          swal({
            title: "Info!",
            text: respuesta.msg,
            icon: respuesta.status,
            timer: 1000
            });
          //swal("Info", respuesta.msg, respuesta.status);
        }

        $("#txtCodigoQR").val('');
        $("#txtCodigoQR").focus();
          
      },
      error: function(respuesta) {
          console.log(respuesta);
      }

  });
    
  });//Fin del lector Scanner

  
  $("#txtCodigoQR").on("change", function () {

    // alert($(this).val());
    var code_ticket = $(this).val();
    var id_asistencia = $("#id_asistencia").val();
    $.ajax({
      url: "getUsers.php",
      type: "POST",
      data: {code_ticket,id_asistencia},
      dataType: 'json',
      beforeSend: function() {
          console.log("Procesando....");

      },
      success: function(respuesta) {
        console.log(respuesta.status);

        if(respuesta.status == 'success'){

          swal({
            title: "Exito!",
            text: respuesta.msg,
            icon: respuesta.status,
            timer: 1000
            });

          //swal("Exito!", respuesta.msg, respuesta.status);
        }else{
          swal({
            title: "Info",
            text: respuesta.msg,
            icon: respuesta.status,
            timer: 1000
            });
         // swal("Info", respuesta.msg, respuesta.status);
        }

        $("#txtCodigoQR").val('');
        $("#txtCodigoQR").focus();
          
      },
      error: function(respuesta) {
          console.log(respuesta);
      }

  });

  });



});/*Fin de JQuery*/