<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplos</title>
    <link rel="stylesheet"  type= "text/css" href="estilos.css">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
    ?>
</head>
<body>
<?php
/* Todos los arrays en php son asociativos como los map de java

    tienen pares clave - valor y son dinamicos 
*/

$numeros =[5, 6, 7, 8, 4];
$numeros = array(6,10,5,4);
print_r($numeros); #PRINT RELATIONAL

echo "<br></br>";
//$animales = ["Perro", "Gato", "Ornitorrinco"];
$animales = [
    0 => "Perro",
    1 => "Gato",
    2 => "Ornitorrinco",
    3 => "Suricato",
    4 => "Capibara",
];
print_r($animales);
echo "<p>" . $animales[3] . "</p>";
$animales[2] = "Koala";

print_r($animales);
$animales[6] = "Iguana";
$animales["A01"] = "Elefente";
echo "<br>";
print_r($animales);

array_push($animales, "Morsa", "Foca"); // para añadir uno o varios valores sin clave (no rellena huecos)
//para añadir con clave se usa el corchete

$animales[] = "Ganso"; // hace lo mismo que array_push
echo "<br>";
unset($animales[1]); // eliminar elemento por clave
print_r($animales);
echo "<br>";
//RECIBE POR PARAMETRO UN ARRAY Y DEVUELVE OTRO, PERO ME LO INDEXA NUMERICAMENTE
//Cambia la clave que tenga por nº ordenados
$animales = array_values($animales);
print_r($animales);

//funcion para contar
$cantidad_animales = count($animales);
echo "<h3>Hay $cantidad_animales animales</h3>";
//Recorrer un array
echo "<h3>Lista de animales con for</h3>";
echo"<ol>";
for($i = 0; $i < count($animales); $i++){
    echo "<li>". $animales[$i] . "</li>";
}
echo "</ol>";

echo "<h3>Lista de animales con while</h3>";
echo"<ol>";
$i = 0;
while($i < count($animales)){
    echo "<li>". $animales[$i] . "</li>";
    $i++;
}
echo "</ol>";
/*
    "4312 TDZ => "Audi TT";
    "1122" FFF => "Mercedez CLR"
        CREAR EL ARRAY CON 3 COCHES
        AÑADIR 2 COCHES CON MATRICULAS
        AÑADIR 1 COCHE SIN MATRICULA
        BORRAR EL COCHE SIN MATRICULA
        RESETEAR LAS CLAVES Y ALMACENAR EL RESULTADO EN OTRO ARRAY
*/
echo "<br>";
echo "<h2>CREAR EL ARRAY CON 3 COCHES</h2>";
$coches = [
    "4312 TDZ" => "Audi TT",
    "1122 FFF" => "Mercedes CLR",
    "1000KFM" => "Renault Megane",
];
print_r($coches);

echo "<br>";

echo "<h2>AÑADIR 2 COCHES CON MATRICULAS</h2>";
$coches["4567 DDR"] = "Audi Q7";
$coches["6798 KDR"] = "Ferrari";
print_r($coches);

echo "<br>";

echo "<h2>AÑADIR 1 COCHE SIN MATRICULA</h2>";
array_push($coches, "Panamera");
print_r($coches);

echo "<br>";

echo "<h2>BORRAR EL COCHE SIN MATRICULA</h2>";
unset($coches[0]);
print_r($coches);

echo "<br>";

echo "<h2>RESETEAR LAS CLAVES Y ALMACENAR EL RESULTADO EN OTRO ARRAY</h2>";
$coches2 = array_values($coches);
print_r($coches2);

echo "<br>";

//FOR EACH recorre el array y lo va mostrando
echo "<ol>";
foreach($coches as $coche){
    echo "<li>$coche</li>";
}
echo "</ol>";

echo "<h3>Lista de foreach con clava</h3>";
echo "<ol>";
foreach($coches as $matricula => $coche){
    echo "<li>$matricula, $coche </li>";
}
echo "</ol>";
?>
<!--HTML TABLAS-->
<h1>TABLA COCHES</h1>
<table>
    <caption>Coches</caption>
    <thead>
        <tr>
            <th>Matricula</th>
            <th>Coche</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>2133 FSD</td>
            <td>Ferrari 355</td>
        </tr>
            <?php
            foreach($coches as $matricula => $coche){
            echo "<tr>";
            echo "<td>$matricula</td>";
            echo "<td>$coche</td>";
            echo "</tr>"; 
            } 
            ?>
    </tbody>
</table>
<h1>TABLA ANIMALES</h1>
<table>
    <caption>Animales</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Animal</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($animales as $id => $animal){
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$animal</td>";
                echo "</tr>"; 
            } 
        ?>
    </tbody>
</table>
<h1>TABLA for alterantivo</h1>
<table>
    <caption>Animales</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Animal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
            foreach($animales as $id => $animal) { ?>
                <tr>
                    <td><?php echo $id?></td>
                    <td><?php echo $animal?></td>
                </tr>
            <?php } ?>
    </tbody>
</table>
</body>
</html>