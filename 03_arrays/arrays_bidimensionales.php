<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"  type= "text/css" href="estilos.css">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
    ?>
</head>
<body>
    <?php
    $videojuegos = [
        ["Disco Elysium", "RPG", 24.99],
        ["Dragon Ball Z Kakarot", "Acción", 59.99],
        ["Persona 3", "RPG", 24.99],
        [" Commando 2", "Estrategia", 4.99],
        ["Hollow Knight", "Metroidvania", 9.99],
        ["Strardew Valley", "Gestion de recursos", 7.99],
    ];

    $nuevo_juego = ["Octopath Traveler", "RPG", 24.99];
    array_push($videojuegos, $nuevo_juego);

    array_push($videojuegos, ["Ender Lilies", "Metroidvania", 9.95]);

    unset($videojuegos[3]);
    //los indices no se quedan bien es recomendable hacer 
    $videojuegos = array_values($videojuegos);
    print_r($videojuegos);

    array_push($videojuegos, ["Dota 2", "MOBA", 0]);
    array_push($videojuegos, ["Fall Guys", "Plataforma", 0]);
    array_push($videojuegos, ["Rocket League", "Deporte", 0]);
    array_push($videojuegos, ["Lego Fortnite", "Acción", 0]);

    //tipo examen!!!!!!
    for($i = 0; $i < count($videojuegos); $i++){
        if($videojuegos[$i][2] == 0){
            $videojuegos[$i][3]="gratis";
        }else{
            $videojuegos[$i][3]="pago";
        }
    }
    // ordenar array bidimensional
    //1) DESCOMPONER EN COLUMNAS
    $_titulo = array_column($videojuegos, 0);
    $_categoria = array_column($videojuegos, 1);
    $_precio = array_column($videojuegos, 2);

    //2) elegir el tipo por el que quieres ordenar y luego ascendente o descendente
    // si duera descendente, SORT_DESC
    array_multisort($_titulo, SORT_DESC, $videojuegos);

    $_titulo = array_column($videojuegos, 0);
    $_categoria = array_column($videojuegos, 1);
    $_precio = array_column($videojuegos, 2);
    array_multisort($_categoria, SORT_ASC, 
                    $_precio, SORT_DESC,
                    $_titulo, SORT_DESC,
                    $videojuegos);
    ?>
    <table>
        <thead>
            <tr>
                <th>Videojuego</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($videojuegos as $videojuego){
                //print_r($videojuego);
                //echo $videojuego[0]; tambien podemos sacar así las columnas
                //echo "<br><br>";
                /**
                 * $titulo = videojuego[0];
                 * $categoria = videojuego[1];
                 * $precio = videojuego[2];
                 */
                //list: descompone un array en varias variables
                //si el array no es consistente (no es cuadrado) el list da error
                list($titulo, $categoria, $precio, $tipo) = $videojuego;
                echo "<tr>";
                echo "<td>$titulo</td>";
                echo "<td>$categoria</td>";
                echo "<td>$precio</td>";
                echo "<td>$tipo</td>";

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>