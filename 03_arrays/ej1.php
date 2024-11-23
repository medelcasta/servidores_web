<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $pares = [];
    for ($i = 1; $i <= 50; $i++) {
        if ($i %2== 0) {
            $pares[] = $i;
        }
    }
    echo "<h1>Barajados</h1>";
    shuffle($pares);
    echo"<ul>";
    foreach ($pares as $par) {
        echo "<li>$par</li>";
    }
    echo"</ul";
echo "<br>";
    echo "<h1>Ordenados</h1>";
    arsort($pares);
    echo"<ul>";
    foreach ($pares as $par) {
        echo "<li>$par</li>";
    }
    echo"</ul";
    
    ?>
</body>
</html>