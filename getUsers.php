<?php 
require 'BDconect.php';

$code_ticket = $_POST['code_ticket'];
$id_asistencia = $_POST['id_asistencia'];
$data = [];

$sql = "SELECT ra.*, ua.*
FROM registros_acceso ra
INNER JOIN utilerias_asistentes ua 
ON (ra.id_registro_acceso = ua.id_registro_acceso) 
WHERE ra.ticket_virtual = '$code_ticket'"; 
$query = $connect -> prepare($sql); 
$query -> execute(); 
$results = $query -> fetchAll(); 

if(count($results) > 0){

    //echo $results[0]['utilerias_asistentes_id'];

    $utilerias_asistentes_id = $results[0]['utilerias_asistentes_id'];
    $nombre_completo = $results[0]['nombre']." ".$results[0]['apellido_paterno']." ".$results[0]['apellido_materno'];

    $sql_registros_asistencia = "SELECT ua.*,rasis.*
    FROM utilerias_asistentes ua 
    INNER JOIN registros_asistencia rasis
    ON (ua.utilerias_asistentes_id = rasis.utilerias_asistentes_id) 
    WHERE ua.utilerias_asistentes_id = '$utilerias_asistentes_id' AND rasis.clave =  '$id_asistencia'"; 
    $query_rasis = $connect -> prepare($sql_registros_asistencia); 
    $query_rasis -> execute(); 
    $results_rasis = $query_rasis -> fetchAll();


    if(count($results_rasis) > 0){
        $data = [
            "data" => $results[0],
            "msg" => "El usuario ".$nombre_completo." ya registro su asistencia",
            "status" => "warning"
        ];
    }else{
        //agregar asistencia
        $sql_insert_asistencia = $connect->prepare("INSERT INTO registros_asistencia (id_asistencias, utilerias_asistentes_id, fecha_alta, status) VALUES (:id_asistencias, :utilerias_asistentes_id, NOW(), 1)");
        // Bind
        $sql_insert_asistencia->bindParam(':id_asistencias', $id_asistencia);
        $sql_insert_asistencia->bindParam(':utilerias_asistentes_id', $utilerias_asistentes_id);
        // Excecute
        if($sql_insert_asistencia->execute()){

            $data = [
                "data" => $results[0],
                "msg" => "Se ha registrado la asistencia de ". $nombre_completo,
                "status" => "success"
            ];

        }else{
            $data = [
                "data" => $results[0],
                "msg" => "Hubo un error al registrar el usuario!!",
                "status" => "warning"
            ];
        }

      
    }

}else{

    $data = [    
        "msg" => "Usuario no encontrado en la base de datos!",   
        "status" => "error"
    ];
}

echo json_encode($data);

?>