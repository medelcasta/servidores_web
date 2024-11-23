<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Números</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
    ?>
</head>
<body>
    <?php
    $numero = 2;
    if($numero > 0) {
        echo "<p>1. El numero $numero es mayor que cero </p>";
    } elseif($numero == 0){
        echo "<p>El numero $numero es cero </p>";
    } else{
        echo "<p1> 1 El numero $numero es menor que cero </p>";
    }

    if($numero > 0) echo "<p>2. El numero $numero es mayor que cero </p>";
    elseif($numero == 0) echo "<p>El numero $numero es cero</p>";
    else echo "<p> El numero $numero es menor que cero</p>";
    
    if($numero > 0):
        echo "<p>3. El numero $numero es mayor que cero </p>";
    elseif($numero == 0):
        echo "<p>El numero $numero es cero</p>";
    else:
        echo "<p>El numero $numero es menor que cero</p>";
    endif;
    ?>
    <?php 
    # Rangos [-10, 0)

    $num = -7;
    #and or && para la conjunción

    #Forma 1
    if($num >= -10 and $num <= 0){
        echo "<p> El numero $num esta en el rango [-10, 0)</p>";
    }elseif($num >= 0 && $num <= 10){
        echo "<p>El numero $num esta en el rango [0,10]</p>";
    }elseif($num >= 10 && $num <= 20){
        echo "<p>El numero $num esta en el rango (10,20]</p>";
    }else {
        echo "<p>El numero $num esta fuera del rango";
    }
    #Forma 2
    if($num >= -10 and $num <= 0) echo "<p>El numero $num esta en el rango [-10, 0)</p>";
    elseif($num >= 0 && $num <= 10) echo "<p>El numero $num esta en el rango [0,10]</p>";
    elseif($num >= 10 && $num <= 20) echo "<p>El numero $num esta en el rango (10,20]</p>";
    else echo "<p>El numero $num esta fuera del rango";

    #Forma 3
    if($num >= -10 and $num <= 0):
        echo "<p> El numero $num esta en el rango [-10, 0)</p>";
    elseif($num >= 0 && $num <= 10):
        echo "<p>El numero $num esta en el rango [0,10]</p>";
    elseif($num >= 10 && $num <= 20):
        echo "<p>El numero $num esta en el rango (10,20]</p>";
    else :
        echo "<p>El numero $num esta fuera del rango";
    endif;

    #Numero aleatorio

    $numero_aleatorio = rand(1,200);

    #numero aleatorio con decimales
    $numero_aleatorio_decimales = rand(10,100)/10;

    #Comprobar de 3 formas diferentes, con la estructura if, si el numero aleatorio tiene 1, 2, 3 digitos

    $digitos = null;
    #FORMA1
    if($numero_aleatorio >= 1 && $numero_aleatorio <= 9) $digitos = 1;
    elseif($numero_aleatorio < 100 && $numero_aleatorio >= 10) $digitos = 2;
    elseif($numero_aleatorio < 1000 && $numero_aleatorio >= 100) $digitos = 3;
    else $digitos = "ERROR";

    // VERSION CON MATCH 

    $resultado = match(true){
        $numero_aleatorio >= 1 && $numero_aleatorio <= 9 => 1,
        $numero_aleatorio >= 10 && $numero_aleatorio <= 99 => 2,
        $numero_aleatorio >= 100 && $numero_aleatorio <= 999 => 3,
        default => "ERROR"
    };

    echo "<h1>El numero $numero_aleatorio tiene $digitos digitos </h1>";
    /*
    #FORMA2
    if($numero_aleatorio < 10){
        echo "tiene 1 cifra";
    } 
    elseif($numero_aleatorio <100 && $numero_aleatorio > 10){
        echo "tiene 2 cifras";
    } 
    elseif($numero_aleatorio <1000 && $numero_aleatorio > 100){
        echo "tiene 3 cifras";
    }
    #FORMA3
    if($numero_aleatorio < 10 == 0):
        echo "tiene 1 cifra";
    elseif($numero_aleatorio <100 && $numero_aleatorio > 10):
         echo "tiene 2 cifras";
    elseif($numero_aleatorio <1000 && $numero_aleatorio > 100):
         echo "tiene 3 cifras";
    endif;
*/
    $digitos_texto = "";
    if($digitos == 1) $digitos_texto = "dígito";
    echo "El numero tiene $digitos $digitos_texto";
    echo "El numero $numero_aleatorio tiene $digitos $digitos_texto";
    echo "</p>";

    $n = rand(1,3);

    switch($n){
        case 1:
            echo "El numero es 1";
            break;
        case 2:
            echo "El numero es 2";
            break;
        default:
            echo "El numero es 3";
    }

    $resultado = match($n){
        1 => "El numero es 1", 
        2 => "El numero es 2", 
        3 => "El numero es 3", 
    };

    echo "<h3>$resultado</h3>"

    /*OJO EN EL SWITCH NO SE PUEDEN HACER COMPARACIONES LOGICAS */
    ?>
</body>
</html>