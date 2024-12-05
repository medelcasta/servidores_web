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
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmp_usuario = depurar($_POST["usuario"]);
            $tmp_contrasena = depurar($_POST["contrasena"]);

            if($tmp_usuario == ''){
                $err_usuario = "El usuario es obligorio";
            }else{
                if(strlen($tmp_usuario) < 3 || strlen($tmp_usuario) > 15){
                    $err_usuario = "El usuario no puede contener mas de 15 caracteres";
                }else{
                    $patron = "/^[a-zA-Z0-9]+$/";
                    if(!preg_match($patron, $tmp_usuario)){
                        $err_usuario = "El usuario solo puedo contener numeros y letras";
                    }else{
                        $usuario = $tmp_usuario;
                    }
                }
            }

            if($tmp_contrasena == ''){
                $err_contrasena = "La contraseña es obligatoria";
            }else{
                if(strlen($tmp_contrasena) < 8 || strlen($tmp_contrasena) > 255){
                    $err_contrasena = "La contraseña no puede contener mas de 255 caracteres";
                }else{
                    $patron = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
                    if(!preg_match($patron, $tmp_contrasena)){
                        $err_contrasena = "La contraseña debe contener mayusculas, minusculas, algun numero y caractreres especiales";
                    }else{
                        $contrasena = $tmp_contrasena;
                    }
                }
            }

            if(isset($usuario) && isset($contrasena)){
                $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
                $resultado = $_conexion -> query($sql);
                //var_dump($resultado);

                if($resultado -> num_rows == 0){
                    $err_usuario = "El usuario no existe";
                }else{
                    $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);
                    $sql = "UPDATE usuarios SET
                    contrasena = '$contrasena_cifrada'
                    WHERE usuario = '$usuario'
                    ";

                    $_conexion -> query($sql);
                }
            }
        }         
    
        ?>
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="hidden" class="form-control" type="text" name="usuario" value="<?php echo $usuario ?>">
                <input type="disabled" class="form-control" type="text" name="usuario" value="<?php echo $_SESSION["usuario"] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input class="form-control" type="password" name="contrasena" value="<?php echo $contrasena?>">
            </div>
            <div class="mb-3">
                <input type="hidden" name="categoria" value="<?php echo $categoria ?>" >
                <input class="btn btn-primary" type="submit" value="Confirmar">
                <a class="btn btn-secondary" href="iniciar_sesion.php">Iniciar Sesion</a>
                <a class="btn btn-secondary" href="../index.php">Volver</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>