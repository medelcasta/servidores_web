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
            manejarPut($_conexion, $entrada);
            break;
        case "DELETE":
            manejarDelete($_conexion, $entrada);
            break;     
        default:
            echo json_encode(["metodo" => "otro"]);
            break;
    }

    function manejarGet($_conexion){
        if(isset($_GET["nombre_estudio"]) && isset($_GET["desde"]) && isset($_GET["hasta"])){
            $sql = "SELECT * FROM animes WHERE nombre_estudio = :nombre_estudio AND anno_estreno BETWEEN :desde AND :hasta";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute([
                "nombre_estudio" => $_GET["nombre_estudio"],
                "desde" => $_GET["desde"],
                "hasta" => $_GET["hasta"]
            ]);

        } else if(isset($_GET["nombre_estudio"])){
            $sql = "SELECT * FROM animes WHERE nombre_estudio = :nombre_estudio";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute([
                "nombre_estudio" => $_GET["nombre_estudio"]
            ]);
        }else if(isset($_GET["desde"]) && isset($_GET["hasta"])) {
            $sql = "SELECT * FROM animes WHERE anno_estreno BETWEEN :desde AND :hasta";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute([
                "desde" => $_GET["desde"],
                "hasta" => $_GET["hasta"]
            ]);
        } else{
            $sql = "SELECT * FROM animes";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute();
        }

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

    function manejarPut($_conexion, $entrada){
        $sql = "UPDATE animes SET
            titulo = :titulo,
            nombre_estudio = :nombre_estudio,
            anno_estreno = :anno_estreno,
            num_temporadas = :num_temporadas
            WHERE id_anime = :id_anime";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "titulo" => $entrada["titulo"],
            "nombre_estudio" => $entrada["nombre_estudio"],
            "anno_estreno" => $entrada["anno_estreno"],
            "num_temporadas" => $entrada["num_temporadas"],
            "id_anime" => $entrada["id_anime"]
        ]);
        if($stmt){
            echo json_encode(["mensaje" => "el anime se ha actualizado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "error al actualizar el anime"]);
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