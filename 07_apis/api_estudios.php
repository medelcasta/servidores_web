<?php 
    header("Content-Type: application/json");
    include("conexion_pdo.php");

    //Cogemos el metodo con el que accedemos y lo guardamos en una variable
    $metodo = $_SERVER["REQUEST_METHOD"];

    switch ($variable) {
        case "GET":
            //echo json_encode(["mensaje" => "get"]);
            manejarGet();
            break;
        case "POST":
            echo json_encode(["metodo" => "post"]);
            break;
        case "PUT":
            echo json_encode(["metodo" => "put"]);
            break;
        case "DELETE":
            echo json_encode(["metodo" => "delete"]);
            break;     
        default:
            echo json_encode(["metodo" => "otro"]);
            break;
    }

    function manejarGet(){
        $sql = "SELECT * FROM estudios";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute();
        $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC); //Equivalente al getResult de mysqli
        echo json_encode($resultado);
        //echo json_last_error();
    }
?>