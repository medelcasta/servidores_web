<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php 
        error_reporting( E_ALL );
        ini_set("display_errors", 1 ); 
        require ('../conexion.php'); 
    ?>
</head>
<body>
    <div class="container">
        <h1>Registro</h1>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $usuario = $_POST["usuario"];
                $contrasena = $_POST["contrasena"];

                $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);
                /*
                $sql = "INSERT INTO usuarios VALUES ('$usuario', '$contrasena_cifrada')";
                $_conexion -> query($sql);
                */

                //1. Preparacion
                $sql = $_conexion -> prepare("INSERT * INTO usuario VALUES (?, ?)");

                //2. Enlace
                $sql -> bind_param("ss", $usuario, $contrasena);

                //3. Ejecución 
                $sql -> execute();

                
                header("location: iniciar_sesion.php");
                exit;
            }
        ?>
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
           
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input class="form-control" type="text" name="usuario">
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input class="form-control" type="password" name="contrasena">
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Registrarse">
            </div>
            <div class="mb-3">
                <h3>O SI YA TIENES CUENTA</h3>
                <a class="btn btn-secondary" href="iniciar_sesion.php">Iniciar Sesion</a>
        <br><br>
            </div>
            
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>