<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!--Crea un array que tenga como keys los DNI de distintas personas y como 
valores sus nombres e imprimelos-->
<?php 
$DNIs = [
    "0909579S" => "Aurora",
    "5675435F"=> "Nicolas",
    "3466443W"=> "Marcos",
    "4567489J"=> "Carla",
    "8693664R"=> "Adrian",
    "000"=> "Eliminar",
];
print_r($DNIs);

echo $DNIs["5675435F"];
//Añadir una persona
$DNIs['24566555P'] = 'Paula';
//Modificar
$DNIs["0909579S"] = 'Aurora Medel';
//eliminar
unset($DNIs['000']);
print_r($DNIs);

foreach( $DNIs as $DNI => $nombre ){
    echo $DNI ." => ". $nombre . "<br>";
}
?>
</body>
</html>