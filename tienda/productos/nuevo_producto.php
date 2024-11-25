<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php 
        require '../util/conexion.php'; 
        require '../util/depurar.php';
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  
    ?>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Añadir Producto</h1>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $precio = $_POST["precio"];
            $categoria = $_POST["categoria"];
            $stock = $_POST["stock"];
            $descripcion = $_POST["descripcion"];
            /**
             * $_FILES -> que es un array BIDIMENSIONAL
             */
            //var_dump($_FILES["imagen"]);
        
            $nombre_imagen = $_FILES["imagen"]["name"];
            $ubicacion_temporal = $_FILES["imagen"]["tmp_name"];
            $ubicacion_final = "../imagenes/$nombre_imagen";

            move_uploaded_file($ubicacion_temporal, $ubicacion_final);

          /* if($tmp_nombre == ''){
                $err_nombre = 'El nombre es obligatorio!';
            }else {
                if(strlen($tmp_nombre) > 255) {
                    $err_nombre = "El nombre no puede contener mas de 50 caracteres";
                } 
                else {
                    $nombre = $tmp_nombre;
                } 
            }

            if($tmp_precio == ''){
                $err_precio = "El precio es obligatorio!";
            }else{
                if(!filter_var($tmp_precio, FILTER_VALIDATE_FLOAT)){
                    $err_precio = "El precio debe ser un numero!";
                }else{
                    $patron = "/^[0-9]{1,4}(\.[0-9]{1,2})$/";
                    if(!preg_match($patron, $tmp_precio)){
                        $err_precio = "El precio no debe superar los 9999, ni ser inferior a 0 ni contener mas de 2 decimales";
                    }else{
                        $precio = $tmp_precio;
                    }
                }
            }

            if($tmp_stock == ''){
                $stock = 0;
            }else{
                if(!filter_var($tmp_precio, FILTER_VALIDATE_INT)){
                    $err_stock = "El stock debe ser un numero entero (sin decimales)!";
                }else{
                    if($tmp_stock > 1000) {
                        $err_stock = "El stock no puede ser superior a 1000";
                    } 
                    else {
                        $stock = $tmp_stock;
                    } 
                }
            }



            if($tmp_descripcion == ''){
                $err_descripcion = 'La descripcion es obligatoria!';
            }else {
                if(strlen($tmp_descripcion) > 255) {
                    $err_descripcion = "La descripcion no puede contener mas de 255 caracteres";
                } 
                else {
                    $descripcion = $tmp_descripcion;
                } 
            }*/
           // if(isset($nombre) && isset($precio) && isset($stock) && isset($descripcion)){
                $sql = "INSERT INTO productos (nombre, precio, categoria, stock, imagen, descripcion) 
                VALUES ('$nombre', $precio, '$categoria', $stock, '$ubicacion_final', '$descripcion')";

                $_conexion -> query($sql);
            //}
            
        }

        $sql = "SELECT * FROM categorias ORDER BY categoria";
        $resultado = $_conexion -> query($sql);
        $categorias_array = []; // aqui añadimos los estudios que encontremos en la base de datos y luego mostraremos este con el select

        while($fila = $resultado -> fetch_assoc()){
            array_push($categorias_array, $fila["categoria"]);
        }
      
        ?>
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input class="form-control" type="text" name="precio">
            </div>
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select class="form-select" name="categoria">
                    <option value="" selected disabled hidden>--Elige la categoria--</option>
                    <?php 
                    foreach($categorias_array as $categoria_array){ ?>
                        <option value="<?php echo $categoria_array ?>">
                            <?php echo $categoria_array ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input class="form-control" type="text" name="stock">
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input class="form-control" type="file" name="imagen">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <input class="form-control" type="textarea" name="descripcion">
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