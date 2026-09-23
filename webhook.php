<?php
// 1. Conexión a tu base de datos local (Usuario por defecto en XAMPP es "root" sin contraseña)
$conexion = new mysqli("localhost", "root", "", "glpi_local");

// Verificar si hay error al conectar
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// 2. Capturar los datos JSON que envía Postman (o WhatsApp en el futuro)
$datos_crudos = file_get_contents('php://input');

// Transformar ese texto JSON en un formato que PHP entienda (un Array)
$datos_json = json_decode($datos_crudos, true);

// 3. Verificar que sí llegaron datos válidos
if ($datos_json) {
    // Extraemos cada dato y lo guardamos en una variable
    $cliente = $datos_json['cliente'];
    $equipo = $datos_json['equipo'];
    $falla = $datos_json['falla'];

    // 4. Instrucción SQL para guardar la información en tu tabla
    $sql = "INSERT INTO tickets (cliente, equipo, falla) VALUES ('$cliente', '$equipo', '$falla')";

    // Ejecutamos la instrucción y verificamos si funcionó
    if ($conexion->query($sql) === TRUE) {
        echo "Éxito: El ticket de $cliente fue creado en MySQL.";
    } else {
        echo "Error al guardar en la base de datos: " . $conexion->error;
    }
} else {
    echo "El servidor funciona, pero no enviaste datos JSON válidos.";
}

// Cerramos la conexión
$conexion->close();
?>