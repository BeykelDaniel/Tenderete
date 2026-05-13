<?php
// 1. Cabeceras obligatorias para que Angular no bloquee la conexión
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

// 2. Conexión a tu base de datos recuperada
$conexion = mysqli_connect("localhost", "root", "", "tenderete");

if (!$conexion) {
    echo json_encode(["error" => "No se pudo conectar a la base de datos"]);
    exit;
}

// 3. Consulta a la tabla 'users' (basada en tu imagen de phpMyAdmin)
$query = "SELECT * FROM actividades";
$res = mysqli_query($conexion, $query);

if ($res && mysqli_num_rows($res) > 0) {
    $datos = mysqli_fetch_all($res, MYSQLI_ASSOC);
    echo json_encode($datos); // Esto enviará el JSON con tus 4 usuarios
} else {
    // Si llegas aquí, es que la tabla está vacía o hubo un error en el SELECT
    echo json_encode([]); 
}
?>
