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
    $peliculas = array(
        array(1,2,3,4),
        [1,2,3,4]
    );
    ?>
    <?php 
    $peliculas =[
         ["Karate a muerte en Torremolinos", "Accion", 1975],
         ["Sharknado 1-5", "Accion", 2015],
         ["Princesa por sorpresa 2", "Comedias", 2008],
         ["Temblores 4", "Terror", 2018],
         ["Cariñom he encogido a los niños", "Aventuras", 2001],
         ["Stuart Little", "Infantil", 2000],
    ];
    /**
     * 1. AÑADIR CON UN RAND, LA DURACION DE CADA PELICULA, LA DURACCION SERA UN NUMERO ALEATORIO ENTRE 30 Y 240
     * 
     * 2. AÑADIR COMO UNA NUEVA COLUMNA, EL TIPO DE PELICULA. EL TIPO SERÁ:
     * - CORTOMETRAJE, SI LA DURACIÓN ES MENOR QUE 60
     * - LARGOMETRAJE, SI LA DURACIÓN ES MAYOR O IGUAL QUE 60
     * 
     * 3. MOSTRAR EN OTRA TABLA, TODAS LAS COLUMNAS Y ORDENAR ADEMAS EN ESTE ORDEN:
     *      1) GENERO
     *      2) AÑO
     *      3) TITULO (TODO ALFABETICAMENTE Y EL AÑO DE MAS RECIENTE A MAS ANTIGUO
     */

    for($i = 0; $i < count($peliculas); $i++){
        $peliculas[$i][3] = rand(30,240);
    }
    for($i = 0; $i < count($peliculas); $i++){
       
        if($peliculas[$i][3] < 60){
            $peliculas[$i][4]="CORTOMETRAJE";
        }else{
            $peliculas[$i][4]="LARGOMETRAJE";
        }
    } 
    

    $_genero = array_column($peliculas, 1);
    $_anio = array_column($peliculas, 2);
    $_titulo = array_column($peliculas, 0);
    
    array_multisort($_genero, SORT_ASC, 
                    $_anio, SORT_DESC,
                    $_titulo, SORT_ASC,
                    $peliculas);
    ?>
    <table>
    <thead>
        <tr>
            <td>Titulo</td>
            <td>Genero</td>
            <td>Año</td>
            <td>Duración</td>
            <td>Categoria</td>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($peliculas as $pelicula){
            list($nombre, $genero, $anio, $duracion, $categoria) = $pelicula;
            echo "<tr>";
            echo "<td>$nombre</td>";
            echo "<td>$genero</td>";
            echo "<td>$anio</td>";
            echo "<td>$duracion</td>";
            echo "<td>$categoria</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
    </table>
    <br><br><br>
    <table>
    <thead>
        <tr>
            <td>Titulo</td>
            <td>Genero</td>
            <td>Año</td>
            <td>Duración</td>
            <td>Categoria</td>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($peliculas as $pelicula){
            list($nombre, $genero, $anio, $duracion, $categoria) = $pelicula;?>
            <tr>
            <td><?php echo $nombre ?></td>
            <td><?php echo $genero ?></td>
            <td><?php echo $anio ?></td>
            <td><?php echo $duracion ?></td>
            <td><?php echo $categoria ?></td>
            </tr>
       <?php } 
        ?>
    </tbody>
    </table>
</body>
</html>