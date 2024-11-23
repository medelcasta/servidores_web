<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <h1>Completa tus datos</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tmp_dni = $_POST["dni"];
            $tmp_nombre = $_POST["nombre"];
            $tmp_1apellido = $_POST["1apellido"];
            $tmp_2apellido = $_POST["2apellido"];
            $tmp_cumple = $_POST["cumple"];
            $tmp_correo = $_POST["correo"];

            if ($tmp_dni == '') {
                $err_dni = "El dni es obligatorio";
            } else {
                $res = intval(substr($tmp_dni, 0, -1)) % 23;
                $patron = "/^[0-9]{8}[A-Z]$/";
                if (!preg_match($patron, $tmp_dni)) {
                    $err_dni = "No has introducido un dni válido";
                } else {
                    $letra_correcta = match ($res) {
                        0 => "T", 1 => "R", 2 => "W", 3 => "A", 4 => "G", 5 => "M", 6 => "Y", 
                        7 => "F", 8 => "P", 9 => "D", 10 => "X", 11 => "B", 12 => "N", 13 => "J", 
                        14 => "Z", 15 => "S", 16 => "Q", 17 => "V", 18 => "H", 19 => "L", 
                        20 => "C", 21 => "K", 22 => "E"
                    };
                    $letra = strtoupper(substr($tmp_dni, -1));
                    if ($letra !== $letra_correcta) {
                        $err_dni = "Letra incorrecta";
                    } else {
                        $dni = $tmp_dni;
                    }
                }
            }

            if ($tmp_nombre == '') {
                $err_nombre = "El nombre es obligatorio";
            } else {
                if (strlen($tmp_nombre) < 2 || strlen($tmp_nombre) > 40) {
                    $err_nombre = "El nombre debe tener entre 2 y 40 caracteres";
                } else {
                    $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚñÑüÜ]+$/";
                    if (!preg_match($patron, $tmp_nombre)) {
                        $err_nombre = "El nombre solo puede contener letras y espacios en blanco";
                    } else {
                        $nombre = $tmp_nombre;
                    }
                }
            }

            if ($tmp_1apellido == '') {
                $err_apellido1 = "El 1º apellido es obligatorio";
            } else {
                if (strlen($tmp_1apellido) < 2 || strlen($tmp_1apellido) > 60) {
                    $err_apellido1 = "El 1º apellido debe tener entre 2 y 60 caracteres";
                } else {
                    $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚñÑüÜ]+$/";
                    if (!preg_match( $patron, $tmp_1apellido)) {
                        $err_apellido1 = "El 1º apellido solo puede contener letras y espacios en blanco";
                    } else {
                        $apellido1 = $tmp_1apellido;
                    }
                }
            }

            if ($tmp_2apellido == '') {
                $err_apellido2 = "El 2º apellido es obligatorio";
            } else {
                if (strlen($tmp_2apellido) < 2 || strlen($tmp_2apellido) > 60) {
                    $err_apellido2 = "El 2º apellido debe tener entre 2 y 60 caracteres";
                } else {
                    $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚñÑüÜ]+$/";
                    if (!preg_match($patron, $tmp_2apellido)) {
                        $err_apellido2 = "El 2º apellido solo puede contener letras y espacios en blanco";
                    } else {
                        $apellido2 = $tmp_2apellido;
                    }
                }
            }

            if ($tmp_cumple == '') {
                $err_cumple = "La fecha de nacimiento es obligatoria";
            } else {
                //$patron = "/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/"; YYYY-MM-DD
                $patron = "/^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-(19|20)\d{2}$/";
                if (!preg_match($patron, $tmp_cumple)) {
                    $err_cumple = "Formato de fecha no válido. Usa DD-MM-YYYY.";
                } else {
                    list($dia, $mes, $anio) = explode('-', $tmp_cumple);
                    if (!checkdate($mes, $dia, $anio)) {
                        $err_cumple = "Fecha no válida.";
                    } else {
                        $edad = (int)date('Y') - (int)$anio;
                        if ($edad < 0 || $edad > 120) {
                            $err_cumple = "Edad no válida.";
                        } else {    
                            if($edad < 18){
                                $err_cumple = "Es menor de edad";
                            }else{
                                $cumple = $tmp_cumple;
                            }
                        }
                    }
                }
            }

            if ($tmp_correo == '') {
                $err_correo = "El correo electrónico es obligatorio";
            } else {
                if (!filter_var($tmp_correo, FILTER_VALIDATE_EMAIL)) {
                    $err_correo = "Formato de correo electrónico no válido";
                } else {
                    $correo = $tmp_correo;
                }
            }
        }
        ?>
            <div>
                <label>DNI</label>
                <input type="text" name="dni">
                <?php 
                    if(isset($err_dni)) echo "<span class='error'>$err_dni</span>";
                ?>
            </div>
            <div>
                <label>Nombre</label>
                <input type="text" name="nombre">
                <?php 
                    if(isset($err_nombre)) echo "<span class='error'>$err_nombre</span>";
                ?>
            </div>
            <div>
                <label>1º Apellido</label>
                <input type="text" name="1apellido">
                <?php 
                    if(isset($err_apellido1)) echo "<span class='error'>$err_apellido1</span>";
                ?>
            </div>
            <div>
                <label>2º Apellido</label>
                <input type="text" name="2apellido">
                <?php 
                    if(isset($err_apellido2)) echo "<span class='error'>$err_apellido2</span>";
                ?>
            </div>
            <div>
                <label>Fecha de Nacimiento</label>
                <input type="text" name="cumple">
                <?php 
                    if(isset($err_cumple)) echo "<span class='error'>$err_cumple</span>";
                ?>
            </div>
            <div>
                <label>Correo Electrónico</label>
                <input type="text" name="correo">
                <?php 
                    if(isset($err_correo)) echo "<span class='error'>$err_correo</span>";
                ?>
            </div>
            <div>
                <input type="submit" value="Enviar">
            </div>   
        </form>
</body>
</html>