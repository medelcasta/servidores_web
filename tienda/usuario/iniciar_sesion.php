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
        require ('../util/conexion.php'); 
    ?>
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $usuario = $_POST["usuario"];
                $contrasena = $_POST["contrasena"];

               $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
               $resultado = $_conexion -> query($sql);
               //var_dump($resultado);

                if($resultado -> num_rows == 0){
                    $err_usuario = "El usuario no existe";
                }else{
                    $datos_usuario = $resultado -> fetch_assoc();
                    /**
                     * Podemos acceder: 
                     * 
                     * $datos_usuario["usuario"];
                     * $datos_usuario["contrasena"];
                     */

                    $acceso_concedido = password_verify($contrasena, $datos_usuario["contrasena"]); //inversa de password hash
                    if($acceso_concedido){
                        //todo guay
                        session_start();
                        $_SESSION["usuario"] = $usuario;
                        //$_COOKIES["loquesea"] = "loquesea";
                        header("location: ../index.php");
                    }else{
                        $err_contrasena = "La contraseña es incorrecta";
                    }
                }
            }
        ?>
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
           
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input class="form-control" type="text" name="usuario">
                <?php if(isset($err_usuario)) echo "<span class='error'>$err_usuario</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input class="form-control" type="password" name="contrasena">
                <?php if(isset($err_contrasena)) echo "<span class='error'>$err_contrasena</span>" ?>
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Iniciar Sesion">
            </div>
            <div class="mb-3">
                <h3>O SI YA TIENES CUENTA</h3>
                <a class="btn btn-secondary" href="registro.php">Registrarse</a>
        <br><br>
            </div>
            
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

        <!--

                SESIONES: informacion almacenada en el servidor 
                (aunque se guarda un id de la sesion en las cookies)

                COOKIES: informacion almacenada en el cliente


        -->