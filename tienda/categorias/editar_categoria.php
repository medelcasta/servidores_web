<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php 
        error_reporting( E_ALL );
        ini_set("display_errors", 1 ); 

        require '../util/conexion.php';
        require '../util/depurar.php';
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
        <h1>Editar Categoria</h1>
        <?php

        $categoria = $_GET["categoria"];
        $sql = "SELECT * FROM categorias WHERE categoria = '$categoria'";
        $resultado = $_conexion -> query($sql);
        while($fila = $resultado -> fetch_assoc()) {
            $categoria = $fila["categoria"];
            $descripcion = $fila["descripcion"];
        }

        $sql = "SELECT * FROM categorias ORDER BY categoria";
        $resultado = $_conexion -> query($sql);


        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $categoria = depurar($_POST["categoria"]);
            $tmp_descripcion = depurar($_POST["descripcion"]);
            
            if($tmp_descripcion == ''){
                $err_descripcion= 'La descripcion es obligatoria!';
            }else {
                if(strlen($tmp_descripcion) > 255) {
                    $err_descripcion = "La descripcion no puede contener mas de 255 caracteres";
                } 
                else {
                    $descripcion = $tmp_descripcion;
                } 
            }

            if(isset($descripcion)){
                $sql = "UPDATE categorias SET
                categoria = '$categoria',
                descripcion = '$descripcion'
                WHERE categoria = '$categoria'
                ";

                $_conexion -> query($sql);
            }
            
        }
        ?>
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <input type="hidden" class="form-control" type="text" name="categoria" value="<?php echo $categoria ?>">
                <input type="disabled" class="form-control" type="text" name="categoria" value="<?php echo $categoria ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <input class="form-control" type="text" name="descripcion" value="<?php echo $descripcion?>">
            </div>
            <div class="mb-3">
                <input type="hidden" name="categoria" value="<?php echo $categoria ?>" >
                <input class="btn btn-primary" type="submit" value="Confirmar">
                <a class="btn btn-secondary" href="index.php">Volver</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>