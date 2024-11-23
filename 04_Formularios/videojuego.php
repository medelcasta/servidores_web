<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  
        
        function depurar($entrada) : string {
            $salida = htmlspecialchars($entrada);
            $salida = trim($salida);
            $salida = stripslashes($salida);
            $salida = preg_replace('!\s+!', ' ', $salida);
            return $salida;
        }
    ?>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
<!--
    VIDEOJUEGOS
        TITULO => 1-80 caracteres, cualquier caracter (SI)
        consola = Nintendo Switch, PS5, PS4, Xbox Series X/S (radio button)
        fecha lanzamiento => el videojuego mas antiguo adminible sera del 1 de enero de 1947,
         y el más en el futuro no podrá de más de 5 años (dinamico)
        -pegi = 3, 7, 12, 16, 18 (select)
        Descripcion = 0-255 caracteres, cualquier caracter (campo opcional ) - text area


        -LIMPIAR LOS DATOS DEL FORMULARIO Y VALIDARLOS 
        -MOSTRAR TODO POR PANTALLA SI HA PASADO LA VALIDACION
-->

<!--

FORMULARIO + ESTRUCUTRA DE CODIGO
A PAPEL SOLO HARIAMOS LA VALIDACION 
PATRON PARA VALIDAR ALGO 
-->

    <?php 
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmp_titulo = depurar($_POST["titulo"]);
           //$tmp_consola = depurar($_POST["consola"]);
            $tmp_fecha_lanzamiento = depurar($_POST["fecha_lanzamiento"]);
            $tmp_pegi = depurar($_POST["pegi"]);
            $tmp_descripcion = depurar($_POST["descripcion"]);

            if($tmp_titulo == ''){
                $err_titulo = "El titulo es un campo OBLIGATORIO";
            }else{
                if(strlen($tmp_titulo) < 1 || strlen($tmp_titulo) > 80) {
                    $err_nombre = "El nombre debe tener entre 1 y 80 caracteres";
                } else {
                    $titulo = $tmp_titulo;
                } 
            }

            //Para coger el radio button (nos aseguramos que no este vacio)
            if (isset($_POST['consola'])) { 
                $tmp_consola =depurar($_POST['consola']); 

            } else { 
                $tmp_consola = "";
            }

            if($tmp_consola == ''){
                $err_consola = "La consola es obligatoria";
            }else{
                $consola_validas = ["PS5", "PS4", "NintendoSwitch", "XboxSeriesX/S"];
                if(!in_array($tmp_consola, $consola_validas)){
                    $err_consola = "La consola no es valida";
                }else{
                    $consola = $tmp_consola;
                }
            }

            if(!is_numeric($tmp_pegi)){
                $err_pegi = "Pegi es un valor numerico";
            }else{
                $valid_pegi_values = ["3", "5", "7", "12", "16", "18"];
                if(in_array($tmp_pegi, $valid_pegi_values)){
                    $pegi = $tmp_pegi;
                } else {
                    $err_pegi = "Pegi incorrecto";
                }      
            }
            if($tmp_fecha_lanzamiento == '') {
                $err_fecha_lanzamiento = "La fecha de lanzamiento es obligatoria";
            } else {
                $patron = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
                if(!preg_match($patron, $tmp_fecha_lanzamiento)) {
                    $err_fecha_lanzamiento = "Formato de fecha incorrecto";
                } else {
                    list($anno_lanzamiento,$mes_lanzamiento,$dia_lanzamiento) =
                        explode('-',$tmp_fecha_lanzamiento);
                    if($anno_lanzamiento < 1947) {
                        $err_fecha_lanzamiento = "El año no puede ser anterior a 1947";
                    } else {
                        $anno_actual = date("Y");
                        $mes_actual = date("m");
                        $dia_actual = date("d");
    
                        if($anno_lanzamiento - $anno_actual < 5) {
                            $fecha_lanzamiento = $tmp_fecha_lanzamiento;
                        } elseif($anno_lanzamiento - $anno_actual > 5) {
                            $err_fecha_lanzamiento = "La fecha debe ser anterior a dentro de 5 años";
                        } elseif($anno_lanzamiento - $anno_actual == 5) {
                            if($mes_lanzamiento - $mes_actual < 0) {
                                $fecha_lanzamiento = $tmp_fecha_lanzamiento;
                            } elseif($mes_lanzamiento - $mes_actual > 0) {
                                $err_fecha_lanzamiento = "La fecha debe ser anterior a dentro de 5 años";
                            } elseif($mes_lanzamiento - $mes_actual == 0) {
                                if($dia_lanzamiento - $dia_actual <= 0) {
                                    $fecha_lanzamiento = $tmp_fecha_lanzamiento;
                                } elseif($dia_lanzamiento - $dia_actual > 0) {
                                    $err_fecha_lanzamiento = "La fecha debe ser anterior a dentro de 5 años";
                                }
                            }
                        }
                    }
                }
            }

            if(strlen($tmp_descripcion) < 0 || strlen($tmp_descripcion) > 255) {
                    $err_descripcion = "La descripcion debe tener entre 0 y 255 caracteres";
            } else {
                $descripcion = $tmp_descripcion;
            } 
        }
    ?>
    <form action="" method="post">
        <h1>Formulario Videojuego</h1>
        <div>
            <label>Titulo del Videojuego</label>
            <input type="text" name="titulo">
            <?php if(isset($err_titulo)) echo "<span class='error'>$err_titulo</span>" ?>
        </div>
        <div>
            <label>Tipo de Consola</label>
                <div class="form-check">
                    <input type="radio" name="consola" value="NintendoSwitch">
                    <label>Nintendo Switch</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="consola" value="PS5">
                    <label>PS5</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="consola" value="PS4">
                    <label>PS4</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="consola" value="XboxSeriesX/S">
                    <label>Xbox Series X/S</label>
                </div>
            <?php if(isset($err_consola)) echo "<span class='error'>$err_consola</span>" ?>
        </div>
        <div>
            <label>Fecha de lanzamiento</label>
            <input type="date" name="fecha_lanzamiento">
            <?php if(isset($err_fecha_lanzamiento)) echo "<span class='error'>$err_fecha_lanzamiento</span>" ?>
        </div>
        <div>
            <label>PEGI</label>
            <select name="pegi"> 
                <option value="3">3</option> 
                <option value="7">7</option> 
                <option value="12">12</option> 
                <option value="16">16</option> 
                <option value="18">18</option> 
            </select>
            <?php if(isset($err_pegi)) echo "<span class='error'>$err_pegi</span>" ?>
        </div>
        <div>
            <label>Descripción</label>
            <input type="textarea" name="descripcion">
            <?php if(isset($err_descripcion)) echo "<span class='error'>$err_descripcion</span>" ?>
        </div>
        <div>
            <input type="submit" value="Añadir">
        </div>
    </form>
    <?php
        if(isset($titulo) && isset($consola) && isset($fecha_lanzamiento) && isset($descripcion)) { ?>
            <h4>Datos Recogidos</h4>
            <p><?php echo $titulo ?></p>
            <p><?php echo $consola ?></p>
            <p><?php echo $fecha_lanzamiento ?></p>
            <p><?php echo $pegi ?></p>
            <p><?php echo $descripcion ?></p>
        <?php } ?>
</body>
</html>