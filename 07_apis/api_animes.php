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
            manejarDelete($_conexion, $entrada);
            break;     
        default:
            echo json_encode(["metodo" => "otro"]);
            break;
    }

    function manejarGet($_conexion){
        $sql = "SELECT * FROM animes";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute();
        $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC); //Equivalente al getResult de mysqli
        echo json_encode($resultado);
    }

    function manejarPost($_conexion, $entrada){
        $sql = "INSERT INTO animes ( titulo, nombre_estudio, anno_estreno, num_temporadas)
            VALUES ( :titulo, :nombre_estudio, :anno_estreno, :num_temporadas)";

        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "titulo" => $entrada["titulo"],
            "nombre_estudio" => $entrada["nombre_estudio"],
            "anno_estreno" => $entrada["anno_estreno"],
            "num_temporadas" => $entrada["num_temporadas"]
        ]);

        if($stmt){
            echo json_encode(["mensaje" => "el estudio se ha insertado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "error al insertar el estudio"]);
        }
    }
    function manejarDelete($_conexion, $entrada){
        $sql = "DELETE FROM animes WHERE id_anime = :id_anime";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "id_anime" => $entrada["id_anime"]
        ]);
        if($stmt){
            echo json_encode(["mensaje" => "el anime se ha borrado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "error al borrar el anime"]);
        }
    }
?>