<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Ejercicio 1" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO 1/ FORMULARIOS</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
    ?>
</head>
<body>
    <h3>Calcula el mayor de 3 numeros</h3>
    <form action="" method="post">
        <label for="num1">Numero 1:</label>
        <input type="text" name="num1" id="num1">
        <label for="num2">Numero 2:</label>
        <input type="text" name="num2" id="num2">
        <label for="num3">Numero 3:</label>
        <input type="text" name="num3" id="num3">
        <input type="submit" value="Calcular Mayor">
    </form>

    <?php 
    //cuando se ejecuta este codigo --> siempre
    if($_SERVER ["REQUEST_METHOD"] == "POST"){
        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];
        $num3 = $_POST["num3"];
        $mayor = $num1;
        if($num1 != '' and $num2 != '' and $num3 != ''){
            if($num2 > $max){
                $max = $num2;
            }

            if($num3 > $max){
                $max = $num3;
            }

            /*$mayor = match(true){   
                $num1 >= $num2 and $num1 >= $num2 => $num1,
                $num2 >= $num1 and $num2 >= $num3 => $num2,
                $num3 >= $num1 and $num3 >= $num2 => $num3,
                
            };*/
            echo "<p>El mayor es $mayor</p>";
        }else {
            echo "<p>Falta informacións</p>";
        }
    }

    
    ?>
</body>
</html>