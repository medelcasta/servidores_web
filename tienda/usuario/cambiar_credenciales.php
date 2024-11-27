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
</head>
<body>
<div class="container">
        <h1>Cambiar contraseña</h1>
        <?php

        $usuario = $_GET["usuario"];
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $resultado = $_conexion -> query($sql);
        while($fila = $resultado -> fetch_assoc()) {
            $usuario = $fila["usuario"];
            $contrasena = $fila["contrasena"];
        }

        $sql = "SELECT * FROM usuarios ORDER BY usuario";
        $resultado = $_conexion -> query($sql);


        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $usuario = depurar($_POST["usuario"]);
            $tmp_contrasena = depurar($_POST["contrasena"]);

            if($tmp_contrasena == ''){
                $err_contrasena= 'La contraseña es obligatoria!';
            }else {
                if(strlen($tmp_contrasena) < 8 || strlen($tmp_contrasena) > 255){
                    $err_contrasena = "La contraseña no puede contener mas de 255 caracteres";
                }else{
                    $patron = "^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$";
                    if(!preg_match($patron, $tmp_contrasena)){
                        $err_contrasena = "La contraseña solo puede contener mayusculas, minusculas, algun numero y caractreres especiales";
                    }else{
                        $contrasena = $tmp_contrasena;
                        $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);
                    }
                }
            }

            if(isset($descripcion)){
                $sql = "UPDATE usuarios SET
                usuario = '$usuario',
                contrasena = '$contrasena'
                WHERE usuario = '$usuario'
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