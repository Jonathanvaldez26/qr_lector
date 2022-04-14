<?php 
require 'BDconect.php';
$id_asistencia = $_GET['asistencia'];
$sql = "SELECT * FROM asistencias WHERE id_asistencia  = '$id_asistencia'"; 
$query = $connect -> prepare($sql); 
$query -> execute(); 
$result = $query -> fetch(PDO::FETCH_ASSOC);

$query->connect = null;
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>MUSA Lector</title>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="description" content="www.marco.presting.pro">
		<meta name="author" content="Ing. Marco Antonio González Martinez">
		<meta name="robots" content="index, follow">
		<meta name="googlebot" content="index, follow">
		<link rel="icon" href="favicon.png">
		<link rel="stylesheet" type="text/css" href="plugins/Bootstrap-3.3.7/css/bootstrap.css"/>
		<link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="plugins/jQuery-3.3.1/jquery-3.3.1.js"></script>
		<script type="text/javascript" src="plugins/Bootstrap-3.3.7/js/bootstrap.js"></script>
		<script type="text/javascript" src="plugins/instascan/instascan.min.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<link rel="stylesheet" href="_css/instascan.min.css">

		<link rel="stylesheet" href="_css/index.min.css">		
		<script type="text/javascript" src="_js/index.js"></script>
	</head>
	<body>
		<div class="container" style="width: 98%;">
			<div class="row">
				<div class="col-lg-offset-4 col-lg-4 col-md-offset-2 col-md-8 col-sm-offset-1 col-sm-10 col-xs-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-qrcode fa-lg"></i> &nbsp;REGISTRO ASISTENCIA <?=$result['nombre']?> </h3>
						</div>
						<div class="panel-body">
						<input id="id_asistencia" name="id_asistencia" type="hidden" class="form-control" placeholder="Asistecia" aria-describedby="sizing-addon1" value="<?= $_GET['asistencia'] ?>" >
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-qrcode fa-lg"></i>
									</span>
									<input id="txtCodigoQR" name="txtCodigoQR" type="text" class="form-control" placeholder="Codigo QR" maxlength="6"  aria-describedby="sizing-addon1">
									<span class="input-group-addon" style="padding:1px;">
										<button id="btnBuscar" name="btnBuscar" type="button" class="btn btn-primary btn-sm"><i class="fa fa-search fa-lg"></i></button>
									</span>
								</div>
							</div>
							<div class="contenedor" style="position:relative;">
								<div class="luz-lector">
									<img class="animate" src="img/luz_lector.png" alt="">
								</div>
								<video id="preview" style="border: 1px solid #CCC; border-radius: 5px; width: 100%; position: relative;">
								</video>
							</div>
						</div>
						<div class="panel-footer">
							<!-- <strong>Últimas Lecturas:</strong>
						<ul class="ultima-lectura"></ul> -->
						<audio id="lectura">
		                	<source src="_js/sounds/success.mp3">
		              	</audio>
						</div>
					</div>
				</div>
			</div>


			<!-- <div class="row">
				<div class="col-lg-offset-4 col-lg-4 col-md-offset-2 col-md-8 col-sm-offset-1 col-sm-10 col-xs-12">
					<div class="well">
						<ul>
							<li><a href="https://code.jquery.com/jquery/" title="" target="_blank">jQuery 3.3.1</a></li>
							<li><a href="https://getbootstrap.com/docs/3.3/" title="" target="_blank">Bootstrap 3.3.7</a></li>
							<li><a href="https://fontawesome.com/v4.7.0/" title="" target="_blank">Font Awesome 4.7.0</a></li>
							<li><a href="https://github.com/schmich/instascan/" title="" target="_blank">Instascan</a></li>
						</ul>
					</div>
				</div>
			</div> -->
		</div>
	</body>
</html> 