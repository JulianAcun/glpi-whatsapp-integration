<?php
// 1. Capturamos la informacion cruda que nos estan enviando
$datos_crudos = file_get_contents('php://input');

//2. Verificamos si realmente enviaron algo
if($datos_crudos){
    //3. Guardamos esos datos en un archivo de texto para poder leerlos (esto es clave para QA y debugging)
    file_put_contents('log_mensajes.txt',$datos_crudos .PHP_EOL, FILE_APPEND);
    //4. Respondemos al sistema que envio el mensaje(Postman o Whatsapp)
    echo "Exito: Los datos fueron recibidos y guardados.";

}else {
    echo "El servidor funciona, pero no enviaste ningun dato.";
}
?>