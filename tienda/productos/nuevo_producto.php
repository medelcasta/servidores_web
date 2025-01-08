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
        session_start();
        if(isset($_SESSION["usuario"])){
            echo "<h2>Bienvenid@ ". $_SESSION["usuario"] ."</h2>";
        }else{
            header("location: usuario/iniciar_sesion.php");
            exit;
        }
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
            $tmp_nombre = depurar($_POST["nombre"]);
            $tmp_precio = depurar($_POST["precio"]);
            if(isset($_POST["categoria"])) $tmp_categoria = depurar($_POST["categoria"]);
            else $tmp_categoria = "";
            $tmp_stock = depurar($_POST["stock"]);
            $tmp_descripcion = depurar($_POST["descripcion"]);
        
            $nombre_imagen = $_FILES["imagen"]["name"];
            $ubicacion_temporal = $_FILES["imagen"]["tmp_name"];
            $ubicacion_final = "../imagenes/$nombre_imagen";    

            if($tmp_nombre == ''){
                $err_nombre = 'El nombre es obligatorio!';
            }else {
                if(strlen($tmp_nombre) < 2 ||strlen($tmp_nombre) > 50) {
                    $err_nombre = "El nombre no puede contener mas de 50 caracteres";
                } 
                else {
                    $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]+$/";
                    if(!preg_match($patron, $tmp_nombre)){
                        $err_nombre = "El nombre solo puede contener letras, espacio en blanco y numeros";
                    }else{
                        $nombre = $tmp_nombre;
                    } 
                } 
            }

            if($tmp_precio == ''){
                $err_precio = "El precio es obligatorio!";
            }else{
                if(!filter_var($tmp_precio, FILTER_VALIDATE_FLOAT)){
                    $err_precio = "El precio debe ser un numero!";
                }else{
                    if($tmp_precio < 0 || $tmp_precio > 9999){
                        $err_precio = "El precio no puede ni ser negativo ni superar 9999";
                    }else{
                        $patron = "/^[0-9]{1,4}(\.[0-9]{1,2})?$/";
                        if(!preg_match($patron, $tmp_precio)){
                            $err_precio = "El precio no debe superar los 9999, ni ser inferior a 0 ni contener mas de 2 decimales";
                        }else{
                            $precio = $tmp_precio;
                        }
                    }
                }
            }


            /*
            $sql = "SELECT * FROM categorias ORDER BY categoria";
            $resultado = $_conexion -> query($sql);
            */
            // 1. Preparacion --> le vamos a quitar todas las variables
            $sql = $_conexion -> prepare("SELECT * FROM categorias ORDER BY ?");

            // 2. Enlazado 
            $sql -> bind_param("s", $categoria); 

            // 3. Ejecución
            $sql -> execute();

            // 4. Obtener/ Retrieve (para select que tenga algún parametro)
            $resultado = $sql -> get_result();

            $categorias_array = [];

            while($fila = $resultado -> fetch_assoc()){
                array_push($categorias_array, $fila["categoria"]);
            }

            if($tmp_categoria == ''){
                $err_categoria = 'La categoria es obligatoria!';
            }else {
                if(!in_array($tmp_categoria, $categorias_array)){
                    $err_categoria = "La categoria no es correcta";
                }else{
                    $categoria = $tmp_categoria;
                }
            }

            if($tmp_stock == '' || $tmp_stock == 0){
                $stock = 0;
            }else{
                if(!filter_var($tmp_precio, FILTER_VALIDATE_INT)){
                    $err_stock = "El stock debe ser un numero entero (sin decimales)!";
                }else{
                    if($tmp_stock > 2147483647) {
                        $err_stock = "El stock no puede ser superior a 2147483647";
                    } 
                    else {
                        $stock = $tmp_stock;
                    } 
                }
            }

            if($nombre_imagen == ''){
                $err_imagen = 'El imagen es obligatoria!';
            }else {
                if(strlen($nombre_imagen) > 60) { 
                    $err_imagen= "La imagen no puede contener mas de 60 caracteres";
                } 
                else {
                    move_uploaded_file($ubicacion_temporal, $ubicacion_final);
                    $imagen = $nombre_imagen;
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
            }

           if(isset($nombre) && isset($precio) && isset($stock) && isset($descripcion) && isset($imagen) && isset($categoria)){
                /*
                $sql = "INSERT INTO productos (nombre, precio, categoria, stock, imagen, descripcion) 
                VALUES ('$nombre', $precio, '$categoria', $stock, '$imagen', '$descripcion')";

                $_conexion -> query($sql);
                */
                // 1. Preparacion --> le vamos a quitar todas las variables
                $sql = $_conexion -> prepare("INSERT INTO productos (nombre, precio, categoria, stock, imagen, descripcion) 
                VALUES (?,?,?,?,?,?)");

                // 2. Enlazado 
                $sql -> bind_param("sisiss", 
                    $nombre, 
                    $precio,
                    $categoria,
                    $stock,
                    $imagen,
                    $descripcion 
                ); //se pone s si es string e i si es int (si hubiera decimales se pone d)

                // 3. Ejecución
                $sql -> execute();
            }
            
        }

        /*
        $sql = "SELECT * FROM categorias ORDER BY categoria";
        $resultado = $_conexion -> query($sql);
        */
        // 1. Preparacion --> le vamos a quitar todas las variables
        $sql = $_conexion -> prepare("SELECT * FROM categorias ORDER BY ?");

        // 2. Enlazado 
        $sql -> bind_param("s", $categoria); 

        // 3. Ejecución
        $sql -> execute();

        // 4. Obtener/ Retrieve (para select que tenga algún parametro)
        $resultado = $sql -> get_result();
        
        $categorias_array = [];

        while($fila = $resultado -> fetch_assoc()){
            array_push($categorias_array, $fila["categoria"]);
        }
      
        ?>
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre">
                <?php if(isset($err_nombre)) echo "<span class='error'>$err_nombre</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input class="form-control" type="text" name="precio">
                <?php if(isset($err_precio)) echo "<span class='error'>$err_precio</span>" ?>
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
                <?php if(isset($err_categoria)) echo "<span class='error'>$err_categoria</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input class="form-control" type="text" name="stock">
                <?php if(isset($err_stock)) echo "<span class='error'>$err_stock</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input class="form-control" type="file" name="imagen">
                <?php if(isset($err_imagen)) echo "<span class='error'>$err_imagen</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <input class="form-control" type="textarea" name="descripcion">
                <?php if(isset($err_descripcion)) echo "<span class='error'>$err_descripcion</span>" ?>
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