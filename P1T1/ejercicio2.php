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
        $menores = [];
        $mayores = [];
        $numeros = [[], []];

        for($i = 0; $i < 5; $i++){
            $menores[] = rand(1, 10);
        }

        for($i = 0; $i < 5; $i++){
            $mayores[] = rand(10, 100);
        }

        array_push($numeros, $menores);
        array_push($numeros, $mayores);

        echo "<h4>Lista menores</h4>";

        echo "<p>";
        foreach($menores as $menor){
            echo $menor . ", ";
        }
        echo "</p>";


        $maximo = -1;
        $minimo = 101;
        $sumatorio = 0;
        $media = 0;
        
        for($i = 0; $i< count($menores); $i++){
            if($menores[$i]> $maximo){
                $maximo = $menores[$i];
            }
            if($menores[$i] < $minimo){
                $minimo = $menores[$i];
            }
            $sumatorio += $menores[$i];
        }
        $media = $sumatorio / count($menores);
        echo "<p>Maximo: ". $maximo . "</p>";
        echo "<p>Minimo: ". $minimo . "</p>";
        echo "<p>Media: ". $media . "</p>";
        
        echo "<h4>Lista mayores</h4>";
        echo "<p>";
        foreach($mayores as $mayor){
            echo $mayor . ", ";
        }
        echo "</p>";

        $maximo = -1;
        $minimo = 101;
        $sumatorio = 0;
        $media = 0;

        for($i = 0; $i< count($mayores); $i++){
            if($mayores[$i] > $maximo){
                $maximo = $mayores[$i];
            }
            if($mayores[$i] < $minimo){
                $minimo = $mayores[$i];
            }
            $sumatorio += $mayores[$i];
        }
        $media = $sumatorio / count($mayores);
        echo "<p>Maximo: ". $maximo . "</p>";
        echo "<p>Minimo: ". $minimo . "</p>";
        echo "<p>Media: ". $media . "</p>";
        
    ?>

</body>
</html>