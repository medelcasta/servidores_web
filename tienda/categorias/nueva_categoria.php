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
        <h1>Añadir Nueva Categoria</h1>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $tmp_categoria = depurar($_POST["categoria"]);
            $tmp_descripcion = depurar($_POST["descripcion"]);


            if($tmp_categoria == ''){
                $err_categoria = 'La categoria es obligatoria!';

            }else {
                /*
                $sql = "SELECT * FROM categorias WHERE categoria = '$tmp_categoria'";
                $resultado = $_conexion -> query($sql);
                */
                 // 1. Preparacion/ Prepare --> le vamos a quitar todas las variables
                 $sql = $_conexion -> prepare("SELECT * FROM categorias WHERE categoria = ?");

                 // 2. Enlazado/ Bind
                 $sql -> bind_param("s", $categoria);
                 // 3. Ejecución / Execute
                 $sql -> execute(); 
                    
                if($resultado -> num_rows > 0){
                    $err_categoria = "La categoria $tmp_categoria ya existe";
                }else{
                    if(strlen($tmp_categoria) < 2 || strlen($tmp_categoria) > 30) {
                        $err_categoria = "La categoria no puede contener mas de 30 caracteres";
                    } 
                    else {
                        $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/";
                        if(!preg_match($patron, $tmp_categoria)){
                            $err_categoria = "La categoria solo puede contener letras o espacios en blanco";
                        }
                        else{
                            $categoria = $tmp_categoria;
                        }
                    } 
                }
            }

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

            if(isset($categoria) && isset($descripcion)) { 
                /*
                $sql = "INSERT INTO categorias (categoria, descripcion) 
                    VALUES ('$categoria', '$descripcion')";

                $_conexion -> query($sql);
                */
                // 1. Preparacion --> le vamos a quitar todas las variables
                $sql = $_conexion -> prepare("INSERT INTO categorias (categoria, descripcion) 
                VALUES (?,?)");

                // 2. Enlazado 
                $sql -> bind_param("ss", 
                    $categoria, 
                    $descripcion, 
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
        
        ?>
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <input class="form-control" type="text" name="categoria">
                <?php if(isset($err_categoria)) echo "<span class='error'>$err_categoria</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <input class="form-control" type="textarea" rows="4" cols="10" name="descripcion">
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