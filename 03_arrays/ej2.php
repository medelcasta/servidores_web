<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $numeros = [];
    for ($i = 0; $i < 10; $i++) {
        $num_rand = rand(0, 100);
        $numeros[$i] = $num_rand;
    }
    
    echo "<h2>Array original</h2>";
    echo "<ul>";
    foreach ($numeros as $numero) {
        echo "<li>$numero</li>";
    }
    echo "</ul>";

    arsort($numeros);  
    echo "<h2>Array ordenado de mayor a menor</h2>";
    echo "<ul>";
    foreach ($numeros as $numero) {
        echo "<li>$numero</li>";
    }
    echo "</ul>";
    
    asort($numeros);  
    echo "<h2>Array ordenado de menor a mayor</h2>";
    echo "<ul>";
    foreach ($numeros as $numero) {
        echo "<li>$numero</li>";
    }
    echo "</ul>";
    ?>
</body>
</html>