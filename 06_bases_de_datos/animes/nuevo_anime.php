<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php 
        require 'conexion.php'; 
        session_start();
        if(isset($_SESSION["usuario"])){
            echo "<h2>Bienvenid@ ". $_SESSION["usuario"] ."</h2>";
        }else{
            header("location: usuario/iniciar_sesion.php");
            exit;
        }
    ?>
</head>
<body>
    <div class="container">
        <h1>Nuevo anime</h1>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $titulo = $_POST["titulo"];
            $nombre_estudio = $_POST["nombre_estudio"];
            $anno_estreno = $_POST["anno_estreno"];
            $num_temporadas = $_POST["num_temporadas"];
            /**
             * $_FILES -> que es un array BIDIMENSIONAL
             */
            //var_dump($_FILES["imagen"]);
            $nombre_imagen = $_FILES["imagen"]["name"];
            $ubicacion_temporal = $_FILES["imagen"]["tmp_name"];
            $ubicacion_final = "./imagenes/$nombre_imagen";

            move_uploaded_file($ubicacion_temporal, $ubicacion_final);

            /*
            $sql = "INSERT INTO animes (titulo, nombre_estudio, anno_estreno, num_temporadas, imagen) 
                VALUES ('$titulo', '$nombre_estudio', $anno_estreno, $num_temporadas, '$ubicacion_final')";

            $_conexion -> query($sql);
            */
            /**
             * SABER HACER ESTO A PAPEL !!!!! 1º PRACTICA IMP
             * VAMOS A TENER AHORA LA SENTENCIA PREPARADA
             * Las 3 etapas de las prepared stataments
             * 
             * 1. Preparación
             * 2. Enlazado (binding)
             * 3. Ejecución
             */

            // 1. Preparacion --> le vamos a quitar todas las variables
            $sql = $_conexion -> prepare("INSERT INTO animes
                (titulo, nombre_estudio, anno_estreno, num_temporadas, imagen)
                VALUES (?,?,?,?,?)");

            // 2. Enlazado 
            $sql -> bind_param("ssiis", 
                $titulo, 
                $nombre_estudio, 
                $anno_estreno, 
                $num_temporadas, 
                $ubicacion_final
            ); //se pone s si es string e i si es int (si hubiera decimales se pone d)

            // 3. Ejecución
            $sql -> execute();


        }

        /*
        $sql = "SELECT * FROM estudios ORDER BY nombre_estudio";
        $resultado = $_conexion -> query($sql);*/
        // 1. Preparacion --> le vamos a quitar todas las variables
        $sql = $_conexion -> prepare("SELECT * FROM estudios ORDER BY ?");

        // 2. Enlazado 
        $sql -> bind_param("s", $nombre_estudio); 

        // 3. Ejecución
        $sql -> execute();

        // 4. Obtener/ Retrieve (para select que tenga algún parametro)
        $resultado = $sql -> get_result();
        
        $_conexion -> close(); // se pone despues de la ultima sentencia sql.
        $estudios = []; // aqui añadimos los estudios que encontremos en la base de datos y luego mostraremos este con el select

        while($fila = $resultado -> fetch_assoc()){
            array_push($estudios, $fila["nombre_estudio"]);
        }

        //print_r($estudios);

        
        ?>
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input class="form-control" type="text" name="titulo">
            </div>
            <div class="mb-3">
                <label class="form-label">Año estreno</label>
                <input class="form-control" type="text" name="anno_estreno">
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre estudio</label>
                <select class="form-select" name="nombre_estudio">
                    <option value="" selected disabled hidden>--Elige el estudio--</option>
                    <?php 
                    foreach($estudios as $estudio){ ?>
                        <option value="<?php echo $estudio ?>">
                            <?php echo $estudio ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Número de temporadas</label>
                <input class="form-control" type="text" name="num_temporadas">
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input class="form-control" type="file" name="imagen">
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Insertar">
                <a class="btn btn-secondary" href="index.php">Volver</a>
        <br><br>
            </div>
            
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>