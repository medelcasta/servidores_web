<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
        require('../05_funciones/iva.php');
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
    ?>
    <style>
        .error{
            color: red;
            font-style: italic;
        }

    </style>
</head>
<body>
<?php 
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmp_precio = $_POST["precio"];
            if(isset($_POST["iva"])) $tmp_iva = $_POST["iva"];
            else $tmp_iva = '';
            
            if($tmp_precio != ''){
                if(filter_var($tmp_precio, FILTER_VALIDATE_FLOAT) !== FALSE){
                    if($tmp_precio >= 0){
                        $precio = $tmp_precio;
                    }else{
                        $err_precio = "El precio debe ser mayor o igual que cero";
                    }
                }else{
                    $err_precio = "El precio debe ser un número";
                }
            }else{
                $err_precio = "El precio es obligatorio";
            }

            if($tmp_iva == ''){
                $err_iva = "El iva es obligatorio";
            }else{
                $valores_validos_iva = ["GENERAL", "REDUCIDO", "SUPERREDUCIDO"];
                //if($tmp_iva != "GENERAL" && $tmp_iva != "REDUCIDO" && $tmp_iva != "SUPERREDUCIDO"){
                if(!in_array($tmp_iva, $valores_validos_iva)){
                    $err_iva =  "EL IVA SOLO PUEDE SER GENERAL, REDUCIDO O SUPERREDUCIDO";
                }else{
                    $iva = $tmp_iva;
                }
            }
        }
        ?>
    
    <form action="" method="post">
        <h3>IVA</h3>
        <label for="precio">Precio</label>
        <input type="text" name="precio" id="precio">
        <?php
            if(isset($err_precio)) echo "<span class='error'>$err_precio</span>";
        ?>
        <br><br>
        <select name="iva">
            <option disabled selected hidden>--- Elige un tipo de IVA ---</option>
            <option value="GENERAL">General</option>
            <option value="REDUCIDO">Reducido</option>
            <option value="SUPERREDUCIDO">Superreducido</option>
        </select>
        <?php
            if(isset($err_iva)) echo "<span class='error'>$err_iva</span>";
        ?>
        <br>
        <input type="submit" value="Calcular">
    </form>

    <?php 
        if(isset($precio) && isset($iva)){
            //calculo la pontencia
            $resultado = calcularIVA($precio, $iva);
            echo "<h1>El PVP es $resultado</h1>";
        }
    ?>

   
</body>
</html>