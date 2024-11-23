<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3/ FORMULARIOS</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
    ?>
</head>
<body>
    <form action="" method="post">
        <h3>Calculadora de Primos</h3>
        <label for="num1">Número 1: </label>
        <input type="text" name="num1" id="num1">
        <label for="num2">Número 2: </label>
        <input type="text" name="num2" id="num2">
        <input type="submit" value="calcular">
    </form>

    <?php 
    if($_SERVER ["REQUEST_METHOD"] == "POST"){
        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];
        $mayor;
        $menor;
        $esPrimo = true;
        $cont = 0;

        if($num1 > $num2){
           $menor = $num2;
           $mayor = $num1;
        }else{
            $menor = $num1;
            $mayor = $num2;
        }
        if($num1 != '' and $num2 != ''){
            echo "Los numeros primos son: ";
            for($j = $menor; $j<= $mayor; $j++){
                if ($j == 2){
                    echo $j . " ";
                    $cont++;  
                }
                else{   
                    for($i = $menor; $i < $j; $i++){
                        if($j % $i == 0){
                            $esPrimo = false;
                            break;
                        }
                    }
                    if($esPrimo){
                        echo $j . " ";
                        $cont++;
                    }
                    else{
                        $esPrimo = true;
                    }
                }        
            }
        }else{
            echo "<p>Falta información</p>";
        }
    }
    ?>
</body>
</html>