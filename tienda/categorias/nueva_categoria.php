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
                if(strlen($tmp_categoria) > 30) {
                    $err_categoria = "La categoria no puede contener mas de 30 caracteres";
                } 
                else {
                    $categoria = ucwords(strtolower($tmp_categoria));
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
                $sql = "INSERT INTO categorias (categoria, descripcion) 
                    VALUES ('$categoria', '$descripcion')";

                $_conexion -> query($sql);
            }
        }

        $sql = "SELECT * FROM categorias ORDER BY categoria";
        $resultado = $_conexion -> query($sql);
        

        
        ?>
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <input class="form-control" type="text" name="categoria">
                <?php if(isset($err_categoria)) echo "<span class='error'>$err_categoria</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <input class="form-control" type="text" name="descripcion">
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