jQuery(document).ready(function(){
  $("#txtCodigoQR").focus();

  //Aqui para realizar una busqueda Manual ingresando el codigo QR
  $("#txtCodigoQR").keyup(function(e){
      if(e.keyCode == 13){
         $("#btnBuscar").trigger("click");
      }
  });

  $("#btnBuscar").click(function(){
      var CodigoQR =  $("#txtCodigoQR").val();
      $(".ultima-lectura").append('<li>'+CodigoQR+'</li>');

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
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
        console.log(cameras[0].name);
      } else {
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
    $(".ultima-lectura").append('<li>'+content+'</li>');

    
    
  });//Fin del lector Scanner



});/*Fin de JQuery*/