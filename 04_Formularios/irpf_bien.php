<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
        require('../05_funciones/irpf.php');
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
        if(isset($_POST["bruto"])) $tmp_bruto = $_POST["bruto"];
        else $tmp_bruto = '';

        if($tmp_bruto != ''){
            if(filter_var($tmp_bruto, FILTER_VALIDATE_FLOAT) !== FALSE){
                if($tmp_bruto >= 0){
                    $bruto = $tmp_bruto;
                }else{
                    $err_bruto = "El salario debe ser mayor o igual que cero";
                }
            }else{
                $err_bruto = "El salario debe ser un número";
            }
        }else{
            $err_bruto = "El salario es obligatoria";
        }
        
        }
    ?>

    <form action="" method="post">
        <label>Salario Bruto</label>
        <input type="text" name="bruto">
        <?php
            if(isset($err_bruto)) echo "<span class='error'>$err_bruto</span>";
        ?>
        <input type="submit" value="Calcular">
    </form>

    <?php 
        if(isset($bruto)){
            //calculo la pontencia
            $resultado = Salario($bruto);
            echo "<h1>El salario es $resultado</h1>";
        }
    ?>
</body>
</html>