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
        <h1>Registro</h1>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $tmp_usuario = depurar($_POST["usuario"]);
                $tmp_contrasena = depurar($_POST["contrasena"]);

                //si se inserta usuario con mismo nombre
                //select * from usuarios num row = 0 para que te puedas registrar
                
                if($tmp_usuario == ''){
                    $err_usuario = "El usuario es obligorio";
                }else{
                    /*
                    $sql = "SELECT * FROM usuarios WHERE usuario = '$tmp_usuario'";
                    $resultado = $_conexion -> query($sql);
                    */
                     // 1. Preparacion --> le vamos a quitar todas las variables
                    $sql = $_conexion -> prepare("SELECT * FROM usuarios WHERE usuario =  ?");

                    // 2. Enlazado 
                    $sql -> bind_param("s", $usuario); 

                    // 3. Ejecución
                    $sql -> execute();

                    // 4. Obtener/ Retrieve (para select que tenga algún parametro)
                    $resultado = $sql -> get_result();
                    if($resultado -> num_rows == 1){
                        $err_usuario = "El usuario $tmp_usuario ya existe";
                    }else{       
                        if(strlen($tmp_usuario) < 3 ||  strlen($tmp_usuario) > 15){
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
                }

                if($tmp_contrasena == ''){
                    $err_contrasena = "La contraseña es obligatoria";
                }else{
                    if(strlen($tmp_contrasena) < 8 || strlen($tmp_contrasena) > 15){
                        $err_contrasena = "La contraseña no puede contener mas de 15 caracteres ni menos de 8";
                    }else{
                        $patron = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
                        if(!preg_match($patron, $tmp_contrasena)){
                            $err_contrasena = "La contraseña debe contener mayusculas, minusculas, algun numero o caractreres especiales";
                        }else{
                            $contrasena = $tmp_contrasena;
                            $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);
                        }
                    }
                }
                
                if(isset($usuario) && isset($contrasena)){
                    /*
                    $sql = "INSERT INTO usuarios VALUES ('$usuario', '$contrasena_cifrada')";

                    $_conexion -> query($sql);
                    */

                    // 1. Preparacion --> le vamos a quitar todas las variables
                    $sql = $_conexion -> prepare("INSERT INTO  usuarios VALUES (?,?)");

                    // 2. Enlazado 
                    $sql -> bind_param("ss", 
                        $usuario, 
                        $contrasena_cifrada
                    ); //se pone s si es string e i si es int (si hubiera decimales se pone d)

                    // 3. Ejecución
                    $sql -> execute();

                    header("location: iniciar_sesion.php");
                    exit;
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
                <input class="btn btn-success" type="submit" value="Registrarse">
            </div>
            <div class="mb-3">
                <h3>Si ya tienes cuenta</h3>
                <a class="btn btn-primary" href="iniciar_sesion.php">Iniciar Sesion</a>
        <br><br>
            </div>
            
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>