<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
    ?>
</head>
<body>
    <form action="" method="post">
        <label for="numero">Numero: </label>
        <input type="text" name="numero">
        <select name="calculo">
            <option value="factorial">Factorial</option>
            <option value="sumatorio">Sumatorio</option>
        </select>
        <input type="submit" value="Calcular">
    </form>

    <?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $numero = $_POST["numero"];
        $calculo = $_POST["calculo"];
        
        $factorial = 1;
        $i = 1;

        $sumatorio = 0;

        if($calculo == "factorial"){

            if($numero < 0){
                $factorial = " ";
                echo "ERROR. No se puede calcular el factorial de un numero negativo";
            }
            else{
                while ($i <= $numero && $numero >= 0){
                    $factorial *= $i;
                    $i++;
                    if($numero == 0){
                        $factorial = 1;
                    }
                }
                echo "El factorial de $numero es $factorial";
            }
        }

        if($calculo == "sumatorio"){
            for($i = 1; $i<= $numero; $i++){
                $sumatorio += $i;
            }
            echo "El sumatorio de $numero es $sumatorio";
        }
    }
    ?>
</body>
</html>