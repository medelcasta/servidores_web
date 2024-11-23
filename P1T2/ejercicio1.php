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
<?php 
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmp_titulo = depurar($_POST["titulo"]);
            $tmp_paginas = depurar($_POST["paginas"]);
            $tmp_secuela = depurar($_POST["secuela"]);
            $tmp_fecha_publicacion = depurar($_POST["fecha_publicacion"]);
            $tmp_sinopsis = depurar($_POST["sinopsis"]);

            if($tmp_titulo == ''){
                $err_titulo = "El titulo es un campo OBLIGATORIO";
            }else{
                $patron = "/^[a-z-A-Z]{1}[a-zA-Z0-9 áéióúÁÉÍÓÚñÑ.,]+$/";
                if(!preg_match($patron, $tmp_titulo)){
                    $err_titulo = "No empiza por letras ni contiene letras, numeros, punto, comas o espacios en blanco unicamente";
                }else{
                    if(strlen($tmp_titulo) < 1 || strlen($tmp_titulo) > 40) {
                        $err_nombre = "El nombre debe tener entre 1 y 40 caracteres";
                    } else {
                        $titulo = $tmp_titulo;
                    } 
                }    
            }

            if($tmp_paginas == ''){
                $err_paginas = "El número de paginas es un campo obligatorio";
            }else{
                if(!filter_var($tmp_paginas, FILTER_VALIDATE_INT)){
                    $err_paginas = "El número de paginas debe ser un número entero";
                }else{
                    if($tmp_paginas < 10 || $tmp_paginas > 9999){
                        $err_paginas = "El número de peginas debe estar entre 10 y 9999";
                    }else{  
                        $paginas = $tmp_paginas;
                    }
                }
            }

            //Para coger el radio button (nos aseguramos que no este vacio)
            if (isset($_POST['genero'])) { 
                $tmp_genero = depurar($_POST['genero']); 

            } else { 
                $tmp_genero = "";
            }

            if($tmp_genero == ''){
                $err_genero = "El genero es obligatorio";
            }else{
                $genero_validas = ["Fantasia", "CienciaFiccion", "Romance", "Drama"];
                if(!in_array($tmp_genero, $genero_validas)){
                    $err_genero = "El genero no es valido";
                }else{
                    $genero = $tmp_genero;
                }
            }
            if($tmp_secuela == ''){
                $secuela = "no";
            }else{
                $secuela_validos = ["si", "no"];
                if(!in_array($tmp_secuela, $secuela_validos)){
                    $err_secuela = "Opcion no valida para secuela";
                }else{
                    $secuela = $tmp_secuela;
                }
            }
    
            if($tmp_fecha_publicacion == '') {
                $fecha_publicacion = "No se ha introducido la fecha de publicacion";
            } else {
                $patron = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
                if(!preg_match($patron, $tmp_fecha_publicacion)) {
                    $err_fecha_publicacion= "Formato de fecha incorrecto";
                } else {
                    list($anno_publicacion,$mes_publicacion,$dia_publicacion) =
                        explode('-',$tmp_fecha_publicacion);
                    $fecha_mas_antigua = "1800-01-01";
                    if($tmp_fecha_publicacion < 1800){
                        $err_fecha_publicacion = "La fecha no puede ser anterior a 1800";
                    }
                    else {
                        $anno_maximo = date("Y");
                        $mes_maximo = date("m");
                        $dia_maximo = date("d");
    
                        if($anno_publicacion - $anno_maximo < 3) {
                            $fecha_publicacion = $tmp_fecha_publicacion;
                        } elseif($anno_publicacion - $anno_actual > 3) {
                            $err_fecha_publicacion= "La fecha debe ser anterior a dentro de 3 años";
                        } elseif($anno_publicacion - $anno_maximo == 3) {
                            if($mes_publicacion - $mes_maximo < 0) {
                                $fecha_publicacion = $tmp_fecha_publicacion;
                            } elseif($mes_publicacion - $mes_maximo > 0) {
                                $err_fecha_publicacion = "La fecha debe ser anterior a dentro de 3 años";
                            } elseif($mes_publicacion - $mes_maximo == 0) {
                                if($dia_publicacion - $dia_maximo <= 0) {
                                    $fecha_publicacion = $tmp_fecha_publicacion;
                                } elseif($dia_publicacion - $dia_maximo> 0) {
                                    $err_fecha_publicacion = "La fecha debe ser anterior a dentro de 3 años";
                                }
                            }
                        }
                    }
                }
            }
            if($tmp_sinopsis == ''){
                $sinopsis = "No tiene sinopsis";
            }else{
                if(strlen($tmp_sinopsis) > 200) {
                    $err_sinopsis= "La sinopsis no puede tener mas 200 caracteres";
                } else {
                    $patron = "/^[a-zA-Z áéióúÁÉÍÓÚñÑ]+$/";
                    if(!preg_match($patron, $tmp_sinopsis)){
                        $err_sinopsis = "No contiene letras o espacios en blanco unicamente";
                    }else{
                        $sinopsis = $tmp_sinopsis;
                    }    
                }
            } 
        }
            
        
    ?>
    <form action="" method="post">
        <h1>Formulario de Libros</h1>
        <div>
            <label>Titulo</label>
            <input type="text" name="titulo">
            <?php if(isset($err_titulo)) echo "<span class='error'>$err_titulo</span>" ?>
        </div>
        <div>
            <label>Paginas</label>
            <input type="text" name="paginas">
            <?php if(isset($err_paginas)) echo "<span class='error'>$err_paginas</span>" ?>
        </div>
        <div>
            <label>Genero</label>
                <div class="form-check">
                    <input type="radio" name="genero" value="Fantasia">
                    <label>Fantasia</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="genero" value="CienciaFiccion">
                    <label>Ciencia Ficcion</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="genero" value="Romance">
                    <label>Romance</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="genero" value="Drama">
                    <label>Drama</label>
                </div>
            <?php if(isset($err_genero)) echo "<span class='error'>$err_genero</span>" ?>
        </div>
        <div>
            <label>¿Tiene secuela?</label>
            <select name="secuela">
            <option value="no">No</option> 
                <option value="si">Si</option>  
            </select>
            <?php if(isset($err_secuela)) echo "<span class='error'>$err_secuela</span>";?>
        </div>
        <div>
            <label>Fecha de publicacion</label>
            <input type="date" name="fecha_publicacion">
            <?php if(isset($err_fecha_publicacion)) echo "<span class='error'>$err_fecha_publicacion</span>" ?>
        </div>
        <div>
            <label>Sinopsis</label>
            <input type="textarea" name="sinopsis">
            <?php if(isset($err_descripcion)) echo "<span class='error'>$err_sinopsis</span>" ?>
        </div>
        <div>
            <input type="submit" value="Añadir">
        </div>
    </form>
    <?php
        if(isset($titulo) && isset($paginas) && isset($fecha_publicacion)&& isset($genero) && isset($sinopsis)) { ?>
            <h4>Datos Recogidos</h4>
            <p><?php echo "Titulo:" .$titulo ?></p>
            <p><?php echo "Nº de Paginas:" .$paginas ?></p>
            <p><?php echo "Secuela:" .$secuela ?></p>
            <p><?php echo "Fecha de publicacion:" .$fecha_publicacion ?></p>
            <p><?php echo "Genero:" .$genero ?></p>
            <p><?php echo "Sinopsis:" .$sinopsis?></p>
        <?php } ?>
</body>
</html>