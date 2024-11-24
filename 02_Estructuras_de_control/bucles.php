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
   
    <?php
        echo "<h1>Lista con WHILE</h1>";
        $i = 1;
        echo"<ul>";
        while($i <= 10){
            echo "<li>$i</li>";
            $i++;
        }
        echo"</ul>";

        echo "<h1>Lista con WHILE alternativa</h1>";
        $i = 1;
        echo"<ul>";
        while($i <= 10):
            echo "<li>$i</li>";
            $i++;
        endwhile;
        echo"</ul>";
    ?>
    <!--EJERCICIO 1: MOSTRAR EN UNA LISTA LOS NUMEROS MULTIPLOS DE 3 USANDO WHILE E IF entre 1 y 100-->
    <h1>EJERCICIO 1</h1>
    <?php
    $num = 1; 
    echo "<h2>Los numeros del 1 al 100 que son divisibles entre 3</h2>";
    echo "<ul>";
    while ($num <= 100){
        if($num % 3 == 0){
            echo "<li>$num</li>";
        }
        $num++;
    }
    echo "</ul>";
    ?>
    <h1>EJERCICIO 2</h1>
    <!--EJERCICIO 2: CALCULAR LA SUMA DE LOS NUMEROS PARES ENTRE 1 Y 20-->
    <?php
    $num = 1; 
    $suma = 0;
    while ($num <= 20){
        if($num % 2 == 0){
            $suma += $num; #$suma = $suma + $num;
        }
        $num++;
    }
    echo "<p>La suma de los 20 primeros numeros pares es $suma</p>";
    ?>
    <h1>EJERCICIO 3</h1>
    <!--EJERCICIO 3: CALCULAR EL FACTORIAL DE 6 CON WHILE-->
    <?php
    $num = 6; 
    $i = 1;
    $factorial = 1;
    if($num < 0){
        $factorial = " ";
        echo "ERROR. No se puede calcular el factorial de un numero negativo";
    }
    else{
        while ($i <= $num && $num >= 0){
            $factorial *= $i;
            $i++;
            if($num == 0){
                $factorial = 1;
            }
        }
        echo "El factorial de $num es $factorial";
    }
    ?>

    <h1>LISTA CON FOR</h1>
    <?php
        echo "<ul>";
        for($i = 1; $i <=10; $i++){
            echo "<li>$i</li>";
        }
        echo "</ul>";

        echo "<h1>LISTA CON FOR CON BREAK cursed</h1>";
        echo "<ul>";
        for($i = 1; ; $i++){
            if($i >= 10){
                break;
            }
            echo "<li>$i</li>";
        }
        echo "</ul>";

        echo "<ul>";
        for($i = 1; ; ){
            if($i >= 10){
                break;
            }
            echo "<li>$i</li>";
            $i++;
        }
        echo "</ul>";
        $i = 1;
        echo "<ul>";
        //codigo ofuscado
        for(; ; ){
            if($i >= 10){
                break;
            }
            echo "<li>$i</li>";
            $i++;
        }
        echo "</ul>";

        
    ?>
    <h3>EJERCICIO 5</h3>
    <?php
        $cont = 0;
        $validacion = true;
    for($j = 2; $j<= 50; $j++){
        if ($j == 2){
            echo "<li>$j</li>";
            $cont++;  
        }
        else{   
            for($i = 2; $i < $j; $i++){
                if($j % $i == 0){
                    //NO ES
                    $validacion = false;
                    break;
                }
            }
            if($validacion){
                echo "<li>$j</li>";
                $cont++;
            }
            else{
                $validacion = true;
            }
        }        
    }
    echo "</ol>";
    
    //version profe
    $numero = 2;
    $numerosPrimos = 0;
    echo "<ol>";
    while($numerosPrimos < 50){
        $esPrimo = true;
        for($i = 2; $i < $numero; $i++){
            if($numero % $i == 0){
                $esPrimo = false;
                break;
            }
        }
        if($esPrimo){
            $numerosPrimos++;
            echo "<li>$numero</li>";
        }
        $numero++;
    }
    echo "</ol>";
    ?>
</body>
</html>