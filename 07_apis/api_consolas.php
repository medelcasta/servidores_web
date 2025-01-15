<?php 
    error_reporting( E_ALL );
    ini_set("display_errors", 1 );  
    header("Content-Type: application/json"); //Indica que esto es un json
    include("conexion_pdo2.php");

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
            manejarDelete($_conexion, $entrada);
            break;     
        default:
            echo json_encode(["metodo" => "otro"]);
            break;
    }

    function manejarGet($_conexion){
        $sql = "SELECT * FROM consolas";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute();
        $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC); //Equivalente al getResult de mysqli
        echo json_encode($resultado);
    }

    function manejarPost($_conexion, $entrada){
        $sql = "INSERT INTO consolas (nombre, fabricante, generacion, unidades_vendidas)
            VALUES (:nombre, :fabricante, :generacion, :unidades_vendidas)";

        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "nombre" => $entrada["nombre"],
            "fabricante" => $entrada["fabricante"],
            "generacion" => $entrada["generacion"],
            "unidades_vendidas" => $entrada["unidades_vendidas"]
        ]);

        if($stmt){
            echo json_encode(["mensaje" => "el estudio se ha insertado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "error al insertar el estudio"]);
        }
    }

    function manejarDelete($_conexion, $entrada){
        $sql = "DELETE FROM consolas WHERE id_consola = :id_consola";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "id_consola" => $entrada["id_consola"]
        ]);
        if($stmt){
            echo json_encode(["mensaje" => "la consola se ha borrado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "error al borrar la consola"]);
        }
    }
?>