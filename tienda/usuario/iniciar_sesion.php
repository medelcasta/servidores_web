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
        require ('../util/depurar.php');
    ?>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $tmp_usuario = depurar($_POST["usuario"]);
                $tmp_contrasena = depurar($_POST["contrasena"]);

                if($tmp_usuario == ''){
                    $err_usuario = "El usuario es obligorio";
                }else{
                    if(strlen($tmp_usuario) < 3 || strlen($tmp_usuario) > 15){
                        $err_usuario = "El usuario no puede contener mas de 15 caracteres ni menos de 3";
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
                    if(strlen($tmp_contrasena) < 8 || strlen($tmp_contrasena) > 15){
                        $err_contrasena = "La contraseña no puede contener mas de 15 caracteres";
                    }else{
                        $patron = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
                        if(!preg_match($patron, $tmp_contrasena)){
                            $err_contrasena = "La contraseña debe contener mayusculas, minusculas, algun numero o caractreres especiales";
                        }else{
                            $contrasena = $tmp_contrasena;
                        }
                    }
                }

                if(isset($usuario) && isset($contrasena)){
                    /*
                    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
                    $resultado = $_conexion -> query($sql);
                    */
                    // 1. Preparacion --> le vamos a quitar todas las variables
                    $sql = $_conexion -> prepare("SELECT * FROM usuarios WHERE usuario = ?");

                    // 2. Enlazado 
                    $sql -> bind_param("s", $usuario); 

                    // 3. Ejecución
                    $sql -> execute();

                    // 4. Obtener/ Retrieve (para select que tenga algún parametro)
                    $resultado = $sql -> get_result();

                    if($resultado -> num_rows == 0){
                        $err_usuario = "El usuario $usuario no existe";
                    }else{
                        $datos_usuario = $resultado -> fetch_assoc();

                        $acceso_concedido = password_verify($contrasena, $datos_usuario["contrasena"]);
                        if($acceso_concedido){
                            session_start();
                            $_SESSION["usuario"] = $usuario;
                            header("location: ../index.php");
                        }else{
                            $err_contrasena = "La contraseña es incorrecta";
                        }
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
                <a class="btn btn-info" href="../index.php">Volver a Inicio</a>
            </div>
            <div class="mb-3">
                <h3>Si aun no tienes cuenta</h3>
                <a class="btn btn-success" href="registro.php">Registro</a>
            </div>
            
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>