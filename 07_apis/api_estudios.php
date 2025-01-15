<?php 
    error_reporting( E_ALL );
    ini_set("display_errors", 1 );  
    header("Content-Type: application/json"); //Indica que esto es un json
    include("conexion_pdo.php");

    //Cogemos el metodo con el que accedemos y lo guardamos en una variable
    $metodo = $_SERVER["REQUEST_METHOD"];
    $entrada = json_decode(file_get_contents('php://input'), true);
    /**
     * $entrada["numero"] -> <input name="numero">
     */

    switch ($metodo) {
        case "GET":
            manejarGet($_conexion);
            break;
        case "POST":
            //echo json_encode(["metodo" => "post"]);
            manejarPost($_conexion, $entrada);
            break;
        case "PUT":
            echo json_encode(["metodo" => "put"]);
            break;
        case "DELETE":
            //echo json_encode(["metodo" => "delete"]);
            manejarDelete($_conexion, $entrada);
            break;     
        default:
            echo json_encode(["metodo" => "otro"]);
            break;
    }

    function manejarGet($_conexion){
        $sql = "SELECT * FROM estudios";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute();
        $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC); //Equivalente al getResult de mysqli
        echo json_encode($resultado);
    }

    function manejarPost($_conexion, $entrada){
        $sql = "INSERT INTO estudios (nombre_estudio, ciudad, anno_fundacion)
            VALUES (:nombre_estudio, :ciudad, :anno_fundacion)";

        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "nombre_estudio" => $entrada["nombre_estudio"],
            "ciudad" => $entrada["ciudad"],
            "anno_fundacion" => $entrada["anno_fundacion"]
        ]);

        if($stmt){
            echo json_encode(["mensaje" => "el estudio se ha insertado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "error al insertar el estudio"]);
        }
    }

    function manejarDelete($_conexion, $entrada){
        $sql = "DELETE FROM estudios WHERE nombre_estudio = :nombre_estudio";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "nombre_estudio" => $entrada["nombre_estudio"]
        ]);
        if($stmt){
            echo json_encode(["mensaje" => "el estudio se ha borrado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "error al borrar el estudio"]);
        }
    }
?>