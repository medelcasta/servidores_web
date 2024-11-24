<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php 
        require '../util/conexion.php';
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
    ?>
</head>
<body>
<div class="container">
        <h1>Editar Producto</h1>
        <?php

        $id_producto = $_GET["id_producto"];
        $sql = "SELECT * FROM productos WHERE id_producto = $id_producto";
        $resultado = $_conexion -> query($sql);
        
        while($fila = $resultado -> fetch_assoc()) {
            $nombre = $fila["nombre"];
            $precio = $fila["precio"];
            $categoria = $fila["categoria"];
            $stock = $fila["stock"];
            $imagen = $fila["imagen"];
            $descripcion = $fila["descripcion"];
        }

        $sql = "SELECT * FROM categorias ORDER BY categoria";
        $resultado = $_conexion -> query($sql);
        $categorias_array = [];

        while($fila = $resultado -> fetch_assoc()) {
            array_push($categorias_array, $fila["categoria"]);
        }


        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $nombre = $_POST["nombre"];
            $precio = $_POST["precio"];
            $categoria = $_POST["categoria"];
            $stock = $_POST["stock"];
            $descripcion = $_POST["descripcion"];

            $sql = "UPDATE productos SET
                nombre = '$nombre',
                precio = $precio,
                categoria = '$categoria',
                stock = $stock,
                descripcion = '$descripcion'
                WHERE id_producto = $id_producto
            ";

            $_conexion -> query($sql);
        }
        ?>
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre" value="<?php echo $nombre ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input class="form-control" type="text" name="precio" value="<?php echo $precio ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select class="form-select" name="categoria">
                    <option value="<?php echo $categoria ?>" selected hidden><?php echo $categoria ?></option>
                    <?php
                    foreach($categorias_array as $categoria_array) { ?>
                        <option value="<?php echo $categoria_array ?>">
                            <?php echo $categoria_array ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input class="form-control" type="text" name="stock" value="<?php echo $stock ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input class="form-control" type="file" name="imagen" value="<?php echo $imagen ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <input class="form-control" type="textarea" name="descripcion" value="<?php echo $descripcion ?>" >
            </div>
            <div class="mb-3">
                <input type="hidden" name="id_producto" value="<?php echo $id_producto ?>" >
                <input class="btn btn-primary" type="submit" value="Confirmar">
                <a class="btn btn-secondary" href="index.php">Volver</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>