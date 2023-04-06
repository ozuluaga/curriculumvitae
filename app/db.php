 <?php

    $servidor = "localhost"; //127.0.0.1
    $baseDeDatos = "app";
    $usuario = "root";
    $contrasenia = "";

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasenia);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
    /*
    $servidor = "sql210.byethost9.com"; //127.0.0.1
    $baseDeDatos = "b9_33952506_app";
    $usuario = "b9_33952506";
    $contrasenia = "pruebavitae";

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasenia);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }*/


    ?>
    