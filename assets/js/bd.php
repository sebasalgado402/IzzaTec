<?php
    /* set_time_limit(0); // Ignorar el tiempo de ejecución máximo

    $nombreBD = 'barredadb';
    $tiempoEspera = 0.2;
    
    $context = stream_context_create([
        'socket' => [
            'connect_timeout' => $tiempoEspera, // Establecer tiempo de espera en segundos
        ],
    ]);
   // $conn = @stream_socket_client("localhost", $errno, $errstr, $tiempoEspera, STREAM_CLIENT_CONNECT, $context);
    $conexion = @stream_socket_client("tcp://192.168.2.16:3306", $errno, $errstr, $tiempoEspera, STREAM_CLIENT_CONNECT, $context);
    
    if ($conexion === false) {
        // La conexión no se pudo establecer dentro del tiempo de espera
        $mensajeError = "Error al conectar a la base de datos.";
        
    } else {
        //echo 'se conecto 1';
        $conexion = mysqli_connect("192.168.2.16", "wsserver2", "tabla23", $nombreBD);
        // La conexión se estableció correctamente
        // Realizar las operaciones necesarias con la conexión a la base de datos
        // ...
    }
    
    if (isset($mensajeError)) {
        $conexion = @stream_socket_client("tcp://192.168.2.18:3306", $errno, $errstr, $tiempoEspera, STREAM_CLIENT_CONNECT, $context);
        if ($conexion) {
            //echo 'se conecto 2';
            $conexion = mysqli_connect("192.168.2.18", "wsserver22", "tabla23", $nombreBD);
        }else{
            echo 'no se conecto a nada';
        }
    } */

    $nombreBD = 'barredadb';

    $conexion = mysqli_connect("localhost", "root", "","$nombreBD");
    

    /* 
       $host = "localhost";
        $username="id19677335_barredadb";
        $nombreBD = 'id19677335_barredadb';
        $conexion = mysqli_connect("localhost", "id19677335_admin", "Proyecto(utu)123","$nombreBD");
            if(!$conexion){
                echo "no se ha conectado a la base de datos";
            }
     */
   
    
?>

   