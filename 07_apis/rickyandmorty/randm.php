<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <?php 
        $apiUrl = "https://rickandmortyapi.com/api/character";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $personajes = $datos["results"];
    ?>
    <form method="GET" action="">
        <label>Cantidad de personajes</label>
        <input type="text" name="cantidad">
        <br>

        <label>Genero</label>
        <select name="genero">
            <option value="Female">Female</option>
            <option value="Male">Male</option>
        </select>
        <br>

        <label>Especie</label>
        <select name="especie">
            <option value="Human">Human</option>
            <option value="Alien">Alien</option>
        </select>
        <br>
        <input type="submit" value="Buscar">
    </form>
    <?php 
        if (isset($_GET["genero"]) && isset($_GET["cantidad"]) && isset($_GET["especie"])) {
            $genero = $_GET["genero"];
            $cantidad = $_GET["cantidad"];
            $especie = $_GET["especie"];
            $contador = 0;

            foreach ($personajes as $personaje) {
                if ($contador >= $cantidad) break;
                if ($personaje["gender"] == $genero && $personaje["species"] == $especie) {
                    $contador++; ?>
                    <div>
                        <img src="<?php echo $personaje['image']; ?>" alt="<?php echo $personaje['name']; ?>">
                        <p>Nombre: <?php echo $personaje['name']; ?></p>
                        <p>Género: <?php echo $personaje['gender']; ?></p>
                        <p>Especie: <?php echo $personaje['species']; ?></p>
                        <p>Origen: <?php echo $personaje['origin']['name']; ?></p>
                    </div>
                <?php }
            }
        }
    ?>
</body>
</html>