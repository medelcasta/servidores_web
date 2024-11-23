<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $fecha_actual = new DateTime(); 
        $fecha_actual->modify('+5 years'); 
        $fecha_futura = $fecha_actual->format('Y-m-d');
        echo $fecha_futura;
    ?>
</body>
</html>